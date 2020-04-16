<header class="header">
    <div class="header-middle sticky-header">
        <div class="container-fluid">
            <div class="header-left">
                <button class="mobile-menu-toggler" type="button">
                    <i class="icon-menu"></i>
                </button>
                <a href="{{ route('front.home') }}" class="logo">
                    @if(isset($logo))
                        <img src="{{$logo}}" alt="Porto Logo">
                    @else
                        <img src="{{ asset('public/portal/images/logo.png') }}" alt="Porto Logo">
                    @endif                    
                </a>

                <nav class="main-nav">
                    <ul class="menu">
                        <li class="active"><a href="{{ route('front.home') }}">Inicio</a></li>
       
                            @if(isset($categorias))
                                <li>
                                    <a href="category.html">Categorías</a>
                                    <div class="megamenu">
                                        <div class="row row-sm">
                                            <div class="col-lg-8">
                                                <ul class="submenu">
                                                    @foreach ($categorias as $cat)
                                                        <li><a href="categorias/{{ $cat->sname }}">{{ $cat->sname }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <div class="col-lg-4 image-container">
                                                <img src="{{ asset('public/portal/images/menu-banner-2.jpg') }}" align="Menu banner">
                                            </div>

                                        </div>    
                                    </div><!-- End .megamenu -->    

                                </li>
                            @endif

                    


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
                                        <img src="{{ asset('public/portal/images/menu-bg.png') }}" alt="Menu banner" class="product-promo">
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
                                            <img src="{{ asset('public/portal/images/products/cart/product-1.jpg') }}" alt="product">
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
                                            <img src="{{ asset('public/portal/images/products/cart/product-2.jpg') }}" alt="product">
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