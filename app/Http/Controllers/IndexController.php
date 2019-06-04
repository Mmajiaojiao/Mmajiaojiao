<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        echo "欢迎来到laravel学院";
        return view('welcome');
    }
    public function admin(){
        echo "goods";
        return view('welcome');
    }


}
