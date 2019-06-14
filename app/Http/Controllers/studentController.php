<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class studentController extends Controller
{
    public function student_add(){
    	return view('/student/student_add');
    }
    public function add_do(Request $request){
    	$post =request()-> all();
    	unset($post['_token']);
    	// dd($post);
    	$res=DB::table("student")->insert($post);
    	// dd($res);
    	if($res){
    		return redirect('/student/student_lists');
    	}else{
    		return redirect('/student/student_add');
    	}
    }
    public function student_lists(Request $request){
        $redis=new \Redis();
        // dd($redis);
        $redis->connect('127.0.0.1','6379');
        $redis->incr('num');
        $num=$redis->get('num');
        echo $num;
        $name=request()->all();
        if(isset($name['name'])){
            $post=DB::table('student')->where('name','like','%'.$name['name'].'%')->paginate(2);
        }else{
            $post=DB::table('student')->paginate(2);
        }
    	
    	return view('/student/student_lists')->with('post',$post);
    }
    public function del(Request $request){
    	// echo $id;die;
    	$id=$_GET['id'];

    	$where=[
    		'id'=>$id
    	];
    	// print_r($id);die;
    	$data=DB::table('student')->where($where)->delete();
    	// $data=DB::table('student')->where($where)->update(['status'=>2]);
    	// print_r($data);die;
    	if($data){
    		return redirect('/student/student_lists');
    	}else{
    		return redirect('/student/student_add');
    	}
    }
    public function update(Request $request){
    	$id=$_GET['id'];
    	// echo $id;die;
    	$data=DB::table("student")->where('id',$id)->first();
    	// dd($data);
    	return view('/student/update',['datas'=>$data]);
    }
    public function update_do(Request $request){
    	$id=$_POST['id'];
    	// dd($id);
    	// echo $id;die;
    	$post=request()->all();
    	unset($post['_token']);
    	// dd($post);
    	$data=DB::table("student")->where('id',$id)->update($post);
    	// dd($data);
    	if($data){
    		return redirect('/student/student_lists');
    	}else{
    		return redirect('/student/student_add');
    	}
    }
}
