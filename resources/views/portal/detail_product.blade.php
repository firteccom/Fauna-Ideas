@extends('layouts.front')

@section('frontcontent')

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Productos</a></li>
            </ol>
        </div><!-- End .container-fluid -->
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-single-container product-single-default">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 product-single-gallery">
                            <div class="product-slider-container product-item">
                                <div class="product-single-carousel owl-carousel owl-theme">
                                    <!-- Principal image -->
                                    <div class="product-item">
                                        <img class="product-single-image" src="{{ URL::to('/') }}{{'/storage/app/'.$product->sthumbnail}}" data-zoom-image="{{ URL::to('/') }}{{'/storage/app/'.$product->sfullimage}}"/>
                                    </div>
                                    <!-- End principal image -->

                                    <div class="product-item">
                                        <img class="product-single-image" src="{{ asset('public/portal/images/products/zoom/product-2.jpg') }}" data-zoom-image="{{ asset('public/portal/images/products/zoom/product-2-big.jpg') }}"/>
                                    </div>
                                    <div class="product-item">
                                        <img class="product-single-image" src="{{ asset('public/portal/images/products/zoom/product-3.jpg') }}" data-zoom-image="{{ asset('public/portal/images/products/zoom/product-3-big.jpg') }}"/>
                                    </div>
                                    <div class="product-item">
                                        <img class="product-single-image" src="{{ asset('public/portal/images/products/zoom/product-4.jpg') }}" data-zoom-image="{{ asset('public/portal/images/products/zoom/product-4-big.jpg') }}"/>
                                    </div>
                                </div>
                                <!-- End .product-single-carousel -->
                                <span class="prod-full-screen">
                                    <i class="icon-plus"></i>
                                </span>
                            </div>
                            <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
                                <div class="col-3 owl-dot">
                                    <img src="{{ URL::to('/') }}{{'/storage/app/'.$product->sthumbnail}}"/>
                                </div>
                                <div class="col-3 owl-dot">
                                    <img src="{{ URL::to('/') }}{{'/storage/app/'.$product->sthumbnail}}"/>
                                </div>
                                <div class="col-3 owl-dot">
                                    <img src="{{ URL::to('/') }}{{'/storage/app/'.$product->sthumbnail}}"/>
                                </div>
                                <div class="col-3 owl-dot">
                                    <img src="{{ URL::to('/') }}{{'/storage/app/'.$product->sthumbnail}}"/>
                                </div>
                            </div>
                        </div><!-- End .col-lg-7 -->

                        <div class="col-lg-5 col-md-6">
                            <div class="product-single-details">
                                <h1 class="product-title">{{ $product->sname }}</h1>
                                <div class="product-sku">SKU: {{ $product->ssku }}</div>                                
                                <br>
                                <div class="row">
                                    <div class="product-price-desc master-price col-lg-4 col-md-4 col-sm-3">Precio Internet</div>
                                    <div class="product-price-new master-price col-lg-8 col-md-8 col-sm-9">S/ {{ $product->nmasterprice }}</div>
                                </div><!-- End .price-box -->
                                <br>
                                <div class="row">
                                    <div class="product-price-desc offer-price col-lg-4 col-md-4 col-sm-3">Precio Oferta</div>
                                    <div class="product-price-new offer-price col-lg-8 col-md-8 col-sm-9">S/ {{ $product->nprice }}</div>
                                </div><!-- End .price-box -->

                                <br>
                                    

                                <div class="product-desc">
                                    <p>{{ $product->sdescription }}</p>
                                </div><!-- End .product-desc -->

                            </div><!-- End .product-single-details -->
                        </div><!-- End .col-lg-5 -->
                    </div><!-- End .row -->
                </div><!-- End .product-single-container -->

                <div class="product-single-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Descripción</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-tab-features" data-toggle="tab" href="#product-features-content" role="tab" aria-controls="product-features-content" aria-selected="false">Características</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                            <div class="product-desc-content">
                                <p>{{ $product->slongdescription }}</p>
                                <ul>
                                    <li><i class="icon-ok"></i>Any Product types that You want - Simple, Configurable</li>
                                    <li><i class="icon-ok"></i>Downloadable/Digital Products, Virtual Products</li>
                                    <li><i class="icon-ok"></i>Inventory Management with Backordered items</li>
                                </ul>
                            </div><!-- End .product-desc-content -->
                        </div><!-- End .tab-pane -->

                        <div class="tab-pane fade" id="product-features-content" role="tabpanel" aria-labelledby="product-tab-features">
                            <div class="product-features-content">
                                
                                <table class="table table-size">
                                    <tbody>
                                        @foreach ($productattributes as $k=>$attribute)
                                        <tr>
                                            <td width="35%">{{ $attribute->sname }}:</td>
                                            <td width="75%">{{ $attribute->svalue }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <p class="note">Para encontrar mayor detalle de las características, contáctanos.</p>
                            </div><!-- End .product-tags-content -->
                        </div><!-- End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .product-single-tabs -->
            </div><!-- End .col-lg-9 -->
            
        </div><!-- End .row -->
    </div><!-- End .container-fluid -->

    @if ($featuredproducts != null && count($featuredproducts) > 0)
    <div class="featured-section">
        <div class="container-fluid">
            <h2 class="carousel-title">Productos destacados</h2>

            <div class="featured-products owl-carousel owl-theme owl-dots-top">

                @foreach ($featuredproducts as $k=>$product)
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ URL::to('/') }}/product/{{$product->nproductid}}">
                            <img src="{{ URL::to('/') }}{{'/storage/app/'.$product->sfullimage}}">
                        </a>
                        <div class="label-group">
                            <span class="product-label label-cut">27% descuento</span>
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
                                <a href="category.html" class="product-category">{{ $product->category }}</a>
                            </div>
                        </div>
                        <h2 class="product-title">
                            <a href="product.html">{{ $product->sname }}</a>
                        </h2>
                        <div class="price-box">
                            <span class="old-price">S/ {{ $product->nmasterprice }}</span>
                            <span class="product-price">S/ {{ $product->nprice }}</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
                @endforeach

            </div><!-- End .featured-proucts -->
        </div><!-- End .container-fluid -->
    </div><!-- End .featured-section -->
    @endif
</main><!-- End .main -->
@endsection