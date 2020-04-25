@extends('layouts.front')


@section('css')
<style type="text/css">

    ::placeholder { /* Firefox, Chrome, Opera */ 
        color: blue; 
    } 
  
    :-ms-input-placeholder { /* Internet Explorer 10-11 */ 
        color: red; 
    } 
    
    ::-ms-input-placeholder { /* Microsoft Edge */ 
        color: orange; 
    }

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
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('front.blog.page') }}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $post->stitle }}</li>
            </ol>
        </div><!-- End .container-fluid -->
    </nav>

    <div class="page-header">
        <div class="container">
            <h1>Blog</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->

    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <article class="entry single">
                    <div class="entry-media">
                        <div class="entry-slider owl-carousel owl-theme">
                            @if (isset($post->simage1))
                            <img src="{{ $post->simage1 }}" alt="Post">
                            @endif
                            @if (isset($post->simage2))
                            <img src="{{ $post->simage2 }}" alt="Post">
                            @endif
                            @if (isset($post->simage3))
                            <img src="{{ $post->simage3 }}" alt="Post">
                            @endif
                        </div><!-- End .entry-slider -->
                    </div><!-- End .entry-media -->

                    <div class="entry-body">
                        <div class="entry-date">
                            <span class="day">{{ $post->day }}</span>
                            <span class="month">{{ $post->month }}</span>
                        </div><!-- End .entry-date -->

                        <h2 class="entry-title">
                            <a href="{{ asset('blog') }}/{{ $post->npostid }}" target="_blank">{{ $post->stitle }}</a>
                        </h2>

                        <div class="entry-meta">
                                <span><i class="icon-calendar"></i>{{ $post->date }}</span>
                                <span><i class="icon-user"></i>Por <a href="#">{{ $post->sauthor }}</a></span>
                                <span><i class="icon-folder-open"></i>
                                    <a href="#">{{ $post->blogcategoryname }}</a>
                                </span>
                        </div><!-- End .entry-meta -->

                        <div class="entry-content">
                            {!! $post->scontent !!}
                        <div class="entry-share">
                            <h3>
                                <i class="icon-forward"></i>
                                Compartir esta publicación
                            </h3>

                            <div class="social-icons">
                                <a href="#" class="social-icon social-facebook" target="_blank" title="Facebook">
                                    <i class="icon-facebook"></i>
                                </a>
                                <a href="#" class="social-icon social-twitter" target="_blank" title="Twitter">
                                    <i class="icon-twitter"></i>
                                </a>
                                <a href="#" class="social-icon social-mail" target="_blank" title="Email">
                                    <i class="icon-mail-alt"></i>
                                </a>
                            </div><!-- End .social-icons -->
                        </div><!-- End .entry-share -->

                        <div class="entry-author">
                            <h3><i class="icon-user"></i>Autor</h3>

                            <figure>
                                <a href="#">
                                    <img src="{{ asset('public/portal/images/blog/author.jpg') }}" alt="author">
                                </a>
                            </figure>

                            <div class="author-content">
                                <h4><a href="#">{{ $post->sauthor }}</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab officia culpa corporis, quidem placeat minima unde vel veniam laboriosam et animi, inventore delectus, officiis doloribus ex amet illum ea suscipit!</p>
                            </div><!-- End .author.content -->
                        </div><!-- End .entry-author -->

                        <div class="comment-respond">
                            <h3>Dejar un comentario</h3>
                            <p>Su dirección de correo electrónico no será publicada. Los campos obligatorios están marcados *</p>

                            <form action="#">
                                <div class="form-group required-field">
                                    <label>Comentario</label> (Máx. 500 caracteres)
                                    <textarea cols="30" rows="1" class="form-control" required></textarea>
                                </div><!-- End .form-group -->

                                <div class="form-group required-field">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" required>
                                </div><!-- End .form-group -->

                                <div class="form-group required-field">
                                    <label>Correo electrónico</label>
                                    <input type="email" class="form-control" required>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label>Celular</label>
                                    <input type="cel" class="form-control">
                                </div><!-- End .form-group -->
                                
                                <div class="form-group-custom-control mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="save-name">
                                        <label class="custom-control-label" for="save-name">Guardar mi nombre, electrónico y celular en este navegador para la próxima vez que comente.</label>
                                    </div><!-- End .custom-checkbox -->
                                </div><!-- End .form-group-custom-control -->

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary">Publicar comentario</button>
                                </div><!-- End .form-footer -->
                            </form>
                        </div><!-- End .comment-respond -->
                    </div><!-- End .entry-body -->
                </article><!-- End .entry -->

                <div class="related-posts">
                    <h4 class="light-title"><strong>Publicaciones </strong> Relacionadas</h4>

                    <div class="owl-carousel owl-theme related-posts-carousel">
                        @foreach ($relatedposts as $k=>$relatedpost)
                        <article class="entry">
                            <div class="entry-media">
                                <a href="{{ asset('blog') }}/{{ $relatedpost->npostid }}" target="_blank">
                                    <img src="{{ asset('public/portal/images/blog/related/post-1.jpg') }}" alt="{{ $relatedpost->stitle }}">
                                </a>
                            </div><!-- End .entry-media -->

                            <div class="entry-body">
                                <div class="entry-date">
                                    <span class="day">{{ $relatedpost->day }}</span>
                                    <span class="month">{{ $relatedpost->month }}</span>
                                </div><!-- End .entry-date -->

                                <h2 class="entry-title">
                                    <a href="{{ asset('blog') }}/{{ $relatedpost->npostid }}" target="_blank">{{ $relatedpost->stitle }}</a>
                                </h2>

                                <div class="entry-content">
                                    <p>{{ $relatedpost->sdescription }}</p>

                                    <a href="{{ asset('blog') }}/{{ $relatedpost->npostid }}" class="read-more">Leer más <i class="icon-angle-double-right"></i></a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </article>
                        @endforeach
                    </div><!-- End .owl-carousel -->
                </div><!-- End .related-posts -->
            </div><!-- End .col-lg-9 -->

            <aside class="sidebar col-lg-3">
                <div class="sidebar-wrapper">
                    <div class="widget widget-search">
                        <form role="search" method="get" class="search-form" action="#">
                            <input type="search" class="form-control" style="font-size: 9px; color:red;" placeholder="Buscar publicaciones aquí..." name="postsearch" id="postsearch" required>
                            <button type="submit" class="search-submit" title="Search">
                                <i class="icon-search"></i>
                                <span class="sr-only">Buscar</span>
                            </button>
                        </form>
                    </div><!-- End .widget -->

                    <div class="widget widget-categories">
                        <h4 class="widget-title">Categorías de blog</h4>

                        <ul class="list">
                            @foreach ($blogcategorieslist as $k=>$blogcategory)
                                <li><a href="#">{{ $blogcategory->blogcategoryname }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h4 class="widget-title">Publicaciones recientes</h4>

                        <ul class="simple-entry-list">
                            @foreach ($recentposts as $k=>$recentpost)
                                <li>
                                    <div class="entry-media">
                                        <a href="{{ asset('blog') }}/{{ $recentpost->npostid }}" target="_blank">
                                            <img src="{{ $recentpost->simage1 }}" alt="Post">
                                        </a>
                                    </div><!-- End .entry-media -->
                                    <div class="entry-info">
                                        <a href="{{ asset('blog') }}/{{ $recentpost->npostid }}" target="_blank">{{ $recentpost->stitle }}</a>
                                        <div class="entry-meta">
                                            {{ $recentpost->day }} de {{ $recentpost->month }} de {{ $recentpost->year }}
                                        </div><!-- End .entry-meta -->
                                    </div><!-- End .entry-info -->
                                </li>
                            @endforeach
                        </ul>
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h4 class="widget-title">Tagcloud</h4>

                        <div class="tagcloud">
                            <a href="#">Fashion</a>
                            <a href="#">Shoes</a>
                            <a href="#">Skirts</a>
                            <a href="#">Dresses</a>
                            <a href="#">Bags</a>
                        </div><!-- End .tagcloud -->
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h4 class="widget-title">Archive</h4>

                        <ul class="list">
                        @foreach ($archivedposts as $k=>$archivedpost)
                            <li><a href="#">{{ $archivedpost->archivedate }}</a></li>
                        @endforeach
                        </ul>
                    </div><!-- End .widget -->


                    <div class="widget widget_compare">
                        <h4 class="widget-title">Compare Products</h4>

                        <p>You have no items to compare.</p>
                    </div><!-- End .widget -->
                </div><!-- End .sidebar-wrapper -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
</main><!-- End .main -->

@endsection

@section('js')
<script>

    $(function() {


        
    });
</script>

@endsection