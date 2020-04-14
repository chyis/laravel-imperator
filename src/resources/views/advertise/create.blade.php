@extends('Imperator::layouts.framework')

@section('pageTitle')
  广告添加
@stop

@section('stylesheet')
  @parent
  <!--时间选择插件-->
  <link rel="stylesheet" href="{{ $staticDir }}/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
  <!--日期选择插件-->
  <link rel="stylesheet" href="{{ $staticDir }}/js/bootstrap-datepicker/bootstrap-datepicker3.min.css">
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
                <form id="mainForm" method="post" action="{{ URL:: route('admin.advertise.store') }}" class="site-form">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="title">广告名称</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="广告的名字，不做展示" value="{{old('title', '')}}" />
                  </div>

                  <div class="form-group">
                    <label for="start_time">开始时间</label>
                    <input class="form-control js-datetimepicker" type="text" id="start_time" name="start_time"
                           placeholder="请选择具体时间" value="" data-side-by-side="true" data-locale="zh-cn" data-format="YYYY-MM-DD HH:mm" />
                  </div>

                  <div class="form-group">
                    <label for="end_time">结束时间</label>
                    <input class="form-control js-datetimepicker" type="text" id="end_time" name="end_time"
                           placeholder="请选择具体时间" value="" data-side-by-side="true" data-locale="zh-cn" data-format="YYYY-MM-DD HH:mm" />
                  </div>

                  <div class="form-group">
                    <label for="type">广告类型</label>
                    <div class="form-controls">
                      <select name="type" class="form-control" id="type">
                        @foreach($types as $type)
                          <option value="{{$type->var_value}}" attr-id="{{$type->id}}">{{$type->var_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group link-group">
                    <label for="url">链接地址</label>
                    <input class="form-control" type="text" id="url" name="url" placeholder="http://" value="{{old('url', '')}}" />
                  </div>

                  <div class="form-group file-group">
                    <label for="file">广告图</label>
                      <input type="text" class="form-control" name="file" id="file" value="">
                      <input class="image-up-field" widget-type="auto-upload" data-target="file" target-type="input" type="file" type="file" id="dict_icon" name="dict_icon">

                  </div>

                  <div class="form-group src-group">
                    <label for="src">代码</label>
                    <textarea  class="form-control" rows="5" name="src" id="src">{{old('src', '')}}</textarea>
                  </div>

                  <div class="form-group text-group">
                    <label for="text">文字</label>
                    <textarea  class="form-control" rows="5" name="text" id="text">{{old('text', '')}}</textarea>
                  </div>

                  <button type="submit" class="btn btn-label btn-info">
                    <label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>
                    保存
                  </button>

                  <button class="btn btn-label btn-warning" type="button" onclick="javascript:history.back(-1);"><label><i class="mdi mdi-page-first"></i></label> 返回</button>
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
  <script type="text/javascript" src="{{ $staticDir }}/js/jquery-validate/jquery.validate.min.js"></script>
  <script type="text/javascript" src="{{ $staticDir }}/js/extends/form.func.js"></script>
  <script type="text/javascript" src="{{ $staticDir }}/js/bootstrap-notify.min.js"></script>
  <script src="{{ $staticDir }}/js/bootstrap-datetimepicker/moment.min.js"></script>
  <script src="{{ $staticDir }}/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
  <script src="{{ $staticDir }}/js/bootstrap-datetimepicker/locale/zh-cn.js"></script>
  <script type="text/javascript" src="{{ $staticDir }}/js/kkadmin.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      function changeType() {
        let type = $("#type").find('option:selected').val();
        let link = $(".link-group");
        let file = $(".file-group");
        let text = $(".text-group");
        let src = $(".src-group");
        if (type == 'src') {
          src.show();
          link.hide();
          file.hide();
          text.hide();
        } else if(type == 'text') {
          src.hide();
          link.show();
          file.hide();
          text.show();
        } else if(type == 'image') {
          src.hide();
          link.show();
          file.show();
          text.hide();
        } else {
          src.show();
          link.show();
          file.show();
          text.hide();
        }
      };
      changeType();
      $("#type").change(function () {
        changeType();
      });
      $("#mainForm").validate({
        errorElement : 'span',
        errorClass : 'help-block',
        rules:{
          title:{
            required:true,
            rangelength: [2,20],
          },
          type:{
            required:true
          },
          url:{
            required:true
          },
          text:{
            required:true
          }
        },
        messages:{
          title:{
            required:"名称不能为空",
            rangelength:"名称必须小于十个字"
          },
          type:{
            required:"类型必须选择",
          },
          url:{
            required:"URL必须有"
          },
          text:{
            required:"未填写文字"
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
            type:$("#type").val(),
            url:$("#url").val(),
            image:$("#file").val(),
            text:$("#text").val(),
            src:$("#src").val(),
            start_time:$("#start_time").val(),
            end_time:$("#end_time").val()
          };
          $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
          });
          $.ajax({
            type: "post",
            url: "{{ route('admin.advertise.store') }}",
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