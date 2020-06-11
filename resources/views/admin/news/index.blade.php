@extends('layouts.base')

@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>资讯管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

<div class="page-container">
	<div class="text-c"></div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" onclick="admin_permission_add('添加资讯','/admin/news/add','','680')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加资讯</a></span></div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="7">资讯列表</th>
			</tr>
			<tr class="text-c">
				<th width="5%"><input type="checkbox" name="" value=""></th>
				<th width="10%">ID</th>
				<th width="10%">名称</th>
				<th width="20%">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($data as $vo)
			<tr class="text-c">
				<td><input type="checkbox" value="1" name=""></td>
				<td>{{$vo->id}}</td>
				<td class="text-l">{{$vo->title}}</td>
				
				<td><a title="编辑" href="javascript:;" onclick="admin_news_edit('编辑','edit','{{$vo->id}}','','680')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_news_del(this,{{$vo->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-权限-添加*/
function admin_permission_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-权限-编辑*/
function admin_news_edit(title,url,id,w,h){
	layer_show(title,url+"?id="+id,w,h);
}



/*管理员-权限-删除*/
function admin_news_del(obj,id){
	
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '/admin/news/del',
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
$(function(){
	$('.table').DataTable({
		"columnDefs": [{ "orderable": false, "targets": 0 }],//禁止第一列排序
		"order": [],//防止DataTable由第一列自动排序
	});
})
</script>

@endsection