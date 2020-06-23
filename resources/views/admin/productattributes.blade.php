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
            Atributos de producto
            <small>Mantenimiento</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Tienda</a></li>
            <li class="active">Atributos de producto</li>
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
                        <form role="form" id="frmProductAttributes">
                        <div class="box-body">
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterproductattributeproduct">Producto</label>
                                <select id="filterproductattributeproduct" name="filterproductattributeproduct" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->nproductid}}">{{$product->sname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterproductattributetype">Tipo de dato</label>
                                <select id="filterproductattributetype" name="filterproductattributetype" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    @foreach ($types as $type)
                                        <option value="{{$type->ntypeid}}">{{$type->sname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterproductattributename">Nombre de atributo</label>
                                <input type="text" class="form-control" id="filterproductattributename" name="filterproductattributename" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterproductattributevalue">Valor de atributo</label>
                                <input type="text" class="form-control" id="filterproductattributevalue" name="filterproductattributevalue" placeholder="Ingrese un SKU" >
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterproductattributestatus">Estado</label>
                                <select id="filterproductattributestatus" name="filterproductattributestatus" class="form-control select2" style="width: 100%;">
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
                            <button type="button" class="btn btn-success btn-new-product-attribute pull-left" data-toggle="modal" data-target="#modalProductAttribute">Nuevo</button>
                            <button type="submit" id="btnSearchProductAttributes" name="btnSearchProductAttributes" class="btn btn-primary pull-right">Buscar</button>
                        </div>  

                        <div class="clearfix"></div>
                        <br>

                        <div class="box  box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de atributos de productos</h3>
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

        
        <div class="modal fade" id="modalProductAttribute">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmProductAttribute" method="post" data-parsley-validate enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title title-product-attribute">Nuevo atributo de producto</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="productattributeproduct">Producto <span class="required">*</span></label>
                                <select id="productattributeproduct" name="productattributeproduct" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->nproductid}}">{{$product->sname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="productattributetype">Producto <span class="required">*</span></label>
                                <select id="productattributetype" name="productattributetype" class="form-control select2" style="width: 100%;">
                                    @foreach ($types as $type)
                                        <option value="{{$type->ntypeid}}">{{$type->sname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="productattributename">Nombre del atributo<span class="required">*</span></label>
                                <input type="text" class="form-control filter" id="productattributename" name="productattributename" placeholder="Ingrese un nombre" minlenght="1" required>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="productattributevalue">Valor del atributo</label>
                                <input type="text" class="form-control filter" id="productattributevalue" name="productattributevalue" placeholder="Ingrese un valor">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left filter" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="btnSaveProductAttribute" class="btn btn-primary">Registrar</button>
                            <button type="submit" id="btnUpdateProductAttribute" style="display:none;" class="btn btn-primary">Actualizar</button>
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
                <p>¿Desea desactivar el atributo del producto seleccionado?</p>
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
                <p>¿Desea activar el atributo del producto seleccionado?</p>
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

    <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->
  
@endsection
@section('js')
<script>

    var table;
    var nproductattributeid = 0;

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
                {sTitle : "Producto", mData: "productname"},
                {sTitle : "Tipo de dato", mData: "typename"},
                {sTitle : "Nombre", mData: "sname"},
                {sTitle : "Valor", mData: "svalue"},
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
                    if(row.sstatus != 'N'){
                        return 	'<a data-id="'+row.nproductattributeid+'" class="btn btn-default fa fa-pencil btn-edit tooltips" data-toggle="modal" data-target="#modalProductAttribute" data-placement="top" title="Editar" data-original-title="Editar"></a>'+ 
                            ' <i data-id="'+row.nproductattributeid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                    } else{
                        return 	'<i data-id="'+row.nproductattributeid+'" class="btn btn-success fa fa-thumbs-up activate tooltips" data-toggle="modal" data-target="#modalActivate"  data-toggle="tooltip" data-placement="top" title="Activar" data-original-title="Activar"></i>';
                    }
                }}
            ],
            "ajax": {
                    "url": "{{ route('admin.productattribute.getall') }}",
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
                aoData.productattributeproduct = $('#filterproductattributeproduct').val();
                aoData.productattributetype = $('#filterproductattributetype').val();
                aoData.productattributename = $('#filterproductattributename').val();
                aoData.productattributevalue = $('#filterproductattributevalue').val();
                aoData.productattributestatus = $('#filterproductattributestatus').val();

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

        });

        $('#btnSearchProductAttributes').click(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('.filter').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filterproductattributestatus').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filterproductattributeproduct').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filterproductattributetype').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#btnSaveProductAttribute').click(function(ev){
            ev.preventDefault();
            saveProduct();
        });

        $('#btnUpdateProductAttribute').click(function(ev){
            ev.preventDefault();
            updateProduct();
        });

        $(document).on('click', '.btn-new-product-attribute', function(event) {
            
            $("#frmProductAttribute")[0].reset();
            $('.title-product-attribute').text('Nuevo atributo del producto');
            loadModalProducts(0);
            $('#btnSaveProductAttribute').show();
            $('#btnUpdateProductAttribute').hide();

        });

        $(document).on('click', '.btn-edit', function(event) {

            var id = $(this).data('id');
            $('.title-product-attribute').text('Actualizar atributo del producto');
            $('#btnSaveProductAttribute').hide();
            $('#btnUpdateProductAttribute').show();
            //alert(id);
            loadModalProducts(id);
            loadModalTypes(id);

            $.ajax({
                url: '{{ route('admin.productattribute.get') }}',
                type: 'POST',
                dataType: 'json',
                data: {nproductattributeid:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                
                nproductattributeid = id;

                if (data.status == 'success') {

                    setTimeout(function(){ 
                        $('#productattributeproduct').val(data.productattribute.nproductid);
                        $('#productattributeproduct').select2().trigger('change');
                    }, 400);

                    setTimeout(function(){ 
                        $('#productattributetype').val(data.productattribute.ntypeid);
                        $('#productattributetype').select2().trigger('change');
                    }, 400);

                    
                    $('#productattributename').val(data.productattribute.sname);
                    $('#productattributevalue').val(data.productattribute.svalue);

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
            nproductattributeid = $(this).data('id');
            //alert('ID: ' + nproductattributeid);
        });

        $(document).on('click', '.activate', function(event) {
            nproductattributeid = $(this).data('id');
            //alert('ID: ' + nproductattributeid);
        });

        $(document).on('click', '#btnDesactivate', function(event) {
            event.preventDefault();
            $("#btnDesactivate").html('Desactivando...');
            $("#btnDesactivate").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.productattribute.desactivate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:nproductattributeid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnDesactivate").html('Confirmar');
                $("#btnDesactivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalDesactivate').modal('hide');
                    reloadTable();
                    nproductattributeid = null;

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
                url: '{{ route('admin.productattribute.activate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: nproductattributeid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnActivate").html('Confirmar');
                $("#btnActivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalActivate').modal('hide');
                    reloadTable();
                    nproductattributeid = null;

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

            productattributeproduct = $('#productattributeproduct').val();
            productattributetype = $('#productattributetype').val();
            productattributetypename = $('#productattributetype option:selected').text();
            productattributename = $('#productattributename').val();
            productattributevalue = $('#productattributevalue').val();

            if(confirm('¿Está seguro de registrar el atributo del producto?')==true){
                $("#btnSaveProductAttribute").html('Guardando...');
                $("#btnSaveProductAttribute").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.productattribute.save') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {productattributeproduct:productattributeproduct,productattributetype:productattributetype,productattributetypename:productattributetypename,productattributename:productattributename,productattributevalue:productattributevalue, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnSaveProductAttribute").html('Guardar');
                    $("#btnSaveProductAttribute").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalProductAttribute').modal('hide');
                        $("#frmProductAttribute")[0].reset();
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
              
            productattributeproduct = $('#productattributeproduct').val();
            productattributetype = $('#productattributetype').val();
            productattributetypename = $('#productattributetype option:selected').text();
            productattributename = $('#productattributename').val();
            productattributevalue = $('#productattributevalue').val();

            if(confirm('¿Está seguro de actualizar el atributo del producto?')==true){
                $("#btnUpdateProductAttribute").html('Actualizando...');
                $("#btnUpdateProductAttribute").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.productattribute.update') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {nproductattributeid:nproductattributeid,productattributeproduct:productattributeproduct,productattributetype:productattributetype,productattributetypename:productattributetypename,productattributename:productattributename,productattributevalue:productattributevalue, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnUpdateProductAttribute").html('Actualizar');
                    $("#btnUpdateProductAttribute").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalProductAttribute').modal('hide');
                        $("#frmProductAttribute")[0].reset();
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

        function loadModalProducts(id){

            $.ajax({
                url: '{{ route('admin.productattribute.getlistproducts') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                $('#productattributeproduct').html('');
                $('#productattributeproduct').append($("<option></option>").attr("value", "0").text("- No asignado -"));
                $.each(data, function(i, item) {
                    $('#productattributeproduct').append($("<option></option>").attr("value", data[i].nproductid).text(data[i].sname));
                });
            });
        }

        function loadModalTypes(id){

            $.ajax({
                url: '{{ route('admin.productattribute.getlisttypes') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                $('#productattributetype').html('');
                $.each(data, function(i, item) {
                    $('#productattributetype').append($("<option></option>").attr("value", data[i].ntypeid).text(data[i].sname));
                });
            });
        }

        })
        </script>

        @endsection


        