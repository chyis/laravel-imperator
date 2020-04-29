@extends('Imperator::layouts.framework')

@section('pageTitle')
    内容列表 - 内容管理
@stop

@section('content')
    <!--页面主要内容-->
    <main class="kkadmin-layout-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-toolbar clearfix">
                            <form class="pull-right search-bar" method="get" action="#!" role="form">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input type="hidden" name="search_field" id="search-field" value="order_no">
                                        <button class="btn btn-default dropdown-toggle" id="search-btn" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
                                            订单号 <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li> <a tabindex="-1" href="javascript:void(0)" data-field="order_no">订单号</a> </li>
                                            <li> <a tabindex="-1" href="javascript:void(0)" data-field="user_name">用户名</a> </li>
                                        </ul>
                                    </div>
                                    <input type="text" class="form-control" value="" name="keyword" placeholder="请输入关键字">
                                </div>
                            </form>
                            <div class="toolbar-btn-action">
                                <a class="btn btn-primary m-r-5" href="{{ URL::route('admin.orders.create') }}"><i class="mdi mdi-plus"></i> 新增</a>
                                <a class="btn btn-danger" href="javascript:listTable.deleteSlt();"><i class="mdi mdi-window-close"></i> 关闭</a>
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
                                        <th>订单号</th>
                                        <th>用户名</th>
                                        <th>下单时间</th>
                                        <th>物流状态</th>
                                        <th>订单状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody id="listTable">
                                    @forelse($lists as $value)
                                    <tr>
                                        <td>
                                            <label class="kkadmin-checkbox checkbox-primary">
                                                <input type="checkbox" name="ids[]" value="{{$value -> id}}"><span></span>
                                            </label>
                                        </td>
                                        <td>{{$value -> id}}</td>
                                        <td>{{$value -> no}}</td>
                                        <td>《{{ $value -> user -> user_name ?? '无下单人' }}》</td>
                                        <td>{{$value -> view_count}}</td>
                                        <td>@if($value->closed == 0) <font class="text-success">正常</font> @else <font class="text-error">关闭</font> @endif</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-xs btn-default" href="{{ URL::route('admin.orders.show', $value->id) }}" title="查看" data-toggle="tooltip"><i class="mdi mdi-pencil"></i></a>
                                                <a class="btn btn-xs btn-default" href="javascript:listTable.remove({{$value->id}});" title="删除" data-toggle="tooltip"><i class="mdi mdi-window-close"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr><td colspan="8" align="center">暂无数据</td></tr>
                                    @endforelse
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
    listTable.baseurl='{{ URL:: route('admin.orders.index')}}';//赋值url
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
