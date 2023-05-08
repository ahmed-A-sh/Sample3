<?php

namespace App\Models;

use App\Traits\HasSearchable;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advice extends Model
{
    use HasFactory,HasSearchable,HasTranslations;
    protected $table="advices";
    protected $translatable=['title','description','source'];

    protected $guarded=[];
    public function getImageUrlAttribute()
    {
        $icon = isset($this->attributes['image']) ? $this->attributes['image'] : '';

        return $icon ? asset('uploads/'.$icon) : asset('uploads/default.png');
    }
    public function getImageThumbAttribute()
    {
        $icon = isset($this->attributes['image']) ? $this->attributes['image'] : '';

        return $icon ? asset('uploads/thumbs/'.$icon) : asset('uploads/default.png');
    }

    public static function getSearchable()
    {
        return [

            'title'=>[
                'type'=>'string',
                'operation'=>'like',
                'title'=>'النص',
            ],
            'status'=>[
                'type'=>'select',
                'title'=>'الحالة',
                'options'=>['enabled'=>lng('dashboard.general.status_enabled','فعال'),'disabled'=>lng('dashboard.general.status_disabled','معطل')]
            ],
        ];
    }

}
