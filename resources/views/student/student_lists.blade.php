<form action="/student/student_lists" method="post">
	@csrf
	姓名:<input type="text" name="name">
	<input type="submit" value="搜索">
</form>
<table border=1>
	<tr>
		<td>ID</td>
		<td>姓名</td>
		<td>年龄</td>
		<td>性别</td>
		<td>操作</td>
	</tr>
	@foreach($post as $v)
	<tr>
		<td>{{$v->id}}</td>
		<td>{{$v->name}}</td>
		<td>{{$v->age}}</td>
		<td>{{$v->sex}}</td>
		<td><a href="/del?id={{$v->id}}">删除</a>|<a href='/update?id={{$v->id}}'>修改</a></td>
	</tr>
	@endforeach
	{{ $post->links() }}
</table>