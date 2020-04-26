@extends('layouts.app')

@section('css')
<style type="text/css">
    input:invalid {
    border: 2px dashed red;
    }

    input:invalid:required {
    background-image: linear-gradient(to right, pink, lightgreen);
    }

    input:valid {
    border: 2px solid black;
    }
</style>
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Productos
            <small>Mantenimiento</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Tienda</a></li>
            <li class="active">Productos</li>
        </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Filtros de búsqueda</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" id="frmProducts">
                        <div class="box-body">
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterproductname">Nombre</label>
                                <input type="text" class="form-control" id="filterproductname" name="filterproductname" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterproductcategory">Categoría</label>
                                <select id="filterproductcategory" name="filterproductcategory" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->ncategoryid}}">{{$category->sname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterproductsku">SKU Producto</label>
                                <input type="text" class="form-control" id="filterproductsku" name="filterproductsku" placeholder="Ingrese un SKU" >
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterproductstatus">Estado</label>
                                <select id="filterproductstatus" name="filterproductstatus" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    <option value="A">Activo</option>
                                    <option value="N">Inactivo</option>
                                    <option value="E">Exportado</option>
                                    <option value="M">Modificado</option>
                                </select>
                            </div>
                            
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="button" class="btn btn-success btn-new-product pull-left" data-toggle="modal" data-target="#modalProduct">Nuevo</button>
                            <button type="submit" id="btnSearchProducts" name="btnSearchProducts" class="btn btn-primary pull-right">Buscar</button>
                        </div>  

                        <div class="clearfix"></div>
                        <br>

                        <div class="box  box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de productos</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="listado" class="table table-bordered table-striped">
                                    
                                </table>
                            </div>
                            <!-- /.box-body -->                         
                        </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>

        
        <div class="modal fade" id="modalProduct">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmProduct" method="post" data-parsley-validate enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title title-product">Nuevo producto</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="productcategory">Categoría <span class="required">*</span></label>
                                <select id="productcategory" name="productcategory" class="form-control select2" style="width: 100%;" required>
                                    <option value="" selected="selected">- No asignado -</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->ncategoryid}}">{{$category->sname}}</option>
                                    @endforeach
                                </select>                            
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="productsku">SKU Producto <span class="required">*</span></label>
                                <input type="text" class="form-control filter" id="productsku" name="productsku" placeholder="Ingrese un nombre" required>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="productname">Nombre <span class="required">*</span></label>
                                <input type="text" class="form-control filter" id="productname" name="productname" placeholder="Ingrese un nombre" minlenght="1" required>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="productdescription">Descripción</label>
                                <input type="text" class="form-control filter" id="productdescription" name="productdescription" placeholder="Ingrese una descripción">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="productfullimage">Imagen principal</label>
                                <input type="url" class="form-control filter" id="productfullimage" name="productfullimage" placeholder="URL de imagen principal">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="productthumbnail">Imagen miniatura</label>
                                <input type="url" class="form-control filter" id="productthumbnail" name="productthumbnail" placeholder="URL de imagen en miniatura">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="productmasterprice">Precio master <span class="required">*</span></label>
                                <input type="number" class="form-control filter" id="productmasterprice" name="productmasterprice" placeholder="Ingrese un precio master" required>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="productprice">Precio <span class="required">*</span></label>
                                <input type="text" class="form-control filter" id="productprice" name="productprice" placeholder="Ingrese un precio" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left filter" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="btnSaveProduct" class="btn btn-primary">Registrar</button>
                            <button type="submit" id="btnUpdateProduct" style="display:none;" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            <!-- /.modal-content -->
            </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal modal-danger fade" id="modalDesactivate">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Desactivar producto</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea desactivar el producto seleccionado?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnDesactivate" class="btn btn-outline">Confirmar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal modal-success fade" id="modalActivate">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Activar producto</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea activar el producto seleccionado?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnActivate" class="btn btn-outline">Confirmar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


        <div class="modal modal-danger fade" id="modalUnhighlight">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Producto destacado</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea quitar el producto de los destacados?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnunhigh" class="btn btn-outline">Confirmar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


        <div class="modal modal-success fade" id="modalHighlight">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Producto destacado</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea agregar el producto a los destacados?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnhigh" class="btn btn-outline">Confirmar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


    <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->
  
@endsection
@section('js')
<script>

    var table;
    var productid = 0;

    $(function () {
    //Initialize Select2 Elements
        $('.select2').select2();

        $('#listado').DataTable({
	        "pageLength"  : 20,
            'paging'      : true,
            "bLengthChange":false, 
            "bServerSide" : true,
            'lengthChange': true,
            'searching'   : false,
            "bSort"       : false,
            "bFilter"     : false,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : true,
            "aoColumns"   : [
                {sTitle : "#", responsivePriority: 1, targets: 0, mRender: function(data, type, row, meta) {
                    return (meta.row+1) + (meta.settings._iDisplayStart);
                }},
                {sTitle : "Categoría", mData: "categoryname"},
                {sTitle : "SKU", mData: "ssku"},
                {sTitle : "Nombre", mData: "sname"},
                {sTitle : "Descripción", mData: "sdescription"},
                {sTitle : "Precio master (S/)", mData: "nmasterprice"},
                {sTitle : "Precio oferta (S/)", mData: "nprice"},
                {sTitle : "Imagen", responsivePriority: 1, targets: 0, mRender: function(data, type, row) {
                    return '<a href="#" class="img" data-id="'+row.nproductid+'" data-title="'+row.sname+'" data-file="'+row.sthumbnailimage+'" data-toggle="modal" data-target=".bs-imagen"><img src="../storage/app/'+row.sthumbnailimage+'" width="30" height="30" /></a>';
                }}, 
                {sTitle : "Estado", mRender: function(data, type, row) {
                    switch (row.sstatus){
                        case 'A':
                            return 'Activo';
                            break;
                        case 'N':
                            return 'Inactivo';
                            break;
                        case 'E':
                            return 'Exportado';
                            break;
                        case 'M':
                            return 'Modificado';
                            break;
                        default:
                            return 'No asignado';
                    }
                }},
                {sTitle : "Acciones", mData: "Acciones", sClass:"col_center", sWidth:"80px", mRender: function(data, type, row) {

                    var high = '<a data-id="'+row.nproductid+'" high="'+row.shighlighted+'" id="btnhighlight" class="btn btn-default fa fa-star btn-highlight rw_'+row.shighlighted+'" tooltips"  data-placement="top" title="Destacado" data-original-title="Destacado"></a>';

                    if(row.sstatus != 'N'){
                        return 	high+'<a data-id="'+row.nproductid+'" class="btn btn-default fa fa-pencil btn-edit tooltips" data-toggle="modal" data-target="#modalProduct" data-placement="top" title="Editar" data-original-title="Editar"></a>'+ 
                            ' <i data-id="'+row.nproductid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                    } else{
                        return 	high+'<i data-id="'+row.nproductid+'" class="btn btn-success fa fa-thumbs-up activate tooltips" data-toggle="modal" data-target="#modalActivate"  data-toggle="tooltip" data-placement="top" title="Activar" data-original-title="Activar"></i>';
                    }
                }}
            ],
            "ajax": {
                    "url": "{{ route('admin.product.getall') }}",
                    "type": "POST"
            },

            "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron datos",
                    "info": "Mostrando _START_ al _END_ de _TOTAL_ registros",
                    "search":"Buscar",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(Filtrado desde _MAX_ registros totales)",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    }
            },

            "fnServerParams": function ( aoData ) {
                aoData._token = "{{ csrf_token() }}";
                aoData.productname = $('#filterproductname').val();
                aoData.productcategory = $('#filterproductcategory').val();
                aoData.productsku = $('#filterproductsku').val();
                aoData.productstatus = $('#filterproductstatus').val();

            },
            "drawCallback": function( settings ) {
                    $('.tooltips').tooltip();
                    var minPag = 0;
                    var maxPag = 0;

                    if($('.paginate_button').length > 2){
                        minPag = parseInt($($('.paginate_button')[1]).text());
                        maxPag = parseInt($($('.paginate_button')[$('.paginate_button').length-2]).text());

                        var inputPag = $('<div class="dt-input-page"></div>');

                        $(inputPag).find('input').change(function(ev){
                            var ipag = parseInt($(this).val()!=''?$(this).val():'0');
                            if(ipag>=minPag && ipag<=maxPag){
                                ipag = parseInt($(this).val())-1;
                                table.fnPageChange(ipag);
                            }
                        });

                        $('#listado_paginate').prepend(inputPag);
                    }	        
                },

        })

        $('#btnSearchProducts').click(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('.filter').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filterproductstatus').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filterproductcategory').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#btnSaveProduct').click(function(ev){
            ev.preventDefault();
            saveProduct();
        });

        $('#btnUpdateProduct').click(function(ev){
            ev.preventDefault();
            updateProduct();
        });

        $(document).on('click', '#btnhighlight', function(ev) {
            ev.preventDefault();
            var high = $(this).attr('high');
            var id = $(this).attr('data-id');

            if(high == 'Y'){
                $('#modalUnhighlight').modal('show');
            }else{
                $('#modalHighlight').modal('show');
            }
            productid = id;
        });


        $(document).on('click', '#btnunhigh', function(event) {
           highlightProduct('Y');
        });

        $(document).on('click', '#btnhigh', function(event) {
           highlightProduct('N');
        });


         function highlightProduct(high){
            
            $.ajax({
                url: '{{ route('admin.product.highlight') }}',
                type: 'POST',
                dataType: 'json',
                data: {high:high, id:productid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
               reloadTable();
               $('#modalUnhighlight').modal('hide');
               $('#modalHighlight').modal('hide');
            });

        }

        

        $(document).on('click', '.btn-new-product', function(event) {
            
            $("#frmProduct")[0].reset();
            $('.title-product').text('Nuevo producto');
            loadModalCategories(0);
            $('#btnSaveProduct').show();
            $('#btnUpdateProduct').hide();

        });

        $(document).on('click', '.btn-edit', function(event) {

            var id = $(this).data('id');
            $('.title-product').text('Actualizar producto');
            $('#btnSaveProduct').hide();
            $('#btnUpdateProduct').show();
            //alert(id);
            loadModalCategories(id);

            $.ajax({
                url: '{{ route('admin.product.get') }}',
                type: 'POST',
                dataType: 'json',
                data: {nproductid:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                
                productid = id;

                if (data.status == 'success') {
                    
                    $('#productsku').val(data.product.ssku);
                    $('#productname').val(data.product.sname);
                    $('#productdescription').val(data.product.sdescription);
                    $('#productcategory').val(data.product.ncategoryid);
                    $('#productcategory').select2().trigger('change');
                    $('#productfullimage').val(data.product.sfullimage);
                    $('#productthumbnail').val(data.product.sthumbnail);
                    $('#productmasterprice').val(data.product.nmasterprice);
                    $('#productprice').val(data.product.nprice);

                }else{
                    Swal.fire({
                        position: 'top-end',
                        type: 'error',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });

        });

        $(document).on('click', '.desactivate', function(event) {
            productid = $(this).data('id');
            //alert('ID: ' + productid);
        });

        $(document).on('click', '.activate', function(event) {
            productid = $(this).data('id');
            //alert('ID: ' + productid);
        });

        $(document).on('click', '#btnDesactivate', function(event) {
            event.preventDefault();
            $("#btnDesactivate").html('Desactivando...');
            $("#btnDesactivate").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.product.desactivate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:productid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnDesactivate").html('Confirmar');
                $("#btnDesactivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalDesactivate').modal('hide');
                    reloadTable();
                    productid = null;

                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });


                }else{

                    Swal.fire({
                        position: 'top-end',
                        type: 'error',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                }
            });
        });

        $(document).on('click', '#btnActivate', function(event) {
            event.preventDefault();
            $("#btnActivate").html('Activando...');
            $("#btnActivate").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.product.activate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: productid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnActivate").html('Confirmar');
                $("#btnActivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalActivate').modal('hide');
                    reloadTable();
                    productid = null;

                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });


                }else{

                    Swal.fire({
                        position: 'top-end',
                        type: 'error',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                }
            });
        });

        function reloadTable(){
            $("#listado").DataTable().ajax.reload();
        }

        function saveProduct(){
            
            productcategory = $('#productcategory').val();
            productcategoryname = $('#productcategory option:selected').text();
            productsku = $('#productsku').val();
            productname = $('#productname').val();
            productdescription = $('#productdescription').val();
            productfullimage = $('#productfullimage').val();
            productthumbnail = $('#productthumbnail').val();
            productmasterprice = $('#productmasterprice').val();
            productprice = $('#productprice').val();


            if(confirm('¿Está seguro de registrar el producto?')==true){
                $("#btnSaveProduct").html('Guardando...');
                $("#btnSaveProduct").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.product.save') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {productcategory:productcategory,productcategoryname:productcategoryname,productsku:productsku,productname:productname,productdescription:productdescription,productfullimage:productfullimage,productthumbnail:productthumbnail,productmasterprice:productmasterprice,productprice:productprice, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnSaveProduct").html('Guardar');
                    $("#btnSaveProduct").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalProduct').modal('hide');
                        $("#frmProduct")[0].reset();
                        reloadTable();
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: data.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }else{
                        reloadTable();
                        Swal.fire({
                            position: 'top-end',
                            type: 'error',
                            title: data.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                });
            }
        }

        function updateProduct(){
            
            productcategory = $('#productcategory').val();
            productcategoryname = $('#productcategory option:selected').text();
            productsku = $('#productsku').val();
            productname = $('#productname').val();
            productdescription = $('#productdescription').val();
            productfullimage = $('#productfullimage').val();
            productthumbnail = $('#productthumbnail').val();
            productmasterprice = $('#productmasterprice').val();
            productprice = $('#productprice').val();

            if(confirm('¿Está seguro de actualizar el producto?')==true){
                $("#btnUpdateProduct").html('Actualizando...');
                $("#btnUpdateProduct").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.product.update') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {productid:productid,productcategory:productcategory,productcategoryname:productcategoryname,productsku:productsku,productname:productname,productdescription:productdescription,productfullimage:productfullimage,productthumbnail:productthumbnail,productmasterprice:productmasterprice,productprice:productprice, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnUpdateProduct").html('Actualizar');
                    $("#btnUpdateProduct").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalProduct').modal('hide');
                        $("#frmProduct")[0].reset();
                        reloadTable();
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: data.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }else{
                        reloadTable();
                        Swal.fire({
                            position: 'top-end',
                            type: 'error',
                            title: data.msg,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                });
            }
        }

       

        function loadModalCategories(id){

            $.ajax({
                url: '{{ route('admin.product.getlistcategories') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                $('#productcategory').html('');
                $('#productcategory').append($("<option></option>").attr("value", "0").text("- No asignado -"));
                $.each(data, function(i, item) {
                    $('#productcategory').append($("<option></option>").attr("value", data[i].ncategoryid).text(data[i].sname));
                });
            });
        }

    })
</script>

@endsection
