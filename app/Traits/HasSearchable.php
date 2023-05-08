<?php
namespace App\Traits;


trait HasSearchable
{
    public static function getSearchable()
    {
        return [
            'id'=>[
                'type'=>'number',
                'operation'=>'=',
                'title'=>lng('dashboard.general.name','الاسم'),

            ],
            'name'=>[
                'type'=>'string',
                'operation'=>'like',
                'title'=>lng('dashboard.general.name','الاسم'),
            ],
            'order_date'=>[
                'type'=>'range',
                'operation'=>'range',
                'title'=>lng('dashboard.general.name','الاسم'),
            ],
            'has_vip'=>[
                'type'=>'checkbox',
                'operation'=>'=',
                'title'=>'يحتوي خدمة VIP',
//                'relation'=>'settings'
            ],
            'status'=>[
                'type'=>'select',
                'title'=>lng('dashboard.general.status','الحالة'),
                'options'=>['enabled'=>lng('dashboard.general.status_enabled','فعال'),'disabled'=>lng('dashboard.general.status_disabled','معطل')]
            ],
        ];
    }
    public function scopeFilter($query,$request)
    {

        foreach ($this->getSearchable() as $key=>$searchItem){

            if($request->has($key) && $request->get($key) !== '' &&  $request->get($key) !== null ){
                $val=$request->get($key);
                $key=trim($key,'|');
                if(!isset($searchItem['operation'])){
                    $searchItem['operation']='=';
                }
                if(isset($searchItem['relation'])){
                    if($searchItem['operation'] == 'has'){
                        $query->has($searchItem['relation']);
                    }else{
                        $query->whereHas($searchItem['relation'],function ($qqqq)use($searchItem,$val,$key){
                            if($searchItem['operation'] == 'like'){
                                $val='%'.str_replace(' ','%',$val).'%';
                            }

                            $qqqq->where($key,$searchItem['operation'],$val);
                        });
                    }

                }else{

                    if($searchItem['operation'] == 'like'){
                        $val='%'.str_replace(' ','%',$val).'%';
                    }

                    if(isset($this->translatable)&& is_array($this->translatable)&& in_array($key,$this->translatable)){
                        $query->where(function ($qqqq)use ($key,$searchItem,$val){
                            $qqqq->where($key.'->ar',$searchItem['operation'],$val)->orWhere($key.'->en',$searchItem['operation'],$val);
                        });
                    }else{
                        $query->where($key,$searchItem['operation'],$val);
                    }


                }
            }elseif($searchItem['type'] == 'range'){
                if($request->has($key.'_from') && $request->get($key.'_from')) {
                    $query->where($key,'>=',$request->get($key.'_from'));
                }
                if($request->has($key.'_to') && $request->get($key.'_to')) {
                    $query->where($key,'<=',$request->get($key.'_to'));
                }
            }
        }

        return $query;
    }
}
