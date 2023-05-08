<?php

namespace App\Http\Controllers;

use App\Models\Advice;
use App\Models\Client;
use App\Models\Company;
use App\Models\Driver;
use App\Models\Emoji;
use App\Models\Image;
use App\Models\Operator;
use App\Models\Order;
use App\Models\OrderView;
use App\Models\ImageType;
use App\Models\Step;
use App\Models\TextType;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        if(!\Auth::user()->can('dashboard.view')){
            return view('system.short_links');

        }

        if(request()->get('mode') == 'dark'){
            session(['mode'=>'dark']);
        }
        if(request()->get('mode') == 'light'){
            session(['mode'=>'light']);
        }
        $counts=[];
        $counts[]=[
            'href'=>route('system.advices.index'),
            'title'=>'النصائح للحمل',
            'count'=>Advice::count(),
            'count_text'=>' نص',
            'icon'=>'fa fa-image',
            'class'=>'col-md-3',
            'color'=>'success',
            'permission'=>'advices.view',

        ];
        $counts[]=[
            'href'=>route('system.steps.index'),
            'title'=>' مراحل نمو الجنين بالشهور',
            'count'=>Step::count(),
            'count_text'=>' نص',
            'icon'=>'fa fa-image',
            'class'=>'col-md-3',
            'color'=>'info',
            'permission'=>'steps.view',

        ];

//        $counts[]=[
//            'href'=>route('system.stickers.index'),
//            'title'=>' المجموعات الخاصة',
//            'count'=>ImageType::where('type','private')->count(),
//            'count_text'=>' مجموعة',
//            'icon'=>'fa fa-images',
//            'class'=>'col-md-3',
//            'color'=>'warning',
//            'permission'=>'stickers.view',
//
//        ];
//        $counts[]=[
//            'href'=>route('system.emoji.index'),
//            'title'=>'الملصقات',
//            'count'=>Emoji::count(),
//            'count_text'=>' ملصق',
//            'icon'=>'fas fa-smile',
//            'class'=>'col-md-3',
//            'color'=>'info',
//            'permission'=>'emoji.view',
//
//        ];
//        $counts[]=[
//            'href'=>route('system.users.index'),
//            'title'=>'العملاء',
//            'count'=>Client::count(),
//            'count_text'=>' عميل',
//            'icon'=>'fa fa-user',
//            'class'=>'col-md-3',
//            'color'=>'danger',
//            'permission'=>'users.view',
//
//        ];


        return view('system.dashboard',compact('counts'));

    }


}
