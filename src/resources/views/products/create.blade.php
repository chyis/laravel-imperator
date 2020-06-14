@extends('Imperator::layouts.framework')

@section('stylesheet')
  @parent
@stop

@section('pageTitle')
  文章添加
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
              <form id="mainForm" action="{{ URL::route('admin.products.store') }}" method="post" class="site-form">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="cate_id">产品分类</label>
                  <div class="form-controls">
                      <select name="cate_id" class="form-control" id="cate_id">
                        <option value="0">分类选择</option>
                        @foreach( $category as $cate)
                          <option value="{{ $cate->id }}">{{ $cate->cate_name }}</option>
                        @endforeach
                      </select>
                      <a href="{{ URL::route('admin.classification.create') }}"> 添加新分类</a>
                  </div>
                </div>

                <div class="form-group">
                  <label for="title">产品名称</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="请输入产品名称" />
                </div>

                <div class="form-group">
                  <label for="description">描述</label>
                  <textarea class="form-control" id="description" name="description" rows="5" placeholder="描述">{{old('description')}}</textarea>
                </div>

                <div class="form-group">
                  <label for="content">详细描述</label>
                  @include('Imperator::include.ckEditor')
                </div>

                <div class="form-group">
                  <label for="image">封面图</label>
                  <input class="form-control" type="text" id="image" name="image" value="">
                  <input class="image-up-field" widget-type="auto-upload" data-target="image" target-type="input" type="file" id="img-upload" name="img-upload">
                </div>

                <div class="form-group">
                  <label>图册</label>
                  <div class="form-controls">

                    <ul class="list-inline clearfix kkadmin-uploads-pic" id="multi_pic">
                      <li class="col-xs-4 col-sm-3 col-md-2">
                        <figure>
                          <img src="/uploads/gallery/15.jpg" alt="图片一">
                          <figcaption>
                            <a class="btn btn-round btn-square btn-primary" href="#!"><i class="mdi mdi-eye"></i></a>
                            <a class="btn btn-round btn-square btn-danger" href="#!"><i class="mdi mdi-delete"></i></a>
                          </figcaption>
                        </figure>
                      </li>
                      <li class="col-xs-4 col-sm-3 col-md-2">
                        <a class="pic-add" id="add-pic-btn" href="javascript:multi_up();" title="点击上传">
                        </a>
                        <input id="multi_up" multiple accept="image/*" class="hidden" widget-type="multi-upload" data-target="multi_pic" type="file" name="target_upload" value="" />
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="form-group">
                  <label for="org_price">市价</label>
                  <input type="text" class="form-control" id="org_price" name="org_price" value="{{old('org_price')}}" placeholder="市场价格" />
                </div>

                <div class="form-group">
                  <label for="price">售价</label>
                  <input type="text" class="form-control" id="price" name="price" value="{{old('price')}}" placeholder="销售价格" />
                </div>

                <div class="form-group">
                  <label for="status">状态</label>
                  <div class="clearfix">
                    <label class="kkadmin-radio radio-inline radio-primary">
                      <input type="radio" name="on_sale" value="-1"><span>下架</span>
                    </label>

                    <label class="kkadmin-radio radio-inline radio-primary">
                      <input type="radio" name="on_sale" value="1"><span>上架</span>
                    </label>

                    <label class="kkadmin-radio radio-inline radio-primary">
                      <input type="radio" name="on_sale" value="0"><span>草稿</span>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary ajax-post" target-form="add-form">确 定</button>
                  <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">返 回</button>
                </div>

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
            rangelength: [2,50],
          },
          cate_id:{
            required:true,
            digits:true,
          },
          description:{
            required:true
          },
          content:{
            required:true
          },
          org_price:{
            required:true,
            digits:true,
          },
          price:{
            required:true,
            digits:true,
          },
          on_sale:{
            required:false,
            digits:true,
          },
        },
        messages:{
          title:{
            required:"标题不能为空",
            rangelength:"标题必须小于十个字"
          },
          content:{
            required:"菜单类型必须选择",
          },
          cate_id:{
            required:"必须有parent选择",
            digits:"选择错误"
          },
          on_sale:{
            required:"必须有类型选择",
            digits:"选择错误"
          },
          price:{
            digits:"价格填写错误",
          },
          org_price:{
            digits:"市场价格填写错误",
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
            title:$("#title").val(),
            cate_id:$("#cate_id").val(),
            description:$("#description").val(),
            image:$("#image").val(),
            content:$("#content").val(),
            price:$("#price").val(),
            org_price:$("#org_price").val(),
            on_sale:$('input[name="on_sale"]:checked').val()
          };
          alert($('input[name="on_sale"]:checked').val());
          $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
          });
          $.ajax({
            type: "post",
            url: "{{ route('admin.products.store') }}",
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
@stop
