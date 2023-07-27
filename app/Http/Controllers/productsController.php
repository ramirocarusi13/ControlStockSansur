<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class productsController extends Controller
{
    public function view(){
        return view('home.products.products');
    }
}