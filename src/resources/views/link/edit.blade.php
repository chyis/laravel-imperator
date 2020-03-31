@extends('Imperator::layouts.framework')

@section('pageTitle')
  合作伙伴修改
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
                <form id="mainForm" method="post" action="{{ URL:: route('admin.links.update', $entity->id) }}" class="site-form">
                  {{csrf_field()}}
                  <input name="_method" type="hidden" value="PUT">
                  <div class="form-group">
                    <label for="title">合作伙伴名称</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="栏目名称必须唯一" value="{{ $entity->title }}" />
                  </div>

                  <div class="form-group">
                    <label for="uri">链接地址</label>
                    <input class="form-control" type="text" id="uri" name="uri" value="{{ $entity->uri }}" />
                  </div>

                  <div class="form-group">
                    <label for="partner_icon">图标</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="partner_icon" id="partner_icon" placeholder="图标样式" value="{{ $entity->icon }}" />
                      <div class="input-group-btn">
                        <button class="btn btn-default file-btn" type="button">
                          <input widget-type="auto-upload" data-target="partner_icon" target-type="input" type="file" id="img-upload" name="img-upload" />
                          点击上传图片
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="description">描述</label>
                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="描述">{{ $entity->description }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="sort">排序</label>
                    <input class="form-control" type="text" id="sort" name="sort" value="{{ $entity->sort }}" />
                  </div>

                  <div class="form-group">
                    <label for="cate_id">合作伙伴类型</label>
                    <div class="form-controls">
                      <select name="cate_id" class="form-control" id="cate_id">
                        @foreach( $types as $type)
                          <option value="{{ $type->id }}" @if($entity->cate_id == $type->id) selected @endif>{{ $type->var_name }}</option>
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
  <script type="text/javascript" src="{{$staticDir}}/js/jquery-validate/jquery.validate.min.js"></script>
  <script type="text/javascript" src="{{$staticDir}}/js/extends/form.func.js"></script>
  <script type="text/javascript" src="{{$staticDir}}/js/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="{{$staticDir}}/js/kkadmin.js"></script>
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
        cate_id:{
          required:true,
          digits:true,
        },
        uri:{
          required:true
        },
        sort:{
          //required:false,
          digits:true,
        },
      },
      messages:{
        title:{
          required:"合作伙伴名称不能为空",
          rangelength:"伙伴名称必须小于十个字"
        },
        cate_id:{
          required:"必须有类型选择",
          digits:"选择错误"
        },
        uri:{
          required:"链接地址必须有"
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
          cate_id:$("#cate_id").val(),
          description:$("#description").val(),
          uri:$("#uri").val(),
          icon:$("#partner_icon").val(),
          sort:$("#sort").val(),
        };
        $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $.ajax({
          type: "put",
          url: "{{ route('admin.links.update', $entity->id) }}",
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