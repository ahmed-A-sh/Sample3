@extends('layouts.application')
@section('title','العملاء')
@section('page_title')
    <x-header.title name="العملاء">
        <x-header.breadcrumb-item href="{{route('system.clients.index')}}" name="العملاء"/>
        <x-header.breadcrumb-item name="تفاصيل hguldg"/>

    </x-header.title>
@endsection
@push('css')
    <style>
        .sticker_item{
            width: 100%;
            border: 2px solid #ddd;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .sticker_item .title {
            position: relative;
        }
        .sticker_item .title .actions{
            position: absolute;
            left: 0;
            top: 0;
            display: flex;
            bottom: 3px;
            padding: 5px;
            gap: 4px;
        }
        .sticker_item .title .actions-r{
            position: absolute;
            right: 0;
            top: 0;
            display: flex;
            bottom: 3px;
            padding: 5px;
            gap: 4px;
        }
        .sticker_item .title h3{
            text-align: center;
            border-bottom: 3px solid #ddd;
            padding: 10px;
            margin-bottom: 0;
        }
        .sticker_item .imgs{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 10px;
            margin-bottom: 10px;
        }
        .imgs_edit{
            border: 2px solid #ddd;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 10px;
            height: 100%;
            align-content: center;

        }
        .imgs_edit .del_from_here{
            position: relative;
            margin: 5px;
            padding: 5px;
        }
        .imgs_edit .btn_del_html{
            position: absolute;
            top: 0;
            left: 0;
            border: 0;
            background: transparent;
        }
        .imgs_edit .btn_del_html i{
            font-size: 16px;
            color: darkred;
        }
    </style>
@endpush
@section('content')


    <!--begin::Layout-->
    <div class="d-flex flex-column flex-xl-row">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-3">
            <!--begin::Card-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Card body-->
                <div class="card-body pt-15">
                    <!--begin::Summary-->
                    <div class="d-flex flex-center flex-column mb-5">

                        <!--begin::Name-->
                        <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">{{$out->username}}</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fs-5 fw-bold text-muted mb-6">نوع الحساب : {{$out->type_text}}</div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <div class="d-flex flex-wrap flex-center">

                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bolder text-center text-gray-700">
                                    <span class="w-75px">{{$out->privet_stickers_count}} مجموعة خاصة </span>

                                </div>
                                <div class="fw-bold text-center text-muted">عدد المجموعات الخاصة</div>
                            </div>

                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bolder text-center text-gray-700">
                                    <span class="w-75px">{{$out->liked_stickers_count}}  مجموعة </span>

                                </div>
                                <div class="fw-bold text-center text-muted">عدد اعجابات المجموعات</div>
                            </div>

                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Summary-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->

        </div>
        <!--end::Sidebar-->

        <div class="flex-lg-row-fluid ms-lg-15">
            <!--begin:::Tabs-->
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">


                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                       href="#private_stick">المجموعات الخاصة</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                       href="#liked_stick">اعجابات المجموعات</a>
                </li>



            </ul>
            <!--end:::Tabs-->
            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="private_stick" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <!--begin::Card header-->
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>المجموعات الخاصة</h2>
                                </div>


                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0 pb-5">

                                <div class="row">
                                    @forelse($out->privet_stickers as $o)
                                        <div class="col-md-4 productItem">
                                            <div class="sticker_item ">
                                                <div class="title">
                                                    <h3>
                                                        {{$o->name}}
                                                    </h3>

                                                </div>
                                                <div class="imgs">
                                                    @foreach($o->images as $img)
                                                        <img src="{{$img->thumb_url}}" alt="">
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>

                                    @empty
                                        <h3 class="text-center"> لا يوجد مجموعات </h3>

                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="liked_stick" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <!--begin::Card header-->
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2> اعجابات المجموعات</h2>
                                </div>


                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0 pb-5">

                                <div class="row">
                                    @forelse($out->liked_stickers as $o)
                                        <div class="col-md-4 productItem">
                                            <div class="sticker_item ">
                                                <div class="title">
                                                    <h3>
                                                        {{$o->name}}
                                                    </h3>

                                                </div>
                                                <div class="imgs">
                                                    @foreach($o->images as $img)
                                                        <img src="{{$img->thumb_url}}" alt="">
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>

                                    @empty
                                        <h3 class="text-center"> لا يوجد مجموعات </h3>

                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>

    </div>

@endsection
