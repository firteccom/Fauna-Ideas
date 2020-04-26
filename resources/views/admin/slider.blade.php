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
            Slider
            <small>Mantenimiento</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Tienda</a></li>
            <li class="active">Slider</li>
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
                                <label for="filterslidemaintext">Texto principal</label>
                                <input type="text" class="form-control" id="filterslidemaintext" name="filterslidemaintext" placeholder="Ingrese texto principal">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterslidesecondarytext">Texto secundario</label>
                                <input type="text" class="form-control" id="filterslidesecondarytext" name="filterslidesecondarytext" placeholder="Ingrese texto secundario">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterslidestatus">Estado</label>
                                <select id="filterslidestatus" name="filterslidestatus" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    <option value="A">Activo</option>
                                    <option value="N">Inactivo</option>
                                </select>
                            </div>
                            
                        </div>
                        <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="button" class="btn btn-success btn-new-slide pull-left" data-toggle="modal" data-target="#modalSlide">Nuevo</button>
                                <button type="submit" id="btnSearchSlide" name="btnSearchSlide" class="btn btn-primary pull-right">Buscar</button>
                            </div>  

                            <div class="clearfix"></div>
                            <br>

                        <div class="box  box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de slides</h3>
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
        
        <div class="modal fade" id="modalSlide">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmSlide" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title title-slide">Nuevo slide</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="objecttype">Tipo de objeto <span class="required">*</span></label>
                                <select id="objecttype" name="objecttype" class="form-control select2" style="width: 100%;" required>
                                    <option value="" selected="selected">- No asignado -</option>
                                    @foreach ($tiposobj as $tip)
                                        <option value="{{$tip->ntypeid}}">{{$tip->sname}}</option>
                                    @endforeach
                                </select>                         
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="objectid">Objeto <span class="required">*</span></label>
                                <select id="objectid" name="objectid" class="form-control select2" style="width: 100%;" required>
                                    <option value="" selected="selected">- No asignado -</option>
                                </select>                            
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="smaintext">Texto principal</label>
                                <input type="text" class="form-control filter" id="smaintext" name="smaintext" placeholder="Ingrese el texto principal">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="ssecondarytext">Texto secundario</label>
                                <input type="text" class="form-control filter" id="ssecondarytext" name="ssecondarytext" placeholder="Ingrese el texto secundario">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="sbuttontext">Texto de botón</label>
                                <input type="text" class="form-control filter" id="sbuttontext" name="sbuttontext" placeholder="Ingrese el texto para el botón">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="slidefullimage">Imagen</label>
                                <input type="url" class="form-control filter" id="slidefullimage" name="slidefullimage" placeholder="URL de imagen">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left filter" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="btnSaveSlide" class="btn btn-primary">Registrar</button>
                            <button type="button" id="btnUpdateSlide" style="display:none;" class="btn btn-primary">Actualizar</button>
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
                <h4 class="modal-title">Desactivar slide</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea desactivar el slide seleccionado?</p>
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
                <h4 class="modal-title">Activar slide</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea activar el slide seleccionado?</p>
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
    var nslideid = 0;

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
                {sTitle : "Texto principal", mData: "smaintext"},
                {sTitle : "Texto secundario", mData: "ssecondarytext"},
                {sTitle : "Texto de botón", mData: "sbuttontext"},
                {sTitle : "Imagen", responsivePriority: 1, targets: 0, mRender: function(data, type, row) {
                    return '<a href="#" class="img" data-id="'+row.nslideid+'" data-title="'+row.smaintext+'" data-file="'+row.sfullimage+'" data-toggle="modal" data-target=".bs-imagen"><img src="../storage/app/'+row.sfullimage+'" height="100" /></a>';
                }},
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
                        return 	'<a data-id="'+row.nslideid+'" class="btn btn-default fa fa-pencil btn-edit tooltips" data-toggle="modal" data-target="#modalSlide" data-placement="top" title="Editar" data-original-title="Editar"></a>'+ 
                            ' <i data-id="'+row.nslideid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                    } else{
                        return 	'<i data-id="'+row.nslideid+'" class="btn btn-success fa fa-thumbs-up activate tooltips" data-toggle="modal" data-target="#modalActivate"  data-toggle="tooltip" data-placement="top" title="Activar" data-original-title="Activar"></i>';
                    }
                }}
            ],
            "ajax": {
                    "url": "{{ route('admin.slider.getall') }}",
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
                aoData.slidemaintext = $('#filterslidemaintext').val();
                aoData.slidesecondarytext = $('#filterslidesecondarytext').val();
                aoData.slidestatus = $('#filterslidestatus').val();
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

        $('#btnSearchSlide').click(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('.filter').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filterslidestatus').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#btnSaveSlide').click(function(ev){
            ev.preventDefault();
            saveSlide();
        });

        $('#btnUpdateSlide').click(function(ev){
            ev.preventDefault();
            updateSlide();
        });

        $(document).on('click', '.btn-new-slide', function(event) {
            
            $("#frmSlide")[0].reset();
            $('.title-slide').text('Nuevo slide');
            $('#btnSaveSlide').show();
            $('#btnUpdateSlide').hide();

        });

        $(document).on('click', '.btn-edit', function(event) {

            var id = $(this).data('id');
            $('.title-slide').text('Actualizar slide');
            $('#btnSaveSlide').hide();
            $('#btnUpdateSlide').show();

            $.ajax({
                url: '{{ route('admin.slider.get') }}',
                type: 'POST',
                dataType: 'json',
                data: {nslideid:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                
                nslideid = id;

                if (data.status == 'success') {

                    $('#objecttype').val(data.slide.nobjecttype);
                    $('#objecttype').select2().trigger('change');

                    setTimeout(function(){ 
                        $('#objectid').val(data.slide.nobjectid);
                        $('#objectid').select2().trigger('change');
                    }, 400);


                    $('#smaintext').val(data.slide.smaintext);
                    $('#ssecondarytext').val(data.slide.ssecondarytext);
                    $('#sbuttontext').val(data.slide.sbuttontext);
                    $('#slidefullimage').val(data.slide.sfullimage);

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

        $(document).on('change','#objecttype',function(event){
            var tipo = $(this).val();

            if(tipo==null || tipo == ''){

                $('#objectid').html('<option value selected="selected">- No asignado -</option>');
                $('#objectid').select2();
               
            }else{

                $.ajax({
                    url: '{{ route('admin.slider.getobjects') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {tipo: tipo, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    if (data.status == 'success') {

                        //data.objects
                        $('#objectid').html('<option value selected="selected">- No asignado -</option>');

                        $( data.objects ).each(function( index ) {
                            $('#objectid').append('<option value="'+data.objects[index].id+'">'+data.objects[index].sname+'</option>');
                        });

                        
                        $('#objectid').select2();

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

            }

        });

        $(document).on('click', '.desactivate', function(event) {
            nslideid = $(this).data('id');
            //alert('ID: ' + catalogid);
        });

        $(document).on('click', '.activate', function(event) {
            nslideid = $(this).data('id');
            //alert('ID: ' + catalogid);
        });

        $(document).on('click', '#btnDesactivate', function(event) {
            event.preventDefault();
            $("#btnDesactivate").html('Desactivando...');
            $("#btnDesactivate").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.slider.desactivate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:nslideid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnDesactivate").html('Confirmar');
                $("#btnDesactivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalDesactivate').modal('hide');
                    reloadTable();
                    nslideid = null;

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
                url: '{{ route('admin.slider.activate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: nslideid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnActivate").html('Confirmar');
                $("#btnActivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalActivate').modal('hide');
                    reloadTable();
                    nslideid = null;

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

        function saveSlide(){
            
            objecttype = $('#objecttype').val();
            objectid = $('#objectid').val();
            slidemaintext =  $('#smaintext').val();
            slidesecondarytext = $('#ssecondarytext').val();
            slidebuttontext = $('#sbuttontext').val();
            slidefullimage = $('#slidefullimage').val();

        
            if(confirm('¿Está seguro de registrar el slide?')==true){
                $("#btnSaveSlide").html('Guardando...');
                $("#btnSaveSlide").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.slider.save') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {objecttype:objecttype, objectid:objectid, slidemaintext:slidemaintext, slidesecondarytext:slidesecondarytext, slidebuttontext:slidebuttontext, slidefullimage:slidefullimage, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnSaveSlide").html('Guardar');
                    $("#btnSaveSlide").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalSlide').modal('hide');
                        $("#frmSlide")[0].reset();
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

        function updateSlide(){
            
            objecttype = $('#objecttype').val();
            objectid = $('#objectid').val();
            slidemaintext =  $('#smaintext').val();
            slidesecondarytext = $('#ssecondarytext').val();
            slidebuttontext = $('#sbuttontext').val();
            slidefullimage = $('#slidefullimage').val();

            if(confirm('¿Está seguro de actualizar el slide?')==true){
                $("#btnUpdateSlide").html('Actualizando...');
                $("#btnUpdateSlide").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.slider.update') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {nslideid:nslideid, objecttype:objecttype, objectid:objectid, slidemaintext:slidemaintext, slidesecondarytext:slidesecondarytext, slidebuttontext:slidebuttontext, slidefullimage:slidefullimage, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnUpdateSlide").html('Actualizar');
                    $("#btnUpdateSlide").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalSlide').modal('hide');
                        $("#frmSlide")[0].reset();
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
