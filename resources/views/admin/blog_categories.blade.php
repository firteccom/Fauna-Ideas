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
            Categorías de Blog
            <small>Mantenimiento</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Tienda</a></li>
            <li class="active">Categorías de Blog</li>
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
                        <form role="form" id="frmListBlogCategories">
                        <div class="box-body">
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterblogcategoryname">Nombre</label>
                                <input type="text" class="form-control filter" id="filterblogcategoryname" name="filterblogcategoryname" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterblogcategoryshortdescription">Abreviatura</label>
                                <input type="text" class="form-control filter" id="filterblogcategoryshortdescription" name="filterblogcategoryshortdescription" placeholder="Ingrese una abreviatura">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filterblogcategorydescription">Descripción</label>
                                <input type="text" class="form-control filter" id="filterblogcategorydescription" name="filterblogcategorydescription" placeholder="Ingrese una descripción">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 form-group">
                                <label for="filtercategorystatus">Estado</label>
                                <select id="filtercategorystatus" name="filtercategorystatus" class="form-control filter select2" style="width: 100%;">
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
                                <button type="button" class="btn btn-success btn-new-blogcategory pull-left" data-toggle="modal" data-target="#modalBlogCategory">Nuevo</button>
                                <button type="submit" id="btnSearchBlogCategories" name="btnSearchBlogCategories" class="btn btn-primary pull-right">Buscar</button>
                            </div>  

                            <div class="clearfix"></div>
                            <br>

                        <div class="box  box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de categoría de blogs</h3>
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
        
        <div class="modal fade" id="modalBlogCategory">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmBlogCategory" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title title-blogcategory">Nueva categoría de blog</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="blogcategoryparent">Categoría padre de blog</label>
                                <select id="blogcategoryparent" name="blogcategoryparent" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- No asignado -</option>
                                    @foreach ($blogcategories as $blogcategory)
                                        <option value="{{$blogcategory->nblogcategoryid}}">{{$blogcategory->sname}}</option>
                                    @endforeach
                                </select>                            
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="blogcategoryname">Nombre</label>
                                <input type="text" class="form-control" id="blogcategoryname" name="blogcategoryname" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="blogcategoryshortdescription">Abreviatura</label>
                                <input type="text" class="form-control" id="blogcategoryshortdescription" name="blogcategoryshortdescription" placeholder="Ingrese una abreviatura">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="blogcategorydescription">Descripción</label>
                                <input type="text" class="form-control" id="blogcategorydescription" name="blogcategorydescription" placeholder="Ingrese una descripción">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="blogcategoryfullimage">Imagen</label>
                                <input type="url" class="form-control" id="blogcategoryfullimage" name="blogcategoryfullimage" placeholder="URL de imagen">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="btnSaveBlogCategory" class="btn btn-primary">Registrar</button>
                            <button type="button" id="btnUpdateBlogCategory" style="display:none;" class="btn btn-primary">Actualizar</button>
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
                <p>¿Desea desactivar la categoría de blog seleccionada?</p>
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
                <p>¿Desea activar la categoría de blog seleccionada?</p>
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
    var blogcategoryid = 0;

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
                {sTitle : "Categoría padre de blog", mRender: function(data, type, row) {
                    if(row.blogcategoryparentid != null){
                        return ($.trim(row.blogcategoryparentid) != '') ? row.blogcategoryparentid : 'No asignado';
                    }else{
                        return 'No asignado';
                    }
                }},           
                {sTitle : "Nombre", mData: "sname"},
                {sTitle : "Abreviatura", mData: "sshortdescription"},
                {sTitle : "Descripción", mData: "sdescription"},
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
                        return 	'<a data-id="'+row.nblogcategoryid+'" class="btn btn-default fa fa-pencil btn-edit tooltips" data-toggle="modal" data-target="#modalBlogCategory" data-placement="top" title="Editar" data-original-title="Editar"></a>'+ 
                            ' <i data-id="'+row.nblogcategoryid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                    } else{
                        return 	'<i data-id="'+row.nblogcategoryid+'" class="btn btn-success fa fa-thumbs-up activate tooltips" data-toggle="modal" data-target="#modalActivate"  data-toggle="tooltip" data-placement="top" title="Activar" data-original-title="Activar"></i>';
                    }
                }}
            ],
            "ajax": {
                    "url": "{{ route('admin.blogcategory.getall') }}",
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
                aoData.blogcategoryname = $('#filterblogcategoryname').val();
                aoData.blogcategoryshortdescription = $('#filterblogcategoryshortdescription').val();
                aoData.blogcategorydescription = $('#filterblogcategorydescription').val();
                aoData.categorystatus = $('#filtercategorystatus').val();


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

        $('#btnSearchBlogCategories').click(function(ev){
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

        $('#btnSaveBlogCategory').click(function(ev){
            ev.preventDefault();
            saveBlogCategory();
        });

        $('#btnUpdateBlogCategory').click(function(ev){
            ev.preventDefault();
            updateBlogCategory();
        });

        $(document).on('click', '.btn-new-blogcategory', function(event) {
            
            $("#frmBlogCategory")[0].reset();
            $('.title-blogcategory').text('Nueva categoría de blog');
            loadModalBlogCategories(0);
            $('#btnSaveBlogCategory').show();
            $('#btnUpdateBlogCategory').hide();

        });

        $(document).on('click', '.btn-edit', function(event) {

            var id = $(this).data('id');
            $('.title-blogcategory').text('Actualizar categoría de blog');
            $('#btnSaveBlogCategory').hide();
            $('#btnUpdateBlogCategory').show();
            //alert(id);
            loadModalBlogCategories(id);

            $.ajax({
                url: '{{ route('admin.blogcategory.get') }}',
                type: 'POST',
                dataType: 'json',
                data: {nblogcategoryid:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                
                blogcategoryid = id;

                if (data.status == 'success') {

                    $('#blogcategoryparent').val(data.blogcategory.nblogcategoryparentid);
                    $('#blogcategoryparent').select2().trigger('change');
                    $('#blogcategoryname').val(data.blogcategory.sname);
                    $('#blogcategoryshortdescription').val(data.blogcategory.sshortdescription);
                    $('#blogcategorydescription').val(data.blogcategory.sdescription);
                    $('#blogcategoryfullimage').val(data.blogcategory.sfullimage);

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
            blogcategoryid = $(this).data('id');
            //alert('ID: ' + blogcategoryid);
        });

        $(document).on('click', '.activate', function(event) {
            blogcategoryid = $(this).data('id');
            //alert('ID: ' + blogcategoryid);
        });

        $(document).on('click', '#btnDesactivate', function(event) {
            event.preventDefault();
            $("#btnDesactivate").html('Desactivando...');
            $("#btnDesactivate").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.blogcategory.desactivate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:blogcategoryid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnDesactivate").html('Confirmar');
                $("#btnDesactivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalDesactivate').modal('hide');
                    reloadTable();
                    blogcategoryid = null;

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
                url: '{{ route('admin.blogcategory.activate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: blogcategoryid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnActivate").html('Confirmar');
                $("#btnActivate").removeAttr('disabled');

                if (data.status == 'success') {

                    $('#modalActivate').modal('hide');
                    reloadTable();
                    blogcategoryid = null;

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

        function saveBlogCategory(){
            
            blogcategoryparentid = $('#blogcategoryparent').val();
            blogcategoryname = $('#blogcategoryname').val();
            blogcategoryshortdescription = $('#blogcategoryshortdescription').val();
            blogcategorydescription = $('#blogcategorydescription').val();
            blogcategoryfullimage = $('#blogcategoryfullimage').val();

            if(confirm('¿Está seguro de registrar la categoría de blog?')==true){
                $("#btnSaveBlogCategory").html('Guardando...');
                $("#btnSaveBlogCategory").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.blogcategory.save') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {blogcategoryparentid:blogcategoryparentid, blogcategoryname:blogcategoryname, blogcategoryshortdescription:blogcategoryshortdescription, blogcategorydescription:blogcategorydescription, blogcategoryfullimage:blogcategoryfullimage, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnSaveBlogCategory").html('Guardar');
                    $("#btnSaveBlogCategory").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalBlogCategory').modal('hide');
                        $("#frmBlogCategory")[0].reset();
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

        function updateBlogCategory(){
            
            blogcategoryparentid = $('#blogcategoryparent').val();
            blogcategoryname = $('#blogcategoryname').val();
            blogcategoryshortdescription = $('#blogcategoryshortdescription').val();
            blogcategorydescription = $('#blogcategorydescription').val();
            blogcategoryfullimage = $('#blogcategoryfullimage').val();

            if(confirm('¿Está seguro de actualizar la categoría de blog?')==true){
                $("#btnUpdateBlogCategory").html('Actualizando...');
                $("#btnUpdateBlogCategory").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.blogcategory.update') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {blogcategoryid:blogcategoryid, blogcategoryparentid:blogcategoryparentid, blogcategoryname:blogcategoryname, blogcategoryshortdescription:blogcategoryshortdescription, blogcategorydescription:blogcategorydescription, blogcategoryfullimage:blogcategoryfullimage, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnUpdateBlogCategory").html('Actualizar');
                    $("#btnUpdateBlogCategory").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalBlogCategory').modal('hide');
                        $("#frmBlogCategory")[0].reset();
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

        function loadModalBlogCategories(id){

            $.ajax({
                url: '{{ route('admin.blogcategory.getlist') }}',
                type: 'POST',
                dataType: 'json',
                data: {id:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                $('#blogcategoryparent').html('');
                $('#blogcategoryparent').append($("<option></option>").attr("value", "0").text("- No asignado -"));
                $.each(data, function(i, item) {
                    $('#blogcategoryparent').append($("<option></option>").attr("value", data[i].nblogcategoryid).text(data[i].sname));
                });
            });
        }
        
    });
</script>

@endsection
