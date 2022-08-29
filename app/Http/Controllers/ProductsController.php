<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $product = new Product();

        $product->title = $request['title'];
        $product->description = $request['description'];
        $product->stock = $request['stock'];
        $product->price = $request['price'];

        $product->save();

        if($product->id && $request['file']){
            $feedback = $this->upload_file($product->id,$request['file'],Storage::disk('ProductImages'));

            $product->file = $feedback;

            $product->save();
        }

        return redirect('/dashboard');
    }

    public function update(Request $request,Product $Product)
    {
        $Product->title = $request['title'];
        $Product->description = $request['description'];
        $Product->stock = $request['stock'];
        $Product->price = $request['price'];

        $Product->save();

        if($Product->id && $request['file']){
            $feedback = $this->upload_file($Product->id,$request['file'],Storage::disk('ProductImages'));

            $Product->file = $feedback;

            $Product->save();
        }

        return redirect('/dashboard');
    }

    public function upload_file($id,$file,$directory)
    {
        $path = storage_path("app");

        $name = $this->generateRandomString(5);

        $file_path = $directory->put('/',$file);

        return $file_path;
    }

    public function generateRandomString($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
