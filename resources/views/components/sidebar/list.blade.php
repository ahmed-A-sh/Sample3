
@canany($permission)
<div data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-start"  class="menu-item menu-lg-down-accordion me-lg-1 {{isset($active)&&$active?' here show ':''}}">
									<span class="menu-link py-3">
										<span class="menu-title">{{$name}}</span>
										<span class="menu-arrow  d-lg-none"></span>
									</span>
    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg p-lg-1 w-lg-160px">
        {{$items}}
    </div>
</div>
@endcan
