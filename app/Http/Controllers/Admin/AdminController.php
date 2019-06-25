<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AdminController extends Controller
{
   public function admin_add(){
   	 return view('admin/admin_add');
   }
   public function admin_do(Request $request){
   		$data=request()->except('_token');
   		$path =$request->file('goods_img')->store('goods');
    	// dd($path);   //goods/2V7qi6xyiIlawy3rJEig3FZmmCqdYu5kxa21ajNz.jpeg
    	$path='/storage/'.$path;
    	// dd($path);
    	$time=time();
    	// dd($time);
    	$input=DB::table('goods')->insert(['goods_name'=>$data['goods_name'],'goods_num'=>$data['goods_num'],'goods_price'=>$data['goods_price'],'goods_img'=>$path,'create_time'=>$time]);
    	// dd($input);
    	if($input){
    		return redirect('admin_lists');
    	}else{
    		return redirect('/admin_add');
    	}
   }
   public function admin_lists(Request $request){
      $post=request()->all();
      // dd($post);
      unset($post['_token']);
      if(isset($post['goods_name'])){
        $data=DB::table('goods')->where('goods_name','like','%'.$post['goods_name'].'%')->orderBy('create_time','desc')->paginate(3);
      }else{
        $data=DB::table("goods")->paginate(3);
      }
   		
   		// dd($data);
   		return view('admin/admin_lists')->with('data',$data);
   }
   public function admin_del(Request $request,$id){
   		// echo $id;die;
   		$data=DB::table("goods")->where('id',$id)->delete();
   		// dd($data);
   		if($data){
   			return redirect('/admin_lists');
   		}else{
   			return redirect('/admin_add');
   		}
   }
   public function admin_upd(Request $request,$id){
   		// echo $id;die;
   		$post=DB::table("goods")->where('id',$id)->first();
   		// dd($post);
   		return view("admin/admin_upd")->with('post',$post);
   }
   public function adminUpd_do(Request $request){
   		$data=request()->all();
   		$id=$data['id'];
   		// dd($id);
   		unset($data['_token']);
   		// dd($data);
   		if($request->file('goods_img')){
   			$path = $request->file('goods_img')->store('goods');
	   		$path= asset('storage/'.$path);
	   		$data['goods_img']=$path;
	   		$post=DB::table("goods")->where('id',$data['id'])->update($data);
   		}else{
   			$post=DB::table("goods")->where('id',$data['id'])->update($data);
   		}
   		// dd($post);
   		if($post){
   			return redirect('admin_lists');
   		}else{
   			return redirect('admin_upd');
   		}
   }
   public function stu_add(){
    return view('admin/stu_add');
   }
   public function stu_do(Request $request){
      $data=request()->all();
      // dd($data);
      unset($data['_token']);
      $post=DB::table("student")->insert($data);
      // dd($post);
      if($post){
        return redirect('stu_list');
      }else{
        return redirect('stu_add');
      }
  }
   public function stu_list(Request $request){
    $post=request()->get('name');
    // dd($post['name']);
    // $name=$post?$post:'';
    $name="";
   if($post){
    $data=DB::table('student')->where('name','like','%'.$name.'%')->paginate(2);
    // dd($data);
  }else{
     $data=DB::table('student')->paginate(2);
  }
    
    return view('admin/stu_list')->with('data',$data);
  }
  public function stu_del(Request $request){
    $id=request()->input('id');
    // dd($id);
    $data=DB::table("student")->where('id',$id)->delete();
    // dd($data);
    if($data){
      return redirect('stu_list');
    }else{
      return redirect('/');
    }
  }
  public function stu_upd(Request $request){
    $id=request()->input('id');
    $data=DB::table("student")->where('id',$id)->first();
       // dd($data);
    return view('admin/stu_upd')->with('data',$data);
  }
  public function upd_do(Request $request){
    $data=request()->all();
    unset($data['_token']);
    $id=$data['id'];
    // dd($id);
    $post=DB::table("student")->where('id',$id)->update($data);
    // dd($post);
    if($post){
      return redirect('stu_list');
    }else{
      return redirect('stu_add');
    }
  }
}