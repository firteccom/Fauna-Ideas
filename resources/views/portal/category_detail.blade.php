@extends('layouts.front')

@section('css')
<style type="text/css">
    .paginas > ul {
      -ms-flex-align: center;
      align-items: center;
      margin-bottom: 0;
      border-radius: 0;
      font-family: $second-font-family;
      font-weight: 700;
      display: flex;
      font-size: 1.2rem;
    }

    .paginas > ul {
      margin-left: auto;
    }

    .paginas > ul > li  {
        margin-left: -1px;
        padding: 0 1rem;
        border: 0;
        background-color: transparent;
        color: #939393;
        line-height: 1.25;
        display: list-item;
    }

    .paginas > ul > li.active {
        border-color: transparent;
        background-color: transparent;
        color: #000;
    }



    .paginas > ul > li a.page-link.next,
    .paginas > ul > li a.page-link.prev {
        display: -ms-inline-flexbox;
        display: inline-flex;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: center;
        justify-content: center;
        width: 4rem;
        height: 4rem;
        padding: 0;
        background-color: #000;
        color: #fff;
        font-size: 1.8rem;
        cursor: pointer;
    }
</style>
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
                                <select name="orderby" class="form-control order">
                                    <option value="default" selected="selected">Por defecto</option>
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
                            <select name="count" class="form-control count">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                        </div><!-- End .select-custom -->
                    </div><!-- End .toolbox-item -->
                </nav>


                <!-- Vista de productos en grillas -->
                <div id="gridproducts" name="gridproducts">
                    <div class="product-grid row row-sm" >
                        
                        @foreach ($categoryproducts as $k=>$product)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="{{ asset('product') }}/{{ $product->nproductid }}">
                                        <img src="{{'../storage/app/'.$product->sfullimage}}">
                                    </a>
                                    <div class="label-group">
                                        <span class="product-label label-cut">30% OFF</span>
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

                    <nav class="paginas" class="toolbox toolbox-pagination">
                    </nav>
                    
                    <div class="resultados"></div>

                </div>
                <!-- Fin de vista de productos en grillas -->


                
                <!-- Vista de productos en lista -->
                <div id="listproducts" name="listproducts">

                    <div class="product-lista product-intro row row-sm">
                        
                    </div>

                    <nav class="paginas" class="toolbox toolbox-pagination">
                    </nav>
                    
                    <div class="resultados"></div>
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


<script src="{{ asset('public/portal/js/jquery.simplePagination.js') }}"></script>

<!-- Lista de productos y paginador -->
<script>
    var app = {
        _token:null,
        pagina:0,

        params:{},

        init:function(){
            app.buscar();
        },

        buscar: function(){
            //obtener parametros de búsqueda:
            app.params._token = '{{csrf_token()}}';
            app.params.items = $('.count').val();
            app.params.order = $('.order').val(); 
            /*
            app.params.nombre = $('#txtNombre').val();
            app.params.ubigeo = '0';
            app.params.tipo_espacio = $('#cboTipoEspacio').val();*/

            app.listarProductos(1);
        },

        listarProductos: function(pagina){   
            app.params.pagina = pagina;

            $('.product-grid').html('');
            $('.product-lista').html('');

            $.post("{{ route('front.product.listproducts') }}",app.params,function(resp){

                $('.paginas').html('');

                if(resp.data){
                    $.each(resp.data, function(idx, obj){

                        var html_body = `<figure>
                                            <a href="{{ URL::to('/') }}/product/`+obj.nproductid+`">
                                                <img src="{{ URL::to('/') }}/storage/app/`+obj.sfullimage+`">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="{{ URL::to('/') }}/category/`+obj.categoryid+`" class="product-category">`+obj.category+`</a>
                                                </div>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="{{ URL::to('/') }}/product/`+obj.nproductid+`">`+obj.sname+`</a>
                                            </h2>
                                            <div class="ratings-container">
                                                
                                            </div><!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="old-price">S/ `+obj.nmasterprice+`</span>
                                                <span class="product-price">S/ `+obj.nprice+`</span>
                                            </div><!-- End .price-box -->
                                        </div>`;

                        //Estructura para grid
                        var html_grid = `<div class="col-6 col-md-4 col-lg-3 col-xl-2 product-default inner-quickview inner-icon">`+html_body+`</div>`;

                        //Estructura para lista
                        var html_list = `<div class="col-6 col-sm-12 product-default left-details product-list mb-4">`+html_body+`</div>`;


                        $('.product-grid').append(html_grid);
                        $('.product-lista').append(html_list);
                    });
                }

                if(resp.paginas && parseInt(resp.paginas) > 0){
                    $('.paginas').pagination({
                        dataSource: null,
                        items: resp.total,
                        itemsOnPage: resp.limite,
                        onPageClick: function(pageNumber, event){
                            app.listarProductos(pageNumber);
                        },
                        currentPage: resp.pagina,
                        prevText: '<',
                        nextText: '>',
                        displayedPages:3
                    });

                    $('.paginas a').click(function(ev){
                        ev.preventDefault();
                    });

                    //$('#resultados').text('Resultados: '+resp.total+' productos');
                    $('html, body').animate({scrollTop:0}, '300');
                }else{
                    //$('#resultados').text('No se encontraron productos');
                }

            }, 'json').fail(function(err){
                $('.resultados').text('');
            });
        }
    }

    app.init();


    $(document).on('change', '.count', function(event) {
        app.params.items = $(this).val();
        app.listarProductos(1);
    });


    $(document).on('change', '.order', function(event) {
        app.params.order = $(this).val();
        app.listarProductos(1);
    });

    

</script>

<!-- Cambio de vista -->
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