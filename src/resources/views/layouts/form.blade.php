<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>{{ $pageName }} - {{ $siteName }}</title>
    <link rel="icon" href="/favicon.ico" type="image/ico">
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
        <!--左侧导航-->
        @include('Imperator::include.sidebar')
        <!--End 左侧导航-->
    @show

    @section('head')
        <!--头部信息-->
            <header class="kkadmin-layout-header">
                <nav class="navbar navbar-default">
                    <div class="topbar">

                        @include('Imperator::include.topbar-left')
                        @include('Imperator::include.topbar-right')

                    </div>
                </nav>
            </header>
            <!--End 头部信息-->
    @show

    @section('content')
        <!--页面主要内容-->
        <main class="kkadmin-layout-content">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                @yield('form')

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </main>
        <!--End 页面主要内容-->
        @show
    </div>
</div>

@section('javascript')
    <script type="text/javascript" src="{{$staticDir}}/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{$staticDir}}/js/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="{{$staticDir}}/js/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="{{$staticDir}}/js/kkadmin.js"></script>
    <script type="text/javascript" src="{{$staticDir}}/js/main.min.js"></script>
@show
</body>
</html>