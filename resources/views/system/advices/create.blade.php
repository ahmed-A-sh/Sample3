@extends('layouts.application')

@section('content')
    <x-theme.card>
        <form action="{{route('system.advices.create')}}" id="FormSubmit" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <x-inputs.input name="title_ar" required placeholder="ادخل النص " title="النص "/>
                        </div>

                        <div class="col-md-6">
                            <x-inputs.input name="title_en" required placeholder="ادخل النص بالانجليزي" title="النص بالانجليزي"/>
                        </div>
                        <div class="col-md-6">
                            <x-inputs.input name="source_ar" required placeholder="ادخل المصدر " title="المصدر "/>
                        </div>

                        <div class="col-md-6">
                            <x-inputs.input name="source_en" required placeholder="ادخل المصدر بالانجليزي" title="المصدر بالانجليزي"/>
                        </div>

                        <div class="col-md-6">
                            <x-inputs.input name="youtube_url" required placeholder="رابط اليوتيوب " title="رابط اليوتيوب "/>
                        </div>
                        <div class="w-100"></div>

                        <div class="col-md-6">
                            <x-inputs.area name="description_ar" required placeholder="ادخل الوصف " title="الوصف"/>
                        </div>


                        <div class="col-md-6">
                            <x-inputs.area name="description_en" required placeholder="ادخل الوصف بالانجليزي" title="الوصف بالانجليزي"/>
                        </div>


                    </div>
                    </div>
                <div class="col-md-2">
                    <x-inputs.image name="image" title="الصورة" width="150" height="150"/>
                </div>





                <div class="w-100"></div>
                <div class="col-md-5">
                    <x-button class="w-100 justify-content-center btn-save" data-closemodal="#OpenModal_2">
                        <span class="svg-icon svg-icon-2"><x-metronic-Check/></span>اضافة

                    </x-button>
                </div>
            </div>
        </form>
    </x-theme.card>

@endsection
@push('js')


@endpush
