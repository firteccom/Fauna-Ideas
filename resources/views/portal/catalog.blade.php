@extends('layouts.front')

@section('css')

<style type="text/css">
	#paginas > ul {
	  -ms-flex-align: center;
	  align-items: center;
	  margin-bottom: 0;
	  border-radius: 0;
	  font-family: $second-font-family;
	  font-weight: 700;
	  display: flex;
	  font-size: 1.2rem;
	}

	#paginas > ul {
	  margin-left: auto;
	}

	#paginas > ul > li  {
	    margin-left: -1px;
	    padding: 0 1rem;
	    border: 0;
	    background-color: transparent;
	    color: #939393;
	    line-height: 1.25;
	    display: list-item;
	}

	#paginas > ul > li.active {
	    border-color: transparent;
	    background-color: transparent;
	    color: #000;
	}



	#paginas > ul > li a.page-link.next,
	#paginas > ul > li a.page-link.prev {
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

            <!--<div class="banner banner-fixed">
                <img src="assets/images/banners/banner-1.jpg" alt="banner">
                <div class="banner-content">
                    <h1>{{ $catalog->sname }}</h1>
            </div> --> <!--End .banner -->

            <nav aria-label="breadcrumb" class="breadcrumb-nav below-banner">
                <div class="container-fluid">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Catálogos</li>
                    </ol>
                </div><!-- End .container-fluid -->
            </nav>

            <div class="container-fluid">
                <nav class="toolbox">
                    <div class="toolbox-left">
                        <div class="toolbox-item toolbox-sort">
                            <label>Ordenar por:</label>

                            <div class="select-custom">
                                <select name="orderby" class="form-control">
                                    <option value="0" selected="selected">Más nuevos</option>
                                    <option value="1">Destacados</option>
                                    <option value="2">Menor precio primero</option>
                                    <option value="3">Mayor precio primero</option>
                                </select>
                            </div><!-- End .select-custom -->

                        </div><!-- End .toolbox-item -->

                    </div><!-- End .toolbox-left -->

                    <!--<div class="toolbox-item toolbox-show">
                        <label>Mostrar:</label>

                        <div class="select-custom">
                            <select name="count" class="form-control">
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div> -->
                </nav>

                <div class="product-wrapper">
                	<div class="product-intro divide-line up-effect">
                	</div>
                </div>

                <nav id="paginas" class="toolbox toolbox-pagination">
                </nav>

                <div id="resultados"></div>
            </div><!-- End .container-fluid -->

            <div class="mb-3"></div><!-- margin -->
        </main><!-- End .main -->

@endsection



@section('js')
<script src="{{ asset('public/portal/js/jquery.simplePagination.js') }}"></script>
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
		    	app.params._token='{{csrf_token()}}';
		        /*
		        app.params.nombre = $('#txtNombre').val();
		        app.params.ubigeo = '0';
		        app.params.tipo_espacio = $('#cboTipoEspacio').val();*/

		        app.listarProductos(1);
		    },

		    listarProductos: function(pagina){   
		        app.params.pagina = pagina;

		        $('.product-intro').html('');

		        $.post("{{ route('front.catalog.listproducts') }}",app.params,function(resp){
		            $('#product-wrapper').html('');
		            $('#toolbox-pagination').html('');

		            if(resp.data){
		                $.each(resp.data, function(idx, obj){
		                	var html = `<div class="col-6 col-md-4 col-lg-3 col-xl-2 product-default inner-quickview inner-icon pr-4 pl-4">
				                            <figure>
				                                <a href="product.html">
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
				                                    <a href="product.html">`+obj.sname+`</a>
				                                </h2>
				                                <div class="ratings-container">
				                                    
				                                </div><!-- End .product-container -->
				                                <div class="price-box">
				                                    <span class="old-price">S/ `+obj.nmasterprice+`</span>
				                                    <span class="product-price">S/ `+obj.nprice+`</span>
				                                </div><!-- End .price-box -->
				                            </div>
				                        </div>`;
		                    $('.product-intro').append(html);
		                });
		            }

		            if(resp.paginas && parseInt(resp.paginas) > 0){
		                $('#paginas').pagination({
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

		                $('#paginas a').click(function(ev){
		                    ev.preventDefault();
		                });

		                //$('#resultados').text('Resultados: '+resp.total+' productos');
		                $('html, body').animate({scrollTop:0}, '300');
		            }else{
		                //$('#resultados').text('No se encontraron productos');
		            }

		        }, 'json').fail(function(err){
		            $('#resultados').text('');
		        });
		    }
		}
    
    app.init();
</script>

@endsection