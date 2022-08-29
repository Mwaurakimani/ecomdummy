<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
{{--    @routes--}}
    @vite(['resources/js/app.js','resources/scss/index.scss','resources/scss/Pages/productPage.scss'])
{{--    @inertiaHead--}}
</head>
<body class="font-sans antialiased">
<nav>
    <a href="/"> Home</a>
    <div class="nav-buttons">
        <a href="{{ route('dashboard') }}">Username</a>
        <a href="  {{ route('login')  }} ">Log In</a>
    </div>
</nav>
<div class="bottom-nav">
    <h1>Site</h1>
</div>

<div class="product-section-display">
    <div class="image-section">
        <div class="cropper" style="overflow: hidden">
            <img src="{{ isset($product->file) ? "/storage/ProductImages/".$product->file : "/storage/systemImages/default_product_image.png"  }}" alt="">
        </div>
    </div>
    <div class="details-section">
        <h1 class="title" >{{ $product->title  }}</h1>
        <p class="description">{{ $product->description  }}</p>
        <div class="stock-content">
            <h3>Stock Quantity :</h3>
            <p>{{ $product->stock  }}</p>
        </div>
        <button>Add to Cart</button>
    </div>
    <div class="price-display">
        <p style="width: 100%;margin-left: 20px;margin-top: 20px">Ksh {{ $product->price  }}</p>
    </div>
</div>

</body>
</html>
