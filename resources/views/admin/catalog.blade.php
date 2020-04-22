@extends('layouts.app')

@section('css')
<style type="text/css">

</style>
<script type="module">
  import Swal from 'sweetalert2/src/sweetalert2.js'
</script>
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Catálogos
            <small>Mantenimiento</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Tienda</a></li>
            <li class="active">Catálogos</li>
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
                        <form role="form" id="frmListCatalog">
                        <div class="box-body">
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filtercatalogname">Nombre</label>
                                <input type="text" class="form-control" id="filtercatalogname" name="filtercatalogname" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filtercatalogdescription">Descripción</label>
                                <input type="text" class="form-control" id="filtercatalogdescription" name="filtercatalogdescription" placeholder="Ingrese una descripción">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filtercatalogstatus">Estado</label>
                                <select id="filtercatalogstatus" name="filtercatalogstatus" class="form-control select2" style="width: 100%;">
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
                                <button type="button" class="btn btn-success btn-new-catalog pull-left" data-toggle="modal" data-target="#modalCatalog">Nuevo</button>
                                <button type="submit" id="btnSearchCatalog" name="btnSearchCatalog" class="btn btn-primary pull-right">Buscar</button>
                            </div>  

                            <div class="clearfix"></div>
                            <br>

                        <div class="box  box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de catálogos</h3>
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
        
        <div class="modal fade" id="modalCatalog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmCatalog" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title title-catalog">Nuevo catálogo</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="catalogname">Nombre</label>
                                <input type="text" class="form-control filter" id="catalogname" name="catalogname" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="catalogdescription">Descripción</label>
                                <input type="text" class="form-control filter" id="catalogdescription" name="catalogdescription" placeholder="Ingrese una descripción">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="catalogfullimage">Imagen</label>
                                <input type="url" class="form-control filter" id="catalogfullimage" name="catalogfullimage" placeholder="URL de imagen">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left filter" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="btnSaveCatalog" class="btn btn-primary">Registrar</button>
                            <button type="button" id="btnUpdateCatalog" style="display:none;" class="btn btn-primary">Actualizar</button>
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
                <h4 class="modal-title">Desactivar catálogo</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea desactivar el catálogo seleccionado?</p>
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
                <h4 class="modal-title">Activar catálogo</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea activar el catálogo seleccionado?</p>
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
    var catalogid = 0;

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
            'autoWidth'   : false,
            "aoColumns"   : [
                {sTitle : "#", responsivePriority: 1, targets: 0, mRender: function(data, type, row, meta) {
                    return (meta.row+1) + (meta.settings._iDisplayStart);
                }},           
                {sTitle : "Nombre", mData: "sname"},
                {sTitle : "Descripción", mData: "sdescription"},
                {sTitle : "Imagen", responsivePriority: 1, targets: 0, mRender: function(data, type, row) {
                    return '<a href="#" class="img" data-id="'+row.ncatalogid+'" data-title="'+row.sname+'" data-file="'+row.sfullimage+'" data-toggle="modal" data-target=".bs-imagen"><img src="'+row.sfullimage+'"  height="100" /></a>';
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
                    if(row.sstatus != 'N'){
                        return 	'<a data-id="'+row.ncatalogid+'" class="btn btn-default fa fa-pencil btn-edit tooltips" data-toggle="modal" data-target="#modalCatalog" data-placement="top" title="Editar" data-original-title="Editar"></a>'+ 
                            ' <i data-id="'+row.ncatalogid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                    } else{
                        return 	'<i data-id="'+row.ncatalogid+'" class="btn btn-success fa fa-thumbs-up activate tooltips" data-toggle="modal" data-target="#modalActivate"  data-toggle="tooltip" data-placement="top" title="Activar" data-original-title="Activar"></i>';
                    }
                }}
            ],
            "ajax": {
                    "url": "{{ route('admin.catalog.getall') }}",
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
                aoData.catalogname = $('#filtercatalogname').val();
                aoData.catalogdescription = $('#filtercatalogdescription').val();
                aoData.catalogstatus = $('#filtercatalogstatus').val();


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

        $('#btnSearchCatalog').click(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('.filter').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filtercatalogstatus').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#btnSaveCatalog').click(function(ev){
            ev.preventDefault();
            saveCatalog();
        });

        $('#btnUpdateCatalog').click(function(ev){
            ev.preventDefault();
            updateCatalog();
        });

        $(document).on('click', '.btn-new-catalog', function(event) {
            
            $("#frmCatalog")[0].reset();
            $('.title-catalog').text('Nuevo catálogo');
            $('#btnSaveCatalog').show();
            $('#btnUpdateCatalog').hide();

        });

        $(document).on('click', '.btn-edit', function(event) {

            var id = $(this).data('id');
            $('.title-catalog').text('Actualizar catálogo');
            $('#btnSaveCatalog').hide();
            $('#btnUpdateCatalog').show();

            $.ajax({
                url: '{{ route('admin.catalog.get') }}',
                type: 'POST',
                dataType: 'json',
                data: {ncatalogid:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                
                catalogid = id;

                if (data.status == 'success') {

                    $('#catalogname').val(data.catalog.sname);
                    $('#catalogdescription').val(data.catalog.sdescription);
                    $('#catalogfullimage').val(data.catalog.sfullimage);

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
            catalogid = $(this).data('id');
            //alert('ID: ' + catalogid);
        });

        $(document).on('click', '.activate', function(event) {
            catalogid = $(this).data('id');
            //alert('ID: ' + catalogid);
        });

        $(document).on('click', '#btnDesactivate', function(event) {
            event.preventDefault();
            $("#btnDesactivate").html('Desactivando...');
            $("#btnDesactivate").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.catalog.desactivate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:catalogid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnDesactivate").html('Confirmar');
                $("#btnDesactivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalDesactivate').modal('hide');
                    reloadTable();
                    catalogid = null;

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
                url: '{{ route('admin.catalog.activate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: catalogid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnActivate").html('Confirmar');
                $("#btnActivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalActivate').modal('hide');
                    reloadTable();
                    catalogid = null;

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

        function saveCatalog(){
            
            catalogname = $('#catalogname').val();
            catalogdescription = $('#catalogdescription').val();
            catalogfullimage = $('#catalogfullimage').val();

            if(confirm('¿Está seguro de registrar el catálogo?')==true){
                $("#btnSaveCatalog").html('Guardando...');
                $("#btnSaveCatalog").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.catalog.save') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {catalogname:catalogname, catalogdescription:catalogdescription, catalogfullimage:catalogfullimage, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnSaveCatalog").html('Guardar');
                    $("#btnSaveCatalog").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalCatalog').modal('hide');
                        $("#frmCatalog")[0].reset();
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

        function updateCatalog(){
            
            catalogname = $('#catalogname').val();
            catalogdescription = $('#catalogdescription').val();
            catalogfullimage = $('#catalogfullimage').val();

            if(confirm('¿Está seguro de actualizar el catálogo?')==true){
                $("#btnUpdateCatalog").html('Actualizando...');
                $("#btnUpdateCatalog").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.catalog.update') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {catalogid:catalogid, catalogname:catalogname, catalogdescription:catalogdescription, catalogfullimage:catalogfullimage, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnUpdateCatalog").html('Actualizar');
                    $("#btnUpdateCatalog").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalCatalog').modal('hide');
                        $("#frmCatalog")[0].reset();
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

       
        
    });
</script>

@endsection
