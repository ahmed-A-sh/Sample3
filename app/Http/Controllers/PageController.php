<?php

namespace App\Http\Controllers;

use App\Actions\ImageActions;
use App\Models\Page;
use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Rule;


class PageController extends Controller
{
    public function index(Request $request)
    {
        $objects = Page::orderBy('id', 'DESC');
        if($request->name){
            $objects->where('title->ar','like','%'.$request->name.'%')->orWhere('title->en','like','%'.$request->name.'%')->orWhere('title->ur','like','%'.$request->name.'%');;
        }
        $objects = $objects->paginate(15);
        return view('system.pages.index', compact('objects'));
    }


    public function showUpdateView($id)
    {
        $object = Page::find($id);
        $activeLink='pages'.$id;
        return view('system.pages.update', compact('object','activeLink'));
    }


    public function Update(Request $request, $id)
    {
        $request->validate([
            'detail_ar'=>['required','string'],
            'detail_en'=>['required','string'],
            'name_ar'=>['required',Rule::unique('pages','title->ar')->ignore($id)],
            'name_en'=>['required',Rule::unique('pages','title->en')->ignore($id)],
        ]);
        $object  = Page::FindOrFail($id);

        $object->update([
            'title' => ['ar'=>$request->name_ar,'en'=>$request->name_en,'ur'=>$request->name_ur],
            'text' => ['ar'=>$request->detail_ar,'en'=>$request->detail_en,'ur'=>$request->details_ur],
        ]);
        flash('تم التعديل بنجاح');
        return redirect()->back();
    }


}
