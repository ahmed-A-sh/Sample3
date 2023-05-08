<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $item=new \App\Models\Country();
        $item->name=['ar'=>'الكويت','en'=>'Kuwait'];
        $item->prefix=965;
        $item->mobile_digits=8;
        $item->currency=['ar'=>'دينار كويتي','en'=>'D.K'];
        $item->is_default=1;
        $item->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
