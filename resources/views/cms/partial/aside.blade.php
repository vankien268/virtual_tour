@push('js')
@endpush
<div id="sidebar" class="nav-collapse">
    <!-- sidebar menu start-->
    <div class="leftside-navigation">
        <ul class="sidebar-menu" id="nav-accordion">
            {{-- <li>
                <a class="@yield('active-menu')" href="{{ route('cms.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Trang chủ</span>
                </a>
            </li> --}}
            @role(['Admin','Super Admin'])
            <li class="menu" style="">
                <a href="javascript:;" class="{{ Request::is('admin/config*') ? 'active' : '' }}">
                    <i class="fa fa-glass"></i>
                    <span>Cấu hình</span>
                </a>
                <ul class="sub">
                    <li class="{{ Request::is('admin/config/locations*') ? 'active' : '' }}">
                        <a href="{{ route('cms.config.locations') }}">Cấu hình địa điểm</a>
                    </li>
                </ul>
            </li>
            @endrole
            @role('Super Admin')
            <li>
                <a class="@yield('menu-zones')" href="{{ route('cms.zones.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Khu vực</span>
                </a>
            </li>
            @endrole
            <li>
                <a class="{{ Request::is('admin/locations*') ? 'active' : '' }}" href="{{ route('cms.locations.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Địa điểm</span>
                </a>
            </li>
            <li>
                <a class="@yield('menu-new')" href="{{ route('cms.news.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Tin tức</span>
                </a>
            </li>
            @role('Super Admin')
            <li>
                <a class="@yield('menu-language')" href="{{ route('cms.languages.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Ngôn ngữ</span>
                </a>
            </li>
            @endrole
            {{-- <li>
                <a class="{{ Request::is('admin/settings*') ? 'active' : '' }}" href="{{ route('cms.settings.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Setting</span>
                </a>
            </li> --}}
            @role(['Admin','Super Admin'])
            <li class="menu" style="">
                <a href="javascript:;" class="{{ Request::is('admin/manager*') ? 'active' : '' }}">
                    <i class="fa fa-glass"></i>
                    <span>Quản lý</span>
                </a>
                <ul class="sub">
                    <li class="{{ Request::is('admin/manager/users*') ? 'active' : '' }}">
                        <a href="{{ route('cms.manager.users.index') }}">Người dùng</a>
                    </li>
                </ul>
                <ul class="sub">
                    <li class="{{ Request::is('admin/manager/roles*') ? 'active' : '' }}">
                        <a href="{{ route('cms.manager.roles.index') }}">Vai trò</a>
                    </li>
                </ul>
            </li>
            @endrole
            
        </ul>
    </div>
</div>
<!-- sidebar menu end-->
