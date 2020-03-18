@extends('admin.layouts.form')

@section('stylesheet')
  @parent
  <!--标签插件-->
  <link rel="stylesheet" href="{{ $staticdir }}js/jquery-tags-input/jquery.tagsinput.min.css">
@stop

@section('pageTitle')
  上传配置 - 配置管理
@stop

@section('content')
  <!--页面主要内容-->
  <main class="lyear-layout-content">

    <div class="container-fluid">

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <ul class="nav nav-tabs page-tabs">
              <li> <a href="{{ URL::route('admin.setting') }}">基本</a> </li>
              <li> <a href="{{ URL::route('admin.setting-system') }}">系统</a> </li>
              <li class="active"> <a href="javascript:void(0);">上传</a> </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">
                <form action="{{ URL::route('admin.setting-update') }}" method="post" name="edit-form" class="edit-form">
                  {{csrf_field()}}
                  <input name="_method" type="hidden" value="PUT">
                  <input name="group_id" type="hidden" value="37">
                  <div class="form-group">
                    <label for="upload_file_ext">图片上传大小限制</label>
                    <input class="js-tags-input form-control" type="text" id="upload_file_ext" name="setting[upload_file_ext]" value="{{$setting['upload_file_ext']}}" >
                    <small class="help-block">多个后缀用逗号隔开，不填写则不限制类型</small>
                  </div>
                  <div class="form-group">
                    <label for="upload_image_size">图片上传大小限制</label>
                    <input class="form-control" type="text" id="upload_image_size" name="setting[upload_image_size]" value="{{$setting['upload_image_size']}}" placeholder="请输入图片上传大小限制" >
                    <small class="help-block">0为不限制大小，单位：kb</small>
                  </div>
                  <div class="form-group">
                    <label for="upload_image_ext">允许上传的图片后缀</label>
                    <input class="js-tags-input form-control" type="text" id="upload_image_ext" name="setting[upload_image_ext]" value="{{$setting['upload_image_ext']}}" >
                    <small class="help-block">多个后缀用逗号隔开，不填写则不限制类型</small>
                  </div>
                  <div class="form-group">
                    <label for="upload_file_size">文件上传大小限制</label>
                    <input class="form-control" type="text" id="upload_file_size" name="setting[upload_file_size]" value="{{$setting['upload_file_size']}}" placeholder="请输入文件上传大小限制" >
                    <small class="help-block">0为不限制大小，单位：kb</small>
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
  <script src="{{ $staticdir }}js/jquery-tags-input/jquery.tagsinput.min.js"></script>
  <script type="text/javascript" src="{{ $staticdir }}js/perfect-scrollbar.min.js"></script>
@stop