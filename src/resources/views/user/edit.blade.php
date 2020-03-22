@extends('Imperator::layouts.framework')

@section('pageTitle')
  用户信息修改
@stop

@section('content')
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <form id="mainForm" method="post" action="{{ URL:: route('admin.manager.update', $entity->id) }}" class="site-form">
                  {{csrf_field()}}
                  <input name="_method" type="hidden" value="PUT">
                  <div class="form-group">
                    <label for="username">登录名</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="用户登录名必须唯一" value="{{$entity->user_name}}" />
                  </div>
                  <div class="form-group">
                    <label for="new-password">登录密码</label>
                    <input type="password" class="form-control" name="pwd" id="pwd" placeholder="输入密码">
                  </div>
                  <div class="form-group">
                    <label for="confirmpwd">确认密码</label>
                    <input type="password" class="form-control" name="confirmpwd" id="confirmpwd" placeholder="请输入正确的密码">
                  </div>

                  <div class="form-group">
                    <label for="role_id">角色选择</label>
                    <div class="form-controls">
                        <select name="role_id" class="form-control" id="role_id">
                          <option value="0">请选择角色</option>
                          @foreach( $roles as $role)
                            <option value="{{ $role->id }}" @if($role->id == $entity->role_id) selected @endif>{{ $role->name }}</option>
                          @endforeach
                        </select>
                        <a href="{{ URL::route('admin.role.create') }}"> 添加新角色</a>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="nickname">昵称</label>
                    <input type="text" class="form-control" name="nickname" id="nickname" placeholder="输入昵称" value="{{$entity->nick_name}}" />
                  </div>
                  <div class="form-group">
                    <label for="nickname">电话</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="输入电话号码" value="{{$entity->phone}}" />
                  </div>
                  <div class="form-group">
                    <label for="email">邮箱</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="请输入正确的邮箱地址" value="{{$entity->email}}" />
                    <small id="emailHelp" class="form-text text-muted">请保证您填写的邮箱地址是正确的。</small>
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
  <script type="text/javascript" src="{{ $staticdir }}js/jquery-validate/jquery.validate.min.js"></script>
  <script type="text/javascript" src="{{ $staticdir }}js/extends/form.func.js"></script>
  <script type="text/javascript" src="{{ $staticdir }}js/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="{{ $staticdir }}js/lightyear.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#mainForm").validate({
        errorElement : 'span',
        errorClass : 'help-block',
        rules:{
          username:{
            required:true,
            rangelength: [2,20]
          },
          nickname:{
            required:true,
            rangelength: [2,20]
          },
          pwd:{
            required:true,
            rangelength: [6,20]
          },
          confirmpwd:{
            required:true,
            rangelength: [6,20]
          },
          email:{
            required:true
          },
          phone:{
            required:true,
            digits:true
          },
          role_id:{
            required:true,
            digits:true
          },
        },
        messages:{
          username:{
            required:"用户名称不能为空",
            rangelength:"用户名必须小于十个字"
          },
          nickname:{
            required:"昵称不能为空",
            rangelength:"昵称需在2-10个字之间"
          },
          confirmpwd:{
            required:"确认密码不能为空",
            rangelength:"密码在6-15字符之间"
          },
          pwd:{
            required:"密码不能为空",
            rangelength:"密码在6-15字符之间"
          },
          phone:{
            required:"电话必须填写",
            digits:"父类选择错误"
          },
          role_id:{
            required:"角色必须选择",
            digits:"角色不能为空"
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
            role_id:$("#role_id").val(),
            email:$("#email").val(),
            phone:$("#phone").val(),
            pwd:$("#pwd").val(),
            confirmpwd:$("#confirmpwd").val(),
          };
          $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
          });
          $.ajax({
            type: "put",
            url: "{{ URL:: route('admin.manager.update', $entity->id) }}",
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