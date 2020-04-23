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
            Publicaciones
            <small>Mantenimiento</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Tienda</a></li>
            <li class="active">Publicaciones</li>
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
                        <form role="form" id="frmPosts">
                        <div class="box-body">
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterposttitle">Título</label>
                                <input type="text" class="form-control" id="filterposttitle" name="filterposttitle" placeholder="Ingrese un título">
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterpostdescription">Descripción</label>
                                <input type="text" class="form-control" id="filterpostdescription" name="filterpostdescription" placeholder="Ingrese una descripción">
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterpostblogcategory">Categoría de blog</label>
                                <select id="filterpostblogcategory" name="filterpostblogcategory" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    @foreach ($blogcategories as $blogcategory)
                                        <option value="{{$blogcategory->nblogcategoryid}}">{{$blogcategory->sname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterposttag">Etiqueta</label>
                                <input type="text" class="form-control" id="filterposttag" name="filterposttag" placeholder="Ingrese un etiqueta" >
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterpostuser">Autor</label>
                                <select id="filterpostuser" name="filterpostuser" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    @foreach ($blogcategories as $blogcategory)
                                        <option value="{{$blogcategory->nblogcategoryid}}">{{$blogcategory->sname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filterpoststatus">Estado</label>
                                <select id="filterpoststatus" name="filterpoststatus" class="form-control select2" style="width: 100%;">
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
                            <button type="button" class="btn btn-success btn-new-post pull-left" data-toggle="modal" data-target="#modalPost">Nuevo</button>
                            <button type="submit" id="btnSearchPosts" name="btnSearchPosts" class="btn btn-primary pull-right">Buscar</button>
                        </div>  

                        <div class="clearfix"></div>
                        <br>

                        <div class="box  box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de publicaciones</h3>
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

        
        <div class="modal fade" id="modalPost">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmPost" method="post" data-parsley-validate enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title title-post">Nueva publicación</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                <label for="postblogcategory">Categoría de blog <span class="required">*</span></label>
                                <select id="postblogcategory" name="postblogcategory" class="form-control select2" style="width: 100%;" required>
                                    <option value="0" selected="selected">- No asignado -</option>
                                    @foreach ($blogcategories as $blogcategory)
                                        <option value="{{ $blogcategory->nblogcategoryid }}">{{ $blogcategory->sname }}</option>
                                    @endforeach
                                </select>                            
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                <label for="posttitle">Título <span class="required">*</span></label>
                                <input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="Ingrese un título" required>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                <label for="postdescription">Breve Descripción <span class="required">*</span></label>
                                <input type="text" class="form-control" id="postdescription" name="postdescription" placeholder="Ingrese una breve descripción (máx. 300 caracteres)" required>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                <label for="posttags">Etiquetas <span class="required">*</span></label>
                                <input type="text" class="form-control" id="posttags" name="posttags" placeholder="Ingrese más de 1 etiqueta separandolos por ';'" minlenght="1" required>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                <label for="postcontent">Contenido <span class="required">*</span></label>
                                <div class="box-body pad">
                                    <form>
                                        <textarea class="form-control" id="postcontent" name="postcontent" rows="10" cols="80"></textarea>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                <label for="postimage1">Imagen 1 <span class="required">*</span></label>
                                <input type="text" class="form-control" id="postimage1" name="postimage1" placeholder="Ingrese una URL">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                <label for="postimage2">Imagen 2 </label>
                                <input type="text" class="form-control" id="postimage2" name="postimage2" placeholder="Ingrese una URL">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                <label for="postimage3">Imagen 3 </label>
                                <input type="text" class="form-control" id="postimage3" name="postimage3" placeholder="Ingrese una URL">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="btnSavePost" class="btn btn-primary">Registrar</button>
                            <button type="submit" id="btnUpdatePost" style="display:none;" class="btn btn-primary">Actualizar</button>
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
                <h4 class="modal-title">Desactivar publicación</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea desactivar la publicación seleccionado?</p>
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
                <h4 class="modal-title">Activar publicación</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea activar la publicación seleccionado?</p>
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
                <h4 class="modal-title">Publicación destacado</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea quitar la publicación de los destacados?</p>
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
                <h4 class="modal-title">Publicación destacado</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea agregar la publicación a los destacados?</p>
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
    var postid = 0;

    $(function () {
    //Initialize Select2 Elements
        $('.select2').select2();

        CKEDITOR.replace('postcontent');
        //bootstrap WYSIHTML5 - text editor

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
                {sTitle : "Categoría", mData: "blogcategoryname"},
                {sTitle : "Título", mData: "stitle"},
                {sTitle : "Autor", mData: "sauthor"},
                {sTitle : "Imagen 1", responsivePriority: 1, targets: 0, mRender: function(data, type, row) {
                    return '<a href="#" class="img" data-id="'+row.npostid+'" data-title="'+row.simage1+'" data-file="'+row.simage1+'" data-toggle="modal" data-target=".bs-imagen"><img src="'+row.simage1+'" width="30" height="30" /></a>';
                }}, 
                {sTitle : "Imagen 2", responsivePriority: 1, targets: 0, mRender: function(data, type, row) {
                    return '<a href="#" class="img" data-id="'+row.npostid+'" data-title="'+row.simage2+'" data-file="'+row.simage2+'" data-toggle="modal" data-target=".bs-imagen"><img src="'+row.simage2+'" width="30" height="30" /></a>';
                }}, 
                {sTitle : "Imagen 3", responsivePriority: 1, targets: 0, mRender: function(data, type, row) {
                    return '<a href="#" class="img" data-id="'+row.npostid+'" data-title="'+row.simage3+'" data-file="'+row.simage3+'" data-toggle="modal" data-target=".bs-imagen"><img src="'+row.simage3+'" width="30" height="30" /></a>';
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
                {sTitle : "Acciones", mData: "Acciones", sClass:"col_center", sWidth:"120px", mRender: function(data, type, row) {

                    var high = '<a data-id="'+row.npostid+'" high="'+row.shighlighted+'" id="btnhighlight" class="btn btn-default fa fa-star btn-highlight rw_'+row.shighlighted+'" tooltips"  data-placement="top" title="Destacado" data-original-title="Destacado"></a>';

                    if(row.sstatus != 'N'){
                        return 	high+'<a data-id="'+row.npostid+'" class="btn btn-default fa fa-pencil btn-edit tooltips" data-toggle="modal" data-target="#modalPost" data-placement="top" title="Editar" data-original-title="Editar"></a>'+ 
                            ' <i data-id="'+row.npostid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                    } else{
                        return 	high+'<i data-id="'+row.npostid+'" class="btn btn-success fa fa-thumbs-up activate tooltips" data-toggle="modal" data-target="#modalActivate"  data-toggle="tooltip" data-placement="top" title="Activar" data-original-title="Activar"></i>';
                    }
                }}
            ],
            "ajax": {
                    "url": "{{ route('admin.post.getall') }}",
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
                aoData.posttitle = $('#filterposttitle').val();
                aoData.postdescription = $('#filterpostdescription').val();
                aoData.blogcategoryid = $('#filterpostblogcategory').val();
                aoData.posttags = $('#filterposttag').val();
                aoData.postuser = $('#filterpostblogcategory').val();
                aoData.poststatus = $('#filterpoststatus').val();

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

        $('#btnSearchPosts').click(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('.filter').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filterpoststatus').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#filterpostblogcategory').change(function(ev){
            ev.preventDefault();
            reloadTable();
        });

        $('#btnSavePost').click(function(ev){
            ev.preventDefault();
            savePost();
        });

        $('#btnUpdatePost').click(function(ev){
            ev.preventDefault();
            updatePost();
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
            postid = id;
        });


        $(document).on('click', '#btnunhigh', function(event) {
           highlightPost('Y');
        });

        $(document).on('click', '#btnhigh', function(event) {
           highlightPost('N');
        });


         function highlightPost(high){
            
            $.ajax({
                url: '{{ route('admin.post.highlight') }}',
                type: 'POST',
                dataType: 'json',
                data: {high:high, id:postid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
               reloadTable();
               $('#modalUnhighlight').modal('hide');
               $('#modalHighlight').modal('hide');
            });

        }

        

        $(document).on('click', '.btn-new-post', function(event) {
            
            $("#frmPost")[0].reset();
            $('.title-post').text('Nueva publicación');
            //loadModalCategories(0);
            $('#btnSavePost').show();
            $('#btnUpdatePost').hide();

        });

        $(document).on('click', '.btn-edit', function(event) {

            var id = $(this).data('id');
            $('.title-post').text('Actualizar publicación');
            $('#btnSavePost').hide();
            $('#btnUpdatePost').show();
            //alert(id);

            $.ajax({
                url: '{{ route('admin.post.get') }}',
                type: 'POST',
                dataType: 'json',
                data: {npostid:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                
                postid = id;

                if (data.status == 'success') {

                    $('#postblogcategory').val(data.post.nblogcategoryid);
                    $('#postblogcategory').select2().trigger('change');
                    $('#posttitle').val(data.post.stitle);
                    $('#postdescription').val(data.post.sdescription);
                    $('#posttags').val(data.post.stags);
                    CKEDITOR.instances.postcontent.setData(data.post.scontent);
                    //$('#postcontent').val(data.post.scontent);
                    $('#postimage1').val(data.post.simage1);
                    $('#postimage2').val(data.post.simage2);
                    $('#postimage3').val(data.post.simage3);
                    

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
            postid = $(this).data('id');
            //alert('ID: ' + postid);
        });

        $(document).on('click', '.activate', function(event) {
            postid = $(this).data('id');
            //alert('ID: ' + postid);
        });

        $(document).on('click', '#btnDesactivate', function(event) {
            event.preventDefault();
            $("#btnDesactivate").html('Desactivando...');
            $("#btnDesactivate").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.post.desactivate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:postid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnDesactivate").html('Confirmar');
                $("#btnDesactivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalDesactivate').modal('hide');
                    reloadTable();
                    postid = null;

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
                url: '{{ route('admin.post.activate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: postid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnActivate").html('Confirmar');
                $("#btnActivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalActivate').modal('hide');
                    reloadTable();
                    postid = null;

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

        function savePost(){
            
            postblogcategory = $('#postblogcategory').val();
            posttitle = $('#posttitle').val();
            postdescription = $('#postdescription').val();
            posttags = $('#posttags').val();
            postauthor = $('#postblogcategory option:selected').text();
            //postcontent = $('#postcontent').val();
            postcontent = CKEDITOR.instances.postcontent.getData();
            postimage1 = $('#postimage1').val();
            postimage2 = $('#postimage2').val();
            postimage3 = $('#postimage3').val();


            if(confirm('¿Está seguro de registrar la publicación?')==true){
                $("#btnSavePost").html('Guardando...');
                $("#btnSavePost").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.post.save') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {blogcategoryid:postblogcategory,posttitle:posttitle,postdescription:postdescription,posttags:posttags,postauthor:postauthor,postcontent:postcontent,postimage1:postimage1,postimage2:postimage2,postimage3:postimage3, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnSavePost").html('Guardar');
                    $("#btnSavePost").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalPost').modal('hide');
                        $("#frmPost")[0].reset();
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

        function updatePost(){
            
            postblogcategory = $('#postblogcategory').val();
            //Id del usuario
            posttitle = $('#posttitle').val();
            postdescription = $('#postdescription').val();
            posttags = $('#posttags').val();
            postauthor = $('#postblogcategory option:selected').text();
            //postcontent = $('#postcontent').val();
            postcontent = CKEDITOR.instances.postcontent.getData();
            postimage1 = $('#postimage1').val();
            postimage2 = $('#postimage2').val();
            postimage3 = $('#postimage3').val();

            if(confirm('¿Está seguro de actualizar la publicación?')==true){
                $("#btnUpdatePost").html('Actualizando...');
                $("#btnUpdatePost").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.post.update') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {postid:postid,blogcategoryid:postblogcategory,posttitle:posttitle,postdescription:postdescription,posttags:posttags,postauthor:postauthor,postcontent:postcontent,postimage1:postimage1,postimage2:postimage2,postimage3:postimage3, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnUpdatePost").html('Actualizar');
                    $("#btnUpdatePost").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalPost').modal('hide');
                        $("#frmPost")[0].reset();
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
                url: '{{ route('admin.post.getlistblogcategories') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                $('#postblogcategory').html('');
                $('#postblogcategory').append($("<option></option>").attr("value", "0").text("- No asignado -"));
                $.each(data, function(i, item) {
                    $('#postblogcategory').append($("<option></option>").attr("value", data[i].nblogcategoryid).text(data[i].sname));
                });
            });
        }

    })
</script>

@endsection
