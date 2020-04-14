<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <title> {{ __('imperator.login') }} - KKAdmin </title>
  <link rel="icon" href="{{ $staticDir }}/favicon.ico" type="image/ico">
  <link rel="shortcut icon" href="{{ $staticDir }}/favicon.ico" type="image/x-icon" />
  <meta name="author" content="">
  <link href="{{ $staticDir }}/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ $staticDir }}/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="{{ $staticDir }}/css/style.min.css" rel="stylesheet">
<style>
.kkadmin-wrapper {
    position: relative;
}
.kkadmin-login {
    display: flex !important;
    min-height: 100vh;
    align-items: center !important;
    justify-content: center !important;
}
.login-center {
    background: #fff;
    min-width: 38.25rem;
    padding: 2.14286em 3.57143em;
    border-radius: 5px;
    margin: 2.85714em 0;
}
.login-header {
    margin-bottom: 1.5rem !important;
}
.login-center .has-feedback.feedback-left .form-control {
    padding-left: 38px;
    padding-right: 12px;
}
.login-center .has-feedback.feedback-left .form-control-feedback {
    left: 0;
    right: auto;
    width: 38px;
    height: 38px;
    line-height: 38px;
    z-index: 4;
    color: #dcdcdc;
}
.login-center .has-feedback.feedback-left.row .form-control-feedback {
    left: 15px;
}
</style>
</head>
<body>
<div class="row kkadmin-wrapper">
  <div class="kkadmin-login">
    <div class="login-center">
      <div class="login-header text-center">
        <a href="http://www.yuncongtec.com"> <img alt="KK admin" src="{{ $staticDir }}/images/logo-sidebar.png"> </a>
      </div>
      @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form action="/admin/login" method="post" onsubmit="javascript::return checkLogin();">
        {{csrf_field()}}
        <div class="form-group has-feedback feedback-left">
          <input type="text" placeholder="{{ __('imperator.userName') }}" class="form-control" value="{{ old('user_name', '') }}" name="user_name" id="user_name" required />
          <span class="mdi mdi-account form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback feedback-left">
          <input type="password" placeholder="{{ __('imperator.password') }}" class="form-control" id="password" value="{{ old('password', '') }}" name="password" required />
          <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback feedback-left row">
          <div class="col-xs-7">
            <input type="text" name="captcha" class="form-control {{ $errors->has('captcha') ? ' is-invalid' : '' }}" placeholder="{{ __('imperator.captcha') }}" required />
            <span class="mdi mdi-check-all form-control-feedback" aria-hidden="true"></span>
          </div>
          <div class="col-xs-5">
            <img class="pull-right captchaImg" src="{{ captcha_src('flat') }}" onclick="this.src='{{ captcha_src('flat') }}?'+Math.random()" title="{{ __('imperator.reloadCaptcha') }}">
          </div>
        </div>
        <div class="form-group">
          <button class="btn btn-block btn-primary" type="submit">{{ __('imperator.login') }}</button>
        </div>
      </form>
      <hr>
      <footer class="col-sm-12 text-center">
        <p class="m-b-0">Copyright © 2019 <a href="http://service.yuncongtec.com">云骢网</a>. All right reserved</p>
      </footer>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ $staticDir }}/js/jquery.min.js"></script>
<script type="text/javascript" src="{{ $staticDir }}/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function checkLogin() {

      return true;
    }
</script>
</body>
</html>