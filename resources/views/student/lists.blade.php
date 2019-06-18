<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    	<form action="">
    		<table border=1>
    			<tr>
    				<td>ID</td>
    				<td>商品图片</td>
    			</tr>
    			@foreach($data as $v)
    			<tr>
    				<td>{{$v->id}}</td>
    				<td><img src="{{$v->goods_img}}"
    					width="50px" height="40px"></td>
    			</tr>
    			@endforeach
    		</table>
    	</form>
    </body>
</html>