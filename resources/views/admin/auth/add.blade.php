@extends('layouts.base')

@section('content')
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
	{{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="auth_name" name="auth_name">
		</div>
	</div>
	
	
	<div class="row cl" id="rowcontroller">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>控制器名：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$info?$info->controller:''}}" placeholder="" id="controller" name="controller">
		</div>
	</div>
	<div class="row cl" id="rowcation">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>方法名：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" placeholder="方法名" name="action" id="action">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">上级：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="pid" id="pid" size="1">
				@foreach ($menus as  $vo)
					<option value="{{$vo->id}}" @if($info&&$vo->id==$info->id) selected @endif>{{$vo->title_show}}</option>
				@endforeach
			</select>
		</span> </div>
	</div>
	
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否导航：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="is_nav" type="radio" id="is_nav-1" value="1" checked>
				<label for="sex-1">是</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="is_nav-2" name="is_nav" value="2">
				<label for="sex-2">否</label>
			</div>
		</div>
	</div>

	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
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
	var pid = $("#pid").val();
	if (pid==0)
	{
		$('#controller,#action').parents('.row').hide();
	}
	$("#pid").change(function(){
		if ($(this).val()>0)
		{
			$('#controller,#action').parents('.row').show();
		}else{
			$('#controller,#action').parents('.row').hide();
		}
		
	});
	
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-admin-add").validate({
		rules:{
			
			auth_name:{
				required:true,
				minlength:2,
				maxlength:16
			},
			pid:{
				required:true,
			},
			
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
<!--/请在上方写此页面业务相关的脚本-->

@endsection