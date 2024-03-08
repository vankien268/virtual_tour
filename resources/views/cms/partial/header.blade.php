<!--header start-->
<header class="header fixed-top clearfix">
    <div class="brand">
        <a href="" class="logo" style="margin-top: 16px; margin-left: 80px">
            <img style="width: 50px;" src="{{ asset('logo/logo2.png') }}" alt="">
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>


    <div class="top-nav clearfix">
        <ul class="nav pull-right top-menu">
            {{-- <li>
                <input type="text" class="form-control search" placeholder=" Search">
            </li> --}}
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="{{ asset('BucketAdmin/html/images/avatar1_small.jpg') }}">
                    <span class="username">{{ Auth::user()->name }}</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    {{-- <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> --}}
                    <li><a href="{{ route('cms.logout') }}"><i class="fa fa-key"></i> Đăng xuất</a></li>
                </ul>
            </li>

        </ul>
    </div>
</header>
