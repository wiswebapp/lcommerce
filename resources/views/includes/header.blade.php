<div class="py-1 bg-primary">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                        <span class="text">+ 1235 2355 98</span>
                    </div>
                    <div class="col-md pr-3 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                        <span class="text">youremail@email.com</span>
                    </div>
                    <div class="col-md-4 pr-4 d-flex topper align-items-center text-lg-right">
                        <span class="text">3-5 Days Delivery and Free Returns</span>
                    </div>
                    <div class="col-md-2 pr-4 d-flex topper align-items-center text-lg-right">
                        <span class="text">
                            @guest
                            <a class="text" href="/login">Login</a> Or <a class="text" href="/register">Register</a>
                            @else
                            <span class="text">Hello {{ Auth::user()->fname }}</span>
                            @endguest
                        </span>
                    </div>
                    @guest
                    @else
                    <div class="col-md-2 pr-4 d-flex topper align-items-center text-lg-right">
                        <a class="text" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
    <a class="navbar-brand" href="index.html">Vegefoods</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
    </button>

    <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
        <li class="nav-item active dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
        <div class="dropdown-menu" aria-labelledby="dropdown04">
            <a class="dropdown-item" href="shop.html">Shop</a>
            <a class="dropdown-item" href="wishlist.html">Wishlist</a>
            <a class="dropdown-item" href="product-single.html">Single Product</a>
            <a class="dropdown-item" href="cart.html">Cart</a>
            <a class="dropdown-item" href="checkout.html">Checkout</a>
        </div>
        </li>
        <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
        <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
        <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
        <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>

        </ul>
    </div>
    </div>
</nav>