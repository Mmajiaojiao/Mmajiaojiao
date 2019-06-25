<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redis;
class LoginController extends Controller
{
    public function register(Request $request){
    	return view('/reglog/register');
    	$data = request()->all();
    	// dd($data);
    	unset($data['_token']);
    	$data['pwd'] = md5($data['pwd']);
    	// dd($data);
    	$res=DB::table("register")->insert($data);
    	// dd($res);
    	if($res){
    		return view('/reglog/login');
    	}else{
    	    return view('/reglog/register');	
    	}

    }
    public function login(Request $request){

    	return view('/reglog/login');
    }
   public function login_do(Request $request){
   		
   		$post=request()->all();
   		$post['pwd']=md5($post['pwd']);
    	unset($post['_token']);
    	$data=DB::table("register")->where('name','=',$post['name'])->first();
    	// dd($data);
    	if(empty($data)){
    		echo "<script>window.location.href='/reglog/register',alert('无此账号,请去账户页面')</script>";
    	}
    	// $uid=$data->id;

    	// $key="loginName$uid";
    	// $aa=Redis::get($key);
    	// dd($aa);
    	// 字符串转为数组
    	// $bb=json_decode($aa,true);
    	
    	// if(Redis::get($key)&&$bb['name']==$post['name']&&$bb['pwd']==$post['pwd']){
    	// 	echo "<script>alert('登录成功')</script>";
		   //  echo "<script>window.location.href='/'</script>";
    	// }else{
    	// 	  // dd($post);
		   //      if($data){
		   //      	//用户名正确情况下
		   //      	//密码正确
		   //      	if($post['pwd']==$data->pwd){
		   //      		$info = [
		   //      			'name'=>$data->name,
		   //      			'pwd' =>$data->pwd
		   //      		];
		   //      		$arr=json_encode($info);
		        		
		   //      		     //存
		   //    			Redis::set($key,$arr);
		   //    			//取
		   //    			// dd(Redis::get($key));die();

		   //      		echo "<script>alert('登录成功')</script>";
		   //      		echo "<script>window.location.href='/'</script>";
		   //      	}else{
		   //      		//密码不正确
		   //      		echo "<script>alert('密码不正确')</script>";
		   //      		echo "<script>window.location.href='/reglog/login'</script>";
		   //      	}
		   //      }else{
		   //      	return view("/reglog/login");
		   //      	die;
		   //      	}
		   //  	}
           

           // $redis=new \Redis();
           //  // dd($redis);
           //  $redis->connect('127.0.0.1','6379');
           //  $redis->incr('num');
           //  $num=$redis->get('num');
           //  echo $num;
              
            if($data){
                 //用户名正确情况下
                 //密码正确
                 if($post['pwd']==$data->pwd){
                     $info = [
                         'name'=>$data->name,
                         'pwd' =>$data->pwd
                     ];
                     $arr=json_encode($info);
                        
                     //存
                         session(['key'=>$data->name]);
                         // dd($data->name);
                         //取
                         // dd(session('key'));

                     echo "<script>alert('登录成功')</script>";
                     echo "<script>window.location.href='/'</script>";
                 }else{
                     //密码不正确
                     echo "<script>alert('密码不正确')</script>";
                     echo "<script>window.location.href='/reglog/login'</script>";
                 }
      
        
            }
        }
    public function quit(Request $request){
        $data=$request->session()->forget('key');
        // dd($data);
        return redirect('/reglog/login');
        
    } 
}
