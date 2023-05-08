@extends('layouts.application')
@section('page_title')
    <x-header.title name="لوحة التحكم">
        <x-header.breadcrumb-item :href="route('system.users.index')" name="الادارة"/>
        <x-header.breadcrumb-item name="تعديل بيانات المدير"/>

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
            <div class="col-md-9 row">
                <div class="col-md-6">
                    <x-inputs.input required name="name" :value="$out->name" placeholder="ادخل الاسم" title="الاسم" />
                </div>
                <div class="col-md-6">
                    <x-inputs.input required name="mobile" :value="$out->mobile" placeholder="ادخل الجوال" title="الجوال" />
                </div>
                <div class="col-md-6">
                    <x-inputs.input required name="email" :value="$out->email" placeholder="ادخل اسم المستخدم" title="اسم المستخدم" />
                </div>

                <div class="mb-7">

                    <label class="required fw-bold fs-6 mb-5">الصلاحية</label>
                    @foreach($roles as $r)
                        <div class="d-flex fv-row">
                            <x-inputs.radio name="role_id" :value="$r->id" :checked="$out->hasRole($r->id)" :title="$r->name"/>
                        </div>
                        <div class='separator separator-dashed my-5'></div>
                    @endforeach


                </div>
            </div>
            <div class="col-3">
                <x-inputs.image name="image" :value="$out->avatar"  title="الصورة" width="300" height="300"/>
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
