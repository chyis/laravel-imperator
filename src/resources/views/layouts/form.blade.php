<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>{{ $pageName }} - {{ $siteName }}</title>
    <link rel="icon" href="/favicon.ico" type="image/ico">
    <meta name="author" content="{{ $siteAuthor }}">
    @section('stylesheet')
    <link href="{{ $staticdir }}css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ $staticdir }}css/materialdesignicons.min.css" rel="stylesheet">
    <link href="{{ $staticdir }}css/style.min.css" rel="stylesheet">
    @show
    <script type="text/javascript" src="{{ $staticdir }}js/jquery.min.js"></script>
</head>

<body>
<div class="lyear-layout-web">
    <div class="lyear-layout-container">
    @section('sidebar')
        <!--左侧导航-->
        @include('admin.include.sidebar')
        <!--End 左侧导航-->
    @show

    @section('head')
        <!--头部信息-->
            <header class="lyear-layout-header">
                <nav class="navbar navbar-default">
                    <div class="topbar">

                        @include('admin.include.topbar-left')
                        @include('admin.include.topbar-right')

                    </div>
                </nav>
            </header>
            <!--End 头部信息-->
    @show

    @section('content')
        <!--页面主要内容-->
        <main class="lyear-layout-content">

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
    <script type="text/javascript" src="{{ $staticdir }}js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ $staticdir }}js/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="{{ $staticdir }}js/main.min.js"></script>
@show
</body>
</html>