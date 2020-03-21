@extends('admin/layouts/framework')

@section('pageTitle')
  合作伙伴添加
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
                <form id="mainForm" method="post" action="{{ URL:: route('admin.links.store') }}" class="site-form">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="title">合作伙伴名称</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="合作伙伴名称必须唯一" value="{{old('title', '')}}" />
                  </div>

                  <div class="form-group">
                    <label for="uri">链接地址</label>
                    <input class="form-control" type="text" id="uri" name="uri" value="{{old('uri', '')}}" />
                  </div>

                  <div class="form-group">
                    <label for="sort">排序</label>
                    <input class="form-control" type="text" id="sort" name="sort" value="{{old('sort', '')}}" />
                  </div>

                  <div class="form-group">
                    <label for="partner_icon">菜单图标</label>
                    <input type="text" class="form-control" name="partner_icon" id="partner_icon" placeholder="图标样式" value="" />
                    <input type="file" id="file_icon" name="file_icon">
                  </div>

                  <div class="form-group col-md-12">
                    <label for="description">描述</label>
                    <textarea class="form-control" id="description" name="description" rows="5" value="" placeholder="描述"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="cateID">合作伙伴类型</label>
                    <div class="form-controls">
                      <select name="cateID" class="form-control" id="cateID">
                        @foreach($types as $type)
                        <option value="{{$type->id}}" attr-code="{{$type->code}}">{{$type->var_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-label btn-info">
                    <label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>
                    保存
                  </button>

                  <button class="btn btn-label btn-warning" type="button" onclick="javascript:history.back(1);"><label><i class="mdi mdi-page-first"></i></label> 返回</button>
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
      $("#parentID").find("option[value=0]").attr("selected",true);
      $("#no-parent-attr").removeClass('hidden');

      $("#mainForm").validate({
        errorElement : 'span',
        errorClass : 'help-block',
        rules:{
          title:{
            required:true,
            rangelength: [2,20],
          },
          cateID:{
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
          cateID:{
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
            cate_id:$("#cateID").val(),
            description:$("#description").val(),
            uri:$("#uri").val(),
            icon:$("#partner_icon").val(),
            sort:$("#sort").val(),
          };
          $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
          });
          $.ajax({
            type: "post",
            url: "{{ route('admin.links.store') }}",
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