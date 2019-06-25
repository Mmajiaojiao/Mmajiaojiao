@extends('layouts.common')

@section('title', '商品添加')

@section('sidebar')

<table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>Id</th>
      <th>商品名称</th>
      <th>商品图片</th>
      <th>商品数量</th>
      <th>商品价格</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
  	@foreach($data as $v)
    <tr>
      <td>{{$v->id}}</td>
      <td>{{$v->goods_name}}</td>
      <td><img src="{{asset($v->goods_img)}}"></td>
      <td>{{$v->goods_num}}</td>
      <td>{{$v->goods_price}}</td>
      <td><a href="admin_del/{{$v->id}}">删除</a>|<a href="admin_upd/{{$v->id}}">修改</a></td>
    </tr>
    @endforeach
    {{ $data->links() }}
  </tbody>
</table>
<form class="layui-form" action="" method="get">
  @csrf
  <div class="layui-form-item">
    <label class="layui-form-label">商品名称</label>
    <div class="layui-input-inline">
      <input type="text" name="goods_name"placeholder="请搜索商品名称" autocomplete="off" class="layui-input">
    </div>
    <button class="layui-btn" lay-submit lay-filter="formDemo">搜索</button>
    </div>
  </div>
</form>
@endsection
      