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
            Tipos de valor
            <small>Mantenimiento</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Tienda</a></li>
            <li class="active">Tipos de valor</li>
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
                        <form role="form" id="frmListTypes">
                        <div class="box-body">
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filtertypename">Nombre</label>
                                <input type="text" class="form-control" id="filtertypename" name="filtertypename" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filtertypedescription">Descripción</label>
                                <input type="text" class="form-control" id="filtertypedescription" name="filtertypedescription" placeholder="Ingrese una descripción">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filtertypeextension">Extensión</label>
                                <input type="text" class="form-control" id="filtertypeextension" name="filtertypeextension" placeholder="Ingrese una extensión">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filtertypestatus">Estado</label>
                                <select id="filtertypestatus" name="filtertypestatus" class="form-control select2" style="width: 100%;">
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
                                <button type="button" class="btn btn-success btn-new-type pull-left" data-toggle="modal" data-target="#modalType">Nuevo</button>
                                <button type="submit" id="btnSearchTypes" name="btnSearchTypes" class="btn btn-primary pull-right">Buscar</button>
                            </div>  

                            <div class="clearfix"></div>
                            <br>

                        <div class="box  box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de tipos de valor</h3>
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
        
        <div class="modal fade" id="modalType">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmType" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title title-type">Nueva tipo de valor</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="typeparent">Tipo de valor padre</label>
                                <select id="typeparent" name="typeparent" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- No asignado -</option>
                                    @foreach ($types as $type)
                                        <option value="{{$type->ntypeid}}">{{$type->sname}}</option>
                                    @endforeach
                                </select>                            
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="typename">Nombre</label>
                                <input type="text" class="form-control filter" id="typename" name="typename" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="typeextension">Extensión</label>
                                <input type="text" class="form-control filter" id="typeextension" name="typeextension" placeholder="Ingrese una extensión">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="typedescription">Descripción</label>
                                <input type="text" class="form-control filter" id="typedescription" name="typedescription" placeholder="Ingrese una descripción">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left filter" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="btnSaveType" class="btn btn-primary">Registrar</button>
                            <button type="button" id="btnUpdateType" style="display:none;" class="btn btn-primary">Actualizar</button>
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
                <h4 class="modal-title">Desactivar tipo de valor</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea desactivar el tipo de valor seleccionado?</p>
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
                <h4 class="modal-title">Activar tipo de valor</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea activar el tipo de valor seleccionado?</p>
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
    var typeid = 0;

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
                {sTitle : "Tipo de valor padre", mRender: function(data, type, row) {
                    if(row.typeparent != null){
                        return ($.trim(row.typeparent) != '') ? row.typeparent : 'No asignado';
                    }else{
                        return 'No asignado';
                    }
                }},           
                {sTitle : "Nombre", mData: "sname"},
                {sTitle : "Descripción", mData: "sdescription"},
                {sTitle : "Extensión", mData: "sextension"},
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
                        return 	'<a data-id="'+row.ntypeid+'" class="btn btn-default fa fa-pencil btn-edit tooltips" data-toggle="modal" data-target="#modalType" data-placement="top" title="Editar" data-original-title="Editar"></a>'+ 
                            ' <i data-id="'+row.ntypeid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                    } else{
                        return 	'<i data-id="'+row.ntypeid+'" class="btn btn-success fa fa-thumbs-up activate tooltips" data-toggle="modal" data-target="#modalActivate"  data-toggle="tooltip" data-placement="top" title="Activar" data-original-title="Activar"></i>';
                    }
                }}
            ],
            "ajax": {
                    "url": "{{ route('admin.type.getall') }}",
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
                aoData.typename = $('#filtertypename').val();
                aoData.typedescription = $('#filtertypedescription').val();
                aoData.typeextension = $('#filtertypeextension').val();
                aoData.typestatus = $('#filtertypestatus').val();


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

        $('#btnSearchTypes').click(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('.filter').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filtertypestatus').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#btnSaveType').click(function(ev){
            ev.preventDefault();
            saveType();
        });

        $('#btnUpdateType').click(function(ev){
            ev.preventDefault();
            updateType();
        });

        $(document).on('click', '.btn-new-type', function(event) {
            
            $("#frmType")[0].reset();
            $('.title-type').text('Nuevo tipo');
            loadModalTypes(0);
            $('#btnSaveType').show();
            $('#btnUpdateType').hide();

        });

        $(document).on('click', '.btn-edit', function(event) {

            var id = $(this).data('id');
            $('.title-type').text('Actualizar tipo de valor');
            $('#btnSaveType').hide();
            $('#btnUpdateType').show();
            //alert(id);
            loadModalTypes(id);

            $.ajax({
                url: '{{ route('admin.type.get') }}',
                type: 'POST',
                dataType: 'json',
                data: {ntypeid:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                
                typeid = id;

                if (data.status == 'success') {

                    $('#typeparent').val(data.type.ntypeparentid);
                    $('#typeparent').select2().trigger('change');
                    $('#typename').val(data.type.sname);
                    $('#typedescription').val(data.type.sdescription);
                    $('#typeextension').val(data.type.sextension);

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
            typeid = $(this).data('id');
            //alert('ID: ' + typeid);
        });

        $(document).on('click', '.activate', function(event) {
            typeid = $(this).data('id');
            //alert('ID: ' + typeid);
        });

        $(document).on('click', '#btnDesactivate', function(event) {
            event.preventDefault();
            $("#btnDesactivate").html('Desactivando...');
            $("#btnDesactivate").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.type.desactivate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:typeid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnDesactivate").html('Confirmar');
                $("#btnDesactivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalDesactivate').modal('hide');
                    reloadTable();
                    typeid = null;

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
                url: '{{ route('admin.type.activate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: typeid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnActivate").html('Confirmar');
                $("#btnActivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalActivate').modal('hide');
                    reloadTable();
                    typeid = null;

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

        function saveType(){
            
            typeparent = $('#typeparent').val();
            typename = $('#typename').val();
            typedescription = $('#typedescription').val();
            typeextension = $('#typeextension').val();

            if(confirm('¿Está seguro de registrar el tipo?')==true){
                $("#btnSaveType").html('Guardando...');
                $("#btnSaveType").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.type.save') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {typeparent:typeparent, typename:typename, typedescription:typedescription, typeextension:typeextension, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnSaveType").html('Guardar');
                    $("#btnSaveType").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalType').modal('hide');
                        $("#frmType")[0].reset();
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

        function updateType(){
            
            typeparent = $('#typeparent').val();
            typename = $('#typename').val();
            typedescription = $('#typedescription').val();
            typeextension = $('#typeextension').val();

            if(confirm('¿Está seguro de actualizar el tipo?')==true){
                $("#btnUpdateType").html('Actualizando...');
                $("#btnUpdateType").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.type.update') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {typeid:typeid, typeparent:typeparent, typename:typename, typedescription:typedescription, typeextension:typeextension, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnUpdateType").html('Actualizar');
                    $("#btnUpdateType").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalType').modal('hide');
                        $("#frmType")[0].reset();
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

        function loadModalTypes(id){

            $.ajax({
                url: '{{ route('admin.type.getlist') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                $('#typeparent').html('');
                $('#typeparent').append($("<option></option>").attr("value", "0").text("- No asignado -"));
                $.each(data, function(i, item) {
                    $('#typeparent').append($("<option></option>").attr("value", data[i].ntypeid).text(data[i].sname));
                });
            });
        }
        
    });
</script>

@endsection
