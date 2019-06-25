<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    	<form action="/upd_do" method="post">
    		<input type="hidden" name="id" value="{{$data->id}}">
    		<table border="1">
    			@csrf
    			<tr>
    				<td>学生姓名</td>
    				<td><input type="text" name="name" value="{{$data->name}}"></td>
    			</tr>
    			<tr>
    				<td>学生性别</td>
    				<td>
    					<input type="radio" name="sex" value="1" checked>男
						<input type="radio" name="sex" value="2">女
    				</td>
    			</tr>
    			<tr>
    				<td>学生年龄</td>
    				<td><input type="text" name="age" value="{{$data->age}}"></td>
    			</tr>
    			<tr>
    				<td></td>
    				<td><input type="submit" value="修改"></td>
    			</tr>
    		</table>
    	</form>
    </body>
</html>
