<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    	<form action="/update_do/{{$datas->id}}" method="post">
    		<input type="hidden" name="id" value='{{$datas->id}}'>
    		<table border="1">
    		@csrf
    			<tr>
    				<td>学生姓名</td>
    				<td><input type="text" name="name" value='{{$datas->name}}'></td>
    			</tr>
    			<tr>
    				<td>学生年龄</td>
    				<td><input type="text" name="age" value='{{$datas->age}}'></td>
    			</tr>
    			<tr>
    				<td>学生性别</td>
    				<td>
    					@if($datas->sex==1)
    					<input type="radio" name="sex" checked value="1">男<input type="radio" name="sex" value="女">女
    					@else
    					<input type="radio" name="sex" value="0">男<input type="radio" name="sex" value="女" checked>女
                    </td>
    					@endif

    			</tr>
    			<tr>
    				<td><input type="submit" value="提交"></td>
    				<td></td>
    			</tr>
    		</table>
    	</form>
    </body>
</html>