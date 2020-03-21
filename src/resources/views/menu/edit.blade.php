@extends('admin/layouts/framework')

@section('pageTitle')
  菜单修改
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
                <form id="mainForm" method="post" action="{{ URL:: route('admin.menu.update', $entity->id) }}" class="site-form">
                  {{csrf_field()}}
                  <input name="_method" type="hidden" value="PUT">
                  <div class="form-group">
                    <label for="title">菜单名称</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="栏目名称必须唯一" value="{{ $entity->title }}" />
                  </div>

                  <div class="form-group">
                    <label for="sort">链接地址</label>
                    <input class="form-control" type="text" id="url" name="url" value="{{ $entity->uri }}" />
                  </div>

                  <div class="form-group">
                    <label for="nickname">菜单图标</label>
                    <input type="file" id="menu_icon" name="menu_icon">
                  </div>

                  <div class="form-group">
                    <label for="sort">排序</label>
                    <input class="form-control" type="text" id="sort" name="sort" value="{{ $entity->order }}" />
                  </div>


                  <div class="form-group">
                    <label for="type">菜单父类</label>
                    <div class="form-controls">
                      <select name="parentID" class="form-control" id="parentID">
                        <option value="0">独立菜单</option>
                        @foreach( $parents as $parent)
                          <option value="{{ $parent->id }}" @if($entity->parent_id == $parent->id) selected @endif>{{ $parent->title }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="type">菜单类型</label>
                    <div class="form-controls">
                      <select name="menuType" class="form-control" id="menuType">
                        @foreach( $types as $type)
                          <option value="{{ $type->id }}" @if($entity->type_id == $type->id) selected @endif>{{ $type->var_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="type">菜单位置</label>
                    <div class="form-controls">
                      <select name="pos" class="form-control" id="pos">
                        <option value="">无</option>
                        @foreach( $positions as $pos)
                          <option value="{{ $pos->var_value }}" @if($entity->position == $pos->var_value) selected @endif>{{ $pos->var_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="priv_id">权限单元</label>
                    <div class="form-controls">
                      <select name="priv_id" class="form-control" id="priv_id">
                        <option value="">无</option>
                        @foreach($privileges as $pri)
                          <option value="{{$pri->id}}" attr-code="{{$pri->var_value}}" @if($entity->privilege_id == $pri->id) selected @endif>{{$pri->var_name}}</option>
                        @endforeach
                      </select>
                    </div>
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
  <script type="text/javascript" src="{{ $staticdir }}js/jquery-validate/jquery.validate.min.js"></script>
  <script type="text/javascript" src="{{ $staticdir }}js/extends/form.func.js"></script>
  <script type="text/javascript" src="{{ $staticdir }}js/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="{{ $staticdir }}js/lightyear.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#mainForm").validate({
      errorElement : 'span',
      errorClass : 'help-block',
      rules:{
        title:{
          required:true,
          rangelength: [2,20],
        },
        type_id:{
          //required:true,
          rangelength: [2,20],
        },
        parentID:{
          required:true,
          digits:true,
        },
        menuType:{
          required:true,
          digits:true,
        },
        sort:{
          //required:false,
          digits:true,
        },
      },
      messages:{
        title:{
          required:"字典名称不能为空",
          rangelength:"名称必须小于十个字"
        },
        type_id:{
          required:"菜单类型必须选择",
        },
        parentID:{
          required:"必须有parent选择",
          digits:"选择错误"
        },
        menuType:{
          required:"必须有类型选择",
          digits:"选择错误"
        },
        sort:{
          digits:"请确认排序",
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
          title:$("#title").val(),
          type_id:$("#menuType").val(),
          parent_id:$("#parentID").val(),
          pos:$("#pos").val(),
          url:$("#url").val(),
          priv_id:$("#priv_id").val(),
          menu_icon:$("#menu_icon").val(),
          order:$("#sort").val(),
        };
        $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $.ajax({
          type: "put",
          url: "{{ route('admin.menu.update', $entity->id) }}",
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