<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = [
            'Italiano',
            'Indiano',
            'Giapponese',
            'Libanese',
            'Americano',
            'Thailandese',
            'Pizza',
            'Sardo',
            'Sushi'
        ];
        return view('welcome',compact('categories'));
    }
}
