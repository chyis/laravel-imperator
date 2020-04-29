@extends('Imperator::layouts.framework')

@section('pageTitle')
    分类管理 - 产品管理
@stop

@section('content')
    <!--页面主要内容-->
    <main class="kkadmin-layout-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-toolbar clearfix">
                            <form class="pull-right search-bar" method="get" action="{{ URL::route('admin.classification.index') }}" role="form">
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $request['keyword'] ?? '' }}" name="keyword" placeholder="请输入名称">
                                </div>
                            </form>
                            <div class="toolbar-btn-action">
                                <a class="btn btn-primary m-r-5" href="{{ URL::route('admin.classification.create') }}"><i class="mdi mdi-plus"></i> 新增</a>
                                <a class="btn btn-success m-r-5" href="javascript:listTable.enableSlt();"><i class="mdi mdi-check"></i> 启用</a>
                                <a class="btn btn-warning m-r-5" href="javascript:listTable.disableSlt();"><i class="mdi mdi-block-helper"></i> 禁用</a>
                                <a class="btn btn-danger" href="javascript:listTable.deleteSlt();"><i class="mdi mdi-window-close"></i> 删除</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>
                                            <label class="kkadmin-checkbox checkbox-primary">
                                                <input type="checkbox" id="check-all"><span></span>
                                            </label>
                                        </th>
                                        <th>编号</th>
                                        <th>分类名称</th>
                                        <th>内容类型</th>
                                        <th>录入人</th>
                                        <th>录入时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody id="listTable">
                                    @if(isset($lists))
                                    @forelse($lists as $value)
                                    <tr>
                                        <td>
                                            <label class="kkadmin-checkbox checkbox-primary">
                                                <input type="checkbox" name="ids[]" value="{{$value -> id}}"><span></span>
                                            </label>
                                        </td>
                                        <td>{{$value -> id}}</td>
                                        <td>{{$value -> cate_name}}</td>
                                        <td>- {{$value -> type_name}} -</td>
                                        <td>{{$value -> creat_user}}</td>
                                        <td>{{$value -> created_at}}</td>
                                        <td>@if( $value->is_delete == 0)
                                            <font class="text-success">{{$value -> status_name}}</font>
                                            @else
                                            <font class="text-warning">{{$value -> status_name}}</font>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-xs btn-default" href="{{ URL::route('admin.classification.edit', $value->id) }}" title="编辑" data-toggle="tooltip"><i class="mdi mdi-pencil"></i></a>
                                                <a class="btn btn-xs btn-default" href="javascript:listTable.remove({{$value->id}});" title="删除" data-toggle="tooltip"><i class="mdi mdi-window-close"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr><td colspan="8" align="center">暂无数据</td></tr>
                                    @endforelse
                                    @else
                                        <tr><td colspan="8" align="center">暂无数据</td></tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            @include('Imperator::include.pagination')
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
<script type="text/javascript" src="{{ $staticDir }}/js/kkadmin.js"></script>
<script type="text/javascript" src="{{ $staticDir }}/js/jquery-pagetool/jquery.pagetool.js"></script>
<script type="text/javascript">
    listTable.baseurl='{{ URL:: route('admin.classification.index')}}';//赋值url
    listTable.appendID="listTable";//赋值可append的div
    listTable.recordCount=100;//赋值总数
    listTable.pageCount = 10;//赋值页数
    listTable.page = 1;//赋值当前页
    listTable.filter.xx = "";//赋值参数
    $(function(){
        $('.search-bar .dropdown-menu a').click(function() {
            var field = $(this).data('field') || '';
            $('#search-field').val(field);
            $('#search-btn').html($(this).text() + ' <span class="caret"></span>');
        });
    });
    </script>
@stop

@section('copyRight')
    Copyright &copy; 2019. <a target="_blank" href="http://service.yuncongtec.com">云骢网</a> All rights reserved.
@stop