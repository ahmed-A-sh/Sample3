@extends('layouts.application')
@section('page_title')
    <x-header.title name="الإحصائيات"/>
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
        .imgs_edit img{
            width: 100px;

        }
    </style>
@endpush
@section('content')

    <div class="row g-5 g-xl-8">
        @foreach($counts as $c)
            @can(set_if($c['permission']))
                <x-dashboard.card
                    :class="set_if($c['class'])"
                    :href="set_if($c['href'])"
                    :title="set_if($c['title'])"
                    :count="set_if($c['count'])"
                    :counttext="set_if($c['count_text'])"
                    :color="set_if($c['color'])"
                    :svg="set_if($c['svg'])"
                    :icon="set_if($c['icon'])"
                />
            @endcan
        @endforeach
    </div>
    <!--begin::Row-->




    <!--end::Tables Widget 10-->
@endsection

@push('js')

@endpush
