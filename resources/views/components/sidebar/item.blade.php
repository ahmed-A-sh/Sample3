@can($permission)
<div class="menu-item me-lg-1">
    <a class="menu-link {{isset($active)&&$active?'active':''}} py-3" href="{{$href}}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
       data-bs-placement="right">
        <span class="menu-title">{{$name}}</span>
    </a>
</div>

@endcan
