<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourismController extends Controller
{
    public function index(){

        return view('tourism.map');
    }

    public function places(){

        return view('tourism.places');
    }
}
