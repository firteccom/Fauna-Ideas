@extends('layouts.app')

@section('css')
<style type="text/css">

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
                                <label for="productname">Nombre</label>
                                <input type="text" class="form-control" id="productname" name="productname" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="productcategory">Categoría</label>
                                <select id="productcategory" name="productcategory" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->ncategoryid}}">{{$category->sname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="productsku">Sku</label>
                                <input type="text" class="form-control" id="productsku" name="productsku" placeholder="Ingrese un SKU">
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="productstatus">Estado</label>
                                <select id="productstatus" name="productstatus" class="form-control select2" style="width: 100%;">
                                    <option selected="selected">- Seleccione una opción -</option>
                                    <option value="A">Activo</option>
                                    <option value="N">Inactivo</option>
                                    <option value="E">Exportado</option>
                                    <option value="M">Modificado</option>
                                </select>
                            </div>
                            
                        </div>
                        <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" id="btnSearchProducts" name="btnSearchProducts" class="btn btn-primary">Buscar</button>
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
    <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->
  
@endsection
@section('js')
<script>

    var table;

    $(function () {
    //Initialize Select2 Elements
        $('.select2').select2();

        $('#listado').DataTable({
	        "pageLength"  : 20,
            'paging'      : true,
            "bServerSide" : true,
            'lengthChange': false,
            'searching'   : true,
            "bSort"       : false,
            "bFilter"     : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "aoColumns"   : [
                {sTitle : "#", responsivePriority: 1, targets: 0, mRender: function(data, type, row, meta) {
                    return (meta.row+1) + (meta.settings._iDisplayStart);
                }},
                {sTitle : "Nombre", mData: "sname"},
                {sTitle : "Descripción", mData: "sdescription"},
                {sTitle : "Imagen", responsivePriority: 1, targets: 0, mRender: function(data, type, row) {
                    return '<a href="#" class="img" data-id="'+row.nproductid+'" data-title="'+row.sname+'" data-file="'+row.sthumbnailimage+'" data-toggle="modal" data-target=".bs-imagen"><img src="'+row.sthumbnailimage+'" width="30" height="30" /></a>';
                }}, 
                {sTitle : "Categoría", mData: "ncategoryid"}
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

            },
            "drawCallback": function( settings ) {
                    $('.tooltips').tooltip();
                    var minPag = 0;
                    var maxPag = 0;

                    if($('.paginate_button').length > 2){
                        minPag = parseInt($($('.paginate_button')[1]).text());
                        maxPag = parseInt($($('.paginate_button')[$('.paginate_button').length-2]).text());

                        var inputPag = $('<div class="dt-input-page"><label>Página:</label> <input type="number" value="'+parseInt($('.paginate_button.active').text())+'" min="'+minPag+'" max="'+maxPag+'" /></div>');

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

    })
</script>

@endsection
