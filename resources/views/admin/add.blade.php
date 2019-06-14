<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    	<form action="/add_do" method="post" enctype="multipart/form-data">
    		{{csrf_field()}}
    		<table border=1>
    			<tr>
    				<td>上传文件</td>
    				<td><input type="file" name="file_name"></td>
    			</tr>
    			<tr>
    				<td></td>
    				<td><input type="submit" value="提交"></td>
    			</tr>
    		</table>
    	</form>
    </body>
</html>