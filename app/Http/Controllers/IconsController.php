<?php

namespace App\Http\Controllers;
use BladeUI\Icons\IconsManifest;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;

class IconsController extends Controller
{

    public function index()
    {

        $icons=$this->getRequire(app()->bootstrapPath('cache/blade-icons.php'));

      return view('icons',compact('icons'));


    }
    public function getRequire($path, array $data = [])
    {
        if (is_file($path)) {
            $__path = $path;
            $__data = $data;

            return (static function () use ($__path, $__data) {
                extract($__data, EXTR_SKIP);

                return require $__path;
            })();
        }

        return [];
    }

}
