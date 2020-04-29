@extends('Imperator::layouts.framework')

@section('pageTitle')
  栏目修改
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
                <form id="mainForm" method="post" action="{{ URL:: route('admin.attributes.update', $entity->id) }}" class="site-form">
                  {{csrf_field()}}
                  <input name="_method" type="hidden" value="PUT">
                    <div class="form-group">
                        <label for="field_title">配置项名称</label>
                        <input type="text" class="form-control" name="field_title" id="field_title" placeholder="栏目名称必须唯一" value="{{$entity->title}}" />
                    </div>

                    <div class="form-group">
                        <label for="field_groupID">配置项分组</label>
                        <div class="form-controls">
                            <select name="field_groupID" class="form-control" id="field_groupID">
                                @foreach( $types as $type)
                                    <option value="{{ $type->id }}" @if($type->id == $entity->group_id) selected @endif>{{ $type->var_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field_code">开发标识</label>
                        <input class="form-control" type="text" id="field_code" name="field_code" placeholder="英文标识" value="{{$entity->code}}">
                    </div>

                    <div class="form-group">
                        <label for="field_input_type">输入方式</label>
                        <div class="form-controls">
                            <select name="field_input_type" class="form-control" id="field_input_type">
                                @foreach( $inputTypes as $code=>$name)
                                    <option value="{{ $code }}" @if($entity->input_type == $code) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group source-group">
                        <label for="field_data_source">数据来源</label>
                        <div class="form-controls">
                      <textarea class="form-control" id="field_data_source" name="field_data_source" rows="5"  placeholder="Model:App/models/xx::class,key,value
或者
key1,value1:selected
key1,value1
...">{{$entity->data_source}}</textarea>
                        </div>
                    </div>

                    <div class="form-group validate-group">
                        <label for="field_validate">验证函数</label>
                        <input class="form-control" type="text" id="field_validate" name="field_validate" placeholder="validate方式: min:20|max:100|..." value="{{$entity->validate}}">
                    </div>

                    <div class="form-group default-value-group">
                        <label for="field_default_value">默认值</label>
                        <input class="form-control" type="text" id="field_default_value" name="field_default_value" placeholder="" value="{{$entity->default_value}}">
                    </div>

                    <div class="form-group order-group">
                        <label for="field_order">排序</label>
                        <input class="form-control" type="text" id="field_order" name="field_order" placeholder="" value="{{$entity->order}}">
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
  <script type="text/javascript" src="{{$staticDir}}/js/jquery-validate/jquery.validate.min.js"></script>
  <script type="text/javascript" src="{{$staticDir}}/js/extends/form.func.js"></script>
  <script type="text/javascript" src="{{$staticDir}}/js/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="{{$staticDir}}/js/kkadmin.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
      function setInputType() {
          let type = $("#field_input_type").val();
          if (in_array(type, Array('select', 'checkbox', 'radio', 'switch'))){
              $(".source-group").show();
              $(".validate-group").hide();
              $(".default-value-group").hide();
          } else {
              $(".source-group").hide();
              $(".validate-group").show();
              $(".default-value-group").show();
          }
      };
      $('#field_input_type').change(function () {
          setInputType();
      });
      setInputType();
    $("#mainForm").validate({
        errorElement : 'span',
        errorClass : 'help-block',
        rules:{
            field_title:{
                required:true,
                rangelength: [2,20],
            },
            field_groupID:{
                required:true,
                digits:true,
            },
            field_code:{
                required:true
            },
            field_input_type:{
                required:true
            },
        },
        messages:{
            field_title:{
                required:"栏目名称不能为空",
                rangelength:"栏目必须小于十个字"
            },
            field_groupID:{
                digits:"类型选择错误"
            },
            field_code:{
                required:"父类未选择",
                digits:"父类选择错误"
            },
            field_input_type:{
                required:"输入类型必须填",
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
                title:$("#field_title").val(),
                group_id:$("#field_groupID").val(),
                code:$("#field_code").val(),
                input_type:$("#field_input_type").val(),
                data_source:$("#field_data_source").val(),
                validate:$("#field_validate").val(),
                order:$("#field_order").val(),
                default_value:$("#field_default_value").val()
            };
        $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $.ajax({
          type: "put",
          url: "{{ route('admin.config.update', $entity->id) }}",
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