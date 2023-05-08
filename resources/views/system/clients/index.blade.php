@extends('layouts.application')
@section('page_title')
    <x-header.title name="العملاء">
        <x-header.breadcrumb-item name="العملاء"/>
    </x-header.title>
@endsection
@section('content')
<x-theme.card>
    <x-slot name="search">
        <x-theme.search name="name" placeholder="بحث عن عميل"/>

    </x-slot>
    <x-slot name="toolbar">

    </x-slot>
    <x-slot name="bulkactions">
        <button type="button" class="btn btn-danger btn-bulk-action" data-url="{{route('system.clients.delete')}}" data-token="{{csrf_token()}}" >حذف المحدد</button>
    </x-slot>
    <x-theme.tables.table>
        <x-slot name="thead">
            <th class="w-10px pe-2">
                <x-theme.tables.checkbox data-kt-check="true" data-kt-check-target="#showTable .form-check-input"
                                  value="1"/>
            </th>
            <th class="min-w-125px">اسم المستخدم</th>
            <th class="min-w-125px">طريقة التسجيل</th>
            <th class="min-w-125px">عدد المجموعات الخاصة</th>
            <th class="min-w-125px">عدد المجموعات المفضلة</th>
            <th class="text-end min-w-100px">الاعدادات</th>
        </x-slot>
        <x-slot name="tbody">

            @foreach($out as $o)
                <tr id="TR_{{$o->id}}">
                    <td class="w-10px pe-2">
                        <x-theme.tables.checkbox value="{{$o->id}}"/>
                    </td>

                    <td class="min-w-125px">{{$o->username}}</td>
                    <td class="min-w-125px">{{$o->type_text}}</td>

                    <td>{{$o->privet_stickers_count}}</td>


                    <td>{{$o->liked_stickers_count}}</td>




                    <td class="text-end">
                        <x-theme.tables.menu title="العمليات">
                            <x-theme.tables.menu-item title="عرض التفاصيل" :href="route('system.clients.view',$o->id)"/>
                            <x-theme.tables.menu-item title="حذف" data-table-action="delete_row" data-url="{{route('system.clients.delete')}}" data-token="{{csrf_token()}}" data-id="{{$o->id}}" />
                        </x-theme.tables.menu>
                    </td>
                </tr>
            @endforeach

        </x-slot>
    </x-theme.tables.table>
    {{$out->links()}}
</x-theme.card>



@endsection
