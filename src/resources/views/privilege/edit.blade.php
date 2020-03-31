@extends('Imperator::layouts.framework')

@section('pageTitle')
    权限修改
@stop

@section('content')
    <!--页面主要内容-->
    <main class="kkadmin-layout-content">
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
                <form id="mainForm" method="post" action="{{ URL:: route('admin.privilege.update', $entity->id) }}" class="site-form">
                  {{csrf_field()}}
                  <input name="_method" type="hidden" value="PUT">
                  <div class="form-group">
                    <label for="name">权限名称</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="权限名称必须唯一" value="{{ $entity->name }}" />
                  </div>

                    <div class="form-group">
                        <label for="code">开发者标识</label>
                        <input type="text" class="form-control" name="code" id="code" placeholder="输入字典标识" value="{{ $entity->code }}" />
                    </div>

                  <div class="form-group">
                    <label for="group_id">权限分组</label>
                    <div class="form-controls">
                      <select name="group_id" class="form-control" id="group_id" onchange="onSelectParent();">
                          @foreach( $parents as $k=>$parent)
                              @if(!empty($parent['child']))
                                  <optgroup label="{{ $parent['var_name'] }}">
                                      @foreach( $parent['child'] as $key=> $child)
                                          <option value="{{ $child['id']}}" @if($child['id'] == $entity->group_id) selected @endif>{{ $child['var_name'] }}</option>
                                      @endforeach
                                  </optgroup>
                              @endif
                          @endforeach
                      </select>
                    </div>
                  </div>
                    <div class="form-group">
                        <label for="http_method">请求方式</label>
                        <div class="form-controls">
                            <select name="http_method" class="form-control" id="http_method">
                                <option value="view" @if($entity->http_path == 'view') selected @endif>- 非HTTP请求 -</option>
                                <option value="source" @if($entity->http_path == 'source') selected @endif>- source请求集合 -</option>
                                <option value="get" @if($entity->http_path == 'get') selected @endif>- GET【查看或管理】 -</option>
                                <option value="put" @if($entity->http_path == 'put') selected @endif>- PUT【修改】 -</option>
                                <option value="post" @if($entity->http_path == 'post') selected @endif>- POST【保存】 -</option>
                                <option value="delete" @if($entity->http_path == 'delete') selected @endif>- DELETE【删除】 -</option>
                                <option value="head" @if($entity->http_path == 'head') selected @endif>- HEAD【报头】 -</option>
                                <option value="options" @if($entity->http_path == 'options') selected @endif>- OPTIONS【资源请求】 -</option>
                                <option value="trace" @if($entity->http_path == 'trace') selected @endif>- TRACE【追踪回显】 -</option>
                                <option value="connect" @if($entity->http_path == 'connect') selected @endif>- CONNECT【管道代理】 -</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="http_path">请求地址</label>
                        <input type="text" class="form-control" name="http_path" id="http_path" placeholder="如有请求地址请输入相对地址" value="{{ $entity->http_path }}" />
                    </div>

                    <div class="form-group">
                        <label for="ext">权限值</label>
                        <input type="text" class="form-control" name="ext" id="ext" placeholder="输入权限值" value="{{ $entity->ext }}" />
                    </div>

                    <button type="submit" class="btn btn-label btn-info">
                        <label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>
                        修改
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
  <script type="text/javascript" src="{{$staticDir}}/js/kkadmin.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
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
                  http_method:$("#http_method").val(),
                  http_path:$("#http_path").val(),
                  group_id:$("#group_id").val(),
                  ext:$("#ext").val()
              };
              $.ajaxSetup({
                  headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
              });
              $.ajax({
                  type: "put",
                  url: "{{ URL:: route('admin.privilege.update', $entity->id) }}",
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