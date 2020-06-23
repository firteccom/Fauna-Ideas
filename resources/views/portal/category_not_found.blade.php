@extends('layouts.front')

@section('frontcontent')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Categorías</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categoría no encontrada</li>
            </ol>
        </div><!-- End .container-fluid -->
    </nav>

    <div class="page-header">
        <div class="container">
            <h1>CATEGORÍA NO ENCONTRADA</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->


    <div class="mb-10"></div><!-- margin -->
</main><!-- End .main -->

@endsection