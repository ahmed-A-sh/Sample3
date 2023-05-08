@extends('layouts.application')
@section('page_title')
    <x-header.title name="المستخدمين">
        <x-header.breadcrumb-item name="المستخدمين"/>
    </x-header.title>
@endsection
@section('content')
<x-theme.card>
    <x-slot name="search">
        <x-theme.search name="name" placeholder="بحث عن مدير"/>

    </x-slot>
    <x-slot name="toolbar">
        <x-theme.filter>
            <x-inputs.search.select class="mb-10" name="rule_id" title="نوع المدير" placeholder="اختر النوع" :options="\Spatie\Permission\Models\Role::all()" />

        </x-theme.filter>
        <x-theme.add-modal add-title="اضافة مدير جديد" :action="route('system.users.create')">
            <div class="row">
                <div class="col-md-9 row">
                    <div class="col-md-6">
                        <x-inputs.input name="name" required placeholder="ادخل الاسم" title="الاسم" />
                    </div>
                    <div class="col-md-6">
                        <x-inputs.input name="mobile" required placeholder="ادخل الجوال" title="الجوال" />
                    </div>
                    <div class="col-md-6">
                        <x-inputs.input name="email"  required placeholder="ادخل اسم المستخدم" title="اسم المستخدم" />
                    </div>
                    <div class="col-md-6">
                        <x-inputs.input name="password" required type="password" placeholder="ادخل كلمة المرور" title="كلمة المرور" />
                    </div>
                    <div class="mb-7">

                        <label class="required fw-bold fs-6 mb-5">الصلاحية</label>
                        @foreach($roles as $r)
                        <div class="d-flex fv-row">
                            <x-inputs.radio name="role_id" :value="$r->id" :title="$r->name"/>
                        </div>
                        <div class='separator separator-dashed my-5'></div>
                        @endforeach


                    </div>
                </div>
                <div class="col-3">
                    <x-inputs.avatar name="image"  title="الصورة"/>
                </div>
            </div>


        </x-theme.add-modal>



    </x-slot>
    <x-slot name="bulkactions">
        <button type="button" class="btn btn-danger btn-bulk-action" data-url="{{route('system.users.delete')}}" data-token="{{csrf_token()}}" >حذف المحدد</button>
    </x-slot>
    <x-theme.tables.table>
        <x-slot name="thead">
            <th class="w-10px pe-2">
                <x-theme.tables.checkbox data-kt-check="true" data-kt-check-target="#showTable .form-check-input"
                                  value="1"/>
            </th>
            <th class="min-w-125px">الاسم</th>
            <th class="min-w-125px">رقم الجوال</th>
            <th class="min-w-125px">الصلاحية</th>
            <th class="min-w-125px">اخر دخول</th>
            <th class="text-end min-w-100px">الاعدادات</th>
        </x-slot>
        <x-slot name="tbody">

            @foreach($out as $o)
                <tr id="TR_{{$o->id}}">
                    <td class="w-10px pe-2">
                        <x-theme.tables.checkbox value="{{$o->id}}"/>
                    </td>
                    <td class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <div class="symbol-label">
                                    <img src="{{$o->image_url}}" alt="Emma Smith" class="w-100" />
                                </div>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="text-gray-800 text-hover-primary mb-1">{{$o->name}}</span>
                            <span>{{$o->email}}</span>
                        </div>
                    </td>
                    <td class="min-w-125px">{{$o->mobile}}</td>

                    <td>{{$o->getRoleNames()->implode(',')}}</td>

                    <td>
                        <div class="badge {{$o->last_login && $o->last_login->diffInDays() == 0 ?'badge-success':'badge-light'}} fw-bolder">{{$o->last_login?$o->last_login->diffForHumans():'-'}}</div>
                    </td>


                    <td class="text-end">
                        <x-theme.tables.menu title="العمليات">
                            <x-theme.tables.menu-item title="تعديل" :href="route('system.users.update',$o->id)"/>
                            <x-theme.tables.menu-item title="تغيير كلمة المرور" :href="route('system.users.password',$o->id)"/>
                            <x-theme.tables.menu-item title="حذف" data-table-action="delete_row" data-url="{{route('system.users.delete')}}" data-token="{{csrf_token()}}" data-id="{{$o->id}}" />
                        </x-theme.tables.menu>
                    </td>
                </tr>
            @endforeach

        </x-slot>
    </x-theme.tables.table>
    {{$out->links()}}
</x-theme.card>



@endsection
