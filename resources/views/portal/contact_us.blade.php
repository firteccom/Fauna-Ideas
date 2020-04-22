@extends('layouts.front')


@section('css')
<style type="text/css">

</style>
<script type="module">
  import Swal from 'sweetalert2/src/sweetalert2.js'
</script>
@endsection

@section('frontcontent')

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contáctanos</li>
            </ol>
        </div><!-- End .container-fluid -->
    </nav>

    <div class="page-header">
        <div class="container">
            <h1>Contáctanos</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->

    <div class="container">
        <div id="map"></div><!-- End #map -->

        <div class="row">
            <div class="col-md-8">
                <h2 class="light-title">Escríbenos <strong></strong></h2>

                <form id="frmSendEmailContact">
                    {!! csrf_field() !!}
                    <div class="form-group required-field">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div><!-- End .form-group -->

                    <div class="form-group required-field">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div><!-- End .form-group -->

                    <div class="form-group">
                        <label for="mobile">Celular</label>
                        <input type="tel" class="form-control" id="mobile" name="mobile">
                    </div><!-- End .form-group -->

                    <div class="form-group required-field">
                        <label for="message">Indícanos tu consulta</label>
                        <textarea cols="30" rows="1" id="message" class="form-control" name="message" required></textarea>
                    </div><!-- End .form-group -->

                    <div class="form-footer">
                        <button type="button" id="btnSendEmail" name="btnSendEmail" class="btn btn-primary">Enviar</button>
                    </div><!-- End .form-footer -->
                </form>
            </div><!-- End .col-md-8 -->

            <div class="col-md-4">
                <h2 class="light-title">Información de <strong>Contacto</strong></h2>

                <div class="contact-info">
                    <div>
                        <i class="icon-mobile"></i>
                        <p><a href="tel:">+51 942 088 668</a></p>
                        <p><a href="tel:">+51 942 088 668</a></p>
                    </div>
                    <div>
                        <i class="icon-mail-alt"></i>
                        <p><a href="mailto:#">fauna.ideas@gmail.com</a></p>
                        <p><a href="mailto:#">fauna.ideas@gmail.com</a></p>
                    </div>
                    <div>
                        <i class="icon-skype"></i>
                        <p>porto_skype</p>
                        <p>porto_template</p>
                    </div>
                </div><!-- End .contact-info -->
            </div><!-- End .col-md-4 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-8"></div><!-- margin -->
</main><!-- End .main -->

@endsection

@section('js')
<script>

    $(function() {

        $(document).on('click', '#btnSendEmail', function(event) {
            $("#btnSendEmail").html('Enviando...');
            $("#btnSendEmail").attr('disabled', 'disabled');

            var frm = $('#frmSendEmailContact');
            var formData = new FormData($(frm)[0]);

            $.ajax({
                url: '{{ route('front.contact.sendemail') }}',
                type: 'POST',
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(data) {

                $("#btnSendEmail").html('Enviar');
                $("#btnSendEmail").removeAttr('disabled');

                if (data.status == 'success') {
                    $("#frmSendEmailContact")[0].reset();
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                } else if (data.status == 'warning') {
                    reloadTable();
                    Swal.fire({
                        position: 'top-end',
                        type: 'warning',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });

                } else if (data.status == 'error') {
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

        });
    
    });
</script>

@endsection