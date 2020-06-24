@extends('layouts.front')

@section('css')
<style type="text/css">

</style>
<script type="module">
  import Swal from 'sweetalert2/src/sweetalert2.js'
</script>
@endsection

@section('frontcontent')

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-md-4">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Categoría</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->category }}</li>
            </ol>
        </div><!-- End .container-fluid -->
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 padding-left-lg col-xl-10">
                <div class="banner banner-cat">
                    <img src="{{ asset('public/portal/images/banners/banner-1.jpg') }}" alt="banner">
                    <div class="banner-content">
                        <h1>Categoría {{ $category->sname }}</h1>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->

                <nav class="toolbox">
                    <div class="toolbox-left">
                        <div class="toolbox-item toolbox-sort">
                            <label>Ordenar por:</label>

                            <div class="select-custom">
                                <select name="orderby" class="form-control">
                                    <option value="menu_order" selected="selected">Por defecto</option>
                                    <option value="popularity">Más populares</option>
                                    <option value="date">Lo nuevo</option>
                                    <option value="price">Precio ascendente</option>
                                    <option value="price-desc">Precio descendente</option>
                                </select>
                            </div><!-- End .select-custom -->

                            <a href="#" class="sorter-btn" title="Set Ascending Direction"><span class="sr-only">Set Ascending Direction</span></a>
                        </div><!-- End .toolbox-item -->

                        <div class="layout-modes">
                            <a href="#" class="layout-btn btn-grid active" id="viewgridproducts" name="viewgridproducts" title="Cuadricula">
                                <i class="icon-mode-grid"></i>
                            </a>
                            <a href="#" class="layout-btn btn-list" id="viewlistproducts" name="viewlistproducts" title="Lista">
                                <i class="icon-mode-list"></i>
                            </a>
                        </div><!-- End .layout-modes -->
                    </div><!-- End .toolbox-left -->

                    <div class="toolbox-item toolbox-show">
                        <label>Mostrar:</label>

                        <div class="select-custom">
                            <select name="count" class="form-control">
                                <option value="20">20</option>
                                <option value="40">40</option>
                                <option value="60">60</option>
                            </select>
                        </div><!-- End .select-custom -->
                    </div><!-- End .toolbox-item -->
                </nav>

                <!-- Vista de productos en grillas -->
                <div id="gridproducts" name="gridproducts">
                    <div class="row row-sm" >
                        
                        @foreach ($categoryproducts as $k=>$product)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="{{ asset('product') }}/{{ $product->nproductid }}">
                                        <img src="{{'../storage/app/'.$product->sfullimage}}">
                                    </a>
                                    <div class="label-group">
                                        <span class="product-label label-cut">27% OFF</span>
                                    </div>
                                    <div class="btn-icon-group">
                                        <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="category.html" class="product-category">category</a>
                                        </div>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ asset('product') }}/{{ $product->nproductid }}">{{ $product->sname }}</a>
                                    </h2>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div><!-- End .product-ratings -->
                                    </div><!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="old-price">S/ {{ $product->nmasterprice }}</span>
                                        <span class="product-price">S/ {{ $product->nprice }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div>
                        @endforeach

                        

                    </div>

                    <nav class="toolbox toolbox-pagination">
                        <ul class="pagination">
                            <li class="page-item active">
                                <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><span class="page-link">...</span></li>
                            <li class="page-item">
                                <a class="page-link page-link-btn" href="#"><i class="icon-angle-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Fin de vista de productos en grillas -->
                
                <!-- Vista de productos en lista -->
                <div id="listproducts" name="listproducts">

                    <div class="product-intro row row-sm">
                        
                        @foreach ($categoryproducts as $k=>$product)
                        <div class="col-6 col-sm-12 product-default left-details product-list mb-4">
                            <figure>
                                <a href="product.html">
                                    <img src="{{'../storage/app/'.$product->sfullimage}}">
                                </a>
                            </figure>
                            <div class="product-details">
                                <div class="category-list">
                                    <a href="category.html" class="product-category">category</a>
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ asset('product') }}/{{ $product->nproductid }}">{{ $product->sname }}</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <p class="product-description">{{ $product->sdescription }}</p>
                                <div class="price-box">
                                    <span class="old-price">S/ {{ $product->nmasterprice }}</span>
                                    <span class="product-price">S/ {{ $product->nprice }}</span>
                                </div><!-- End .price-box -->
                                <div class="product-action">
                                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Vista rápida"><i class="fas fa-external-link-alt"></i></a> 
                                </div>
                            </div><!-- End .product-details -->
                        </div>   
                        @endforeach

                    </div>

                    <nav class="toolbox toolbox-pagination">
                        <ul class="pagination">
                            <li class="page-item active">
                                <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><span class="page-link">...</span></li>
                            <li class="page-item">
                                <a class="page-link page-link-btn" href="#"><i class="icon-angle-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Fin de vista de productos en lista -->

            </div><!-- End .col-lg-8 -->

            <!-- Barra lateral de filtros -->
            <aside class="sidebar-shop col-lg-3 col-xl-2 order-lg-first">
                <div class="sidebar-wrapper">

                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-5" role="button" aria-expanded="true" aria-controls="widget-body-5">Marca</a>
                        </h3>

                        <div class="collapse show" id="widget-body-5">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    @foreach ($filterbrand as $k=>$brand)
                                        <li><a href="#">{{ $brand->svalue }}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">Tamaño</a>
                        </h3>

                        <div class="collapse show" id="widget-body-4">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    @foreach ($filtersize as $k=>$size)
                                        <li><a href="#">{{ $size->svalue }}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">Año</a>
                        </h3>

                        <div class="collapse show" id="widget-body-4">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    @foreach ($filteryear as $k=>$year)
                                        <li><a href="#">{{ $year->svalue }}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-6" role="button" aria-expanded="true" aria-controls="widget-body-6">Color</a>
                        </h3>

                        <div class="collapse show" id="widget-body-6">
                            <div class="widget-body">
                                <ul class="config-swatch-list">
                                    <li class="active">
                                        <a href="#" style="background-color: #1645f3;"></a>
                                        <span>Blue</span>
                                    </li>
                                    <li>
                                        <a href="#" style="background-color: #f11010;"></a>
                                        <span>Red</span>
                                    </li>
                                    <li>
                                        <a href="#" style="background-color: #fe8504;"></a>
                                        <span>Orange</span>
                                    </li>
                                    <li>
                                        <a href="#" style="background-color: #2da819;"></a>
                                        <span>Green</span>
                                    </li>
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Rango de precios</a>
                        </h3>

                        <div class="collapse show" id="widget-body-3">
                            <div class="widget-body">
                                <form action="#">
                                    <div class="price-slider-wrapper">
                                        <div id="price-slider"></div><!-- End #price-slider -->
                                    </div><!-- End .price-slider-wrapper -->

                                    <div class="filter-price-action">
                                        <button type="submit" class="btn btn-primary">Filter</button>

                                        <div class="filter-price-text">
                                            Precio:
                                            <span id="filter-price-range"></span>
                                        </div><!-- End .filter-price-text -->
                                    </div><!-- End .filter-price-action -->
                                </form>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->
                </div><!-- End .sidebar-wrapper -->
            </aside><!-- End .col-lg-4 -->
        </div><!-- End .row -->
    </div><!-- End .container-fluid -->

    <div class="mb-3"></div><!-- margin -->
</main><!-- End .main -->

@endsection

@section('js')
<script>

    var typeview = 1;

    $(function() {

        if (typeview == 1){
            $('#listproducts').hide();
            $('#gridproducts').show();
        } else {
            $('#gridproducts').hide();
            $('#listproducts').show();
        }

        $(document).on('click', '#viewgridproducts', function(event) {
            $('#listproducts').hide();
            $('#viewlistproducts').removeClass("active");
            $('#viewgridproducts').addClass("active");
            $('#gridproducts').show();    
        });

        $(document).on('click', '#viewlistproducts', function(event) {
            $('#gridproducts').hide();
            $('#viewgridproducts').removeClass("active");
            $('#viewlistproducts').addClass("active");
            $('#listproducts').show();
        });        
    
    });
</script>

@endsection