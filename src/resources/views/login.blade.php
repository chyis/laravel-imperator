<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <title>登录页- </title>
  <link rel="icon" href="/favicon.ico" type="image/ico">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
  <meta name="author" content="">
  <link href="{{ $staticDir }}css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ $staticDir }}css/materialdesignicons.min.css" rel="stylesheet">
  <link href="{{ $staticDir }}css/style.min.css" rel="stylesheet">
<style>
.lyear-wrapper {
    position: relative;
}
.lyear-login {
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
<div class="row lyear-wrapper">
  <div class="lyear-login">
    <div class="login-center">
      <div class="login-header text-center">
        <a href="index.html"> <img alt="light year admin" src="{{ $staticDir }}images/logo-sidebar.png"> </a>
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
          <input type="text" placeholder="请输入您的用户名" class="form-control" value="{{ old('user_name', '') }}" name="user_name" id="user_name" required />
          <span class="mdi mdi-account form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback feedback-left">
          <input type="password" placeholder="请输入密码" class="form-control" id="password" value="{{ old('password', '') }}" name="password" required />
          <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback feedback-left row">
          <div class="col-xs-7">
            <input type="text" name="captcha" class="form-control {{ $errors->has('captcha') ? ' is-invalid' : '' }}" placeholder="验证码" required />
            <span class="mdi mdi-check-all form-control-feedback" aria-hidden="true"></span>
          </div>
          <div class="col-xs-5">
            <img class="pull-right captchaImg" src="{{ captcha_src('flat') }}" onclick="this.src='{{ captcha_src('flat') }}?'+Math.random()" title="点击图片重新获取验证码">
          </div>
        </div>
        <div class="form-group">
          <button class="btn btn-block btn-primary" type="submit">立即登录</button>
        </div>
      </form>
      <hr>
      <footer class="col-sm-12 text-center">
        <p class="m-b-0">Copyright © 2019 <a href="http://service.yuncong.com">云骢网</a>. All right reserved</p>
      </footer>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ $staticDir }}js/jquery.min.js"></script>
<script type="text/javascript" src="{{ $staticDir }}js/bootstrap.min.js"></script>
<script type="text/javascript">
    function checkLogin() {

      return true;
    }
</script>
</body>
</html>