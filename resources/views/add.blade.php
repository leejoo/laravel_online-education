<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户注册案例</title>
    <style type="text/css"></style>
    <script type="text/javascript"></script>
</head>
<body>
<form action="/user/add" method="post">
	{{csrf_field()}}
    <table width="400px" height="400px">
        <tr>
            <!--colspan:单元格跨几列-->
            <td colspan="2">
                <h4>用户注册</h4>
                <hr/>
            </td>
        </tr>
 
 
        <!--隐藏表单项，应用场景：某些数据对用户而言是没有意义的，用户不需要看到这些数据，但是服务器又需要，那么这-->
        <!--时候就可以使用隐藏表单项-->
        <input type="hidden" name="flag" value="true"/>
 
        <tr>
            <td>用户名：</td>
            <td>
                <!--用户名：普通文本输入框-->
                <input type="text" name="useName" value=""/>
            </td>
        </tr>

		<tr align="center">
            <!--colspan：单元格跨几列-->
            <td colspan="2">
                <!--提交按钮：提交表单的数据到服务器上-->
                <input type="submit" value="注册"/>
            </td>
        </tr>

    </table>
</form>
</body>
</html>
