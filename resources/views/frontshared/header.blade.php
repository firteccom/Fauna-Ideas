<header class="header">
    <div class="header-middle sticky-header">
        <div class="container-fluid">
            <div class="header-left">
                <button class="mobile-menu-toggler" type="button">
                    <i class="icon-menu"></i>
                </button>
                <a href="{{ route('front.home') }}" class="logo">
                    @if(isset($logo))
                        <img src="{{$logo}}" alt="Porto Logo">
                    @else
                        <img src="{{ asset('public/portal/images/logo.png') }}" alt="Porto Logo">
                    @endif                    
                </a>

                <nav class="main-nav">
                    <ul class="menu">
                        <li class="active"><a href="{{ route('front.home') }}">Inicio</a></li>
       
                        @if(isset($categorias))
                            <li>
                                <a href="#">Categorías</a>
                                <div class="megamenu">
                                    <div class="row row-sm">
                                        <div class="col-lg-8">
                                            <ul class="submenu">
                                                @foreach ($categorias as $cat)
                                                    <li><a href="{{ URL::to('/') }}/category/{{ $cat->ncategoryid }}">{{ $cat->sname }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <div class="col-lg-4 image-container">
                                            <img src="{{ asset('public/portal/images/menu-banner-2.jpg') }}" align="Menu banner">
                                        </div>

                                    </div>    
                                </div><!-- End .megamenu -->    

                            </li>
                        @endif

                        <li><a href="{{ route('front.about.page') }}">Nosotros</a></li>
                        <li><a href="{{ route('front.contact.page') }}">Contacto</a></li>
                        <li><a href="{{ route('front.blog.page') }}">Blog</a></li>
    
                    </ul>
                </nav>

                
            </div><!-- End .header-left -->

        </div><!-- End .container-fluid -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->