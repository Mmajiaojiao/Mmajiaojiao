<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function add(){
    	return view('admin/add');
    }
    public function add_do(Request $request){ 
    	                                     //文件夹
    	$path = $request->file('file_name')->store('goods');
    	// dd($path);   goods/2V7qi6xyiIlawy3rJEig3FZmmCqdYu5kxa21ajNz.jpeg
    	echo asset('storage/'.$path);
    	// http://w3.myblog.cn/storage/goods/tFgCvSANtwopzskQRFcEd9BPdC2WHEGH5iLPp6YF.jpeg
    }
}
