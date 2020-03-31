@extends('Imperator::layouts.framework')

@section('pageTitle')
    字典添加
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
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" id="mainForm" action="{{ URL:: route('admin.module.store') }}"
                                  class="site-form">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="var_ame">模块名称</label>
                                    <input type="text" name="new_name" class="form-control" id="new_name">
                                </div>

                                <div class="form-group">
                                    <label for="new_page_id">请选择页面</label>
                                    <div class="form-controls">
                                        <select class="form-control" name="new_page_id" id="new_page_id">
                                            <option value="">请选择页面</option>
                                            @foreach($pages as $page)
                                                <option value="{{$page->id}}">{{$page->var_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="new_type" class="control-label"> 内容来源</label>
                                    <select class="form-control" name="new_type" id="new_type">
                                        <option value="">请选择模块内容来源</option>
                                        <option value="hot-news">最热新闻</option>
                                        <option value="top-news">推荐新闻</option>
                                        <option value="fast-news">最新新闻</option>
                                        <option value="article">自定义新闻</option>
                                        <option value="advertise">自定义广告</option>
                                        <option value="manual">自定义html</option>
                                        <option value="top-goods">推荐产品 [未开启]</option>
                                        <option value="new-goods">最新产品 [未开启]</option>
                                        <option value="goods">自定义产品 [未开启]</option>
                                        <option value="top-service">推荐服务 [未开启]</option>
                                        <option value="service">自定义服务 [未开启]</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="new_length" class="control-label">条目</label>
                                    <input type="text" name="new_length" class="form-control" id="new_length" value=""
                                           placeholder=""/>
                                </div>

                                <div class="form-group">
                                    <label for="new_content" class="control-label">模块内容</label>
                                    <textarea class="form-control" id="new_content" rows="4"
                                              placeholder="自定义填写html，具体类型填写ID（多个ID用“，”分割）"></textarea>
                                </div>

                                <button type="submit" class="btn btn-label btn-info">
                                    <label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>
                                    保存
                                </button>

                                <button class="btn btn-label btn-warning" type="button"
                                        onclick="javascript:history.back(1);">
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
        $(document).ready(function () {
            $("#parentID").find("option[value=0]").attr("selected", true);
            $("#no-parent-attr").removeClass('hidden');

            $("#mainForm").validate({
                errorElement: 'span',
                errorClass: 'help-block',
                rules: {
                    new_name: {
                        required: true,
                        rangelength: [2, 20]
                    },
                    new_page_id: {
                        required:true
                    },
                    new_type: {
                        required:true
                    }
                },
                messages: {
                    new_name: {
                        required: "模块名称不能为空",
                        rangelength: "模块名称必须小于十个字"
                    },
                    new_page_id: {
                        required: "页面必须选择",
                    },
                    new_type: {
                        required: "模块类型不能为空",
                    }
                },
                errorPlacement: function (error, element) {
                    element.next().remove();
                    element.after('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error has-feedback');
                },
                success: function (label) {
                    var el = label.closest('.form-group').find("input");
                    el.next().remove();
                    el.after('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>');
                    label.closest('.form-group').removeClass('has-error').addClass("has-feedback has-success");
                    label.remove();
                },
                submitHandler: function (form) {
                    let Data = {
                        title: $("#new_name").val(),
                        page_id: $("#new_page_id").val(),
                        type: $("#new_type").val(),
                        content: $("#new_content").val(),
                        length: $("#new_length").val(),
                    };
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                    });
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.module.store') }}",
                        dataType: 'json',
                        processData: false,
                        contentType: "application/json;charset=UTF-8",
                        cache: false,
                        data: JSON.stringify(Data),
                        async: false,    //同步
                        success: function (res) {
                            if (res.code == 0) {
                                success(res.msg);
                            } else if (res.code > 0) {
                                error(res.msg);
                            } else {
                                alert(res.code);
                            }
                        },
                        //请求失败，包含具体的错误信息
                        error: function (e) {
                            error("error occurred!");
                        }
                    });
                }
            })
        });

        function onSelectParent() {
            var parentID = $("#parent_id").val();
            if (parentID == 0) {
                $("#no-parent-attr").removeClass('hidden');
                $("#parent-attr").addClass('hidden');
            } else {
                $("#no-parent-attr").addClass('hidden');
                $("#parent-attr").removeClass('hidden');
            }
        }
    </script>
@endsection