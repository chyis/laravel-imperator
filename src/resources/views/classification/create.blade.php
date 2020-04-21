@extends('Imperator::layouts.framework')

@section('pageTitle')
产品分类添加
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
                <form id="mainForm" method="post" action="{{ URL:: route('admin.classification.store') }}" class="site-form">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="username">产品分类名称</label>
                    <input type="text" class="form-control" name="cateName" id="cateName" placeholder="栏目名称必须唯一" value="" />
                  </div>

                  <div class="form-group">
                    <label for="parentID">分类父类</label>
                    <div class="form-controls">
                        <select name="parentID" class="form-control" id="parentID">
                          <option value="0">独立栏目</option>
                          @foreach( $parents as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->cate_name }}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="typeID">分类类型</label>
                    <div class="form-controls">
                      <select name="typeID" class="form-control" id="typeID">
                        <option value="0">普通内容</option>
                        @foreach( $types as $type)
                          <option value="{{ $type->id }}">{{ $type->var_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="cate_icon">分类图标</label>
                    <input class="form-control" type="text" id="cate_icon" name="cate_icon" value="">
                    <input class="image-up-field" widget-type="auto-upload" data-target="cate_icon" target-type="input" type="file" id="img-upload" name="img-upload">
                  </div>

                  <div class="form-group">
                    <label for="sort">排序</label>
                    <input class="form-control" type="text" id="sort" name="sort" value="" />
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
  <script type="text/javascript" src="{{$staticDir}}/js/kkadmin.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#parentID").find("option[value=0]").attr("selected",true);
    $("#mainForm").validate({
      errorElement : 'span',
      errorClass : 'help-block',
      rules:{
        cateName:{
          required:true,
          rangelength: [2,20],
        },
        typeID:{
          required:true,
          digits:true,
        },
        parentID:{
          required:true,
          digits:true,
        },
        cate_icon:{
          //required:true,
          //file: true,
        },
        sort:{
          //required:false,
          digits:true,
        },
      },
      messages:{
        cateName:{
          required:"栏目名称不能为空",
          rangelength:"栏目必须小于十个字"
        },
        typeID:{
          digits:"类型选择错误"
        },
        parentID:{
          required:"父类未选择",
          digits:"父类选择错误"
        },
        cate_icon:{
          file:"文件上传",
        },
        sort:{
          digits:"排序必须为数字",
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
          cate_name:$("#cateName").val(),
          type_id:$("#typeID").val(),
          parent_id:$("#parentID").val(),
          image:$("#cate_icon").val(),
          sort:$("#sort").val(),
        };
        $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $.ajax({
          type: "post",
          url: "{{ route('admin.classification.store') }}",
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