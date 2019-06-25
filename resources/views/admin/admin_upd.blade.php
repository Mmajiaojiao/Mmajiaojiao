@extends('layouts.common')

@section('title', '商品添加')

@section('sidebar')
  	<form class="layui-form" action="/adminUpd_do" method="post" enctype="multipart/form-data">
  	@csrf
  	<input type="hidden" name="id" value="{{$post->id}}">
  <div class="layui-form-item">
    <label class="layui-form-label">商品名称</label>
    <div class="layui-input-inline">
      <input type="text" name="goods_name" value="{{$post->goods_name}}" placeholder="请输入商品名称" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">商品库存</label>
    <div class="layui-input-inline">
      <input type="text" name="goods_num" value="{{$post->goods_num}}" placeholder="请输入商品库存" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">商品链接</label>
   <input type="file" name="goods_img"><img width="50px" height="50px" src="{{$post->goods_img}}">
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">商品价格</label>
    <div class="layui-input-inline">
      <input type="text" name="goods_price" value="{{$post->goods_price}}" placeholder="请输入商品价格" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>

@endsection

    	

