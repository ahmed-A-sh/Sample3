<x-theme.card>

    <x-slot name="toolbar">
        <x-theme.button type="back">
            <span class="svg-icon svg-icon-2"><x-metronic-Redo/></span>رجوع
        </x-theme.button>
        <x-theme.button class="has-load" type="button"  wire:click.prevent="save" wire:loading.attr="disabled"  wire:target="save">
            <span class="indicator-label"><span class="svg-icon svg-icon-2"><x-metronic-Check/></span>اضافة</span>
            <span class="indicator-progress">الرجاء الانتظار...
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>



        </x-theme.button>

    </x-slot>
    <div class="row">
        <div class="col-md-9 row">
            <div class="col-md-6">
                <x-inputs.select-ajax :url="route('system.companies.ajax')"  wire:model.defer="order.company_id" required  title="الشركة" placeholder="اختر الشركة"/>
            </div>
            <div class="col-md-6">
                <x-inputs.select-ajax :url="route('system.operators.ajax')" wire:model.defer="order.operator_id" required title="الموزع" placeholder="اختر الموزع"/>
            </div>
            <div class="col-md-6">
                <x-inputs.select :options="$govs" required  wire:model="order.gov_id"  title="المحافظة" placeholder="اختر المحافظة"/>
            </div>
            <div class="col-md-6">
                <x-inputs.select :options="$this->areas"  wire:model.defer="order.area_id" required  title="المدينة" placeholder="اختر المدينة"/>
            </div>
            <div class="col-md-12">
                <x-inputs.area wire:model.lazy="order.description" required  title="الوصف" rows="2" placeholder="ادخل الوصف"/>
            </div>

        </div>
        <div class="col-md-3 row">

            <div class="col-md-12">
                <x-inputs.input required   wire:model.lazy="order.order_number" title="رقم الطلب" placeholder="ادخل رقم الطلب"/>

            </div>

            <div class="col-md-12">
                <x-inputs.input required type="date" wire:model.lazy="order.order_date" title="تاريخ الطلب" placeholder="ادخل تاريخ الطلب"/>

            </div>


            <div class="col-md-{{$order->payment_type_id != 1?'12':'6'}}">
                <x-inputs.select :options="$payment_types" required  wire:model="order.payment_type_id"  title="وسيلة الدفع" placeholder="اختر وسيلة الدفع"/>

            </div>
            @if($order->payment_type_id == 1)
            <div class="col-md-6">
                <x-inputs.input required   wire:model.lazy="order.price" title="السعر" placeholder="ادخل السعر"/>
            </div>
            @endif
        </div>



    </div>


</x-theme.card>
