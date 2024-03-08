<header id="header" class="header-transparent">
    <div id="header-wrap">
        <div class="container">
            <!--Logo-->
            <div id="logo">
                <a href="{{route('home')}}" class="logo" data-dark-logo="{{asset('assets/images/logo-qr.png')}}">
                    <img
                        src="{{asset('assets/images/logo-qr.png')}}" alt="Polo Logo">
                </a>
            </div>

            <!--End: Logo-->


            <!--Header Extras-->
            <div class="header-extras">
                <ul>
                    <li>
                        <div class="topbar-dropdown">
                            <a class="title">
                                <i class="fa fa-globe"></i>
                                @if($currentLanguageObj)
                                    {{--                                    {{\App\Models\Language::findByCode($currentLanguage)->name}}--}}
                                    {{\App\Models\Language::findByCode($currentLanguage)->localization}}
                                @endif
                            </a>
                            <div class="dropdown-list">

                                @foreach($langs as $lang)
                                    <a class="list-entry" href="?language={{$lang->code}}">
                                        {{--                                        {{$lang->name}}/--}}
                                        {{$lang->localization}}
                                    </a>
                                @endforeach


                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!--end: Header Extras-->

            <!--Navigation Resposnive Trigger-->
            <div id="mainMenu-trigger">
                <button class="lines-button x"><span class="lines"></span></button>
            </div>
            <!--end: Navigation Resposnive Trigger-->

            <!--Navigation-->
            <div id="mainMenu" class="light">
                <div class="container">
                    <nav>
                        <ul>
                            <li><a href="{{route('home')}}">{{$settings? $h? $h->value : null:null}}</a></li>

                        </ul>
                    </nav>
                </div>
            </div>
            <!--end: Navigation-->
        </div>
    </div>
</header>
