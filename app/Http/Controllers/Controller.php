<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $active='dashboard';
        $currentRoute=\Illuminate\Support\Facades\Route::current()->getName();
        if($currentRoute){
            $ar=explode('.',$currentRoute);
            if(isset($ar[1])){
                $active=$ar[1];
            }
        }

        \View::share('activeLink',$active);
    }
}
