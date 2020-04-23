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
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog</li>
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

                @foreach ($posts as $k=>$post)

                    <article class="entry">
                        <div class="entry-media">
                            <a href="{{ asset('blog') }}/{{ $post->npostid }}" target="_blank">
                                <div class="entry-slider owl-carousel owl-theme">
                                    @if (isset($post->simage1))
                                    <img src="{{ asset('public/portal/images/blog/post-1.jpg') }}" alt="Post">
                                    @endif
                                    @if (isset($post->simage2))
                                    <img src="{{ asset('public/portal/images/blog/post-2.jpg') }}" alt="Post">
                                    @endif
                                    @if (isset($post->simage3))
                                    <img src="{{ asset('public/portal/images/blog/post-3.jpg') }}" alt="Post">
                                    @endif
                                </div><!-- End .entry-slider -->
                            </a>
                        </div><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-date">
                                <span class="day">{{ $post->day }}</span>
                                <span class="month">{{ $post->month }}</span>
                            </div><!-- End .entry-date -->

                            <h2 class="entry-title">
                                <a href="{{ asset('blog') }}/{{ $post->npostid }}" target="_blank">{{ $post->stitle }}</a>
                            </h2>

                            <div class="entry-content">
                                <p>{{ $post->postdescription }}</p>

                                <a href="{{ asset('blog') }}/{{ $post->npostid }}" target="_blank" class="read-more">Leer más <i class="icon-angle-double-right"></i></a>
                            </div><!-- End .entry-content -->

                            <div class="entry-meta">
                                <span><i class="icon-calendar"></i>{{ $post->date }}</span>
                                <span><i class="icon-user"></i>Por <a href="#">{{ $post->sauthor }}</a></span>
                                <span><i class="icon-folder-open"></i>
                                    <a href="#">{{ $post->blogcategoryname }}</a>
                                </span>
                            </div><!-- End .entry-meta -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->

                @endforeach

                <nav class="toolbox toolbox-pagination">
                    <ul class="pagination">
                        <li class="page-item active">
                            <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><span class="page-link">...</span></li>
                        <li class="page-item">
                            <a class="page-link page-link-btn" href="#"><i class="icon-angle-right"></i></a>
                        </li>
                    </ul>
                </nav>
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