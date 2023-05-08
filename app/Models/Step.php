<?php

namespace App\Models;

use App\Traits\HasSearchable;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{

    use HasSearchable,HasTranslations;
    protected $table='steps';
    protected $guarded=[];
        protected $translatable=['title','description','source'];
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

}
