<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js','resources/scss/index.scss','resources/scss/Pages/homePage.scss'])
    @inertiaHead
</head>
<body class="font-sans antialiased">
<nav>
    <div class="nav-buttons">
        @guest
            <a href="  {{ route('register')  }} ">Register</a>
            <a href="  {{ route('login')  }} ">Log In</a>
        @endguest
        @auth
            <a href="{{ route('dashboard') }}">Username</a>
        @endauth
    </div>
</nav>
<div class="bottom-nav">
    <h1>Site Name</h1>
</div>
<div class="banner-display mb-[50px]">
    <img src="/storage/systemImages/banner.jpg" alt="">
</div>

<div class="content-display">
    @php



        $query_param =app('request')->input('search');

        $query_param = str_replace('-', ' ',  $query_param);

    if (isset($query_param) && $query_param != null) {
        $products = \App\Models\Product::where('title','like',"%${query_param}%")->orWhere('description','like',"%${query_param}%")->get();
    } else {
        $products = \App\Models\Product::all();
    }
    @endphp

    @if(count($products) > 0)
        @foreach( $products as $product )
            <a href="{{route('getProductPage',[$product->id])}}" class="product-card">
                <div class="product-image p-[10px]" style="overflow: hidden">
                    <img
                        src="{{ isset($product->file) ? "/storage/ProductImages/".$product->file : "/storage/systemImages/default_product_image.png"  }}"
                        alt="laptop">
                </div>
                <h4>{{ $product->title  }}</h4>
                <p>{{ $product->description  }} </p>
                <div class="action-box">
                    <button>Buy</button>
                    <p>Ksh {{ $product->price  }}</p>
                </div>
            </a>
        @endforeach
    @endif

</div>
</body>
</html>
