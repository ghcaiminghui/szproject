@extends('home.public.personalCenter')
@section('title','收货地址')
@section('right')
					<div class="pull-right">
				<div class="user-content__box clearfix bgf">
					<div class="title">账户信息-收货地址</div>
					<form action="/personal/address/{{$info->id}}" class="user-addr__form form-horizontal" role="form" method="post">
						<p class="fz18 cr">新增收货地址<span class="c6" style="margin-left: 20px">电话号码、手机号码选填一项，其余均为必填项</span></p>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">收货人姓名：</label>
							<div class="col-sm-6">
								<input class="form-control" name="username" id="name" placeholder="请输入姓名" type="text" value="{{$info->username}}">
							</div>
						</div>
						<div class="form-group">
							<label for="details" class="col-sm-2 control-label">收货地址：</label>
							<div class="col-sm-10">
								<div class="addr-linkage">
									<select name="province">
										@foreach($country as $row)
										@if($row->id == $info->province)
										<option selected value="{{$row->id}}">{{$row->area}}</option>
										@else		
										<option value="{{$row->id}}">{{$row->area}}</option>
										@endif
										@endforeach
									</select>
									<select name="city">
										<option value="{{$info1->city}}">{{$info->city}}</option>
									</select>
									<select name="area">
										<option value="{{$info1->area}}">{{$info->area}}</option>
									</select>
									<select name="town">
										<option value="{{$info1->town}}">{{$info->town}}</option>
									</select>
								</div>
								<input class="form-control" id="details" name="address" placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码等信息" maxlength="30" type="text" value="{{$info->address}}">
							</div>
						</div>
						<div class="form-group">
							<label for="code" class="col-sm-2 control-label">地区编码：</label>
							<div class="col-sm-6">
								<input class="form-control" name="code" id="code" placeholder="请输入邮政编码" type="text" value="{{$info->code}}">
							</div>
						</div>
						<div class="form-group">
							<label for="mobile" class="col-sm-2 control-label">手机号码：</label>
							<div class="col-sm-6">
								<input class="form-control" name="phone" id="mobile" placeholder="请输入手机号码" type="text" value="{{$info->phone}}">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-6">
								<div class="checkbox">
									
									<label><input type="checkbox" @if($info->status == '1') checked @endif name="status" value="1"><i></i> 设为默认收货地址</label>
									
								</div>
							</div>
						</div>
						{{ method_field('PUT') }}
						{{csrf_field()}}
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-6">
								<button type="submit" class="but">保存</button>
							</div>
						</div>
					</form>
					<script>
						//选择市
						$('select[name=province]').change(function(){

							var id = $(this).val();
							$.get("/personal/address",{id:id},function(data){

								var str = '';
								$.each(data,function(index,el){

									str += "<option value='"+ el.id +"'>"+ el.area +"</option>";
								});
								$('select[name=city]').find('option:gt(0)').remove();
								$('select[name=area]').find('option:gt(0)').remove();
								$('select[name=town]').find('option:gt(0)').remove();
								$('select[name=city]').append(str);
							},'json');
						});

						//选择区
						$('select[name=city]').change(function(){

							var id = $(this).val();
							$.get("/personal/address",{id:id},function(data){

								var str = '';
								$.each(data,function(index,el){

									str += "<option value='"+ el.id +"'>"+ el.area +"</option>";
								});
								$('select[name=area]').find('option:gt(0)').remove();
								$('select[name=town]').find('option:gt(0)').remove();
								$('select[name=area]').append(str);
							},'json');
						});

						//选择镇
						$('select[name=area]').change(function(){

							var id = $(this).val();
							$.get("/personal/address",{id:id},function(data){

								var str = '';
								$.each(data,function(index,el){

									str += "<option value='"+ el.id +"'>"+ el.area +"</option>";
								});
								$('select[name=town]').find('option:gt(0)').remove();
								$('select[name=town]').append(str);
							},'json');
						});
					</script>

					<!-- dsf	 -->
					<p class="fz18 cr">已保存的有效地址</p>

					<div class="table-thead addr-thead">
						<div class="tdf1">收货人</div>
						<div class="tdf2">所在地</div>
						<div class="tdf3"><div class="tdt-a_l">详细地址</div></div>
						<div class="tdf1">邮编</div>
						<div class="tdf1">电话/手机</div>
						<div class="tdf1">操作</div>
						<div class="tdf1"></div>
					</div>
					@foreach($data as $val)
					<div class="addr-list">
						<div class="addr-item">
							<div class="tdf1">{{$val->username}}</div>
							<div class="tdf2 tdt-a_l">{{$val->province}} {{$val->area}} {{$val->city}}</div>
							<div class="tdf3 tdt-a_l">{{$val->address}}</div>
							<div class="tdf1">{{$val->code}}</div>
							<div class="tdf1">{{$val->phone}}</div>
							<div class="tdf1 order">
								<form class="addstatus">
								<input type="hidden" name="id" value="{{$val->id}}">
								<a href="/personal/address/{{$val->id}}/edit" class="xiugai">修改</a><a href="javascript:void(0)" class="shanchu">删除</a>
								{{ method_field('PUT') }}
								{{ method_field('DELETE') }}
								{{csrf_field()}}
								</form>
							</div>
							<div class="tdf1">
								@if($val->status == '1')
								<a href="javascript:void(0)" class="default active" >默认地址</a>
								@else
								<a href="/personal/address/{{$val->id}}" class=" active" >默认地址</a>
								@endif
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<script>
				//删除操作
				$('.shanchu').click(function(){
					var id = $(this).parent().find('input').val(); //获取id
					var div = $(this).parent().parent().parent();

					$('.addstatus').ajaxSubmit({

						url:'/personal/address/'+id,
						type:'post',
						dataType:'json',
						beforeSubmit:function(){},
						success:function(data){
							
							if(data.msg == '1'){
								
								div.remove();
							}
						}
					});
				});


			</script>
@endsection