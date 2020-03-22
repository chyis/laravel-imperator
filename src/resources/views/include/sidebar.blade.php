<aside class="lyear-layout-sidebar">
    <!-- logo -->
    <div id="logo" class="sidebar-header">
        <a href="/"><img src="{{$staticDir}}/images/logo-sidebar.png" title="LightYear" alt="LightYear" /></a>
    </div>
    <div class="lyear-layout-sidebar-scroll">
        <nav class="sidebar-main">
            <ul class="nav nav-drawer">
                @foreach( $sideBar as $k=>$menu)
                <li class="nav-item @if(!empty($menu['child'])) nav-item-has-subnav @endif @if(strstr(Request()->path(), trim($menu['uri'], '/'))) active open @endif">
                    <a @if(!empty($menu['child'])) href="{{$menu['uri']}}" @else href="javascript:void(0);" @endif><i class="mdi {{$menu['icon']}}"></i> {{$menu['title']}}</a>
                    @if(!empty($menu['child']))
                        <ul class="nav nav-subnav">
                            @foreach( $menu['child'] as $h=>$m)
                            <li @if(strstr(Request()->path(), trim($m['uri'], '/')) !== false) class="active" @endif> <a href="{{$m['uri']}}">{{$m['title']}}</a> </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </nav>
        <div class="sidebar-footer">
            <p class="copyright">@yield('copyRight')</p>
        </div>
    </div>
</aside>
<script type="text/javascript">
    $(document).ready(function() {
        var menuOn = $(".nav-subnav li[class='active']");
        if (menuOn) {
            menuOn.parent().parent(".nav-item").addClass('active').addClass('open');
        }
    });
</script>
@section('copyRight')
    Copyright &copy; 2019. <a target="_blank" href="http://service.yuncongtec.com">云骢网</a> All rights reserved.
@stop
