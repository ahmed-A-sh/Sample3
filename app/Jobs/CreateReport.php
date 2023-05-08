<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class CreateReport
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    public $data;
    public $fields;
    public $creator;
    public $title;
    public $title_all;
    public $subject;
    public $description;

    /**
     * @param $data
     */
    public function __construct($data,$fields,$creator='Selsela',$title='Export',$subject=null,$description=null)
    {
        $this->data = $data;
        $this->fields = $fields;
        $this->creator = $creator;
        $this->title = substr($title,0,30);
        $this->title_all = $title;
        $this->subject = $subject??$title;
        $this->description = $description??$title;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $spreadsheet = new Spreadsheet();
        // Set document properties
        $spreadsheet->getProperties()->setCreator($this->creator)
            ->setLastModifiedBy($this->creator)
            ->setTitle($this->title)
            ->setSubject($this->subject)
            ->setDescription($this->description)
            ->setKeywords('office 2007 openxml php')
            ->setCategory($this->title);


        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', '#');
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);

        $cell_Letters=[
            'A','B','C','D','E','F','G','H',
            'I','J','K','L','M','N','O',
            'P','Q','R','S','T','U','V',
            'W','X','Y','Z'
            ];

        $id=0;
        foreach ($this->fields as $field){
            if(isset($cell_Letters[$id + 1])){
                $letter=$cell_Letters[$id + 1];
            }else{
                $index=$id%26;
                $pref=(int) $id/26 -1;
                $letter=$cell_Letters[$pref].$cell_Letters[$index];
            }
            $spreadsheet->getActiveSheet()->setCellValue($letter.'1', $field);
            $spreadsheet->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $id++;
        }

        $i=2;
        foreach ($this->data as $o){
            $id=0;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $i-1);
            foreach ($this->fields as $key=>$field){
                if(isset($cell_Letters[$id + 1])){
                    $letter=$cell_Letters[$id + 1];
                }else{
                    $index=$id%26;
                    $pref=(int) $id/26 -1;
                    $letter=$cell_Letters[$pref].$cell_Letters[$index];
                }
                $spreadsheet->getActiveSheet()->setCellValue($letter.$i, $o[$key]);
                $id++;
            }
            $i++;

        }

// Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle($this->title);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$this->title_all.'.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;

    }
}
