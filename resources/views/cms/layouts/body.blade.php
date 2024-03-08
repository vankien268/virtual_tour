<section id="container">
     {{-- Loading --}}
     <div id="loading" style="display:none">
        <img src="{{ asset('BucketAdmin') }}/html/gif/Rolling.gif" alt="Loading..."/>
    </div>
    <!--header start-->
    <header class="header fixed-top clearfix">
        @include('cms.partial.header')
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
        @include('cms.partial.aside')
    </aside>    
    <!--sidebar end-->
    <!--main content start-->

    <section id="main-content">
        <section class="wrapper">
            @if ($errors->any())
                <div class="alert alert-block alert-danger fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('success'))
            <div class="alert alert-block alert-success fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
            {{ Session::get('success') }}
            </div>
            @elseif (Session::has('error'))
                <div class="alert alert-block alert-danger fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                {{ Session::get('error') }}
            </div>
            @endif
            @yield('content')
        </section>
    </section>
    <!--main content end-->

</section>
<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->
<script src="{{ asset('BucketAdmin') }}/html/js/jquery.js"></script>
<script src="{{ asset('BucketAdmin') }}/html/js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
<script src="{{ asset('BucketAdmin') }}/html/bs3/js/bootstrap.min.js"></script>
<script src="{{ asset('BucketAdmin') }}/html/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="{{ asset('BucketAdmin') }}/html/js/jquery.scrollTo.min.js"></script>
<script src="{{ asset('BucketAdmin') }}/html/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="{{ asset('BucketAdmin') }}/html/js/jquery.nicescroll.js"></script>
<script src="{{ asset('BucketAdmin') }}/html/js/jquery.scrollTo/jquery.scrollTo.js"></script>
<script src="{{ asset('BucketAdmin') }}/html/js/ckeditor/ckeditor.js"></script>
<script src="{{ asset('BucketAdmin/html/js/ckfinder/ckfinder.js') }}"></script>

<!--common script init for all pages-->
<script src="{{ asset('BucketAdmin') }}/html/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<!--script for page-->
{{-- table --}}
<script type="text/javascript" language="javascript" src="{{ asset('BucketAdmin') }}/html/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="{{ asset('BucketAdmin') }}/html/js/data-tables/DT_bootstrap.js"></script>
<script src="{{ asset('BucketAdmin') }}/html/js/dynamic_table_init.js"></script>
{{-- thông báo --}}
<script src="{{ asset('BucketAdmin') }}/html/js/toastr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stack('js')