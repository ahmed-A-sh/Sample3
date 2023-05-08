@extends('layouts.login')
@section('content')

    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside order-2 order-lg-1 d-flex flex-column-fluid flex-lg-row-auto bgi-size-cover bgi-no-repeat p-7 p-lg-10">
                <!--begin: Aside Container-->
                <div class="d-flex flex-row-fluid flex-column justify-content-between">
                    <!--begin::Aside body-->
                    <div class="d-flex flex-column-fluid flex-column flex-center mt-5 mt-lg-0">
                        <a href="#" class="mb-15 text-center">
                            <img src="{{ asset('assets/media/logos/logo.png') }}" style="max-height: 200px;" alt="" />
                        </a>
                        <!--begin::Signin-->
                        <div class="login-form login-signin">
                            <div class="text-center mb-10 mb-lg-20">
                                <h2 class="font-weight-bold">تسجيل الدخول</h2>
                                <p class="text-muted font-weight-bold">ادخل اسم المستخدم وكلمة المرور</p>
                            </div>
                            <!--begin::Form-->
                                <form class="form" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group py-3 m-0">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="رقم الجوال" value="{{old('mobile')}}" name="mobile" autocomplete="off" />
                                    @error('mobile'){{$message}}@enderror
                                </div>
                                <div class="form-group py-3 border-top m-0">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Password" placeholder="كلمة المرور" name="password" />
                                </div>
                                <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-3">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline m-0 text-muted">
                                            <input type="checkbox" name="remember" />
                                            <span></span>تذكرني</label>
                                    </div>
                                </div>
                                <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-2">

                                    <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3">تسجيل الدخول</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Signin-->
                    </div>
                    <!--end::Aside body-->
                    <!--begin: Aside footer for desktop-->

                    <!--end: Aside footer for desktop-->
                </div>
                <!--end: Aside Container-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="order-1 order-lg-2 flex-column-auto flex-lg-row-fluid d-flex flex-column p-7" style="background-image: url({{ asset('assets/media/bg/bg-11.jpg') }});">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-lg-center">
                    <div class="d-flex flex-column justify-content-center">
                        <h3 class="display-3 font-weight-bold my-7 text-center text-white">حساب الحمل</h3>
                    </div>
                </div>
                <!--end::Content body-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
@endsection
