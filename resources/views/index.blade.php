@extends('layouts.common')

@section('title','Page Title')
<!-- 引入占位符区域 -->
@section('sidebar')
	@parent
	<p>This is appended to the master sidebar</p>
@endsection

@section('content')
	<p>This is my body content.</p>
@endsection