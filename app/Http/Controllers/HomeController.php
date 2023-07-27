<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    //
    public function view() {

        return view('home.home');
    }

    public function view_ss() {

        return view('home.home_ss');
    }
    public function view_kitchen() {

        return view('home.discountKitchen.form_kitchen');
    }

}
