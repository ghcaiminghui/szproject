<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>修改权限 - 权限管理</title>
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add" action="/auths/{{$info->id}}">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$info->auth_name}}" placeholder="" id="auth_name" name="auth_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">控制器：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$info->controller}}" placeholder="" id="controller" name="controller">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">方法名：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" placeholder="" name="action" id="action" value="{{$info->action}}">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>父级权限：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="pid" size="1">
				@if($info->pid == 0)
						<option value="0">顶级权限</option>
						@foreach($data as $row)
						<option value="{{$row->id}}">{{$row->auth_name}}</option>
						@endforeach
				@else
						<option value="{{$pid->id}}">{{$pid->auth_name}}</option>
						<option value="0">顶级权限</option>
						@foreach($data as $row)
						@if($row->id != $pid->id)
						<option value="{{$row->id}}">{{$row->auth_name}}</option>
						@endif
						@endforeach
				@endif
				
			</select>
			</span> </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>导航显示：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="is_nav" value="1" type="radio" id="is_nav-1" @if($info->is_nav == 1) checked @endif>
				<label for="is_nav-1">是</label>
			</div>
			<div class="radio-box">
				<input type="radio" value="2" id="is_nav-2" name="is_nav" @if($info->is_nav == 2) checked @endif>
				<label for="is_nav-2">不是</label>
			</div>
		</div>
	</div>
	{{csrf_field()}}
	{{ method_field('PUT') }}
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){

	
	if($('select:first-child').val() == 0){

		$('#controller,#action').parents('.row').hide();
	}

	$('select').change(function(){

		var _var = $(this).val();

		if(_var > 0){

			$('#controller,#action').parents('.row').show(300);
		}else{

			$('#controller,#action').val('');
			$('#controller,#action').parents('.row').hide(300);
		}
	});

	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-admin-add").validate
	({
		rules:
		{
			auth_name:
			{
				required:true,
				minlength:2,
				maxlength:16
			},	
			is_nav:
			{
				required:true,
			},
			pid:
			{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				success: function(data){
					console.log(data);
					if(data.msg == 1){

						layer.msg('修改成功!',{icon:1,time:1000},function(){

							var index = parent.layer.getFrameIndex(window.name);
							parent.window.location = parent.window.location;
							parent.layer.close(index);
						})
					}else{

						layer.msg('修改失败!',{icon:2,time:1000})
					}
					
				},
                error: function(XmlHttpRequest, textis_nav, errorThrown){
					layer.msg('error!',{icon:1,time:1000});
				}
			});
			
		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>