@extends('admin.layouts.form')

@section('stylesheet')
  @parent
  <!--标签插件-->
  <link rel="stylesheet" href="{{ $staticdir }}js/jquery-tags-input/jquery.tagsinput.min.css">
@stop

@section('pageTitle')
  系统配置 - 配置管理
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
              <li class="active"> <a href="javascript:void(0);">系统</a> </li>
              <li> <a href="{{ URL::route('admin.setting-upload') }}">上传</a> </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">

                <form action="{{ URL::route('admin.setting-update') }}" method="post" name="edit-form" class="edit-form">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="PUT">
                    <input name="group_id" type="hidden" value="35">
                  <div class="form-group">
                    <label for="config_group">配置分组</label>
                    <textarea class="form-control" id="config_group" rows="5" name="setting[config_group]" placeholder="请输入配置分组" >{{$setting['config_group']}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="form_item_type">配置类型</label>
                    <textarea class="form-control" id="form_item_type" rows="5" name="setting[form_item_type]" placeholder="请输入配置类型" >{{$setting['form_item_type']}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="wipe_cache_type">清除缓存类型</label>
                    <div class="controls-box">
                      <label class="lyear-checkbox checkbox-inline checkbox-primary">
                        <input type="checkbox" name="setting[wipe_cache_type][]" checked><span>应用缓存</span>
                      </label>
                      <label class="lyear-checkbox checkbox-inline checkbox-primary">
                        <input type="checkbox" name="setting[wipe_cache_type][]"><span>应用日志</span>
                      </label>
                      <label class="lyear-checkbox checkbox-inline checkbox-primary">
                        <input type="checkbox" name="setting[wipe_cache_type][]"><span>模板缓存</span>
                      </label>
                    </div>
                    <small class="help-block">清除缓存时，要删除的缓存类型</small>
                  </div>
                  <div class="form-group">
                    <label for="develop_mode">开发模式</label>
                    <div class="controls-box">
                      <label class="lyear-radio radio-inline radio-primary">
                        <input type="radio" name="setting[develop_mode]" value="0" checked><span>关闭</span>
                      </label>
                      <label class="lyear-radio radio-inline radio-primary">
                        <input type="radio" name="setting[develop_mode]" value="1"><span>开启</span>
                      </label>
                    </div>
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

