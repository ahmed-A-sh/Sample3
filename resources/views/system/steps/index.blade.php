@extends('layouts.application')
@section('title',lng('dashboard.steps.steps','مراحل نمو الجنين بالشهور'))
@section('page_title')
    <x-header.title :name="lng('dashboard.general.dashboard','لوحة التحكم')">
        <x-header.breadcrumb-item :name="lng('dashboard.steps.steps','مراحل نمو الجنين بالشهور')"/>
    </x-header.title>
@endsection
@push('css')

@endpush
@section('search_content')
    <x-search :searchable="\App\Models\Step::getSearchable()"/>
@endsection
@section('content')
    <x-theme.card>
        <x-slot name="toolbar">
            <x-theme.button type="openmodal"  class="btn btn-sm btn-flex btn-light-primary mx-2"
                            :modaltitle="lng('dashboard.steps.add_title','اضافة عنصر جديد')"
                            modalsize="modal-xl"
                            modallevel="2"
                href="{{route('system.steps.create')}}">
                <span class="svg-icon svg-icon-white svg-icon-x">@svg('lineawesome-plus-solid')</span>
                <span>اضافة عنصر جديد</span>
            </x-theme.button>
        </x-slot>
        <x-slot name="bulkactions">
            <button type="button" class="btn btn-danger mx-2 btn-bulk-action"
                    data-url="{{route('system.steps.delete')}}" data-token="{{csrf_token()}}">حذف المحدد
            </button>
            <button type="button" class="btn btn-success mx-2 btn-bulk-action"
                    data-url="{{route('system.steps.activate')}}" data-token="{{csrf_token()}}">تفعيل المحدد
            </button>
            <button type="button" class="btn btn-warning mx-2 btn-bulk-action"
                    data-url="{{route('system.steps.deactivate')}}" data-token="{{csrf_token()}}">تعطيل المحدد
            </button>
        </x-slot>
        <x-theme.tables.table>
            <x-slot name="thead">
                <th class="w-10px pe-2">
                    #
                </th>
                <th class="w-10px pe-2">
                    <x-theme.tables.checkbox data-kt-check="true" data-kt-check-target="#showTable .form-check-input"
                                             value="1"/>
                </th>
                <th class="w-500px">الصورة</th>
                <th class="w-500px">النص</th>
                <th class="w-500px">المصدر</th>
                <th class="w-50px">الحالة</th>
                <th class="text-end w-150px">الاعدادات</th>
            </x-slot>
            <x-slot name="tbody">

                @forelse($out as $o)
                    <tr id="TR_{{$o->id}}">
                        <td class="w-10px pe-2">
                            {{$loop->iteration + ($out->currentPage()-1)*$out->perPage()}}
                        </td>
                        <td class="w-10px pe-2"> <x-theme.tables.checkbox value="{{$o->id}}"/></td>
                        <td class="d-flex align-items-center">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <div class="symbol-label">
                                    <img src="{{$o->image_thumb}}" alt="Emma Smith" class="w-100 h-100" />
                                </div>
                            </div>
                        </td>


                        <td class="">{{$o->title}}</td>
                        <td class="">{{$o->source}}</td>


                        <td class="">
                            <div
                                class="badge {{$o->status == 'enabled' ?'badge-success':'badge-danger'}} fw-bolder">{{$o->status == 'enabled' ?lng('dashboard.general.status_enabled','فعال'):lng('dashboard.general.status_disabled','معطل')}}</div>

                        </td>


                        <td class="text-end">
                            <x-theme.tables.menu title="الاعدادات">
                                <x-theme.tables.menu-item title="تعديل"
                                                          class="OpenModal"
                                                          data-title="تعديل "
                                                          data-size="modal-xl"
                                                          level="2"
                                                          :href="route('system.steps.update',$o->id)"/>

                                @if($o->status == 'enabled')
                                    <x-theme.tables.menu-item title="تعطيل" data-table-action="action"
                                      data-url="{{route('system.steps.deactivate')}}"
                                      data-token="{{csrf_token()}}" data-id="{{$o->id}}"/>

                            @else
                                <x-theme.tables.menu-item title="تفعيل" data-table-action="action"
                                                          data-url="{{route('system.steps.activate')}}"
                                                          data-token="{{csrf_token()}}" data-id="{{$o->id}}"/>

                            @endif
                                    <x-theme.tables.menu-item title="حذف" data-table-action="delete_row"
                                                              data-url="{{route('system.steps.delete')}}"
                                                              data-token="{{csrf_token()}}" data-id="{{$o->id}}"/>
                                                           </x-theme.tables.menu>
                        </td>
                    </tr>
                @empty
                    <tr id="TR_0">

                        <td colspan="15" class="text-center text-muted">
                            لا يوجد نتائج

                        </td>
                    </tr>
                @endforelse

            </x-slot>
        </x-theme.tables.table>
        {{$out->links()}}
    </x-theme.card>

@endsection
