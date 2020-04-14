<ul class="topbar-right">
    <li class="dropdown dropdown-profile">
        <a href="javascript:void(0)" data-toggle="dropdown">
            <img class="img-avatar img-avatar-48 m-r-10" src="{{$staticDir}}/images/sample/users/avatar.jpg" alt="{{$loginUser->nick_name}}" />
            <span>{{$loginUser->nick_name}}<span class="caret"></span></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
            <li> <a href="{{ URL::route('admin.profile') }}"><i class="mdi mdi-account"></i> {{ __('imperator.userConfig') }}</a> </li>
            <li> <a href="{{ URL::route('admin.password') }}"><i class="mdi mdi-lock-outline"></i> {{ __('imperator.modify') }}{{ __('imperator.password') }}</a> </li>
            <li class="divider"></li>
            <li> <a href="{{ URL::route('admin.logout') }}"><i class="mdi mdi-logout-variant"></i> {{ __('imperator.logout') }}</a> </li>
        </ul>
    </li>
</ul>