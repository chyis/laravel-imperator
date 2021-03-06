@extends('Imperator::layouts.framework')

@section('pageTitle')
    开发者配置 - 字典管理 - 字典添加
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
                <form method="post" id="mainForm" action="{{ URL:: route('admin.dictionary.store') }}" class="site-form">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="var_ame">字典名称</label>
                    <input type="text" class="form-control" name="var_name" id="var_name" placeholder="字典名称必须唯一" value="" />
                  </div>

                  <div class="form-group">
                    <label for="image">样式或图标</label>
                    <input type="text" class="form-control" name="image" id="image" placeholder="图标样式" value="" />
                    <input class="image-up-field" widget-type="auto-upload" data-target="image" target-type="input" type="file" id="dict_icon" name="dict_icon">
                  </div>

                  <div class="form-group">
                    <label for="root_id">字典类型</label>
                    <div class="form-controls">
                        <select name="root_id" class="form-control" id="root_id">
                          <option value="0" selected>新建根类型</option>
                          @foreach( $dictRoot as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->var_name }}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="form-group hidden" id="no-parent-attr">
                    <label for="var_code">字典标识</label>
                    <input type="text" class="form-control" name="var_code" id="var_code" placeholder="输入字典标识" value="" />
                  </div>

                  <div id="parent-attr" class="hidden">
                      <div class="form-group ">
                          <label for="parent_id">字典上级</label>
                          <div class="form-controls">
                              <select name="parent_id" class="form-control" id="parent_id">
                                  <option value="0">无上级</option>
                                  @foreach( $parents as $parent)
                                      <option value="{{ $parent->id }}">{{ $parent->var_name }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                    <div class="form-group">
                      <label for="var_value">字典值</label>
                      <input type="text" class="form-control" name="var_value" id="var_value" placeholder="输入字典值" value="" />
                    </div>

                    <div class="form-group">
                      <label for="sort">排序</label>
                      <input class="form-control" type="text" id="sort" name="sort" value="" />
                    </div>
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
<script type="text/javascript" src="{{ $staticDir }}/js/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{ $staticDir }}/js/extends/form.func.js"></script>
<script type="text/javascript" src="{{ $staticDir }}/js/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="{{ $staticDir }}/js/kkadmin.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#parent_id").find("option[value=0]").attr("selected",true);
    $("#root_id").find("option[value=0]").attr("selected",true);
    $("#no-parent-attr").removeClass('hidden');

    $("#mainForm").validate({
      errorElement : 'span',
      errorClass : 'help-block',
      rules:{
        var_name:{
          required:true,
          rangelength: [2,20],
        },
        var_code:{
          //required:true,
          rangelength: [2,20],
        },
        parentID:{
          required:true,
          digits:true,
        },
        var_value:{
          //required:true,
          rangelength: [2,20],
        },
        sort:{
          //required:false,
          digits:true,
        },
      },
      messages:{
        var_name:{
          required:"字典名称不能为空",
          rangelength:"名称必须小于十个字"
        },
        var_code:{
          rangelength:"标识必须小于十个字",
        },
        parentID:{
          required:"必须有parent选择",
          digits:"选择错误"
        },
        var_value:{
          rangelength:"字典值长度不正确",
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
            var_name:$("#var_name").val(),
            var_code:$("#var_code").val(),
            root_id:$("#root_id").val(),
            parent_id:$("#parent_id").val(),
            var_value:$("#var_value").val(),
            sort:$("#sort").val(),
          };
          $.ajaxSetup({
              headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
          });
          $.ajax({
              type: "post",
              url: "{{ route('admin.dictionary.store') }}",
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
    });
    $("#root_id").change(function () {
        var root_id = $(this).val();
        if (root_id == 0) {
            $("#no-parent-attr").removeClass('hidden');
            $("#parent-attr").addClass('hidden');
        } else {
            $("#no-parent-attr").addClass('hidden');
            $("#parent-attr").removeClass('hidden');
            var optionHtml = '<option selected value="0">无上级</option>';
            $.ajax({
                type: "get",
                url: "/admin/dictionary/"+ root_id+"/child",
                dataType: 'json',
                processData: false,
                contentType: "application/json;charset=UTF-8",
                cache: false,
                async : false,    //同步
                success:function (res) {
                    if(res.code==0) {
                        if (res.data){
                            $("#parent_id").empty();
                            $("#parent_id").append(optionHtml);
                            let data = res.data;
                            for (let i in data) {
                                $("#parent_id").append("<option value='"+data[i].id+"'>"+data[i].var_name+"</option>");
                            }
                        }
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
    });
  });

</script>
@endsection