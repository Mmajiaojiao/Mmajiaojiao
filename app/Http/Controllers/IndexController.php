<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
class IndexController extends Controller
{
    public function index(){    
        // dd($data);
        // $redis=new \Redis();
    	// $redis->connect('127.0.0.1','6379');
    	
    	// $redis->incr('num');
    	// $post=$redis->get('num');
    	// echo $post;
    	
        return view('welcome');

    }
    public function productList(Request $request){
    	$post=request()->all();
    	unset($post['_token']);
    	// dd($post);
    	if(isset($post['goods_name'])){
    		$data=DB::table("goods")->where('goods_name','like','%'.$post['goods_name'].'%')->paginate(2);
    	}else{
    		$data=DB::table('goods')->paginate(2);
    	}
    	return view('index/productList')->with('data',$data);
    }

    //购物车
    public function cart(Request $request){
    	$goods=DB::table("cart")->where('uid',session('id'))->get();
    	// dd($goods);
        // dd($goods['id']); 
    	return view('index/cart')->with('goods',$goods);
    }
    public function shopSingle(Request $request){
    	
    	$id=request()->input('id');
    	// echo $id;die();
    	$data=DB::table("goods")->where('id',$id)->first();
    	// dd($data);
    	// dd($data->goods_price);
    	return view('index/shopSingle')->with('data',$data);
    }
    public function shop(Request $request){
        $id=session('id');
        // dd($id);/
        $all=request()->all();
        // dd($all);
        $num=$all['num'];
        // dd($num);
       $goods_id=request()->input('id');
       // dd($goods_id);
       $data=DB::table("goods")->where('id',$goods_id)->first();
       // dd($data);
       $where=[
            ['uid','=',$id],
            ['goods_id','=',$goods_id]
       ];
       $sel=DB::table("cart")->where($where)->first();
       // dd($sel);
       if($sel){
            $post=DB::table("cart")->where($where)->update(['num'=>$sel->num+$all['num']]);
            // dd($post);
       }else{
            $post=DB::table("cart")->insert(['uid'=>$id,'goods_name'=>$data->goods_name,'goods_img'=>$data->goods_img,'num'=>$data->num,'goods_id'=>$data->id,'add_time'=>time(),'goods_price'=>$data->goods_price]);
        // dd($post);
       }
        
        if($post){
            return redirect('cart');
        }
    }
    //结帐
    public function checkout(Request $request){
    	 $uid=session('id');
    	// dd($uid);
    	$oid=request()->input('oid');
    	// dd($oid);
    	$cart=DB::table("cart")->where('uid',$uid)->get()->toArray();
        // dd($cart);
         $num=0; 
        foreach($cart as $k=>$val){
            $num= $num+$val->num;
        }
         $pay_money=0; 
        foreach($cart as $k=>$val){
            $pay_money= $pay_money+$val->goods_price;
        }
    	return view('index/checkout')->with(['cart'=>$cart,'num'=>$pay_money,'oid'=>$oid,'uid'=>$uid]);
    }
    public function checkDo(Request $request){
        $uid=session('id');
        $num=0; 
         $cart=DB::table("cart")->where('uid',$uid)->get()->toArray();
        foreach($cart as $k=>$val){
            $num= $num+$val->num;
        }
        $pay_money=0; 
       
        foreach($cart as $k=>$val){
            $pay_money= $pay_money+$val->goods_price;
        }
        // dd($pay_money);
        $oid=time().mt_rand(1111,9999);
        // dd($cart);
        $add_time=time();
        $where=[
            ['uid','=',$uid]
        ];
        $order=DB::table("order")->where($where)->insert(['oid'=>$oid,'uid'=>$uid,'pay_money'=>$pay_money,'add_time'=>$add_time]);
        // dd($order);
        if($order){
            return redirect("checkout?oid=$oid") ;
        }else{
            echo "<script>window.location.href='javaScript:;',alert('提交订单失败')</script>";
        }
    }
    //订单列表
    public function checkList(Request $request){
        $uid=session('id');
       
        $data=DB::table("order")->where('uid',$uid)->get();
        // dd($data);
       
        return view('index/checkList')->with('data',$data);
       
    }
    public function register(Request $request){
    	return view('index/register');
    }
    public function register_do(Request $request){
    	$data=request()->all();
    	// dd($data);
    	unset($data['_token']);
    	$data['pwd']=md5($data['pwd']);
    	// dd($data);
    	$post=DB::table("register")->insert($data);
    	if($post){
    		return redirect('login');
    	}else{
    		return redirect('register');
    	}
    }
    public function settings(Request $request){
    	return view('index/settings');
    }
    public function aboutus(Request $request){
    	return view('index/aboutus');
    }
    public function contact(Request $request){
    	return view('index/contact');
    }
    public function wishlist(Request $request){
    	return view('index/wishlist');
    }
    //登录
    public function login(Request $request){
    	return view('index/login');
    }
    public function login_do(Request $request){
    	$post=request()->all();
    	unset($post['_token']);
    	$post['pwd']=md5($post['pwd']);
    	// dd($post);
    	
    	$data=DB::table("register")->where('name',$post['name'])->first();
    	// dd($data);
    	if($post['name']==$data->name&&$post['pwd']==$data->pwd){
    		session(['name'=>$data->name,'id'=>$data->id]);
            session('name');
           
    		return redirect('/productList');
    	}else{
    		return redirect('/login');
    	}

    }
    public function admin(){
        echo "goods";
        return view('welcome');
    }


}
