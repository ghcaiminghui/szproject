
<html>
 <head></head>
 <script type="text/javascript" charset="utf-8" src="/admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/admin/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/admin/ueditor/lang/zh-cn/zh-cn.js"></script>
<title>公告修改</title>
 <body>
  <article class="page-container">
	<form class="form form-horizontal" id="form-admin-add" method="post" action="/advert">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>广告名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$info->ad_name}}" placeholder="" id="ad_name" name="ad_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>内容：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<script id="editor" name="ad_code" type="text/plain" style="width:900px;height:500px;">{{$info->ad_code}}</script>
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
		</div>
		{{csrf_field()}}
	</form>
</article>
 </body>
 <script type="text/javascript">
 //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
 </script>
</html>

