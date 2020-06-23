<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @if(isset($nsitio))
      <title>{{$nsitio}}</title>
    @else
      <title>Fauna & Ideas</title>
    @endif

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Bootstrap eCommerce Template">
    <meta name="author" content="SW-THEMES">
        
    @yield('css')

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('public/portal/images/icons/favicon.ico') }}">

    <script type="text/javascript">
        WebFontConfig = {
            google: { families: [ 'Open+Sans:300,400,600,700,800','Poppins:300,400,500,600,700','Segoe Script:300,400,500,600,700' ] }
        };
        (function(d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '{{ asset("public/portal/js/webfont.js") }}';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <script type="text/javascript">
        WebFontConfig = {
            google: { families: [ 'Open+Sans:300,400,600,700,800','Poppins:300,400,500,600,700','Segoe Script:300,400,500,600,700' ] }
        };
        (function(d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '{{ asset("public/portal/js/webfont.js") }}';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('public/portal/css/bootstrap.min.css') }}">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('public/portal/css/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/portal/vendor/fontawesome-free/css/all.min.css') }}">
</head>
<body class="full-screen-slider">
    <div class="page-wrapper">

        @include('frontshared.header')
        
        @yield('frontcontent')
        
        @include('frontshared.footer')
    
    </div><!-- End .page-wrapper -->

    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-retweet"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="active"><a href="{{ route('front.home') }}">Inicio</a></li>

                    @if(isset($categorias))
                        <li>
                            <a href="#">Categorías</a>
                            <ul>
                                @foreach ($categorias as $cat)
                                    <li><a href="{{ URL::to('/') }}/category/{{ $cat->ncategoryid }}">{{ $cat->sname }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    
                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                @if(isset($facebook))<a href="{{$facebook}}" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>@endif
                @if(isset($twitter))<a href="{{$twitter}}" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>@endif
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <div class="newsletter-popup mfp-hide" id="" style="background-image: url({{ asset('public/portal/images/newsletter_popup_bg.jpg') }})">
        <div class="newsletter-popup-content">
            <img src="{{ asset('public/portal/images/logo-black.png') }}" alt="Logo" class="logo-newsletter">
            <h2>BE THE FIRST TO KNOW</h2>
            <p>Subscribe to the Porto eCommerce newsletter to receive timely updates from your favorite products.</p>
            <form action="#">
                <div class="input-group">
                    <input type="email" class="form-control" id="newsletter-email" name="newsletter-email" placeholder="Email address" required>
                    <input type="submit" class="btn" value="Go!">
                </div><!-- End .from-group -->
            </form>
            <div class="newsletter-subscribe">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="1">
                        Don't show this popup again
                    </label>
                </div>
            </div>
        </div><!-- End .newsletter-popup-content -->
    </div><!-- End .newsletter-popup -->
    
    <!-- Add Cart Modal -->
    <div class="modal fade" id="addCartModal" tabindex="-1" role="dialog" aria-labelledby="addCartModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body add-cart-box text-center">
            <p>You've just added this product to the<br>cart:</p>
            <h4 id="productTitle"></h4>
            <img src="" id="productImage" width="100" height="100" alt="adding cart image">
            <div class="btn-actions">
                <a href="cart.html"><button class="btn-primary">Go to cart page</button></a>
                <a href="#"><button class="btn-primary" data-dismiss="modal">Continue</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script src="{{ asset('public/portal/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/portal/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/portal/js/plugins.min.js') }}"></script>
    <script src="{{ asset('public/portal/js/nouislider.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('public/portal/js/main.min.js') }}"></script>

    <!-- www.addthis.com share plugin -->
    <script src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b927288a03dbde6"></script>

    <!-- Google Map-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDc3LRykbLB-y8MuomRUIY0qH5S6xgBLX4"></script>
    <script src="{{ asset('public/portal/js/map.js') }}"></script>

    <!--Sweer Alert 2 -->
    <script src="{{ asset('public/plugins/sweetalert2.js') }}"></script>

    @yield('js')

</body>
</html>