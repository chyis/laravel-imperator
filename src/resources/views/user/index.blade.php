@extends('Imperator::layouts.framework')

@section('pageTitle')
    用户列表 - 系统管理
@stop

@section('content')
    <!--页面主要内容-->
    <main class="kkadmin-layout-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-toolbar clearfix">
                            <form class="pull-right search-bar" method="get" action="{{ URL::route('admin.manager.index') }}" role="form">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input type="hidden" name="search_field" id="search-field" value="title">
                                        <button class="btn btn-default dropdown-toggle" id="search-btn" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
                                            登录名 <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li> <a tabindex="-1" href="javascript:void(0)" data-field="title">登录名</a> </li>
                                            <li> <a tabindex="-1" href="javascript:void(0)" data-field="cat_name">昵称</a> </li>
                                        </ul>
                                    </div>
                                    <input type="text" class="form-control" value="" name="keyword" placeholder="请输入名称">
                                </div>
                            </form>
                            <div class="toolbar-btn-action">
                                <a class="btn btn-primary m-r-5" href="{{ URL::route('admin.manager.create') }}"><i class="mdi mdi-plus"></i> 新增</a>
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
                                        <th>登录名</th>
                                        <th>昵称</th>
                                        <th>角色</th>
                                        <th>录入时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($lists as $value)
                                    <tr>
                                        <td>
                                            <label class="kkadmin-checkbox checkbox-primary">
                                                <input type="checkbox" name="ids[]" value="{{$value -> id}}"><span></span>
                                            </label>
                                        </td>
                                        <td>{{$value -> user_name}}</td>
                                        <td>{{$value -> nick_name}}</td>
                                        <td>{{ $value ->role->name }}</td>
                                        <td>{{$value -> created_at}}</td>
                                        <td><font class="text-success">正常</font></td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-xs btn-default" href="{{ URL::route('admin.manager.edit', $value->id) }}" title="编辑" data-toggle="tooltip"><i class="mdi mdi-pencil"></i></a>
                                                <a class="btn btn-xs btn-default" href="{{ URL::route('admin.manager.destroy', $value->id) }}" title="删除" data-toggle="tooltip"><i class="mdi mdi-window-close"></i></a>
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

@section('copyRight')
    Copyright &copy; 2019. <a target="_blank" href="http://service.yuncongtec.com">云骢网</a> All rights reserved.
@stop
