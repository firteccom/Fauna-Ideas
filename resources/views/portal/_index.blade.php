@extends('layouts.front')

@section('frontcontent')
<main class="main">
    <div class="home-slider owl-carousel owl-theme">
        <div class="home-slide">
            <div class="slide-bg owl-lazy"  data-src="assets/images/slider/slide1.jpg"></div><!-- End .slide-bg -->
            <div class="home-slide-content">
                <h2>Winter Sale <br>Get 30% OFF <br>On JACKETS.</h2>

                <span>It's time to start shopping porto's winter sale</span>

                <a href="category.html" class="btn" role="button">Shop By Jackets</a>
            </div><!-- End .home-slide-content -->
        </div><!-- End .home-slide -->

        <div class="home-slide">
            <div class="slide-bg owl-lazy"  data-src="assets/images/slider/slide2.jpg"></div><!-- End .slide-bg -->
            <div class="home-slide-content">
                <h2>New Campaign Sale <br>UP to 70% </h2>

                <span>Fashion for Women | Spring/Summer Collection</span>

                <a href="category.html" class="btn" role="button">Shop By Hats</a>
            </div><!-- End .home-slide-content -->
        </div><!-- End .home-slide -->
    </div>
	<!-- End .home-slider -->
	

    @if(isset($categorias))
    <!-- CATEGORÍAS -->
    <section class="container-fluid">
        <div class="section-header mt-6">
            <h2 class="section-title">Compra por categoría</h2>
            <h3 class="section-subtitle">Navega por nuestras categorías</h3>
        </div>

        <div class="row row-sm mb-2">
            @foreach ($categorias as $cat)
                <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                <div class="product-category">
                    <a href="categorias/{{$cat->sname}}">
                        <figure>
                            <img src="{{$cat->sfullimage}}">
                        </figure>
                        <div class="category-content">
                            <h3>{{$cat->sname}}</h3>
                            <!--<span><mark class="count">8</mark> products</span>-->
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
            
        </div>
    </section>
    @endif


    <section class="bg-grey pt-3 pb-3">
        <div class="container-fluid mt-6 mb-5">
            <div class="row row-sm">
                <div class="col-6 col-lg-3">
                    <div class="home-banner">
                        <img src="assets/images/banners/home-banner1.jpg">
                        <div class="home-banner-content content-left-bottom">
                            <h3>Sunglasses Sale</h3>
                            <h4>See all and find yours</h4>
                            <a href="category.html" class="btn" role="button">Shop By Glasses</a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="home-banner">
                        <img src="assets/images/banners/home-banner2.jpg">
                        <div class="home-banner-content content-top-center">
                            <h3>Cosmetics Trends</h3>
                            <h4>Browse in all and find yours</h4>
                            <a href="category.html" class="btn" role="button">Shop By Cosmetics</a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="home-banner">
                        <img src="assets/images/banners/home-banner3.jpg">
                        <div class="home-banner-content content-reverse content-center">
                            <h3>Fashion Summer Sale</h3>
                            <h4>Browse in all our categories</h4>
                            <a href="category.html" class="btn" role="button">Shop By Fashion</a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="home-banner">
                        <img src="assets/images/banners/home-banner4.jpg">
                        <div class="home-banner-content boxed-content content-bottom-center">
                            <div class="info-group">
                                <h3>UP TO 70% IN ALL BAGS</h3>
                                <h4>Starting at $99</h4>
                            </div>
                            <a href="category.html" class="btn" role="button">Shop By Bags</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid">
        <div class="section-header mt-6">
            <h2 class="section-title">Popular Products</h2>
            <h3 class="section-subtitle">Check all our popular products</h3>
        </div>

        <div class="row row-sm mb-10">
            @foreach ($populares as $pop)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="product.html">
                            <img src="{{$pop->sfullimage}}">
                        </a>
                        <div class="label-group">
                            <span class="product-label label-cut">27% OFF</span>
                        </div>
                        <div class="btn-icon-group">
                            <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                        </div>
                        <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
                                <a href="category.html" class="product-category">category</a>
                            </div>
                        </div>
                        <h2 class="product-title">
                            <a href="product.html">{{$pop->sname}}</a>
                        </h2>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <span class="old-price">S/ {{$pop->nmasterprice}}</span>
                            <span class="product-price">S/ {{$pop->nprice}}</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>
            @endforeach
        </div>
    </section>
</main><!-- End .main -->
@endsection