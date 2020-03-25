@extends('Imperator::layouts.framework')

@section('pageTitle')
    模块管理 - 系统管理
@stop

@section('content')
    <!--页面主要内容-->
    <main class="lyear-layout-content">
        <div class="container-fluid">
            <div class="alert alert-info" role="alert">
                为指定页面扩展新模块，该模块的内容、形式包括链接地址均可自定义设置。详情请阅读 <a href="/admin/help/template">模块向导</a>。
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><h4>模块添加</h4></div>
                        <div class="card-body">
                            <h5>选择页面点击新建模块。</h5>
                            <div class="form-inline">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#creatModal" data-whatever="@mdo">新建模块 @</button>
                                </div>
                                <div class="form-group  has-info">
                                    <select class="form-control" name="page_id" id="page_id">
                                        <option value="">请选择页面</option>
                                        @foreach($pages as $page)
                                            <option value="{{$page->id}}">{{$page->var_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="modal fade" id="creatModal" tabindex="-1" role="dialog" aria-labelledby="creatModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title" id="creatModalLabel">新模块</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form id="mainForm" method="post" action="{{ URL:: route('admin.module.store') }}" class="site-form">
                                                <div class="form-group">
                                                    <label for="new_name" class="control-label">模块名称</label>
                                                    <input type="text" name="new_name" class="form-control" id="new_name">
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
                                                    <input type="text" name="new_length" class="form-control" id="new_length" value="" placeholder="" />
                                                </div>

                                                <div class="form-group">
                                                    <label for="new_content" class="control-label">模块内容</label>
                                                    <textarea class="form-control" id="new_content" placeholder="自定义填写html，具体类型填写ID（多个ID用“，”分割）"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                            <button type="button" id="create-btn" class="btn btn-primary">保存模块</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                @foreach($lists as $module)
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $module->page()->var_name }}-{{ $module->title }}</h4>
                            <ul class="card-actions">
                                <li>
                                    {{--<button type="button" data-toggle="tooltip" title="修改信息"><i class="mdi mdi-pencil"></i></button>--}}
                                    <a title="修改信息" href="{{ URL::route("admin.module.edit", $module->id) }}"><i class="mdi mdi-pencil"></i> </a>
                                </li>
                                <li class="dropdown">
                                    <button type="button" data-toggle="dropdown">更多 <span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li> <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">3</span> 更新内容</a> </li>
                                        <li> <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">1</span> 预览效果</a> </li>
                                        <li class="divider"></li>
                                        <li> <a tabindex="-1" href="javascript:void(0)">删除模块</a> </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- .card-actions -->
                        </div>
                        <div class="card-body">
                            {{ $module->type }} {{ $module->content }}
                        </div>
                    </div>
                </div>
                @endforeach

                {{--<div class="col-sm-6">--}}
                    {{--<div class="card">--}}
                        {{--<div class="card-header">--}}
                            {{--<h4>标题</h4>--}}
                            {{--<ul class="card-actions">--}}
                                {{--<li> <span>文本 1</span> </li>--}}
                                {{--<li> <span>文本 2</span> </li>--}}
                                {{--<li> <span>文本 3</span> </li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="card-body">--}}
                            {{--<p>内容...</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <!-- .col-sm-6 -->
            </div>
            <!-- .row -->
            <!-- End Cards with Actions -->

        </div>
    </main>
    <!--End 页面主要内容-->
@stop

@section('javascript')
@parent
<script type="text/javascript" src="{{$staticDir}}/js/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{$staticDir}}/js/extends/form.func.js"></script>
<script type="text/javascript" src="{{$staticDir}}/js/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="{{$staticDir}}/js/lightyear.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#mainForm").validate({
            errorElement : 'span',
            errorClass : 'help-block',
            rules:{
                new_name:{
                    required:true,
                    rangelength: [2,20],
                },
                new_type:{
                    required:true,
                    digits:true,
                },
                new_number:{
                    required:true
                },
                new_content:{
                    //required:false,
                    digits:true,
                },
            },
            messages:{
                new_name:{
                    required:"合作伙伴名称不能为空",
                    rangelength:"伙伴名称必须小于十个字"
                },
                new_type:{
                    required:"必须有类型选择",
                    digits:"选择错误"
                },
                new_number:{
                    required:"链接地址必须有"
                },
                new_content:{
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
                            $('#creatModal').modal('hide');
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
    $('#creatModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var pageName = $("#page_id").find("option:selected").text();
        var pageID = $("#page_id").find("option:selected").val();
        if (pageID == '') {
            error("请选择页面");
            return false;
        }
        var modal = $(this);
        modal.find('.modal-title').text('在“ ' + pageName + '” 新建模块');
    });
</script>
@stop

@section('stylesheet')
    @parent
    <link href="{{$staticDir}}/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="{{$staticDir}}/css/animate.css" rel="stylesheet">
@stop

@section('copyRight')
    Copyright &copy; 2019. <a target="_blank" href="http://service.yuncongtec.com">云骢网</a> All rights reserved.
@stop
