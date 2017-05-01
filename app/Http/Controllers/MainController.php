<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;

class MainController extends Controller
{
    //
    public function index()
    {

        $products = Product::paginate(9);
        return view('main.index',['products' => $products]);

    }
}
