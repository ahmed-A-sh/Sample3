@extends('layouts.application')

@section('content')
    <x-theme.card>
        <form action="{{route('system.texts.update',$text->id)}}" id="FormSubmit" method="post">
            @csrf
            <div class="row justify-content-center">


                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-12">
                            <x-inputs.area name="text"  :value="$text->text" required placeholder="ادخل النص" title="النص"/>

                        </div>
                        <div class="col-md-4">
                            <x-inputs.select empty="false" :value="$text->language" required :options="['ar'=>'العربية','en'=>'الانجليزية']" name="language" title="اللغة" placeholder="اللغة"/>



                        </div>
                        <div class="col-md-8">
                            <x-inputs.select opt_groups="true" childes="childes"  :value="$text->text_type_id"  required :options="$categories" name="text_type_id" title="المجموعة الرئيسية" placeholder="مجموعة رئيسية"/>
                        </div>

                    </div>
                </div>

                <div class="col-md-1">
                    <div class="py-3">
                        <x-inputs.checkbox name="is_suggested"  :checked="$text->is_suggested"  placeholder="مقترح" title="مقترح"/>

                    </div>




                </div>


                <div class="w-100"></div>
                <div class="col-md-5">
                    <x-button class="w-100 justify-content-center btn-save" data-closemodal="#OpenModal_2">
                        <span class="svg-icon svg-icon-2"><x-metronic-Check/></span>تعديل

                    </x-button>
                </div>
            </div>
        </form>
    </x-theme.card>

@endsection
@push('js')


@endpush
