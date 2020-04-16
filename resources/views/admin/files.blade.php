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
            Archivos
            <small>Mantenimiento</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Tienda</a></li>
            <li class="active">Archivos</li>
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
                        <form role="form" id="frmFiles">
                        <div class="box-body">
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterfiletype">Tipos de archivo</label>
                                <select id="filterfiletype" name="filterfiletype" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    @foreach ($types as $type)
                                        <option value="{{$type->ntypeid}}">{{$type->sname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterfilename">Nombre</label>
                                <input type="text" class="form-control" id="filterfilename" name="filterfilename" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterfileshortdescription">Abreviatura</label>
                                <input type="text" class="form-control" id="filterfileshortdescription" name="filterfileshortdescription" placeholder="Ingrese una abreviatura" >
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterfiledescription">Descripción</label>
                                <input type="text" class="form-control" id="filterfiledescription" name="filterfiledescription" placeholder="Ingrese una descripción" >
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterfilestatus">Estado</label>
                                <select id="filterfilestatus" name="filterfilestatus" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    <option value="A">Activo</option>
                                    <option value="N">Inactivo</option>
                                </select>
                            </div>
                            
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="button" class="btn btn-success btn-new-file pull-left" data-toggle="modal" data-target="#modalFile">Nuevo</button>
                            <button type="submit" id="btnSearchFiles" name="btnSearchFiles" class="btn btn-primary pull-right">Buscar</button>
                        </div>  

                        <div class="clearfix"></div>
                        <br>

                        <div class="box  box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de archivos</h3>
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

        
        <div class="modal fade" id="modalFile">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmFile" method="post" data-parsley-validate enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title title-file">Nuevo archivo</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="filetype">Tipos de archivo <span class="required">*</span></label>
                                <select id="filetype" name="filetype" class="form-control select2" style="width: 100%;" required>
                                    <option value="" selected="selected">- No asignado -</option>
                                    @foreach ($types as $type)
                                        <option value="{{$type->ntypeid}}">{{$type->sname}}</option>
                                    @endforeach
                                </select>                            
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="filename">Nombre <span class="required">*</span></label>
                                <input type="text" class="form-control filter" id="filename" name="filename" placeholder="Ingrese un nombre" minlenght="1" required>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="fileshortdescription">Abreviatura </label>
                                <input type="text" class="form-control filter" id="fileshortdescription" name="fileshortdescription" placeholder="Ingrese una abreviatura">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="filedescription">Descripción</label>
                                <input type="text" class="form-control filter" id="filedescription" name="filedescription" placeholder="Ingrese una descripción">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 form-group" id="inputuploadfile">
                                <label for="fileupload">Cargar archivo</label>
                                <input type="file" id="fileupload" name="fileupload">
                                <br>
                                <p>El archivo debe ser menor a 20MB *</p>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group" id="imagepreview" style="display:none;">
                                <img id="imgpreview" alt="" width="100" height="100" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left filter" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="btnSaveFile" class="btn btn-primary">Registrar</button>
                            <button type="submit" id="btnUpdateFile" style="display:none;" class="btn btn-primary">Actualizar</button>
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
                <h4 class="modal-title">Desactivar archivo</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea desactivar el archivo seleccionado?</p>
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
                <h4 class="modal-title">Activar archivo</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea activar el archivo seleccionado?</p>
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
    var fileid = 0;

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
                {sTitle : "Tipo de archivo", mData: "typename"},
                {sTitle : "Nombre", mData: "sname"},
                {sTitle : "Abreviatura", mData: "sshortdescription"},
                {sTitle : "Descripción", mData: "sdescription"},
                {sTitle : "Imagen", responsivePriority: 1, targets: 0, mRender: function(data, type, row) {
                    return '<a href="#" class="img" data-id="'+row.nfileid+'" data-title="'+row.sname+'" data-file="'+row.spath+'" data-toggle="modal" data-target=".bs-imagen"><img src="../storage/app/'+row.spath+'" width="30" height="30" /></a>';
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
                        return '<a data-id="'+row.nfileid+'" class="btn btn-default fa fa-pencil btn-edit tooltips" data-toggle="modal" data-target="#modalFile" data-placement="top" title="Editar" data-original-title="Editar"></a>'+ 
                            ' <i data-id="'+row.nfileid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                    } else{
                        return '<i data-id="'+row.nfileid+'" class="btn btn-success fa fa-thumbs-up activate tooltips" data-toggle="modal" data-target="#modalActivate"  data-toggle="tooltip" data-placement="top" title="Activar" data-original-title="Activar"></i>';
                    }
                }}
            ],
            "ajax": {
                    "url": "{{ route('admin.file.getall') }}",
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
                aoData.filetype = $('#filterfiletype').val();
                aoData.filename = $('#filterfilename').val();
                aoData.filedescription = $('#filterfiledescription').val();
                aoData.fileshortdescription = $('#filterfileshortdescription').val();
                aoData.filestatus = $('#filterfilestatus').val();

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

        $('#btnSearchFiles').click(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('.filter').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filterfilestatus').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filterfiletype').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#fileupload').change(function(ev){

            type=this.files[0].name.substr( (this.files[0].name.lastIndexOf('.') +1) ).toLowerCase();
            //alert(type);
            if (type == 'jpg' || type == 'jpeg' || type == 'png' || type == 'gif'){
                document.getElementById('imgpreview').src = window.URL.createObjectURL(this.files[0]);
                $('#inputuploadfile').removeClass( "col-sm-12 col-md-12 col-lg-12 form-group" ).addClass( "col-sm-12 col-md-6 col-lg-6 form-group" );
				$('#imagepreview').show();
            } else {
                $('#inputuploadfile').removeClass( "col-sm-12 col-md-6 col-lg-6 form-group" ).addClass( "col-sm-12 col-md-12 col-lg-12 form-group" );
				$('#imagepreview').hide();
            }

        });


        $('#btnSaveFile').click(function(ev){
            ev.preventDefault();
            saveFile();
        });

        $('#btnUpdateFile').click(function(ev){
            ev.preventDefault();
            updateFile();
        });

        $(document).on('click', '#btnhighlight', function(ev) {
            ev.preventDefault();
            var high = $(this).attr('high');
            var id = $(this).attr('data-id');
            highlightFile(high, id);
        });
        

        $(document).on('click', '.btn-new-file', function(event) {
            
            $("#frmFile")[0].reset();
            $('.title-file').text('Nuevo archivo');
            loadModalTypes(0);
            $('#btnSaveFile').show();
            $('#btnUpdateFile').hide();

        });

        $(document).on('click', '.btn-edit', function(event) {

            var id = $(this).data('id');
            $('.title-file').text('Actualizar archivo');
            $('#btnSaveFile').hide();
            $('#btnUpdateFile').show();
            //alert(id);
            loadModalTypes(id);

            $.ajax({
                url: '{{ route('admin.file.get') }}',
                type: 'POST',
                dataType: 'json',
                data: {nfileid:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                
                fileid = id;

                if (data.status == 'success') {
                    
                    $('#filetype').val(data.file.ntypeid);
                    $('#filetype').select2().trigger('change');
                    $('#filename').val(data.file.sname);
                    $('#fileshortdescription').val(data.file.sshortdescription);
                    $('#filedescription').val(data.file.sdescription);

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
            fileid = $(this).data('id');
            //alert('ID: ' + fileid);
        });

        $(document).on('click', '.activate', function(event) {
            fileid = $(this).data('id');
            //alert('ID: ' + fileid);
        });

        $(document).on('click', '#btnDesactivate', function(event) {
            event.preventDefault();
            $("#btnDesactivate").html('Desactivando...');
            $("#btnDesactivate").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.file.desactivate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:fileid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnDesactivate").html('Confirmar');
                $("#btnDesactivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalDesactivate').modal('hide');
                    reloadTable();
                    fileid = null;

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
                url: '{{ route('admin.file.activate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: fileid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnActivate").html('Confirmar');
                $("#btnActivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalActivate').modal('hide');
                    reloadTable();
                    fileid = null;

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

        function saveFile(){
            
            /*filetype = $('#filetype').val();
            filename = $('#filename').val();
            fileshortdescription = $('#fileshortdescription').val();
            filedescription = $('#filedescription').val();*/


            if(confirm('¿Está seguro de registrar el archivo?')==true){
                $("#btnSaveFile").html('Guardando...');
                $("#btnSaveFile").attr('disabled', 'disabled');

                var frm = $('#frmFile');
                var formData = new FormData($(frm)[0]);
		        //ev.preventDefault();

                $.ajax({
                    url: '{{ route('admin.file.save') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {

                    $("#btnSaveFile").html('Guardar');
                    $("#btnSaveFile").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalFile').modal('hide');
                        $("#frmFile")[0].reset();
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

        function updateFile(){
            
            filetype = $('#filetype').val();
            filename = $('#filename').val();
            fileshortdescription = $('#fileshortdescription').val();
            filedescription = $('#filedescription').val();

            if(confirm('¿Está seguro de actualizar el archivo?')==true){
                $("#btnUpdateFile").html('Actualizando...');
                $("#btnUpdateFile").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.file.update') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {fileid:fileid,filetype:filetype,filename:filename,fileshortdescription:fileshortdescription,filedescription:filedescription, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnUpdateFile").html('Actualizar');
                    $("#btnUpdateFile").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalFile').modal('hide');
                        $("#frmFile")[0].reset();
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
                url: '{{ route('admin.file.getlisttypes') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                $('#filetype').html('');
                $('#filetype').append($("<option></option>").attr("value", "0").text("- No asignado -"));
                $.each(data, function(i, item) {
                    $('#filetype').append($("<option></option>").attr("value", data[i].ntypeid).text(data[i].sname));
                });
            });
        }

        $('input[type="file"]').change(function(event) {    
		if($(this).val()!=''){
			var _size = this.files[0].size/1024/1024;
			var _type = this.files[0].type.toLowerCase();
			var _ext = this.files[0].name.substr( (this.files[0].name.lastIndexOf('.') +1) ).toLowerCase();
			var msg = '';


			if(_ext == 'exe' || _ext == 'bat' || _ext == 'sh' || _ext == 'dmg' || _ext == 'pkg'){
				msg = 'No se permiten archivos con extensión: .exe, .bat, .sh, .dmg, .pkg.';
			}else if(_size > 20){ // Mayor a 20MB
				msg = 'El archivo supera los 20MB';
			}

			if(msg != ''){
				$(this).val('');
				//alert(msg);
                Swal.fire({
                    position: 'top-end',
                    type: 'error',
                    title: msg,
                    showConfirmButton: false,
                    timer: 4000
                });
			}
		}
    });

    })
</script>

@endsection
