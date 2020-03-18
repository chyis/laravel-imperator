@extends('admin/layouts/framework')

@section('pageTitle')
  关于我们信息修改
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

                <form id="mainForm" method="post" action="{{ URL:: route('admin.about.update') }}" class="site-form">
                  {{csrf_field()}}
                  <input name="_method" type="hidden" value="PUT">
                  <input id="group_id" name="group_id" type="hidden" value="33">
                  <div class="form-group">
                    <label for="com_name">公司名称：</label>
                    <input type="text" class="form-control" name="setting[com_name]" id="com_name" placeholder="" value="{{$setting['com_name']}}" />
                  </div>

                  <div class="form-group">
                    <label for="com_logo">Logo：</label>
                    <input type="text" class="form-control" name="file[com_logo]" id="com_logo" value="{{$setting['com_logo']}}" />
                    <div class="input-group-btn"><button class="btn btn-default" type="button">上传图片</button></div>
                  </div>

                  <div class="form-group">
                    <label for="phone">电话：</label>
                    <input class="form-control" type="text" id="phone" name="setting[phone]" value="{{$setting['phone']}}" />
                  </div>

                  <div class="form-group">
                    <label for="address">地址：</label>
                    <input class="form-control" type="text" id="address" name="setting[address]" value="{{$setting['address']}}" />
                  </div>

                  <div class="form-group">
                    <label for="contact_name">联系人：</label>
                    <input class="form-control" type="text" id="contact_name" name="setting[contact_name]" value="{{$setting['contact_name']}}" />
                  </div>

                  <div class="form-group">
                    <label for="com_description">公司简介：</label>
                    <textarea class="form-control" id="com_description" name="setting[com_description]" rows="5" placeholder="描述">{{$setting['com_description']}}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="events">大事件：</label>

                  </div>

                  <button type="submit" class="btn btn-label btn-info">
                    <label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>
                    确认修改
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
  $(document).ready(function(){
    $("#mainForm").validate({
      errorElement : 'span',
      errorClass : 'help-block',
      rules:{
        setting:{
          required:true
        }
      },
      messages:{
        setting:{
          required:"配置信息不能为空"
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
        var arr = {
          com_name: $("#com_name").val(),
          com_logo: $("#com_logo").val(),
          phone: $("#phone").val(),
          address: $("#address").val(),
          contact_name: $("#contact_name").val(),
          com_description: $("#com_description").val()
        };
        let Data = {
          setting:arr,
          group_id:$("#group_id").val()
        };
        $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $.ajax({
          type: "put",
          url: "{{ route('admin.about.update') }}",
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

@section('copyRight')
  Copyright &copy; 2019. <a target="_blank" href="http://service.yuncongtec.com">云骢网</a> All rights reserved.
@stop
