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