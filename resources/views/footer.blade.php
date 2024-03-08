<footer id="footer" class="footer-light">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Footer widget area 1 -->
                    <div class="widget clearfix widget-contact-us" style="background-image: url('{{asset('assets/images/world-map-dark.png')}}'); background-position: 50% 20px; background-repeat: no-repeat">
                        <h4>{{$settings? $pagoda? $pagoda->value: null : null}}</h4>
                        <ul class="list-icon">
                            <li><i class="fa fa-map-marker"></i>{{$settings? $address? $address->value: null : null}}
                                </li>
                        </ul>
                        <!-- Social icons -->
                        <!-- end: Social icons -->
                    </div>
                    <!-- end: Footer widget area 1 -->
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-content">
        <div class="container">
            <div class="copyright-text text-center">&copy; 2023 @if(date('Y') > 2023) {{" - " . date('Y') }} @endif
                TRANG AN GROUP. <span>A</span><span class="text-lowercase">ll rights reserved.</span></div>
            <div class="text-center"><a href="https://newwaypms.com/" class="text-primary">Developed by NewwayPMS</a></div>
        </div>
    </div>
</footer>
