@extends('layouts.base')

@section('content')
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
		{{ csrf_field() }}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">网站角色：</label>
			<div class="formControls col-xs-8 col-sm-9">
			   @foreach ($data as $key=>$vo)
			   @if($vo->level==1)
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" id="user-Character-{{$key}}">
							{{$vo->auth_name}}</label>
					</dt>
					@foreach ($data as $koo=>$voo)
					@if($voo->level==2)
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="{{$voo->id}}" name="auth_ids[]" id="user-Character-{{$key}}-{{$koo}}"@if(in_array($voo->id,$auth_ids)) checked @endif>{{$voo->auth_name}}</label>
							</dt>
							<dd>
							@foreach ($data as $koos=>$voos)
							@if($voos->level==3 && $voos->pid == $voo->id)
							<label class=""><input type="checkbox" value="{{$voos->id}}" name="auth_ids[]" id="user-Character-{{$key}}-{{$koo}}-{{$koos}}" @if(in_array($voos->id,$auth_ids)) checked @endif>{{$voos->auth_name}}</label>
							@endif
							@endforeach
							</dd>
						</dl>
					</dd>
					@endif
					@endforeach
				</dl>
				@endif
				@endforeach
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
	});
	
	$("#form-admin-role-add").validate({
		rules:{
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "" ,
				success: function(data){

					if (data==1)
					{
						layer.msg('添加成功!',{icon:1,time:2000},function(){
							var index = parent.layer.getFrameIndex(window.name);
							parent.location.reload();
							parent.layer.close(index);
						
						});
					}else{
						layer.msg('添加失败!',{icon:2,time:2000});
					}
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('error!',{icon:1,time:1000});
				}
			});
		}
	});
});
</script>
@endsection