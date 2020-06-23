@extends('layouts.front')

@section('frontcontent')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Productos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Producto no encontrado</li>
            </ol>
        </div><!-- End .container-fluid -->
    </nav>

    <div class="page-header">
        <div class="container">
            <h1>PRODUCTO NO ENCONTRADO</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->

    <div class="container">
        <div class="heading mb-4">
            <h1 class="title">¡Calma!</h1>
            <p><h2>Aún puedes encontrar más productos aquí.</h2></p>
        </div><!-- End .heading -->
    </div><!-- End .container -->

    @if (count($featuredproducts) > 0)
    <div class="featured-section">
        <div class="container-fluid">
            <h2 class="carousel-title">Productos destacados</h2>

            <div class="featured-products owl-carousel owl-theme owl-dots-top">

                @foreach ($featuredproducts as $prod)
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ URL::to('/') }}/product/{{$prod->nproductid}}">
                            <img src="{{ URL::to('/') }}/{{'storage/app/'.$prod->sfullimage}}">
                        </a>
                        <div class="label-group">
                            <!--<span class="product-label label-cut">27% descuento</span>-->
                        </div>
                        <!--
                        <div class="btn-icon-group">
                            <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                        </div>
                        <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> -->
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
                                <a href="{{ URL::to('/') }}/category/{{$prod->categoryid}}" class="product-category">{{$prod->category}}</a>
                            </div>
                        </div>
                        <h2 class="product-title">
                            <a href="{{ URL::to('/') }}/product/{{$prod->nproductid}}">{{$prod->sname}}</a>
                        </h2>
                        <div class="price-box">
                            <span class="old-price">S/ {{$prod->nmasterprice}}</span>
                                    <span class="product-price">S/ {{$prod->nprice}}</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
                @endforeach

            </div><!-- End .featured-proucts -->
        </div><!-- End .container-fluid -->
    </div><!-- End .featured-section -->
    @endif

    <div class="mb-10"></div><!-- margin -->
</main><!-- End .main -->

@endsection