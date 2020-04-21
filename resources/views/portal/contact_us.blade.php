@extends('layouts.front')

@section('frontcontent')

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
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

                <form action="#">
                    <div class="form-group required-field">
                        <label for="contact-name">Nombre</label>
                        <input type="text" class="form-control" id="contact-name" name="contact-name" required>
                    </div><!-- End .form-group -->

                    <div class="form-group required-field">
                        <label for="contact-email">Correo electrónico</label>
                        <input type="email" class="form-control" id="contact-email" name="contact-email" required>
                    </div><!-- End .form-group -->

                    <div class="form-group">
                        <label for="contact-phone">Celular</label>
                        <input type="tel" class="form-control" id="contact-phone" name="contact-phone">
                    </div><!-- End .form-group -->

                    <div class="form-group required-field">
                        <label for="contact-message">Indícanos tu consulta</label>
                        <textarea cols="30" rows="1" id="contact-message" class="form-control" name="contact-message" required></textarea>
                    </div><!-- End .form-group -->

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
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