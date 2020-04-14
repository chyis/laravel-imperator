<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>{{ $pageName }} - {{ $siteName }}</title>
    <link rel="icon" href="/favicon.ico" type="image/ico">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <meta name="author" content="{{ $siteAuthor }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('stylesheet')
    <link href="{{$staticDir}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{$staticDir}}/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="{{$staticDir}}/css/style.min.css" rel="stylesheet">
    @show
    <script type="text/javascript" src="{{$staticDir}}/js/jquery.min.js"></script>
</head>
<body>
<div class="kkadmin-layout-web">
    <div class="kkadmin-layout-container">
        @section('sidebar')
            <!-- Start left side bar-->
            @include('Imperator::include.sidebar')
            <!--End left side bar-->
        @show

        @section('head')
        <!-- Head information-->
        <header class="kkadmin-layout-header">
            <nav class="navbar navbar-default">
                <div class="topbar">
                    @include('Imperator::include.topbar-left')
                    @include('Imperator::include.topbar-right')
                </div>
            </nav>
        </header>
        <!--End head information-->
        @show

        @section('content')
        <!-- main content -->
        <main class="kkadmin-layout-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-toolbar clearfix">
                                <form class="pull-right search-bar" method="get" action="#!" role="form">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input type="hidden" name="search_field" id="search-field" value="title">
                                            <button class="btn btn-default dropdown-toggle" id="search-btn" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
                                                标题 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li> <a tabindex="-1" href="javascript:void(0)" data-field="title">标题</a> </li>
                                                <li> <a tabindex="-1" href="javascript:void(0)" data-field="cat_name">栏目</a> </li>
                                            </ul>
                                        </div>
                                        <input type="text" class="form-control" value="" name="keyword" placeholder="请输入名称">
                                    </div>
                                </form>
                                <div class="toolbar-btn-action">
                                    <a class="btn btn-primary m-r-5" href="#!"><i class="mdi mdi-plus"></i> 新增</a>
                                    <a class="btn btn-success m-r-5" href="#!"><i class="mdi mdi-check"></i> 启用</a>
                                    <a class="btn btn-warning m-r-5" href="#!"><i class="mdi mdi-block-helper"></i> 禁用</a>
                                    <a class="btn btn-danger" href="#!"><i class="mdi mdi-window-close"></i> 删除</a>
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
                                            <th>标题</th>
                                            <th>状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <label class="kkadmin-checkbox checkbox-primary">
                                                    <input type="checkbox" name="ids[]" value="1"><span></span>
                                                </label>
                                            </td>
                                            <td><font class="text-success">正常</font></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-xs btn-default" href="#!" title="编辑" data-toggle="tooltip"><i class="mdi mdi-pencil"></i></a>
                                                    <a class="btn btn-xs btn-default" href="#!" title="删除" data-toggle="tooltip"><i class="mdi mdi-window-close"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <ul class="pagination">
                                    <li class="disabled"><span>«</span></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#1">2</a></li>
                                    <li><a href="#1">3</a></li>
                                    <li><a href="#1">8</a></li>
                                    <li class="disabled"><span>...</span></li>
                                    <li><a href="#!">14452</a></li>
                                    <li><a href="#!">14453</a></li>
                                    <li><a href="#!">»</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </main>
        <!--End main content-->
        @show
    </div>
</div>


@section('javascript')
<script type="text/javascript" src="{{$staticDir}}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{$staticDir}}/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="{{$staticDir}}/js/main.min.js"></script>
<script type="text/javascript" src="{{$staticDir}}/js/extends/table.func.js"></script>
<script type="text/javascript">
    $(function(){
        $('.search-bar .dropdown-menu a').click(function() {
            var field = $(this).data('field') || '';
            $('#search-field').val(field);
            $('#search-btn').html($(this).text() + ' <span class="caret"></span>');
        });
    });
</script>
@show
</body>
</html>