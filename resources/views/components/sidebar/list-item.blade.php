@can($permission)
<div class="menu-item">
    <a class="menu-link mb-1 py-3 {{isset($active)&&$active?'active':''}}" href="{{$href}}">

        <span class="menu-title w-100 d-block text-center">{{$name}}</span>
    </a>
</div>
@endcan
