<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Porto - Bootstrap eCommerce Template</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Bootstrap eCommerce Template">
    <meta name="author" content="SW-THEMES">
        
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('portal/images/icons/favicon.ico') }}">
    
    <script type="text/javascript">
        WebFontConfig = {
            google: { families: [ 'Open+Sans:300,400,600,700,800','Poppins:300,400,500,600,700','Segoe Script:300,400,500,600,700' ] }
        };
        (function(d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = "{{ asset('js/webfont.js') }}";
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    
    <script type="text/javascript">
        WebFontConfig = {
            google: { families: [ 'Open+Sans:300,400,600,700,800','Poppins:300,400,500,600,700','Segoe Script:300,400,500,600,700' ] }
        };
        (function(d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = "{{ asset('js/webfont.js') }}";
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>


    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('portal/css/bootstrap.min.css') }}">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('portal/css/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portal/vendor/fontawesome-free/css/all.min.css') }}">
</head>
<body class="full-screen-slider">
    <div class="page-wrapper">

        <header class="header header-transparent">
            <div class="header-middle">
                <div class="container-fluid">
                    <div class="header-left">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>
                        <a href="index.html" class="logo">
                            <img src="assets/images/logo.png" alt="Porto Logo">
                        </a>

                        <nav class="main-nav">
                            <ul class="menu">
                                <li>
                                    <a href="index.html">Home</a>
                                </li>
                                <li>
                                    <a href="category.html">Categories</a>
                                    <div class="megamenu">
                                        <div class="row row-sm">
                                            <div class="col-lg-4">
                                                <a href="#" class="nolink">VARIATION 1</a>
                                                <ul class="submenu">
                                                    <li><a href="category.html">Fullwidth Banner</a></li>
                                                    <li><a href="category-banner-boxed-slider.html">Boxed Slider Banner</a></li>
                                                    <li><a href="category-banner-boxed-image.html">Boxed Image Banner</a></li>
                                                    <li><a href="category.html">Left Sidebar</a></li>
                                                    <li><a href="category-sidebar-right.html">Right Sidebar</a></li>
                                                    <li><a href="category-flex-grid.html">Product Flex Grid</a></li>
                                                    <li><a href="category-horizontal-filter1.html">Horizontal Filter1</a></li>
                                                    <li><a href="category-horizontal-filter2.html">Horizontal Filter2</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-4">
                                                <a href="#" class="nolink">VARIATION 2</a>
                                                <ul class="submenu">
                                                    <li><a href="#">Product List Item Types</a></li>
                                                    <li><a href="category-infinite-scroll.html">Ajax Infinite Scroll</a></li>
                                                    <li><a href="category-3col.html">3 Columns Products</a></li>
                                                    <li><a href="category.html">4 Columns Products</a></li>
                                                    <li><a href="category-5col.html">5 Columns Products</a></li>
                                                    <li><a href="category-6col.html">6 Columns Products</a></li>
                                                    <li><a href="category-7col.html">7 Columns Products</a></li>
                                                    <li><a href="category-8col.html">8 Columns Products</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-4 image-container">
                                                <img src="assets/images/menu-banner-2.jpg" align="Menu banner">
                                            </div>
                                        </div>
                                    </div><!-- End .megamenu -->
                                </li>
                                <li class="">
                                    <a href="product.html">Products</a>
                                    <div class="megamenu">
                                        <div class="row row-sm">
                                            <div class="col-lg-3">
                                                <a href="#" class="nolink">Variations 1</a>
                                                <ul class="submenu">
                                                    <li><a href="product.html">Horizontal Thumbnails</a></li>
                                                    <li><a href="product-full-width.html">Vertical Thumbnails</a></li>
                                                    <li><a href="product.html">Inner Zoom</a></li>
                                                    <li><a href="product-addcart-sticky.html">Addtocart Sticky</a></li>
                                                    <li><a href="product-sidebar-left.html">Accordion Tabs</a></li>
                                                </ul>
                                            </div><!-- End .col-lg-4 -->
                                            <div class="col-lg-3">
                                                <a href="#" class="nolink">Variations 2</a>
                                                <ul class="submenu">
                                                    <li><a href="product-sticky-tab.html">Sticky Tabs</a></li>
                                                    <li><a href="product-simple.html">Simple Product</a></li>
                                                    <li><a href="product-sidebar-left.html">With Left Sidebar</a></li>
                                                </ul>
                                            </div><!-- End .col-lg-4 -->
                                            <div class="col-lg-3">
                                                <a href="#" class="nolink">Product Layout Types</a>
                                                <ul class="submenu">
                                                    <li><a href="product.html">Default Layout</a></li>
                                                    <li><a href="product-extended-layout.html">Extended Layout</a></li>
                                                    <li><a href="product-full-width.html">Full Width Layout</a></li>
                                                    <li><a href="product-grid-layout.html">Grid Images Layout</a></li>
                                                    <li><a href="product-sticky-both.html">Sticky Both Side Info</a></li>
                                                    <li><a href="product-sticky-info.html">Sticky Right Side Info</a></li>
                                                </ul>
                                            </div><!-- End .col-lg-4 -->

                                            <div class="col-lg-3 image-container">
                                                <img src="assets/images/menu-bg.png" alt="Menu banner" class="product-promo">
                                            </div><!-- End .col-lg-4 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .megamenu -->
                                </li>
                                <li class="sf-with-ul">
                                    <a href="#">Pages</a>
                                    <ul>
                                        <li><a href="cart.html">Shopping Cart</a></li>
                                        <li><a href="#">Checkout</a>
                                            <ul>
                                                <li><a href="checkout-shipping.html">Checkout Shipping</a></li>
                                                <li><a href="checkout-shipping-2.html">Checkout Shipping 2</a></li>
                                                <li><a href="checkout-review.html">Checkout Review</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Dashboard</a>
                                            <ul>
                                                <li><a href="dashboard.html">Dashboard</a></li>
                                                <li><a href="my-account.html">My Account</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="about.html">About Us</a></li>
                                        <li><a href="#">Blog</a>
                                            <ul>
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="single.html">Blog Post</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact Us</a></li>
                                        <li><a href="#" class="login-link">Login</a></li>
                                        <li><a href="forgot-password.html">Forgot Password</a></li>
                                    </ul>
                                </li>
                                <li><a href="https://1.envato.market/DdLk5" target="_blank">Buy Porto!</a></li>
                            </ul>
                        </nav>
                    </div><!-- End .header-left -->

                    <div class="header-right"> 

                        <a href="login.html">
                            <div class="header-user">
                                <i class="icon-user-2"></i>
                            </div>
                        </a>

                        <div class="header-search">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                            <form action="#" method="get">
                                <div class="header-search-wrapper">
                                    <input type="search" class="form-control" name="q" id="q" placeholder="I'm searching for..." required="">
                                    <div class="select-custom">
                                        <select id="cat" name="cat">
                                            <option value="">All Categories</option>
                                            <option value="4">Fashion</option>
                                            <option value="12">- Women</option>
                                            <option value="13">- Men</option>
                                            <option value="66">- Jewellery</option>
                                            <option value="67">- Kids Fashion</option>
                                            <option value="5">Electronics</option>
                                            <option value="21">- Smart TVs</option>
                                            <option value="22">- Cameras</option>
                                            <option value="63">- Games</option>
                                            <option value="7">Home &amp; Garden</option>
                                            <option value="11">Motors</option>
                                            <option value="31">- Cars and Trucks</option>
                                            <option value="32">- Motorcycles &amp; Powersports</option>
                                            <option value="33">- Parts &amp; Accessories</option>
                                            <option value="34">- Boats</option>
                                            <option value="57">- Auto Tools &amp; Supplies</option>
                                        </select>
                                    </div><!-- End .select-custom -->
                                    <button class="btn" type="submit"><i class="icon-search-3"></i></button>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div>

                        <a href="#" class="porto-icon"><i class="icon icon-wishlist-2"></i></a>

                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="icon-bag-2"></i>
                                <span class="cart-count">2</span>
                            </a>

                            <div class="dropdown-menu" >
                                <div class="dropdownmenu-wrapper">
                                    <div class="dropdown-cart-header">
                                        <span>2 Items</span>

                                        <a href="cart.html">View Cart</a>
                                    </div><!-- End .dropdown-cart-header -->
                                    <div class="dropdown-cart-products">
                                        <div class="product">
                                            <div class="product-details">
                                                <h4 class="product-title">
                                                    <a href="product.html">Woman Ring</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">1</span>
                                                    x $99.00
                                                </span>
                                            </div><!-- End .product-details -->

                                            <figure class="product-image-container">
                                                <a href="product.html" class="product-image">
                                                    <img src="assets/images/products/cart/product-1.jpg" alt="product">
                                                </a>
                                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-retweet"></i></a>
                                            </figure>
                                        </div><!-- End .product -->

                                        <div class="product">
                                            <div class="product-details">
                                                <h4 class="product-title">
                                                    <a href="product.html">Woman Necklace</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">1</span>
                                                    x $35.00
                                                </span>
                                            </div><!-- End .product-details -->

                                            <figure class="product-image-container">
                                                <a href="product.html" class="product-image">
                                                    <img src="assets/images/products/cart/product-2.jpg" alt="product">
                                                </a>
                                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-retweet"></i></a>
                                            </figure>
                                        </div><!-- End .product -->
                                    </div><!-- End .cart-product -->

                                    <div class="dropdown-cart-total">
                                        <span>Total</span>

                                        <span class="cart-total-price">$134.00</span>
                                    </div><!-- End .dropdown-cart-total -->

                                    <div class="dropdown-cart-action">
                                        <a href="checkout-shipping.html" class="btn btn-block">Checkout</a>
                                    </div><!-- End .dropdown-cart-total -->
                                </div><!-- End .dropdownmenu-wrapper -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container-fluid -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->

        <main class="main">
            <div class="home-slider owl-carousel owl-theme">
                <div class="home-slide">
                    <div class="slide-bg owl-lazy"  data-src="assets/images/slider/slide1.jpg"></div><!-- End .slide-bg -->
                    <div class="home-slide-content">
                        <h2>Winter Sale <br>Get 30% OFF <br>On JACKETS.</h2>

                        <span>It's time to start shopping porto's winter sale</span>

                        <a href="category.html" class="btn" role="button">Shop By Jackets</a>
                    </div><!-- End .home-slide-content -->
                </div><!-- End .home-slide -->

                <div class="home-slide">
                    <div class="slide-bg owl-lazy"  data-src="assets/images/slider/slide2.jpg"></div><!-- End .slide-bg -->
                    <div class="home-slide-content">
                        <h2>New Campaign Sale <br>UP to 70% </h2>

                        <span>Fashion for Women | Spring/Summer Collection</span>

                        <a href="category.html" class="btn" role="button">Shop By Hats</a>
                    </div><!-- End .home-slide-content -->
                </div><!-- End .home-slide -->
            </div><!-- End .home-slider -->

            <section class="container-fluid">
                <div class="section-header mt-6">
                    <h2 class="section-title">Shop By Category</h2>
                    <h3 class="section-subtitle">Browse in all our categories</h3>
                </div>

                <div class="row row-sm mb-2">
                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <div class="product-category">
                            <a href="category.html">
                                <figure>
                                    <img src="assets/images/categories/category-1.jpg">
                                </figure>
                                <div class="category-content">
                                    <h3>Sunglasses</h3>
                                    <span><mark class="count">8</mark> products</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <div class="product-category">
                            <a href="category.html">
                                <figure>
                                    <img src="assets/images/categories/category-2.jpg">
                                </figure>
                                <div class="category-content">
                                    <h3>Bags</h3>
                                    <span><mark class="count">4</mark> products</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <div class="product-category">
                            <a href="category.html">
                                <figure>
                                    <img src="assets/images/categories/category-3.jpg">
                                </figure>
                                <div class="category-content">
                                    <h3>Electronics</h3>
                                    <span><mark class="count">8</mark> products</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <div class="product-category">
                            <a href="category.html">
                                <figure>
                                    <img src="assets/images/categories/category-4.jpg">
                                </figure>
                                <div class="category-content">
                                    <h3>Fashion</h3>
                                    <span><mark class="count">11</mark> products</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <div class="product-category">
                            <a href="category.html">
                                <figure>
                                    <img src="assets/images/categories/category-5.jpg">
                                </figure>
                                <div class="category-content">
                                    <h3>Headphone</h3>
                                    <span><mark class="count">3</mark> products</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <div class="product-category">
                            <a href="category.html">
                                <figure>
                                    <img src="assets/images/categories/category-6.jpg">
                                </figure>
                                <div class="category-content">
                                    <h3>Shoes</h3>
                                    <span><mark class="count">4</mark> products</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-grey pt-3 pb-3">
                <div class="container-fluid mt-6 mb-5">
                    <div class="row row-sm">
                        <div class="col-6 col-lg-3">
                            <div class="home-banner">
                                <img src="assets/images/banners/home-banner1.jpg">
                                <div class="home-banner-content content-left-bottom">
                                    <h3>Sunglasses Sale</h3>
                                    <h4>See all and find yours</h4>
                                    <a href="category.html" class="btn" role="button">Shop By Glasses</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="home-banner">
                                <img src="assets/images/banners/home-banner2.jpg">
                                <div class="home-banner-content content-top-center">
                                    <h3>Cosmetics Trends</h3>
                                    <h4>Browse in all and find yours</h4>
                                    <a href="category.html" class="btn" role="button">Shop By Cosmetics</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="home-banner">
                                <img src="assets/images/banners/home-banner3.jpg">
                                <div class="home-banner-content content-reverse content-center">
                                    <h3>Fashion Summer Sale</h3>
                                    <h4>Browse in all our categories</h4>
                                    <a href="category.html" class="btn" role="button">Shop By Fashion</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="home-banner">
                                <img src="assets/images/banners/home-banner4.jpg">
                                <div class="home-banner-content boxed-content content-bottom-center">
                                    <div class="info-group">
                                        <h3>UP TO 70% IN ALL BAGS</h3>
                                        <h4>Starting at $99</h4>
                                    </div>
                                    <a href="category.html" class="btn" role="button">Shop By Bags</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="container-fluid">
                <div class="section-header mt-6">
                    <h2 class="section-title">Popular Products</h2>
                    <h3 class="section-subtitle">Check all our popular products</h3>
                </div>

                <div class="row row-sm mb-10">
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="product.html">
                                    <img src="assets/images/products/product-1.jpg">
                                </a>
                                <div class="label-group">
                                    <span class="product-label label-cut">27% OFF</span>
                                </div>
                                <div class="btn-icon-group">
                                    <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                </div>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="category.html" class="product-category">category</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="product.html">Product Short Name</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="old-price">$59.00</span>
                                    <span class="product-price">$49.00</span>
                                </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="product.html">
                                    <img src="assets/images/products/product-2.jpg">
                                </a>
                                <div class="label-group">
                                    <span class="product-label label-cut">27% OFF</span>
                                </div>
                                <div class="btn-icon-group">
                                    <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                </div>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="category.html" class="product-category">category</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="product.html">Product Short Name</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="old-price">$59.00</span>
                                    <span class="product-price">$49.00</span>
                                </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="product.html">
                                    <img src="assets/images/products/product-3.jpg">
                                </a>
                                <div class="label-group">
                                    <span class="product-label label-cut">27% OFF</span>
                                </div>
                                <div class="btn-icon-group">
                                    <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                </div>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="category.html" class="product-category">category</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="product.html">Product Short Name</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="old-price">$59.00</span>
                                    <span class="product-price">$49.00</span>
                                </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="product.html">
                                    <img src="assets/images/products/product-4.jpg">
                                </a>
                                <div class="label-group">
                                    <span class="product-label label-cut">27% OFF</span>
                                </div>
                                <div class="btn-icon-group">
                                    <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                </div>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="category.html" class="product-category">category</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="product.html">Product Short Name</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="old-price">$59.00</span>
                                    <span class="product-price">$49.00</span>
                                </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="product.html">
                                    <img src="assets/images/products/product-5.jpg">
                                </a>
                                <div class="label-group">
                                    <span class="product-label label-cut">27% OFF</span>
                                </div>
                                <div class="btn-icon-group">
                                    <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                </div>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="category.html" class="product-category">category</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="product.html">Product Short Name</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="old-price">$59.00</span>
                                    <span class="product-price">$49.00</span>
                                </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="product.html">
                                    <img src="assets/images/products/product-6.jpg">
                                </a>
                                <div class="label-group">
                                    <span class="product-label label-cut">27% OFF</span>
                                </div>
                                <div class="btn-icon-group">
                                    <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                </div>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="category.html" class="product-category">category</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="product.html">Product Short Name</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="old-price">$59.00</span>
                                    <span class="product-price">$49.00</span>
                                </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="product.html">
                                    <img src="assets/images/products/product-7.jpg">
                                </a>
                                <div class="label-group">
                                    <span class="product-label label-cut">27% OFF</span>
                                </div>
                                <div class="btn-icon-group">
                                    <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                </div>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="category.html" class="product-category">category</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="product.html">Product Short Name</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="old-price">$59.00</span>
                                    <span class="product-price">$49.00</span>
                                </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="product.html">
                                    <img src="assets/images/products/product-8.jpg">
                                </a>
                                <div class="label-group">
                                    <span class="product-label label-cut">27% OFF</span>
                                </div>
                                <div class="btn-icon-group">
                                    <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                </div>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="category.html" class="product-category">category</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="product.html">Product Short Name</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="old-price">$59.00</span>
                                    <span class="product-price">$49.00</span>
                                </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="product.html">
                                    <img src="assets/images/products/product-9.jpg">
                                </a>
                                <div class="label-group">
                                    <span class="product-label label-cut">27% OFF</span>
                                </div>
                                <div class="btn-icon-group">
                                    <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                </div>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="category.html" class="product-category">category</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="product.html">Product Short Name</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="old-price">$59.00</span>
                                    <span class="product-price">$49.00</span>
                                </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="product.html">
                                    <img src="assets/images/products/product-10.jpg">
                                </a>
                                <div class="label-group">
                                    <span class="product-label label-cut">27% OFF</span>
                                </div>
                                <div class="btn-icon-group">
                                    <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                </div>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="category.html" class="product-category">category</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="product.html">Product Short Name</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="old-price">$59.00</span>
                                    <span class="product-price">$49.00</span>
                                </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="product.html">
                                    <img src="assets/images/products/product-11.jpg">
                                </a>
                                <div class="label-group">
                                    <span class="product-label label-cut">27% OFF</span>
                                </div>
                                <div class="btn-icon-group">
                                    <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                </div>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="category.html" class="product-category">category</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="product.html">Product Short Name</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="old-price">$59.00</span>
                                    <span class="product-price">$49.00</span>
                                </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="product-default inner-quickview inner-icon">
                            <figure>
                                <a href="product.html">
                                    <img src="assets/images/products/product-12.jpg">
                                </a>
                                <div class="label-group">
                                    <span class="product-label label-cut">27% OFF</span>
                                </div>
                                <div class="btn-icon-group">
                                    <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i></button>
                                </div>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="category.html" class="product-category">category</a>
                                    </div>
                                </div>
                                <h2 class="product-title">
                                    <a href="product.html">Product Short Name</a>
                                </h2>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->
                                <div class="price-box">
                                    <span class="old-price">$59.00</span>
                                    <span class="product-price">$49.00</span>
                                </div><!-- End .price-box -->
                            </div><!-- End .product-details -->
                        </div>
                    </div>
                </div>
            </section>
        </main><!-- End .main -->

        <footer>
            <div class="footer-top">
                <div class="container-fluid">
                    <div class="footer-left widget-newsletter">
                        <div class="widget-newsletter-info">
                            <a href="#" class="widget-newsletter-title">subscribe newsletter</a>
                            <p class="widget-newsletter-content">Get all the latest information on Events, Sales and Offers.</p>
                        </div>
                        <form action="#">
                            <div class="footer-submit-wrapper">
                                <input type="email" class="form-control" placeholder="Email address..." required>
                                <button type="submit" class="btn">Subscribe</button>
                            </div>
                        </form>
                    </div>
                    <div class="footer-right">
                        <div class="social-icons">
                            <a href="#" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </div><!-- End .social-icons -->
                    </div>
                </div>
            </div>
            <div class="footer-middle">
                    <div class="container-fluid">
                    <div class="row row-sm">
                        <div class="col-lg-6">
                            <div class="widget">
                                <h4 class="widget-title">Contact Info</h4>

                                <div class="row row-sm">
                                    <div class="col-sm-6">
                                        <div class="contact-widget">
                                            <h4 class="widget-title">ADDRESS</h4>
                                            <a href="#">123 Street Name, City, England</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="contact-widget email">
                                            <h4 class="widget-title">EMAIL</h4>
                                            <a href="mailto:mail@example.com">mail@example.com</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="contact-widget">
                                            <h4 class="widget-title">PHONE</h4>
                                            <a href="#">Toll Free (123) 456-7890</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="contact-widget">
                                            <h4 class="widget-title">WORKING DAYS/HOURS</h4>
                                            <a href="#">Mon - Sun / 9:00AM - 8:00PM</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4>
                                <ul class="links link-parts">
                                    <div class="link-part">
                                        <li><a href="about.html">About us</a></li>
                                        <li><a href="contact.html">Contact us</a></li>
                                        <li><a href="my-account.html">My account</a></li>
                                    </div>
                                    <div class="link-part">
                                        <li><a href="#">Orders History</a></li>
                                        <li><a href="#">Advanced Search</a></li>
                                        <li><a href="login.html">Login</a></li>
                                    </div>
                                </ul>
                            </div><!-- End .widget -->
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">Main Features</h4>
                                <ul class="links link-parts">
                                    <div class="link-part">    
                                        <li><a href="#">Super Fast Magento Theme</a></li>
                                        <li><a href="#">1st Fully working Ajax Theme</a></li>
                                        <li><a href="#">10 Unique Homepage Layouts</a></li>
                                    </div>
                                    <div class="link-part">
                                        <li><a href="#">Powerful Admin Panel</a></li>
                                        <li><a href="#">Mobile & Retina Optimized</a></li>
                                    </div>
                                </ul>
                            </div><!-- End .widget -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container-fluid">
                    <p class="footer-copyright">Porto eCommerce. &copy;  2019.  All Rights Reserved</p>
                    <img src="assets/images/payments.png" alt="payment image">
                </div>
            </div>
        </footer>
    </div><!-- End .page-wrapper -->

    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-retweet"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="active"><a href="index.html">Home</a></li>
                    <li>
                        <a href="category.html">Categories</a>
                        <ul>
                            <li><a href="category.html">Full Width Banner</a></li>
                            <li><a href="category-banner-boxed-slider.html">Boxed Slider Banner</a></li>
                            <li><a href="category-banner-boxed-image.html">Boxed Image Banner</a></li>
                            <li><a href="category.html">Left Sidebar</a></li>
                            <li><a href="category-sidebar-right.html">Right Sidebar</a></li>
                            <li><a href="category-flex-grid.html">Product Flex Grid</a></li>
                            <li><a href="category-horizontal-filter1.html">Horizontal Filter 1</a></li>
                            <li><a href="category-horizontal-filter2.html">Horizontal Filter 2</a></li>
                            <li><a href="#">Product List Item Types</a></li>
                            <li><a href="category-infinite-scroll.html">Ajax Infinite Scroll</a></li>
                            <li><a href="category-3col.html">3 Columns Products</a></li>
                            <li><a href="category.html">4 Columns Products</a></li>
                            <li><a href="category-5col.html">5 Columns Products</a></li>
                            <li><a href="category-6col.html">6 Columns Products</a></li>
                            <li><a href="category-7col.html">7 Columns Products</a></li>
                            <li><a href="category-8col.html">8 Columns Products</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="product.html">Products</a>
                        <ul>
                            <li>
                                <a href="#">Variations</a>
                                <ul>
                                    <li><a href="product.html">Horizontal Thumbnails</a></li>
                                    <li><a href="product-full-width.html">Vertical Thumbnails</a></li>
                                    <li><a href="product.html">Inner Zoom</a></li>
                                    <li><a href="product-addcart-sticky.html">Addtocart Sticky</a></li>
                                    <li><a href="product-sidebar-left.html">Accordion Tabs</a></li>
                                    <li><a href="product-sticky-tab.html">Sticky Tabs</a></li>
                                    <li><a href="product-simple.html">Simple Product</a></li>
                                    <li><a href="product-sidebar-left.html">With Left Sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Product Layout Types</a>
                                <ul>
                                    <li><a href="product.html">Default Layout</a></li>
                                    <li><a href="product-extended-layout.html">Extended Layout</a></li>
                                    <li><a href="product-full-width.html">Full Width Layout</a></li>
                                    <li><a href="product-grid-layout.html">Grid Images Layout</a></li>
                                    <li><a href="product-sticky-both.html">Sticky Both Side Info</a></li>
                                    <li><a href="product-sticky-info.html">Sticky Right Side Info</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Pages</a>
                        <ul>
                            <li><a href="cart.html">Shopping Cart</a></li>
                            <li>
                                <a href="#">Checkout</a>
                                <ul>
                                    <li><a href="checkout-shipping.html">Checkout Shipping</a></li>
                                    <li><a href="checkout-shipping-2.html">Checkout Shipping 2</a></li>
                                    <li><a href="checkout-review.html">Checkout Review</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Dashboard</a>
                                <ul>
                                    <li><a href="dashboard.html">Dashboard</a></li>
                                    <li><a href="my-account.html">My Account</a></li>
                                </ul>
                            </li>
                            <li><a href="about.html">About Us</a></li>
                            <li>
                                <a href="#">Blog</a>
                                <ul>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="single.html">Blog Post</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact Us</a></li>
                            <li><a href="#" class="login-link">Login</a></li>
                            <li><a href="forgot-password.html">Forgot Password</a></li>
                        </ul>
                    </li>
                    <li><a href="https://1.envato.market/DdLk5" target="_blank">Buy Porto!</a></li>
                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
                <a href="#" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank"><i class="icon-instagram"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <div class="newsletter-popup mfp-hide" id="" style="background-image: url(assets/images/newsletter_popup_bg.jpg)">
        <div class="newsletter-popup-content">
            <img src="assets/images/logo-black.png" alt="Logo" class="logo-newsletter">
            <h2>BE THE FIRST TO KNOW</h2>
            <p>Subscribe to the Porto eCommerce newsletter to receive timely updates from your favorite products.</p>
            <form action="#">
                <div class="input-group">
                    <input type="email" class="form-control" id="newsletter-email" name="newsletter-email" placeholder="Email address" required>
                    <input type="submit" class="btn" value="Go!">
                </div><!-- End .from-group -->
            </form>
            <div class="newsletter-subscribe">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="1">
                        Don't show this popup again
                    </label>
                </div>
            </div>
        </div><!-- End .newsletter-popup-content -->
    </div><!-- End .newsletter-popup -->
    
    <!-- Add Cart Modal -->
    <div class="modal fade" id="addCartModal" tabindex="-1" role="dialog" aria-labelledby="addCartModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body add-cart-box text-center">
            <p>You've just added this product to the<br>cart:</p>
            <h4 id="productTitle"></h4>
            <img src="" id="productImage" width="100" height="100" alt="adding cart image">
            <div class="btn-actions">
                <a href="cart.html"><button class="btn-primary">Go to cart page</button></a>
                <a href="#"><button class="btn-primary" data-dismiss="modal">Continue</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>


    <!-- Plugins JS File -->
    <script src="{{ asset('portal/js/jquery.min.js') }}"></script>
    <script src="{{ asset('portal/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('portal/js/plugins.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('portal/js/main.min.js') }}"></script>
</body>
</html>