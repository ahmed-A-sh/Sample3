<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Gov;
use Livewire\Component;

class GovsAndAreas extends Component
{
    public $gov_id;
    public $area_id;
    public function mount()

    {


        $this->govs = \Cache::rememberForever('govs', function () {
            return Gov::get();
        });
        $this->gov_id=$this->govs->first()->id??0;

    }
    public function getAreasProperty()

    {

        $areas = \Cache::rememberForever('areas', function () {
            return Area::get();
        });

        return $areas->where('gov_id',$this->gov_id)->all();

    }
    public function render()
    {
        return view('livewire.govs-and-areas');
    }
}
