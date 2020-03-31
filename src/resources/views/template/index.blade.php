@extends('Imperator::layouts.framework')

@section('pageTitle')
    模板管理 - 系统管理
@stop

@section('content')
    <!--页面主要内容-->
    <main class="kkadmin-layout-content">
        <div class="container-fluid">
            <div class="alert alert-info" role="alert">
                以下为系统监测到的可用模板，当前使用的模板是 <code>default</code> ，如需添加新的模板内容请阅读 <a href="/admin/help/template">模板向导</a>。
            </div>
            <div class="row">
                @foreach($template as $key=>$tpl)
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4>默认【{{$tpl}}】</h4>
                            <ul class="card-actions">
                                <li>
                                    <button type="button"><i class="mdi mdi-lead-pencil"></i></button>
                                    <button type="button"><i class="mdi mdi-pin"></i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <img src="/statics/uploads/template/screen-shot.png"/>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- .col-sm-6 -->
            </div>
            <!-- End Cards with Actions -->
        </div>
    </main>
    <!--End 页面主要内容-->
@stop

@section('javascript')
@parent
<script type="text/javascript">
    $(function(){
        $('.search-bar .dropdown-menu a').click(function() {
            var field = $(this).data('field') || '';
            $('#search-field').val(field);
            $('#search-btn').html($(this).text() + ' <span class="caret"></span>');
        });
    });
    </script>
@stop

@section('copyRight')
    Copyright &copy; 2019. <a target="_blank" href="http://service.yuncongtec.com">云骢网</a> All rights reserved.
@stop
