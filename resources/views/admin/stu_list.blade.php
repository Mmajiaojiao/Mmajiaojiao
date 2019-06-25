<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    	<form action="/stu_list" method="get">
    		<input type="text" name="name"><input type="submit" value="搜索">
    	</form>
    	<table border=1>
    		<tr>
    			<td>ID</td>
    			<td>姓名</td>
    			<td>性别</td>
    			<td>年龄</td>
    			<td>操作</td>
    		</tr>
    		@foreach($data as $v)
    		<tr>
    			<td>{{$v->id}}</td>
    			<td>{{$v->name}}</td>
    			<td>{{$v->sex}}</td>
    			<td>{{$v->age}}</td>
    			<td><a href="stu_del?id={{$v->id}}">删除</a>|<a href="stu_upd?id={{$v->id}}">修改</a></td>
    		</tr>
    		@endforeach
    		{{$data->links()}}
    	</table>
    </body>
</html>
