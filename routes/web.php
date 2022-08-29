<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (\Illuminate\Http\Request $request) {

    return Inertia::render('Welcome', [
//        'products' => $products,
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $products = \App\Models\Product::all();

        return Inertia::render('Dashboard', [
            'products' => $products
        ]);
    })->name('dashboard');

    Route::get('/products/create', function () {
        return Inertia::render('Dashboard/ProductForm');
    })->name('create_products');

    Route::get('/products/{Product}', function (\App\Models\Product $Product) {

        $prod = $Product;

        return Inertia::render('Dashboard/ProductForm', [
            'product' => $prod,
            'test' => 'test'
        ]);
    })->name('view_product');

    Route::post('/products', [ProductsController::class, 'index'])->name('post_product');

    Route::post('/products/{Product}', [ProductsController::class, 'update'])->name('put_product');
});


Route::get('/getproduct/{Products}', function (\Illuminate\Http\Request $request, $Product) {

    $product = \App\Models\Product::find((int)$Product);

    return view('product')->with('product', $product);
})->name('getProductPage');



