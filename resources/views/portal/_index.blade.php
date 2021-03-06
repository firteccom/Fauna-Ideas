@extends('layouts.front')

@section('frontcontent')
<main class="main">

    @if(isset($slider))
    <div class="home-slider owl-carousel owl-theme">
        @foreach ($slider as $sl)
        <div class="home-slide">
            <div class="slide-bg owl-lazy"  data-src="{{ URL::to('/') }}{{'/storage/app/'.$sl->sfullimage}}"></div><!-- End .slide-bg -->
            <div class="home-slide-content">
                <h2>{{$sl->smaintext}}</h2>

                <span>{{$sl->ssecondarytext}}</span>
                
                @if($sl->nobjecttype == 21)
                    <a href="{{ URL::to('/') }}/product/{{$sl->nobjectid }}" class="btn" role="button">{{$sl->sbuttontext}}</a>    
                @elseif($sl->nobjecttype == 22)
                    <a href="{{ URL::to('/') }}/category/{{$sl->nobjectid }}" class="btn" role="button">{{$sl->sbuttontext}}</a>
                @elseif($sl->nobjecttype == 23)
                    <a href="{{ URL::to('/') }}/catalog/{{$sl->nobjectid }}" class="btn" role="button">{{$sl->sbuttontext}}</a>
                @endif
                
            </div><!-- End .home-slide-content -->
        </div><!-- End .home-slide -->
        @endforeach
    </div>
	<!-- End .home-slider -->
    @endif
	

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
                    <a href="{{ URL::to('/') }}/category/{{$cat->ncategoryid}}">
                        <figure>
                            <img src="{{ URL::to('/') }}{{'/storage/app/'.$cat->sfullimage}}">
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

<!-- CATALOGOS -->
    @if(isset($catalogos)) 
    <section class="bg-grey pt-3 pb-3">
        <div class="container-fluid mt-6 mb-5">
            <div class="row row-sm">
                @foreach ($catalogos as $cata)
                <div class="col-6 col-lg-3">
                    <div class="home-banner">
                        <img src="{{ URL::to('/') }}{{'/storage/app/'.$cata->sfullimage}}">
                        <div class="home-banner-content content-left-bottom">
                            <h3>{{$cata->sname}}</h3>
                            <h4>{{$cata->sdecription}}</h4>
                            <a href="{{ URL::to('/') }}/catalog/{{$cata->ncatalogid}}" class="btn" role="button">Ver catálogo</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif


<!-- POPULARES -->
    @if(isset($populares)) 
    <section class="container-fluid">
        <div class="section-header mt-6">
            <h2 class="section-title">Productos Destacados</h2>
            <h3 class="section-subtitle">Mira nuestros productos destacados</h3>
        </div>

        <div class="row row-sm mb-10">
            @foreach ($populares as $pop)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ URL::to('/') }}/product/{{$pop->nproductid}}">
                            <img src="{{ URL::to('/') }}{{'/storage/app/'.$pop->sfullimage}}">
                        </a>
                        <div class="label-group">
                            <!--<span class="product-label label-cut">27% OFF</span>-->
                        </div>
                    </figure>

                    <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="{{ URL::to('/') }}/category/{{$pop->categoryid}}" class="product-category">{{$pop->category}}</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ URL::to('/') }}/product/{{$pop->nproductid}}">{{$pop->sname}}</a>
                                </h2>
                                <div class="price-box">
                                    <span class="old-price">S/ {{$pop->nmasterprice}}</span>
                                    <span class="product-price">S/ {{$pop->nprice}}</span>
                                </div><!-- End .price-box -->
                            </div>                    
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

</main><!-- End .main -->
@endsection