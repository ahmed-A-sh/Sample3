<?php

namespace App\Http\Controllers;

use App\Actions\ImageActions;
use App\Models\Advice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdviceController extends Controller
{

    public function index(Request $request)
    {
        $out = Advice::filter($request)->orderBy('id', 'DESC')->paginate(20);
        $out->appends($request->all());

        return view('system.advices.index', compact('out',));
    }


    public function create()
    {
        return view('system.advices.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
            'description_ar'=>'required',
            'description_en'=>'required',
            'source_ar'=>'required',
            'source_en'=>'required',
            'youtube_url'=>'required',
            'image'=>'required',
        ]);
        Advice::create([
            'title'=>['ar'=>$request->get('title_ar'),'en'=>$request->get('title_en')],
            'description'=>['ar'=>$request->get('description_ar'),'en'=>$request->get('description_en')],
            'source'=>['ar'=>$request->get('source_ar'),'en'=>$request->get('source_en')],
            'youtube_url'=>$request->youtube_url,
            'image'=>$request->image
        ]);
        ImageActions::deleteUnUsedFiles($request->image);

        if($request->is_ajax == 1){
            flash('تمت الاضافة بنجاح');

            return ['done'=>true];
        }
        flash('تمت الاضافة بنجاح');
        return redirect()->route('system.advices.index');
    }



    public function edit(Advice $advice)
    {
        return view('system.advices.update', compact('advice'));

    }


    public function update(Request $request, Advice $advice)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
            'description_ar'=>'required',
            'description_en'=>'required',
            'source_ar'=>'required',
            'source_en'=>'required',
            'youtube_url'=>'required',
            'image'=>'required',
        ]);
        $advice->update([
            'title'=>['ar'=>$request->get('title_ar'),'en'=>$request->get('title_en')],
            'description'=>['ar'=>$request->get('description_ar'),'en'=>$request->get('description_en')],
            'source'=>['ar'=>$request->get('source_ar'),'en'=>$request->get('source_en')],
            'youtube_url'=>$request->youtube_url,
            'image'=>$request->image
        ]);
        ImageActions::deleteUnUsedFiles($request->image);

        if($request->is_ajax == 1){
            flash('تم التعديل بنجاح');

            return ['done'=>true];
        }
        flash('تم التعديل بنجاح');
        return redirect()->route('system.advices.index');
    }


    public function delete(Request $request)
    {
        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;
        }

        $deleted_count = Advice::whereIn('id',$ids)->delete();

        return ['done' => count($ids) == $deleted_count ? 1 : 0];
    }
    public function activate(Request $request)
    {

        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;
        }

        Advice::whereIn('id',$ids)->update(['status' => 'enabled']);

        return ['done' => 1];
    }
    public function deactivate( Request $request)
    {

        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;
        }

        Advice::whereIn('id',$ids)->update(['status' => 'disabled']);

        return ['done' => 1];
    }
}
