@extends('layouts.application')

@section('content')
    <x-theme.card>
        <form action="{{route('system.advices.update',$advice->id)}}" id="FormSubmit" method="post">
            @csrf
            <div class="row justify-content-center">


                <div class="col-md-10">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <x-inputs.input name="title_ar"  :value="$advice->getTranslation('title','ar')" required placeholder="ادخل النص " title="النص "/>
                        </div>

                        <div class="col-md-6">
                            <x-inputs.input name="title_en"  :value="$advice->getTranslation('title','en')" required placeholder="ادخل النص بالانجليزي" title="النص بالانجليزي"/>
                        </div>
                        <div class="col-md-6">
                            <x-inputs.input name="source_ar"  :value="$advice->getTranslation('source','ar')" required placeholder="ادخل المصدر " title="المصدر "/>
                        </div>

                        <div class="col-md-6">
                            <x-inputs.input name="source_en" :value="$advice->getTranslation('source','en')" required placeholder="ادخل المصدر بالانجليزي" title="المصدر بالانجليزي"/>
                        </div>


                        <div class="col-md-6">
                            <x-inputs.input name="youtube_url"  :value="$advice->youtube_url" required placeholder="رابط اليوتيوب " title="رابط اليوتيوب "/>
                        </div>
                        <div class="w-100"></div>

                        <div class="col-md-6">
                            <x-inputs.area name="description_ar"  :value="$advice->getTranslation('description','ar')" required placeholder="ادخل الوصف " title="الوصف"/>
                        </div>


                        <div class="col-md-6">
                            <x-inputs.area name="description_en"   :value="$advice->getTranslation('description','en')" required placeholder="ادخل الوصف بالانجليزي" title="الوصف بالانجليزي"/>
                        </div>

                    </div>
                </div>
                <div class="col-md-2">
                    <x-inputs.image name="image" title="الصورة" :value="$advice->image" width="150" height="150"/>
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
