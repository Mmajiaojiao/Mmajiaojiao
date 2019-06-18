<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    	<form action="/adds_do" method="post" enctype="multipart/form-data">
    		<table border=1>
                @csrf
    			<tr>
    				<td>商品图片</td>
    				<td><input type="file" name="goods_img"></td>
    			</tr>
                <tr>
                    <td><input type="submit" value="提交"></td>
                    <td></td>
                </tr>
    		</table>
    	</form>
    </body>
</html>