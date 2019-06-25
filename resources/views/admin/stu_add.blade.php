<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    	<form action="/stu_do" method="post">
    		<table border="1">
    			@csrf
    			<tr>
    				<td>学生姓名</td>
    				<td><input type="text" name="name"></td>
    			</tr>
    			<tr>
    				<td>学生性别</td>
    				<td><input type="radio" name="sex" value="1">男
						<input type="radio" name="sex" value="2">女
    				</td>
    			</tr>
    			<tr>
    				<td>学生年龄</td>
    				<td><input type="text" name="age"></td>
    			</tr>
    			<tr>
    				<td></td>
    				<td><input type="submit" value="提交"></td>
    			</tr>
    		</table>
    	</form>
    </body>
</html>
