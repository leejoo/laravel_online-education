@extends('layouts.base')

@section('content')
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
	{{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-1"><span class="c-red">*</span>标题：</label>
		<div class="formControls col-xs-8 col-sm-11">
			<input type="text" class="input-text" value="{{$info->title}}" placeholder="" id="title" name="title">
		</div>
	</div>
	
		<div class="row cl" id="rowcontroller">
		<label class="form-label col-xs-4 col-sm-1"><span class="c-red">*</span>内容：</label>
		<div class="formControls col-xs-8 col-sm-11">
			<script id="editor" type="text/plain" style="width:100%;height:350px;">{!! $info->content !!}</script>
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
<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script> 
<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
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
			
			title:{
				required:true,
			},
			content:{
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
						layer.msg('修改成功!',{icon:1,time:2000},function(){
							var index = parent.layer.getFrameIndex(window.name);
							parent.location.reload();
							parent.layer.close(index);
						
						});
					}else{
						layer.msg('修改失败!',{icon:2,time:2000});
					}
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('error!',{icon:1,time:1000});
				}
			});
			
		}
	});

	var ue = UE.getEditor('editor');
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->

@endsection