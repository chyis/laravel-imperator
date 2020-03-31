@extends('Imperator::layouts.framework')

@section('pageTitle')
  首页面板
@stop

@section('content')
    <!--页面主要内容-->
    <main class="kkadmin-layout-content">
      
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                @if (isset($errors) && count($errors) > 0)
                  <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                  <form id="mainForm" method="post" action="{{ URL:: route('admin.profile.save') }}" class="site-form">
                    {{csrf_field()}}
                <div class="edit-avatar">
                  <img src="@if(empty($loginUser->avatar)) {{$staticDir}}/images/users/avatar.jpg @else /statics/uploads/{{$loginUser->avatar}} @endif" alt="..." class="img-avatar">
                  <div class="avatar-divider"></div>
                  <div class="edit-avatar-content">
                    <button class="btn btn-default">修改头像</button>
                    <p class="m-0">上传后会自动裁剪生成264x264大小头像，上传图片大小不能超过2M，原图不会保留。</p>
                  </div>
                </div>
                <hr>
                  <div class="form-group">
                    <label for="username">用户名</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{$loginUser->user_name}}" disabled="disabled" />
                  </div>
                  <div class="form-group">
                    <label for="nickname">昵称</label>
                    <input type="text" class="form-control" name="nickname" id="nickname" placeholder="输入您的昵称" value="{{$loginUser->nick_name}}" />
                  </div>
                  <div class="form-group">
                    <label for="nickname">电话</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="输入您的电话" value="{{$loginUser->phone}}" />
                  </div>
                  <div class="form-group">
                    <label for="email">邮箱</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="请输入正确的邮箱地址" value="{{$loginUser->email}}" />
                    <small id="emailHelp" class="form-text text-muted">请保证您填写的邮箱地址是正确的。</small>
                  </div>
                  <div class="form-group">
                    <label for="description">简介</label>
                    <textarea class="form-control" name="description" id="description" placeholder="没介绍是有个性的，有介绍是张扬的" rows="3">{{$loginUser->description}}</textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">保存</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!--End 页面主要内容-->
@stop

@section('javascript')
  @parent
  <script type="text/javascript" src="{{$staticDir}}/js/jquery-validate/jquery.validate.min.js"></script>
  <script type="text/javascript" src="{{$staticDir}}/js/extends/form.func.js"></script>
  <script type="text/javascript" src="{{$staticDir}}/js/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="{{$staticDir}}/js/kkadmin.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#mainForm").validate({
        errorElement : 'span',
        errorClass : 'help-block',
        rules:{
          nickname:{
            required:true,
            rangelength: [2,20]
          },
          email:{
            required:true
          },
          phone:{
            required:true,
            digits:true
          },
        },
        messages:{
          nickname:{
            required:"昵称不能为空",
            rangelength:"昵称需在2-10个字之间"
          },
          phone:{
            required:"电话必须填写",
            digits:"父类选择错误"
          },
          email:{
            required:"邮箱不能为空",
          },
        },
        errorPlacement : function(error, element) {
          element.next().remove();
          element.after('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');
          element.closest('.form-group').append(error);
        },
        highlight : function(element) {
          $(element).closest('.form-group').addClass('has-error has-feedback');
        },
        success : function(label) {
          var el=label.closest('.form-group').find("input");
          el.next().remove();
          el.after('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>');
          label.closest('.form-group').removeClass('has-error').addClass("has-feedback has-success");
          label.remove();
        },
        submitHandler: function(form) {
          let Data = {
            username:$("#username").val(),
            nickname:$("#nickname").val(),
            email:$("#email").val(),
            phone:$("#phone").val(),
            description:$("#description").val(),
          };
          $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
          });
          $.ajax({
            type: "post",
            url: "{{ URL:: route('admin.profile.save') }}",
            dataType: 'json',
            processData: false,
            contentType: "application/json;charset=UTF-8",
            cache: false,
            data: JSON.stringify(Data),
            async : false,    //同步
            success:function (res) {
              if(res.code==0) {
                success(res.msg);
              } else if(res.code > 0) {
                error(res.msg);
              } else {
                alert(res.code);
              }
            },
            //请求失败，包含具体的错误信息
            error : function(e){
              error("error occurred!");
            }
          });
        }
      })
    });
  </script>
@endsection