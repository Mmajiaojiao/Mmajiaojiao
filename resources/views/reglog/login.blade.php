
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    	<form action="/reglog/login_do" method="post">
    		@csrf
    		<table border=1>
    			<tr>
    				<td>用户名</td>
    				<td><input type="text" name="name"></td>
    			</tr>
    			<tr>
    				<td>密码</td>
    				<td><input type="password" name="pwd"></td>
    			</tr>
    			<tr>
    				<td></td>
    				<td><input type="submit" value="登录"></td>
    			</tr>
    		</table>
    	</form>
    </body>
</html>
