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
                <form id="mainForm" method="post" action="{{ URL:: route('admin.password.save') }}" class="site-form">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="old-password">旧密码</label>
                    <input type="password" class="form-control" name="password" id="old-password" placeholder="输入账号的原登录密码">
                  </div>
                  <div class="form-group">
                    <label for="new-password">新密码</label>
                    <input type="password" class="form-control" name="new_pwd" id="new-password" placeholder="输入新的密码">
                  </div>
                  <div class="form-group">
                    <label for="confirm-password">确认新密码</label>
                    <input type="password" class="form-control" name="confirmpwd" id="confirm-password" placeholder="请输入正确的密码">
                  </div>
                  <button type="submit" class="btn btn-primary">修改密码</button>
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
          password:{
            required:true,
            rangelength: [6,20]
          },
          pwd:{
            required:true,
            rangelength: [6,20]
          },
          confirmpwd:{
            required:true,
            rangelength: [6,20]
          },
        },
        messages:{
          confirmpwd:{
            required:"确认密码不能为空",
            rangelength:"密码在6-15字符之间"
          },
          pwd:{
            required:"新密码不能为空",
            rangelength:"密码在6-15字符之间"
          },
          password:{
            required:"旧密码不能为空",
            rangelength:"密码在6-15字符之间"
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
            password:$("#old-password").val(),
            new_pwd:$("#new-password").val(),
            confirmpwd:$("#confirm-password").val(),
          };
          $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
          });
          $.ajax({
            type: "post",
            url: "{{ URL:: route('admin.password.save') }}",
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