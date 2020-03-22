@extends('Imperator::layouts.framework')

@section('pageTitle')
    权限添加
@stop

@section('content')
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                @if (isset($errors) && $errors->any())
                  <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <form method="post" id="mainForm" action="{{ URL:: route('admin.privilege.store') }}" class="site-form">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="name">权限名称 *</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="权限名称必须唯一" value="" />
                  </div>

                  <div class="form-group">
                    <label for="group_id">权限分组</label>
                    <div class="form-controls">
                        <select name="group_id" class="form-control" id="group_id">
                          <option value="0">- 新建同名分组 -</option>
                          @foreach( $parents as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->var_name }}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>

                    <div class="form-group">
                        <label for="http_method">请求方式</label>
                        <div class="form-controls">
                            <select name="http_method" class="form-control" id="http_method">
                                <option value="view">- 非HTTP请求 -</option>
                                <option value="source">- source请求集合 -</option>
                                <option value="get">- GET【查看或管理】 -</option>
                                <option value="put">- PUT【修改】 -</option>
                                <option value="post">- POST【保存】 -</option>
                                <option value="delete">- DELETE【删除】 -</option>
                                <option value="head">- HEAD【报头】 -</option>
                                <option value="options">- OPTIONS【资源请求】 -</option>
                                <option value="trace">- TRACE【追踪回显】 -</option>
                                <option value="connect">- CONNECT【管道代理】 -</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="http_path">请求地址</label>
                        <input type="text" class="form-control" name="http_path" id="http_path" placeholder="如有请求地址请输入相对地址" value="" />
                    </div>

                    <div class="form-group">
                        <label for="code">开发者标识 *</label>
                        <input type="text" class="form-control" name="code" id="code" placeholder="输入唯一的开发者标识" value="" />
                    </div>

                  <div class="form-group">
                      <label for="ext">扩展权限值</label>
                      <input type="text" class="form-control" name="ext" id="ext" placeholder="输入开发者扩展权限值" value="" />
                  </div>

                  <button type="submit" class="btn btn-label btn-info">
                    <label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>
                    保存
                  </button>

                  <button class="btn btn-label btn-warning" type="button" onclick="javascript:history.back(1);">
                    <label><i class="mdi mdi-page-first"></i></label> 返回
                  </button>
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
<script type="text/javascript" src="{{$staticDir}}/js/lightyear.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#parentID").find("option[value=0]").attr("selected",true);
    $("#mainForm").validate({
      errorElement : 'span',
      errorClass : 'help-block',
      rules:{
        name:{
          required:true,
          rangelength: [2,20],
        },
        code:{
          //required:true,
          rangelength: [2,20],
        },
        group_id:{
          required:true,
          digits:true,
        },
        ext:{
          //required:true,
          rangelength: [2,20],
        }
      },
      messages:{
        name:{
          required:"权限名称不能为空",
          rangelength:"名称必须小于十个字"
        },
        code:{
          rangelength:"请填写开发者标识",
        },
        group_id:{
          digits:"选择错误"
        },
        ext:{
            rangelength: [2,20]
        }
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
            name:$("#name").val(),
            code:$("#code").val(),
            group_id:$("#group_id").val(),
            http_path:$("#http_path").val(),
            http_method:$("#http_method").val(),
            ext:$("#ext").val()
          };
          $.ajaxSetup({
              headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
          });
          $.ajax({
              type: "post",
              url: "{{ route('admin.privilege.store') }}",
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