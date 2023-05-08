<div class="col-md-12 mt-5 mb-5 row">
    <div class="col-md-9 d-flex flex-wrap">
        <label for="" class="w-100 required">اختر المحافظة</label>
        @foreach($govs as $c)
            <x-inputs.radio wire:model="gov_id" name="gov_id" style="border: 1px solid #ddd;border-radius: 10px;padding: .75rem !important;margin: .5rem !important;" :value="$c->id" :title="$c->name"/>


        @endforeach
    </div>
    <div class="col-md-3">
        <x-inputs.select :options="$this->areas"  wire:model="area_id" required  title="المدينة" placeholder="اختر المدينة"/>
    </div>
</div>
