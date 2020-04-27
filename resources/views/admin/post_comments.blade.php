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
            Comentarios de publicaciones
            <small>Mantenimiento</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Tienda</a></li>
            <li class="active">Comentarios de publicaciones</li>
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
                        <form role="form" id="frmListPostComments">
                            <div class="box-body">
                                <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                    <label for="filterpostcategory">Categoría de la publicación</label>
                                    <select id="filterpostcategory" name="filterpostcategory" class="form-control filter select2" style="width: 100%;">
                                        <option value="" selected="selected">- No seleccionado -</option>
                                        @foreach ($blogcategories as $blogcategory)
                                            <option value="{{$blogcategory->nblogcategoryid}}">{{$blogcategory->sname}}</option>
                                        @endforeach
                                    </select>                            
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                    <label for="filterpost">Publicación</label>
                                    <select id="filterpost" name="filterpost" class="form-control filter select2" style="width: 100%;">
                                        
                                    </select>                            
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                    <label for="filtercommentname">Nombre</label>
                                    <input type="text" class="form-control filter" id="filtercommentname" name="filtercommentname" placeholder="Ingrese un nombre">
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                    <label for="filtercommentemail">Correo</label>
                                    <input type="text" class="form-control filter" id="filtercommentemail" name="filtercommentemail" placeholder="Ingrese una abreviatura">
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                    <label for="filtercommentmobile">Celular</label>
                                    <input type="text" class="form-control filter" id="filtercommentmobile" name="filtercommentmobile" placeholder="Ingrese una descripción">
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                    <label for="filtercommentreviewstatus">Estado de revisión</label>
                                    <select id="filtercommentreviewstatus" name="filtercommentreviewstatus" class="form-control filter select2" style="width: 100%;">
                                        <option value="" selected="selected">- Seleccione una opción -</option>
                                        <option value="P">Pendiente</option>
                                        <option value="A">Aprobado</option>
                                        <option value="R">Rechazado</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                    <label for="filtercommentstatus">Estado de comentario</label>
                                    <select id="filtercommentstatus" name="filtercommentstatus" class="form-control filter select2" style="width: 100%;">
                                        <option value="" selected="selected">- Seleccione una opción -</option>
                                        <option value="A">Activo</option>
                                        <option value="N">Inactivo</option>
                                    </select>
                                </div>
                                
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" id="btnSearchPostComments" name="btnSearchPostComments" class="btn btn-primary pull-right">Buscar</button>
                            </div>  

                            <div class="clearfix"></div>
                            <br>

                            <div class="box  box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Comentarios de publicaciones</h3>
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

        <div class="modal fade" id="modalComment">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmProduct" method="post" data-parsley-validate enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title title-comment">Comentario de publicación</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                <label for="postcomment">Descripción</label>
                                <textarea type="text" rows="6"  class="form-control" id="postcomment" name="postcomment" disabled value=""></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
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
                <h4 class="modal-title">Desactivar categoría de blog</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea desactivar el comentario seleccionado?</p>
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
                <h4 class="modal-title">Activar categoría de blog</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea activar el comentario seleccionado?</p>
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

        <div class="modal modal-danger fade" id="modalReject">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Rechazar comentario</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea rechazar el comentario seleccionado?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnReject" class="btn btn-outline">Confirmar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal modal-success fade" id="modalApprove">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Aprobar comentario</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea aprobar el comentario seleccionado?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnApprove" class="btn btn-outline">Confirmar</button>
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
    var postcommentid = 0;

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
                {sTitle : "Categoría", mData: "postcategoryname"},
                {sTitle : "Tītulo de la publicación", mData: "posttitle"},
                {sTitle : "Nombre", mData: "sname"},
                {sTitle : "Correo", mData: "semail"},
                {sTitle : "Celular", mData: "smobile"},
                {sTitle : "Comentario", mData: "sshortcomment"},
                {sTitle : "Estado de revisión", mRender: function(data, type, row) {
                    switch (row.sreviewstatus){
                        case 'P':
                            return 'Pendiente';
                            break;
                        case 'A':
                            return 'Aprobado';
                            break;
                        case 'R':
                            return 'Rechazado';
                            break;
                        default:
                            return 'No asignado';
                    }
                }},
                {sTitle : "Estado de comentario", mRender: function(data, type, row) {
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
                {sTitle : "Acciones", mData: "Acciones", sClass:"col_center", sWidth:"170px", mRender: function(data, type, row) {
                    if(row.sstatus != 'N'){
                        if (row.sreviewstatus == 'P'){
                            return 	' <i data-comment="'+row.scomment+'" class="btn btn-info fa fa-eye comment tooltips" data-toggle="modal" data-target="#modalComment" data-toggle="tooltip" data-placement="top" title="Ver comentario" data-original-title="Ver comentario"></i>' + 
                                    ' <i data-id="'+row.npostcommentid+'" class="btn btn-danger fa fa-ban reject tooltips" data-toggle="modal" data-target="#modalReject" data-toggle="tooltip" data-placement="top" title="Rechazar" data-original-title="Rechazar"></i>' + 
                                    ' <i data-id="'+row.npostcommentid+'" class="btn btn-success fa fa-check approve tooltips" data-toggle="modal" data-target="#modalApprove" data-toggle="tooltip" data-placement="top" title="Aprobar" data-original-title="Aprobar"></i>' +
                                    ' <i data-id="'+row.npostcommentid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                        } else if (row.sreviewstatus == 'A'){
                            return 	' <i data-comment="'+row.scomment+'" class="btn btn-info fa fa-eye comment tooltips" data-toggle="modal" data-target="#modalComment" data-toggle="tooltip" data-placement="top" title="Ver comentario" data-original-title="Ver comentario"></i>' + 
                                    ' <i data-comment="'+row.npostcommentid+'" class="btn btn-danger fa fa-ban reject tooltips" data-toggle="modal" data-target="#modalReject" data-toggle="tooltip" data-placement="top" title="Rechazar" data-original-title="Rechazar"></i>' +
                                    ' <i data-id="'+row.npostcommentid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                        } else if (row.sreviewstatus == 'R'){
                            return 	' <i data-comment="'+row.scomment+'" class="btn btn-info fa fa-eye comment tooltips" data-toggle="modal" data-target="#modalComment" data-toggle="tooltip" data-placement="top" title="Ver comentario" data-original-title="Ver comentario"></i>' + 
                                    ' <i data-comment="'+row.npostcommentid+'" class="btn btn-success fa fa-check approve tooltips" data-toggle="modal" data-target="#modalApprove" data-toggle="tooltip" data-placement="top" title="Aprobar" data-original-title="Aprobar"></i>' +
                                    ' <i data-id="'+row.npostcommentid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                        }
                    } else{
                        return 	'<a data-id="'+row.npostcommentid+'" class="btn btn-success fa fa-thumbs-up activate tooltips" data-toggle="modal" data-target="#modalActivate"  data-toggle="tooltip" data-placement="top" title="Activar" data-original-title="Activar"></a>';
                    }
                }}
            ],
            "ajax": {
                    "url": "{{ route('admin.postcomment.getall') }}",
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
                aoData.postcategory = $('#filterpostcategory').val();
                aoData.post = $('#filterpost').val();
                aoData.commentname = $('#filtercommentname').val();
                aoData.commentemail = $('#filtercommentemail').val();
                aoData.commentmobile = $('#filtercommentmobile').val();
                aoData.commentreviewstatus = $('#filtercommentreviewstatus').val();
                aoData.commentstatus = $('#filtercommentstatus').val();
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

        $('#btnSearchPostComments').click(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('.filter').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filterpostcategory').change(function(){
            var categoryid = $(this).val();
            loadPosts(categoryid);
        });

        $(document).on('click', '.comment', function(event) {
            $('#postcomment').val($(this).data('comment'));
            //alert('ID: ' + postcommentid);
        });

        $(document).on('click', '.desactivate', function(event) {
            postcommentid = $(this).data('id');
            //alert('ID: ' + postcommentid);
        });

        $(document).on('click', '.activate', function(event) {
            postcommentid = $(this).data('id');
            //alert('ID: ' + postcommentid);
        });

        $(document).on('click', '.reject', function(event) {
            postcommentid = $(this).data('id');
            //alert('ID: ' + postcommentid);
        });

        $(document).on('click', '.approve', function(event) {
            postcommentid = $(this).data('id');
            //alert('ID: ' + postcommentid);
        });

        $(document).on('click', '#btnDesactivate', function(event) {
            event.preventDefault();
            $("#btnDesactivate").html('Desactivando...');
            $("#btnDesactivate").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.postcomment.desactivate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:postcommentid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnDesactivate").html('Confirmar');
                $("#btnDesactivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalDesactivate').modal('hide');
                    reloadTable();
                    postcommentid = null;

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
                url: '{{ route('admin.postcomment.activate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: postcommentid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnActivate").html('Confirmar');
                $("#btnActivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalActivate').modal('hide');
                    reloadTable();
                    postcommentid = null;

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

        $(document).on('click', '#btnReject', function(event) {
            event.preventDefault();
            $("#btnReject").html('Rechazando...');
            $("#btnReject").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.postcomment.reject') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:postcommentid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnReject").html('Confirmar');
                $("#btnReject").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalReject').modal('hide');
                    reloadTable();
                    postcommentid = null;

                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else{

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

        $(document).on('click', '#btnApprove', function(event) {
            event.preventDefault();
            $("#btnApprove").html('Aprobando...');
            $("#btnApprove").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.postcomment.approve') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: postcommentid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnApprove").html('Confirmar');
                $("#btnApprove").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalApprove').modal('hide');
                    reloadTable();
                    postcommentid = null;

                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                } else{

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

        function loadPosts(id){

            $.ajax({
                url: '{{ route('admin.postcomment.getlistposts') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                $('#filterpost').html('');
                $('#filterpost').append($("<option></option>").attr("value", "0").text("- No seleccionado -"));
                $.each(data, function(i, item) {
                    $('#filterpost').append($("<option></option>").attr("value", data[i].npostid).text(data[i].stitle));
                });
            });
        }

        function reloadTable(){
            $("#listado").DataTable().ajax.reload();
        }
        
    });
</script>

@endsection
