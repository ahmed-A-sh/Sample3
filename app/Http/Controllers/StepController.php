<?php

namespace App\Http\Controllers;

use App\Actions\ImageActions;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StepController extends Controller
{

    public function index(Request $request)
    {
        $out = Step::filter($request)->orderBy('ordering', 'ASC')->paginate(20);
        $out->appends($request->all());

        return view('system.steps.index', compact('out',));
    }


    public function create()
    {
        return view('system.steps.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'source_ar' => 'required',
            'source_en' => 'required',
            'image' => 'required',
        ]);
        Step::create([
            'title' => ['ar' => $request->get('title_ar'), 'en' => $request->get('title_en')],
            'description' => ['ar' => $request->get('description_ar'), 'en' => $request->get('description_en')],
            'source' => ['ar' => $request->get('source_ar'), 'en' => $request->get('source_en')],
            'image' => $request->image,
            'ordering' => Step::max('ordering') + 1
        ]);
        ImageActions::deleteUnUsedFiles($request->image);

        if ($request->is_ajax == 1) {
            flash('تمت الاضافة بنجاح');

            return ['done' => true];
        }
        flash('تمت الاضافة بنجاح');
        return redirect()->route('system.steps.index');
    }


    public function edit(Step $step)
    {
        $max = Step::max('ordering');
        $orders = [];
        $tmb = [
            'الاول',
            'الثاني',
            'الثالث',
            'الرابع',
            'الخامس',
            'السادس',
            'السابع',
            'الثامن',
            'التاسع',
            'العاشر',
        ];
        for ($i = 1; $i <= $max; $i++) {
            $orders[$i] = isset($tmb[$i - 1]) ? $tmb[$i - 1] : 'المركز رقم #' . $i;
        }

        return view('system.steps.update', compact('step', 'orders'));

    }


    public function update(Request $request, Step $step)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'source_ar' => 'required',
            'source_en' => 'required',
            'image' => 'required',
            'ordering' => 'required',

        ]);


            $ste = Step::where('ordering', $request->ordering)->exists();
        $ordering=$request->ordering;
            if ($ste) {
                if($step->ordering < $request->ordering){
                    $ordering = $request->ordering + 0.1;

                }else{
                    $ordering = $request->ordering - 0.1;

                }

            }


        $step->update([
            'title' => ['ar' => $request->get('title_ar'), 'en' => $request->get('title_en')],
            'description' => ['ar' => $request->get('description_ar'), 'en' => $request->get('description_en')],
            'source' => ['ar' => $request->get('source_ar'), 'en' => $request->get('source_en')],
            'image' => $request->image,
            'ordering' => $ordering
        ]);
        $steps = Step::orderBy('ordering', 'ASC')->get();
        $bs_or=1;
        foreach ($steps as $st) {
            $st->ordering = $bs_or;
            $st->save();
            $bs_or++;
        }
        ImageActions::deleteUnUsedFiles($request->image);

        if ($request->is_ajax == 1) {
            flash('تم التعديل بنجاح');

            return ['done' => true];
        }
        flash('تم التعديل بنجاح');
        return redirect()->route('system.steps.index');
    }


    public function delete(Request $request)
    {
        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;
        }

        $deleted_count = Step::whereIn('id', $ids)->delete();

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

        Step::whereIn('id', $ids)->update(['status' => 'enabled']);

        return ['done' => 1];
    }

    public function deactivate(Request $request)
    {

        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;
        }

        Step::whereIn('id', $ids)->update(['status' => 'disabled']);

        return ['done' => 1];
    }
}
