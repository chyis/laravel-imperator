@extends('Imperator::layouts.framework')

@section('pageTitle')
    信息管理 - 信息反馈
@stop

@section('content')
    <!--页面主要内容-->
    <main class="kkadmin-layout-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-toolbar clearfix">
                            <form class="pull-right search-bar" method="get" action="{{ URL::route('admin.contact.index') }}" role="form">
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $request['keyword'] ?? '' }}" name="keyword" placeholder="请输入用户名称">
                                </div>
                            </form>
                            <div class="toolbar-btn-action">
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
                                        <th>联系人</th>
                                        <th>电话</th>
                                        <th>咨询类型</th>
                                        <th>咨询时间</th>
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
                                        <td>{{$value -> username}}</td>
                                        <td>- {{$value -> phone}} -</td>
                                        <td>{{$value -> type_name}}</td>
                                        <td>{{$value -> created_at}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-xs btn-default" href="{{ URL::route('admin.contact.destroy', $value->id) }}" title="删除" data-toggle="tooltip"><i class="mdi mdi-window-close"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr><td colspan="7" align="center">暂无数据</td></tr>
                                    @endforelse
                                    @else
                                        <tr><td colspan="7" align="center">暂无数据</td></tr>
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
<script type="text/javascript">
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
