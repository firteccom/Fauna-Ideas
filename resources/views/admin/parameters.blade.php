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
            Configuración
            <small>Mantenimiento</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Mantenimiento</a></li>
            <li class="active">Configuración</li>
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
                        <form role="form" id="frmListCategories">
                        <div class="box-body">
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterparametername">Nombre</label>
                                <input type="text" class="form-control" id="filterparametername" name="filterparametername" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterparametercode">Código</label>
                                <input type="text" class="form-control" id="filterparametercode" name="filterparametercode" placeholder="Ingrese una abreviatura">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterparameterstatus">Estado</label>
                                <select id="filterparameterstatus" name="filterparameterstatus" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    <option value="A">Activo</option>
                                    <option value="N">Inactivo</option>
                                </select>
                            </div>
                            
                        </div>
                        <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="button" class="btn btn-success btn-new-parameter pull-left" data-toggle="modal" data-target="#modalParameter">Nuevo</button>
                                <button type="submit" id="btnSearchParameter" name="btnSearchParameter" class="btn btn-primary pull-right">Buscar</button>
                            </div>  

                            <div class="clearfix"></div>
                            <br>

                        <div class="box  box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de parámetros</h3>
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
        
        <div class="modal fade" id="modalParameter">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmParameter" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title title-parameter">Nuevo parámetro</h4>
                        </div>
                        <div class="modal-body">

                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="parametername">Nombre</label>
                                <input type="text" class="form-control filter" id="parametername" name="parametername" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="parametercode">Código</label>
                                <input type="text" class="form-control filter" id="parametercode" name="parametercode" placeholder="Ingrese un código">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="parametervalue">Valor</label>
                                <input type="text" class="form-control filter" id="parametervalue" name="parametervalue" placeholder="Ingrese un código">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="parameterdescription">Descripción</label>
                                <input type="text" class="form-control filter" id="parameterdescription" name="parameterdescription" placeholder="Ingrese una descripción">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left filter" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="btnSaveParameter" class="btn btn-primary">Registrar</button>
                            <button type="button" id="btnUpdateParameter" style="display:none;" class="btn btn-primary">Actualizar</button>
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
                <h4 class="modal-title">Desactivar parameter</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea desactivar el parámetro seleccionado?</p>
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
                <h4 class="modal-title">Activar parámetro</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea activar el parámetro seleccionado?</p>
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
    var parameterid = 0;

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
                {sTitle : "Código", mData: "scode"},
                {sTitle : "Valor", mData: "svalue"},
                {sTitle : "Descripción", mData: "sdescription"},
                {sTitle : "Estado", mRender: function(data, type, row) {
                    switch (row.sstatus){
                        case 'A':
                            return 'Activo';
                            break;
                        case 'N':
                            return 'Inactivo';
                            break;
                        default:
                            return 'No asignado';
                    }
                }}, 
                {sTitle : "Acciones", mData: "Acciones", sClass:"col_center", sWidth:"80px", mRender: function(data, type, row) {
                    if(row.sstatus != 'N'){
                        return 	'<a data-id="'+row.nparameterid+'" class="btn btn-default fa fa-pencil btn-edit tooltips" data-toggle="modal" data-target="#modalParameter" data-placement="top" title="Editar" data-original-title="Editar"></a>'+ 
                            ' <i data-id="'+row.nparameterid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                    } else{
                        return 	'<i data-id="'+row.nparameterid+'" class="btn btn-success fa fa-thumbs-up activate tooltips" data-toggle="modal" data-target="#modalActivate"  data-toggle="tooltip" data-placement="top" title="Activar" data-original-title="Activar"></i>';
                    }
                }}
            ],
            "ajax": {
                    "url": "{{ route('admin.parameter.getall') }}",
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
                aoData.parametername = $('#filterparametername').val();
                aoData.parametercode = $('#filterparametercode').val();
                aoData.parameterstatus = $('#filterparameterstatus').val();
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

        $('#btnSearchParameter').click(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('.filter').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filtercategorystatus').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#btnSaveParameter').click(function(ev){
            ev.preventDefault();
            saveParameter();
        });

        $('#btnUpdateParameter').click(function(ev){
            ev.preventDefault();
            updateParameter();
        });

        $(document).on('click', '.btn-edit', function(event) {

            var id = $(this).data('id');
            $('#btnSaveParameter').hide();
            $('#btnUpdateParameter').show();
    
            $.ajax({
                url: '{{ route('admin.parameter.get') }}',
                type: 'POST',
                dataType: 'json',
                data: {nparameterid:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                
                parameterid = id;

                if (data.status == 'success') {

                    $('#parametername').val(data.parameter.sname);
                    $('#parametercode').val(data.parameter.scode);
                    $('#parametervalue').val(data.parameter.svalue);
                    $('#parameterdescription').val(data.parameter.sdescription);

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
            parameterid = $(this).data('id');
        });

        $(document).on('click', '.activate', function(event) {
            parameterid = $(this).data('id');
        });

        $(document).on('click', '.btn-new-parameter', function(event) {
            
            $("#frmParameter")[0].reset();
            loadModalParameters(0);
            $('#btnSaveParameter').show();
            $('#btnUpdateParameter').hide();

        });

        $(document).on('click', '#btnDesactivate', function(event) {
            event.preventDefault();
            $("#btnDesactivate").html('Desactivando...');
            $("#btnDesactivate").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.parameter.desactivate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:parameterid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnDesactivate").html('Confirmar');
                $("#btnDesactivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalDesactivate').modal('hide');
                    reloadTable();
                    parameterid = null;

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
                url: '{{ route('admin.parameter.activate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: parameterid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnActivate").html('Confirmar');
                $("#btnActivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalActivate').modal('hide');
                    reloadTable();
                    parameterid = null;

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

        function saveParameter(){

            parametername = $('#parametername').val();
            parametercode = $('#parametercode').val();
            parametervalue = $('#parametervalue').val();
            parameterdescription = $('#parameterdescription').val();

            if(confirm('¿Está seguro de registrar el parámetro?')==true){
                $("#btnSaveParameter").html('Guardando...');
                $("#btnSaveParameter").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.parameter.save') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {parametername:parametername, parametercode:parametercode, parametervalue:parametervalue, parameterdescription:parameterdescription, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnSaveParameter").html('Guardar');
                    $("#btnSaveParameter").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalParameter').modal('hide');
                        $("#frmParameter")[0].reset();
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

        function updateParameter(){
            
            parametername = $('#parametername').val();
            parametercode = $('#parametercode').val();
            parametervalue = $('#parametervalue').val();
            parameterdescription = $('#parameterdescription').val();

            if(confirm('¿Está seguro de actualizar el parámetro?')==true){
                $("#btnUpdateParameter").html('Actualizando...');
                $("#btnUpdateParameter").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.parameter.update') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {parameterid:parameterid,parametername:parametername, parametercode:parametercode, parametervalue:parametervalue, parameterdescription:parameterdescription, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnUpdateParameter").html('Actualizar');
                    $("#btnUpdateParameter").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalParameter').modal('hide');
                        $("#frmParameter")[0].reset();
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
