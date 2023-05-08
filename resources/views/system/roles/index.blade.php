@extends('layouts.application')
@section('title','الصلاحيات')
@section('page_title')
    <x-header.title name="الصلاحيات">
        <x-header.breadcrumb-item name="الصلاحيات"/>

    </x-header.title>
@endsection
@section('content')
    <x-theme.card>
        <x-slot name="search">
            <x-theme.search name="name" placeholder="بحث  "/>
        </x-slot>
        <x-slot name="toolbar">
            <x-theme.button type="href" :href="route('system.roles.create')">
                <span class="svg-icon svg-icon-2"><x-metronic-Plus/></span>اضافة
            </x-theme.button>
        </x-slot>
        <x-slot name="bulkactions">
            <button type="button" class="btn btn-danger btn-bulk-action" data-url="{{route('system.roles.delete')}}" data-token="{{csrf_token()}}" >حذف المحدد</button>
        </x-slot>
        <x-theme.tables.table>
            <x-slot name="thead">
                <th class="w-10px pe-2">
                    <x-theme.tables.checkbox data-kt-check="true" data-kt-check-target="#showTable .form-check-input"
                                      value="1"/>
                </th>
                <th class="min-w-125px">اسم الصلاحية</th>
                <th class="text-end min-w-100px">الاعدادات</th>
            </x-slot>
            <x-slot name="tbody">

                @foreach($out as $o)
                    <tr>
                        <td class="w-10px pe-2">
                            <x-theme.tables.checkbox value="{{$o->id}}"/>
                        </td>
                        <td class="min-w-125px">{{$o->name}}</td>
                        <td class="text-end">
                            <x-theme.tables.menu title="العمليات">
                                <x-theme.tables.menu-item title="تعديل" :href="route('system.roles.update',$o->id)"/>
                                <x-theme.tables.menu-item title="حذف" data-table-action="delete_row" data-url="{{route('system.roles.delete')}}" data-token="{{csrf_token()}}" data-id="{{$o->id}}" />
                            </x-theme.tables.menu>
                        </td>
                    </tr>
                @endforeach

            </x-slot>
        </x-theme.tables.table>
    </x-theme.card>



@endsection
