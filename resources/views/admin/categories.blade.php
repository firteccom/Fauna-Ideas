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
            Categorías
            <small>Mantenimiento</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Tienda</a></li>
            <li class="active">Categorías</li>
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
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filtercategoryname">Nombre</label>
                                <input type="text" class="form-control" id="filtercategoryname" name="filtercategoryname" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filtercategoryshortdescription">Abreviatura</label>
                                <input type="text" class="form-control" id="filtercategoryshortdescription" name="filtercategoryshortdescription" placeholder="Ingrese una abreviatura">
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filtercategorydescription">Descripción</label>
                                <input type="text" class="form-control" id="filtercategorydescription" name="filtercategorydescription" placeholder="Ingrese una descripción">
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 form-group">
                                <label for="filtercategorystatus">Estado</label>
                                <select id="filtercategorystatus" name="filtercategorystatus" class="form-control select2" style="width: 100%;">
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
                                <button type="button" class="btn btn-success pull-left" data-toggle="modal" data-target="#modalCategory">Nuevo</button>
                                <button type="submit" id="btnSearchProducts" name="btnSearchProducts" class="btn btn-primary pull-right">Buscar</button>
                            </div>  

                            <div class="clearfix"></div>
                            <br>

                        <div class="box  box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de categorías</h3>
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
        
        <div class="modal fade" id="modalCategory">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmCategory" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Nueva categoría</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="categoryparent">Categoría padre</label>
                                <select id="categoryparent" name="categoryparent" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">- Seleccione una opción -</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->ncategoryid}}">{{$category->ncategoryid}}</option>
                                    @endforeach
                                </select>                            
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="categoryname">Nombre</label>
                                <input type="text" class="form-control" id="categoryname" name="categoryname" placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="categoryshortdescription">Abreviatura</label>
                                <input type="text" class="form-control" id="categoryshortdescription" name="categoryshortdescription" placeholder="Ingrese una abreviatura">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label for="categorydescription">Descripción</label>
                                <input type="text" class="form-control" id="categorydescription" name="categorydescription" placeholder="Ingrese una descripción">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="btnSaveCategory" class="btn btn-primary">Guardar</button>
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
                <h4 class="modal-title">Desactivar categoría</h4>
              </div>
              <div class="modal-body">
                <p>¿Desea desactivar la categoría seleccionada?</p>
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



    <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->
  
@endsection
@section('js')
<script>

    var table;
    var categoryid;

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
                {sTitle : "Categoría padre", mRender: function(data, type, row) {
                    if(row.categoryparent != null){
                        return ($.trim(row.categoryparent) != '') ? row.categoryparent : 'No asignado';
                    }else{
                        return 'No asignado';
                    }
                }},           
                {sTitle : "Nombre", mData: "sname"},
                {sTitle : "Abreviatura", mData: "sshortdescription"},
                {sTitle : "Descripción", mData: "sdescription"},
                {sTitle : "Acciones", mData: "Acciones", sClass:"col_center", sWidth:"80px", mRender: function(data, type, row) {
                    if(row.sstatus != 'N'){
                        return 	'<a data-id="'+row.ncategoryid+'" class="btn btn-default fa fa-pencil btn-edit tooltips" data-toggle="modal" data-target="#modalCategory" data-placement="top" title="Editar" data-original-title="Editar"></a>'+ 
                            ' <i data-id="'+row.ncategoryid+'" class="btn btn-danger fa fa-thumbs-down desactivate tooltips" data-toggle="modal" data-target="#modalDesactivate" data-toggle="tooltip" data-placement="top" title="Desactivar" data-original-title="Desactivar"></i>';
                    } else{
                        return 	'<i data-id="'+row.ncategoryid+'" class="btn btn-success fa fa-thumbs-up activate tooltips" data-toggle="modal" data-target="#modalActivate"  data-toggle="tooltip" data-placement="top" title="Activar" data-original-title="Activar"></i>';
                    }
                }}
            ],
            "ajax": {
                    "url": "{{ route('admin.category.getall') }}",
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

        function reloadTable(){
            $("#listado").DataTable().ajax.reload();
        }

        $('#btnSaveCategory').click(function(ev){
            ev.preventDefault();
            saveCategory();
        });

        function saveCategory(){
		    
            categoryparent = $('#categoryparent').val();
            categoryname = $('#categoryname').val();
            categoryshortdescription = $('#categoryshortdescription').val();
            categorydescription = $('#categorydescription').val();

            if(confirm('¿Está seguro de registrar la categoría?')==true){
                $("#btnSaveCategory").html('Guardando...');
                $("#btnSaveCategory").attr('disabled', 'disabled');

                $.ajax({
                    url: '{{ route('admin.category.save') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {categoryparent:categoryparent, categoryname:categoryname, categoryshortdescription:categoryshortdescription, categorydescription:categorydescription, _token:'{{ csrf_token() }}'},
                })
                .done(function(data) {

                    $("#btnSaveCategory").html('Guardar');
                    $("#btnSaveCategory").removeAttr('disabled');

                    if (data.status == 'success') {
                        $('#modalCategory').modal('hide');
                        $("#frmCategory")[0].reset();
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

        $(document).on('click', '.btn-edit', function(event) {

            cargarCategoriasModal();
		    
            var id = $(this).data('id');

            $.ajax({
                url: '{{ route('admin.category.get') }}',
                type: 'POST',
                dataType: 'json',
                data: {ncategoryid:id, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnSaveCategory").html('Actualizar');

                if (data.status == 'success') {

                    $('#categoryparent').val(data.category.ncategoryparent);
                    $('#categoryparent').select2().trigger('change');
                    $('#categoryname').val(data.category.sname);
                    $('#categoryshortdescription').val(data.category.sshortdescription);
                    $('#categorydescription').val(data.category.sdescription);

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

        function cargarCategoriasModal(){

            $.ajax({
                url: '{{ route('admin.category.getlist') }}',
                type: 'POST',
                dataType: 'json',
                data: {_token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                $('#categoryparent').html('');
                $('#categoryparent').append($("<option></option>").attr("value", "").text("- Seleccione una opción -"));
                $.each(data, function(i, item) {
                    $('#categoryparent').append($("<option></option>").attr("value", data[i].ncategoryid).text(data[i].sname));
                });
            });
        }

        $(document).on('click', '.desactivate', function(event) {
            categoryid = $(this).data('id');
            alert('ID: ' + categoryid);
        });

        $(document).on('click', '.activate', function(event) {
            categoryid = $(this).data('id');
            alert('ID: ' + categoryid);
        });

        $(document).on('click', '#btnDesactivate', function(event) {
            event.preventDefault();
            $("#btnDesactivate").html('Desactivando...');
            $("#btnDesactivate").attr('disabled', 'disabled');

            $.ajax({
                url: '{{ route('admin.category.desactivate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: categoryid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {

                $("#btnDesactivate").html('Confirmar');

                if (data.status == 'success') {

                    $('#modalDesactivate').modal('hide');
                    reloadTable();

                    Swal.fire({
                        position: 'top-end',
                        type: 'error',
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
            $.ajax({
                url: '{{ route('admin.category.activate') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: categoryid, _token:'{{ csrf_token() }}'},
            })
            .done(function(data) {
                if (data.status == 'ok') {
                    buscarPersonal();
                    $('.bs-activar').modal('hide');
                }
            });
        });
        
    });
</script>

@endsection
