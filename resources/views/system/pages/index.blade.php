@extends('layouts.application')
@section('title','الصفحات التعريفية')
@section('page_title')
    <x-header.title name="لوحة التحكم">
        <x-header.breadcrumb-item name="الصفحات التعريفية"/>
    </x-header.title>
@endsection
@section('content')
<x-theme.card>
    <x-slot name="search">
{{--        <x-theme.search name="name"  placeholder="بحث  حسب الاسم" value="{{request()->input('name')}}"/>--}}
    </x-slot>
    <x-slot name="toolbar">
{{--        <div class="div">--}}
{{--            <a  class="btn btn-light-success" href="{{route('system.pages.index')}}">تفريغ</a>--}}
{{--        </div>--}}
{{--        <div style="visibility:hidden ; margin:5px">--}}
{{--            <span></span>--}}
{{--        </div>--}}

    </x-slot>

    <x-theme.tables.table>
        <x-slot name="thead">
            <th class="min-w-125px text-center">العنوان</th>
            <th class="min-w-130px text-center">التفاصيل</th>
            <th class="text-center min-w-100px">الاعدادات</th>
        </x-slot>
        <x-slot name="tbody">

            @foreach($objects as $object)
                <tr id="TR_{{$object->id}}">
                <td class="text-center">
                        <div class="d-flex flex-column">
                            <span class="text-gray-800 mb-1">{{$object->getTranslation('title', 'ar')}}</span>
                            <span>{{$object->getTranslation('title', 'en')}}</span>
                        </div>
                    </td>

                    <td class="text-center">
                        <div class="d-flex flex-column">

                            <span class="text-gray-800 mb-1">{{Str::limit(strip_tags($object->getTranslation('text', 'ar')),50)}}</span>
                            <span>{{Str::limit(strip_tags($object->getTranslation('text', 'en')),50)}}</span>

                        </div>
                    </td>
                    <td class="text-end">
                        <x-theme.tables.menu title="العمليات">
                            <x-theme.tables.menu-item title="تعديل" :href="route('system.pages.update',$object->id)"/>
                        </x-theme.tables.menu>
                    </td>
                </tr>
            @endforeach

        </x-slot>
    </x-theme.tables.table>
    {{$objects->links()}}
</x-theme.card>



@endsection
