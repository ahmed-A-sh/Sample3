@extends('layouts.application')
@section('page_title')
    <x-header.title name="الرئيسية"/>
@endsection
@section('content')

    <div class="row g-5 g-xl-8">

        @can('companies.view')
            <x-dashboard.card-text
                class="col"
                class2="h-100"
                :href="route('system.companies.index',['show_create'=>true])"
                title="اضافة شركة"
                color="info"
            />
        @endcan

        @can('drivers.view')
            <x-dashboard.card-text
                class="col"
                class2="h-100"
                :href="route('system.drivers.index',['show_create'=>true])"
                title="اضافة سائق"
                color="primary"
            />
        @endcan

        @can('operators.view')
            <x-dashboard.card-text
                class="col"
                class2="h-100"
                :href="route('system.operators.index',['show_create'=>true])"
                title="اضافة مجهز"
                color="success"
            />
        @endcan

        @can('orders.view')
            <x-dashboard.card-text
                class="col"
                class2="h-100"
                :href="route('system.orders.create')"
                title="اضافة طلب"
                color="danger"
            />
        @endcan
    </div>

@endsection
