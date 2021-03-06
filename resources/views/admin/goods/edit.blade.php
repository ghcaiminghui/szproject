<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<!-- 引入webuploader.css -->
<link rel="stylesheet" type="text/css" href="/statics/webuploader-0.1.5/webuploader.css">
<!--[if IE 6]>
<script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>添加商品 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form  method="post" class="form form-horizontal" id="form-member-add">
		@foreach($data as $value)
				<input type="hidden" class="input-text" value="{{$value->id}}" placeholder="" id="id" name="id">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商品名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$value->name}}" placeholder="" id="name" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商品分类：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<span class="select-box" style="width:150px;">
					<select class="select"  size="1" disabled>
						<option value="{{$value->id}}">{{$value->cates->name}}</option>	
						@foreach($parents as $val)
						<option value="{{$val->id}}">{{$val->name}}</option>
						@endforeach

					</select>
				</span> 
			</div>
		</div>	
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商品销量：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$value->sales}}" placeholder="" id="sales" name="sales">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商品库存：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" placeholder="总和" name="store" id="store" value="{{$value->store}}">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商品数量：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" placeholder="" name="num" id="num" value="{{$value->num}}">
			</div>
		</div>
		<div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">头像：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <!-- 给webuploader使用的div -->
                    <div id="uploader-demo">
                        <!--用来存放item-->
                        <div id="fileList" class="uploader-list">
                            <!-- 添加隐藏域 -->
                            <input type="hidden" name="avatar" value="{{$value->avatar}}"/>
                        </div>
                        <div id="filePicker">选择图片</div>
                    </div>
                </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商品价格：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" placeholder="$" name="price" id="price" value="{{$value->price}}">
			</div>
		</div>		
		{{csrf_field()}}
	
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="status" type="radio" id="status-0" value="{{$value->status}}" @if($value->status === 0) checked @endif>
					<label for="status-0">上架</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="status-1" name="status" value="{{$value->status}}" @if($value->status == 1) checked @endif>
					<label for="status-1">下架</label>
				</div>
			</div>
		</div>
		@endforeach
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
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> 
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本--> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<!--webuploader.js-->
<script type="text/javascript" src="/statics/webuploader-0.1.5/webuploader.js"></script>
<script type="text/javascript" src="/statics/avatar.js"></script>
<script type="text/javascript">
$(function()
{	
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				maxlength:20
			},
			typeid:{
				required:true,
			},											
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form)
		{
			$(form).ajaxSubmit
			({
				type: 'put',
				url: "/goods/{{$value->id}}",
				
				success: function(data)
				{
					//console.log(data);
					if (data == '1') 
					{
						layer.msg('添加成功!',{icon:1,time:1000},function ()
						{
	                        var index = parent.layer.getFrameIndex(window.name);
	                        //parent.$('.btn-refresh').click();
                            //刷新
                            parent.window.location = parent.window.location;
	                        parent.layer.close(index);
                    	});	
					}
					else
					{
						layer.msg('添加失败!',{icon:2,time:1000});
					}
				},	
                error: function(XmlHttpRequest, textis_nav, errorThrown)
				{
					layer.msg('error!',{icon:2,time:1000});
				}
			});	
		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>