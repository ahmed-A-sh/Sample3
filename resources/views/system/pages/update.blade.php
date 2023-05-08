@extends('layouts.application')
@section('title','الصفحات التعريفية')
@section('page_title')
    <x-header.title name="لوحة التحكم">
        <x-header.breadcrumb-item :href="route('system.pages.index')" name="الصفحات التعريفية"/>
        <x-header.breadcrumb-item name="تعديل بيانات الصفحة"/>

    </x-header.title>
@endsection
@section('content')
    <form id="editForm" class="form" method="post">
        @csrf
        <x-theme.card>

            <x-slot name="toolbar">
                <x-theme.button type="back">
                    <span class="svg-icon svg-icon-2"><x-metronic-Redo/></span>رجوع
                </x-theme.button>
                <x-theme.button type="submit">
                    <span class="svg-icon svg-icon-2"><x-metronic-Check/></span>تعديل
                </x-theme.button>

            </x-slot>

            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-6">
                        <x-inputs.input required name="name_ar" :value="$object->getTranslation('title', 'ar')" placeholder="ادخل الاسم" title="الاسم" />
                    </div>
                    <div class="col-md-6" style="">
                        <x-inputs.input name="name_en" style="direction:ltr" required :value="$object->getTranslation('title', 'en')" placeholder="ادخل الاسم باللغة الانجليزية" title="الاسم باللغة الانجليزية" />
                    </div>


                    <div class="col-md-6">
                        <x-inputs.area_editor name="detail_ar" title="نص  الصفحة باللغة العربية" value="{!! $object->getTranslation('text','ar')!!}"/>
                    </div>
                    <div class="col-md-6">
                        <x-inputs.area_editor name="detail_en" title="نص الصفحة بالانجليزية" value="{!!$object->getTranslation('text','en')!!}"/>
                    </div>



                </div>


            </div>
        </x-theme.card>

    </form>

@endsection
@push('js')
    <script src="{{asset('assets/custom/ar_MA.js')}}"></script>
    <script>
        const form = document.querySelector('#editForm');
        var validator = FormValidation.formValidation(
            form,
            {
                // fields: {
                //     'name': {
                //         validators: {
                //             notEmpty:{}
                //         }
                //     },
                // },
                locale: 'ar_MA',
                localization: ArabicLang,

                plugins: {
                    declarative: new FormValidation.plugins.Declarative({
                        html5Input: true,
                    }),
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    }),

                    icon: new FormValidation.plugins.Icon({
                        valid: 'fa fa-check',
                        invalid: 'fa fa-times',
                        validating: 'fa fa-refresh',
                    }),
                }
            }
        );
        const submitButton = form.querySelector('[data-kt-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();
            if (validator) {
                validator.validate().then(function (status) {
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        form.submit();
                    }
                });
            }

        });
    </script>
@endpush
