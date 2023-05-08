<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Company;
use App\Models\Driver;
use App\Models\Gov;
use App\Models\Operator;
use App\Models\Order;
use App\Models\PaymentType;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddOrder extends Component
{

    public Order $order;
    public Driver $driver;

    public $driver_id = 0;
//    public $companies = [];
//    public $operators = [];
    public $govs = [];
    public $payment_types = [];
    protected $queryString = ['driver_id'];

    protected function rules()

    {

        return [

            'order.order_number' => 'required|numeric|unique:orders,order_number',
            'order.description' => 'required|min:10',
            'order.order_date' => 'required|date',
            'order.company_id' => 'required|int',
            'order.operator_id' => 'required|int',
            'order.payment_type_id' => 'required|int',
            'order.gov_id' => 'required|int',
            'order.area_id' => 'required|int',
            'order.price' => [Rule::requiredIf($this->order->payment_type_id == 1),'numeric','min:0'],

        ];

    }
    public function mount()

    {
//
//        $this->companies = \Cache::rememberForever('companies', function () {
//            return Company::get();
//        });
//
//        $this->operators = \Cache::rememberForever('operators', function () {
//            return Operator::get();
//        });


        $this->govs = \Cache::rememberForever('govs', function () {
            return Gov::get();
        });
        $this->driver=Driver::findOrFail($this->driver_id);

        $this->payment_types=PaymentType::all();
        $this->order=new Order();
        $this->order->driver_id=$this->driver_id;
        $this->order->price=0;


    }
    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);

    }

    public function getAreasProperty()

    {

        $areas = \Cache::rememberForever('areas', function () {
            return Area::get();
        });

        return $areas->where('gov_id',$this->order->gov_id)->all();

    }

    public function save()

    {
        $this->validate();
        $validatedData = $this->validate();

//        dd($validatedData);

        $this->order->driver_id=$this->driver_id;
        $this->order->save();
        flash('تم اضافة الطلب بنجاح');
        return redirect()->route('system.drivers.index');

    }
    public function render()
    {
        return view('livewire.add-order');
    }
}
