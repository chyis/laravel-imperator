@extends('Imperator::layouts.framework')

@section('pageTitle')
    开发者配置 - 字典管理
@stop

@section('content')
    <!--页面主要内容-->
    <main class="kkadmin-layout-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-toolbar clearfix">
                            <form class="pull-right search-bar" method="get" action="{{ URL::route('admin.dictionary.index') }}" role="form">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input type="hidden" name="search_field" id="search-field" value="{{ empty($request['search_field']) ? 'name' : $request['search_field'] }}">
                                        <button class="btn btn-default dropdown-toggle" id="search-btn" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
                                            {{ isset($request['search_field']) && $request['search_field']=='name' ? '字典名称': '字典标识' }} <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li> <a tabindex="-1" href="javascript:void(0)" data-field="name">字典名称</a> </li>
                                            <li> <a tabindex="-1" href="javascript:void(0)" data-field="code">字典标识</a> </li>
                                        </ul>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $request['keyword'] ?? '' }}" name="keyword" placeholder="请输入名称">
                                </div>
                            </form>
                            <div class="toolbar-btn-action">
                                <a class="btn btn-primary m-r-5" href="{{ URL::route('admin.dictionary.create') }}"><i class="mdi mdi-plus"></i> 新增</a>
                                <a class="btn btn-success m-r-5" href="javascript:return enableSlt();"><i class="mdi mdi-check"></i> 启用</a>
                                <a class="btn btn-warning m-r-5" href="javascript:return disableSlt();"><i class="mdi mdi-block-helper"></i> 禁用</a>
                                <a class="btn btn-danger" href="javascript:return deleteSlt();"><i class="mdi mdi-window-close"></i> 删除</a>
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
                                        <th>字典名称</th>
                                        <th>字典标识</th>
                                        <th>字典类型</th>
                                        <th>创建时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($lists))
                                    @forelse($lists as $value)
                                    <tr>
                                        <td>
                                            <label class="kkadmin-checkbox checkbox-primary">
                                                <input type="checkbox" name="ids[]" value="{{$value -> id}}"><span></span>
                                            </label>
                                        </td>
                                        <td>{{$value -> id}}</td>
                                        <td>{{$value -> dirs}}{{$value -> var_name}} @if($value->type==0)[{{$value -> var_code}}]@endif</td>
                                        <td>{{$value -> var_value}}</td>
                                        <td>{{$value -> type_name}}</td>
                                        <td>{{$value -> created_at}}</td>
                                        <td>@if( $value->is_delete == 0)
                                            <font class="text-success">{{$value -> status_name}}</font>
                                            @else
                                            <font class="text-warning">{{$value -> status_name}}</font>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-xs btn-default" href="{{ URL::route('admin.dictionary.show', $value->id) }}" title="查看目录" data-toggle="tooltip"><i class="mdi mdi-search-web"></i></a>
                                                <a class="btn btn-xs btn-default" href="{{ URL::route('admin.dictionary.edit', $value->id) }}" title="编辑" data-toggle="tooltip"><i class="mdi mdi-pencil"></i></a>
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
    listTable.baseurl='{{ URL:: route('admin.dictionary.index')}}';//赋值url
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
