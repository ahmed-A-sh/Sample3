<?php

namespace App\Actions;

 use Illuminate\Filesystem\Filesystem;
 use Intervention\Image\Facades\Image;

 class ImageActions
{


     public static function deleteUnUsedFiles($images){
         $temp=session('tempMultiImage');
         if(is_array($temp))
             foreach ($temp as $t){
                 if(! in_array($t,$images)){
                     try{
                         unlink("./uploads/".$t);

                     }catch (\Exception $e){}
                 }

             }
         session(['tempMultiImage'=>[]]);
         $temp=session('tempImage');
         if(!is_array($images)){
             $images=[$images];
         }

         if(is_array($temp))
             foreach ($temp as $t){
                 if(array_search($t,$images) === false){
                     try{
                         unlink("./uploads/".$t);

                     }catch (\Exception $e){}
                 }

             }
         session(['tempImage'=>[]]);
         return true;

     }
     public static function SaveFile($file){
         if (isset($file)){
             $name=time().'_'.rand(1,999999999).'.'.$file->getClientOriginalExtension();

             $path=realpath('public/uploads')?realpath('public/uploads'):realpath('uploads');

             $originalImage= $file;
             try {
                 $thumbnailImage = Image::make($originalImage);
                 $originalPath = $path.'/';
                 $thumbnailImage->save($originalPath.$name);
                 $thumbnailImage->widen(50);
                 $thumbnailPath = $path.'/thumbs/';
                 $thumbnailImage->save($thumbnailPath.$name);
             }catch (\Exception $e){
                 $file->move($path, $name);
                 (new Filesystem)->copy($path.'/'.$name, $path.'/thumbs/'.$name);

             }


//            $file->move('uploads', $name);
             return $name;
         }
         return '';

     }

 }
