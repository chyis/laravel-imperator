@extends('Imperator::layouts.form')

@section('stylesheet')
  @parent
  <!--标签插件-->
  <link rel="stylesheet" href="{{ $staticDir }}js/jquery-tags-input/jquery.tagsinput.min.css">
@stop

@section('pageTitle')
  基本配置 - 配置管理
@stop

@section('content')
  <!--页面主要内容-->
  <main class="lyear-layout-content">

    <div class="container-fluid">

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <ul class="nav nav-tabs page-tabs">
              <li class="active"> <a href="javascript:void(0);">基本</a> </li>
              <li> <a href="{{ URL::route('admin.setting-system') }}">系统</a> </li>
              <li> <a href="{{ URL::route('admin.setting-upload') }}">上传</a> </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">
                <form action="{{ URL::route('admin.setting-update') }}" method="post" name="edit-form" class="edit-form">
                  {{csrf_field()}}
                  <input name="_method" type="hidden" value="PUT">
                  <input name="group_id" type="hidden" value="34">
                  <div class="form-group">
                    <label for="site_name">网站标题</label>
                    <input class="form-control" type="text" id="site_name" name="setting[site_name]" value="{{$setting['site_name']}}" placeholder="请输入站点标题" >
                    <small class="help-block">调用方式：<code>config('web_site_title')</code></small>
                  </div>
                  <div class="form-group">
                    <label for="site_logo">LOGO图片</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="setting[site_logo]" id="site_logo" value="{{$setting['site_logo']}}" />
                      <div class="input-group-btn"><button class="btn btn-default" type="button">上传图片</button></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="site_keywords">站点关键词</label>
                    <input class="form-control" type="text" id="site_keywords" name="setting[site_keywords]" value="{{$setting['site_keywords']}}" placeholder="请输入站点关键词" >
                    <small class="help-block">网站搜索引擎关键字</small>
                  </div>
                  <div class="form-group">
                    <label for="site_description">站点描述</label>
                    <textarea class="form-control" id="site_description" rows="5" name="setting[site_description]" placeholder="请输入站点描述" >{{$setting['site_description']}}</textarea>
                    <small class="help-block">网站描述，有利于搜索引擎抓取相关信息</small>
                  </div>
                  <div class="form-group">
                    <label for="site_copyright">版权信息</label>
                    <input class="form-control" type="text" id="site_copyright" name="setting[site_copyright]" value="{{$setting['site_copyright']}}" placeholder="请输入版权信息" >
                    <small class="help-block">调用方式：<code>config('site_copyright')</code></small>
                  </div>
                  <div class="form-group">
                    <label for="web_site_icp">备案信息</label>
                    <input class="form-control" type="text" id="site_icp" name="setting[site_icp]" value="{{$setting['site_icp']}}" placeholder="请输入备案信息" >
                    <small class="help-block">调用方式：<code>config('site_icp')</code></small>
                  </div>
                  <div class="form-group">
                    <label class="btn-block" for="web_site_status">站点开关</label>
                    <label class="lyear-switch switch-solid switch-primary">
                      <input name="setting[site_closed]" type="checkbox" @if($setting['site_closed'] == 1) checked="" @endif  value="1">
                      <span></span>
                    </label>
                    <small class="help-block">站点关闭后将不能访问，后台可正常登录</small>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary m-r-5">确 定</button>
                    <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">返 回</button>
                  </div>
                </form>

              </div>
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
  <!--标签插件-->
  <script src="{{ $staticDir }}js/jquery-tags-input/jquery.tagsinput.min.js"></script>
  <script type="text/javascript" src="{{ $staticDir }}js/perfect-scrollbar.min.js"></script>
@stop
