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
            Usuarios
            <small>Mantenimiento</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Mantenimiento</a></li>
            <li class="active">Usuarios</li>
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
                        <form role="form" id="frmListusers">
                        <div class="box-body">
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterusername">Nombre</label>
                                <input type="text" class="form-control" id="filterusername" name="filterusername" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filteruserfatherlastname">Ap. Paterno</label>
                                <input type="text" class="form-control" id="filteruserfatherlastname" name="filteruserfatherlastname" placeholder="Ingrese Ap. paterno">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterusermotherlastname">Ap. Materno</label>
                                <input type="text" class="form-control" id="filterusermotherlastname" name="filterusermotherlastname" placeholder="Ingrese Ap. materno">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filteruserstatus">Estado</label>
                                <select id="filteruserstatus" name="filteruserstatus" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    <option value="A">Activo</option>
                                    <option value="N">Inactivo</option>
                                </select>
                            </div>
                            
                        </div>
                        <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="button" class="btn btn-success btn-new-user pull-left" data-toggle="modal" data-target="#modaUser">Nuevo</button>
                                <button type="submit" id="btnSearchUsers" name="btnSearchUsers" class="btn btn-primary pull-right">Buscar</button>
                            </div>  

                            <div class="clearfix"></div>
                            <br>

                        <div class="box  box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de usuarios</h3>
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
        
        <div class="modal fade" id="modaUser">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmUser" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title title-user">Nuevo Usuario</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="username">Nombre</label>
                                <input type="text" class="form-control filter" id="username" name="username" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="userfatherlastname">Ap. paterno</label>
                                <input type="text" class="form-control filter" id="userfatherlastname" name="userfatherlastname" placeholder="Ingrese ap. paterno">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="usermotherlastname">Ap. materno</label>
                                <input type="text" class="form-control filter" id="usermotherlastname" name="usermotherlastname" placeholder="Ingrese ap. materno">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="userprofilepicture">Imagen de perfil</label>
                                <input type="text" class="form-control filter" id="userprofilepicture" name="userprofilepicture" placeholder="Imagen de perfil">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="userbiography">Biografía</label>
                                <textarea class="form-control" name="userbiography" id="userbiography"  rows="10"></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="useremail">Email</label>
                                <input type="text" class="form-control filter" id="useremail" name="useremail" placeholder="Ingrese email">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="userpassword">Contraseña</label>
                                <input type="password" class="form-control filter" id="userpassword" name="userpassword" placeholder="Ingrese contraseña">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="userpassword2">Confirmar contraseña</label>
                                <input type="password" class="form-control filter" id="userpassword2" name="userpassword2" placeholder="Confirmar contraseña">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left filter" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="btnSaveUser" class="btn btn-primary">Registrar</button>
                            <button type="button" id="btnUpdateUser" style="display:none;" class="btn btn-primary">Actualizar</button>
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
                <h4 class="modal-title">Desactivar usuario</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea desactivar el usuario seleccionado?</p>
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
                <h4 class="modal-title">Activar usuario</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea activar el usuario seleccionado?</p>
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
    var userid = 0;

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
                {sTitle : "Ap. paterno", mData: "sfatherlastname"},
                {sTitle : "Ap. materno", mData: "smotherlastname"},
                {sTitle : "Email", mData: "semail"},
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
                        return 	'<a data-id="'+row.nuserid+'" class="btn btn-default fa fa-pencil btn-edit tooltips" data-toggle="modal" data-target="#modaUser" data-placement="top" title="Editar" data-original-title="Editar"></a>'+ 
                            ' <i data-id="'+row.nuserid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                    } else{
                        return 	'<i data-id="'+row.nuserid+'" class="btn btn-success fa fa-thumbs-up activate tooltips" data-toggle="modal" data-target="#modalActivate"  data-toggle="tooltip" data-placement="top" title="Activar" data-original-title="Activar"></i>';
                    }
                }}
            ],
            "ajax": {
                    "url": "{{ route('admin.user.getall') }}",
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
                aoData.username = $('#filterusername').val();
                aoData.userfatherlastname = $('#filteruserfatherlastname').val();
                aoData.usermotherlastname = $('#filterusermotherlastname').val();
                aoData.userstatus = $('#filteruserstatus').val();
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

        $('#btnSearchUsers').click(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('.filter').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filteruserstatus').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#btnSaveUser').click(function(ev){
            ev.preventDefault();
            saveUser();
        });

        $('#btnUpdateUser').click(function(ev){
            ev.preventDefault();
            updateUser();
        });

        $(document).on('click', '.btn-new-user', function(event) {
            $("#frmUser")[0].reset();
            $('.title-user').text('Nuevo usuario');
            $('#btnSaveUser').show();
            $('#btnUpdateUser').hide();
        });

        $(document).on('click', '.btn-edit', function(event) {

            var id = $(this).data('id');
            $('.title-user').text('Actualizar usuario');
            $('#btnSaveUser').hide();
            $('#btnUpdateUser').show();

            $.ajax({
                url: '{{ route('admin.user.get') }}',
                type: 'POST',
                dataType: 'json',
                data: {nuserid:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                
                userid = id;

                if (data.status == 'success') {

                    $('#username').val(data.user.sname);
                    $('#userfatherlastname').val(data.user.sfatherlastname);
                    $('#usermotherlastname').val(data.user.smotherlastname);
                    $('#userprofilepicture').val(data.user.sprofilepicture);
                    $('#userbiography').val(data.user.sbiography);
                    $('#useremail').val(data.user.semail);

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
            userid = $(this).data('id');
        });

        $(document).on('click', '.activate', function(event) {
            userid = $(this).data('id');
        });

        $(document).on('click', '#btnDesactivate', function(event) {
            event.preventDefault();
            $("#btnDesactivate").html('Desactivando...');
            $("#btnDesactivate").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.user.desactivate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:userid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnDesactivate").html('Confirmar');
                $("#btnDesactivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalDesactivate').modal('hide');
                    reloadTable();
                    userid = null;

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
                url: '{{ route('admin.user.activate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: userid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnActivate").html('Confirmar');
                $("#btnActivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalActivate').modal('hide');
                    reloadTable();
                    userid = null;

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

        function saveUser(){
            
            username = $('#username').val();
            userfatherlastname = $('#userfatherlastname').val();
            usermotherlastname = $('#usermotherlastname').val();
            userprofilepicture = $('#userprofilepicture').val();
            userbiography = $('#userbiography').val();
            useremail = $('#useremail').val();
            userpassword = $('#userpassword').val();
            userpassword2 = $('#userpassword2').val();

            if(confirm('¿Está seguro de registrar el usuario?')==true){
                $("#btnSaveUser").html('Guardando...');
                $("#btnSaveUser").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.user.save') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {username:username, userfatherlastname:userfatherlastname, usermotherlastname:usermotherlastname, userprofilepicture:userprofilepicture, userbiography:userbiography, useremail:useremail,userpassword:userpassword,userpassword2:userpassword2, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnSaveUser").html('Guardar');
                    $("#btnSaveUser").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modaUser').modal('hide');
                        $("#frmUser")[0].reset();
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

        function updateUser(){
            
            username = $('#username').val();
            userfatherlastname = $('#userfatherlastname').val();
            usermotherlastname = $('#usermotherlastname').val();
            userprofilepicture = $('#userprofilepicture').val();
            userbiography = $('#userbiography').val();
            useremail = $('#useremail').val();
            userpassword = $('#userpassword').val();
            userpassword2 = $('#userpassword2').val();

            if(confirm('¿Está seguro de actualizar el usuario?')==true){
                $("#btnUpdateUser").html('Actualizando...');
                $("#btnUpdateUser").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.user.update') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {userid:userid, username:username, userfatherlastname:userfatherlastname, usermotherlastname:usermotherlastname,userprofilepicture:userprofilepicture, userbiography:userbiography, useremail:useremail,userpassword:userpassword,userpassword2:userpassword2, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnUpdateUser").html('Actualizar');
                    $("#btnUpdateUser").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modaUser').modal('hide');
                        $("#frmUser")[0].reset();
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
