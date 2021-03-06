@extends('layouts.base')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-refresh btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<form class="Huiform" method="post" action="/admin/manager/index" target="_self">
	{{ csrf_field() }}
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" name="starttime" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" name="endtime" class="input-text Wdate" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="keywords">
		<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_add('添加管理员','add','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="9">员工列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="150">登录名</th>
				<th width="90">手机</th>
				<th width="150">邮箱</th>
				<th>角色</th>
				<th width="130">加入时间</th>
				<th width="100">是否已启用</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($data as $vo)

			<tr class="text-c">
				<td><input type="checkbox" value="1" name=""></td>
				<td>{{$vo->id}}</td>
				<td>{{$vo->username}}</td>
				<td>{{$vo->mobile}}</td>
				<td>{{$vo->email}}</td>
				<td>{{$vo->role->role_name}}</td>
				<td>{{$vo->created_at}}</td>
				<td class="td-status">
				@if($vo->status==1)<span class="label label-success radius">已启用</span>
				@else
				<span class="label radius">已禁用</span>
				@endif
				</td>
				<td class="td-manage">
				@if($vo->status==1)
				<a style="text-decoration:none" onClick="admin_stop(this,{{$vo->id}})" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> 
				@else
				<a style="text-decoration:none" onClick="admin_start(this,{{$vo->id}})" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a> 

				@endif
				<a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','edit',{{$vo->id}},'800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
				
				<a title="删除" href="javascript:;" onclick="admin_del(this,{{$vo->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
				
				</td>
			</tr>
			@endforeach

		</tbody>
	</table>
</div>


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除*/
function admin_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '/admin/manager/del',
			data:{"_token":"{{csrf_token()}}","id":id},
			dataType: 'json',
			success: function(data){
				if (data==1)
				{
					$(obj).parents("tr").remove();
					layer.msg('删除成功!',{icon:1,time:1000});
				}else{
					layer.msg('删除失败!',{icon:2,time:2000});
				}
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}

/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url+"?id="+id,w,h);
}
/*管理员-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type: 'POST',
			url: '/admin/manager/status',
			data:{"_token":"{{csrf_token()}}","id":id,"status":2},
			dataType: 'json',
			success: function(data){
				if (data.code==200)
				{
					$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,'+id+')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
					$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
					$(obj).remove();
					layer.msg('已停用!',{icon: 5,time:1000});
				}else{
					layer.msg('停用失败!',{icon:2,time:2000});
				}
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
		
	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type: 'POST',
			url: '/admin/manager/status',
			data:{"_token":"{{csrf_token()}}","id":id,"status":1},
			dataType: 'json',
			success: function(data){
				if (data.code==200)
				{
					$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,'+id+')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
					$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
					$(obj).remove();
					layer.msg('已启用!', {icon: 6,time:1000});
				}else{
					layer.msg('启用失败!',{icon:2,time:2000});
				}
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
		
		
	});
}

$(function(){
	$('.table').DataTable({
		"columnDefs": [{ "orderable": false, "targets": 0 }],//禁止第一列排序
		"order": [],//防止DataTable由第一列自动排序
	});
})
</script>
@endsection