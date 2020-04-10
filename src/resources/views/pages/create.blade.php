<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>登录后创建会议</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/bootstrap.css" rel="stylesheet">
    <link href="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/fileinput.css" rel="stylesheet">
    <link href="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/bootstrap-datetimepicker.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/font-awesome.css">
    <link href="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/animate.css" rel="stylesheet">
    <link href="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/summernote.css" rel="stylesheet">
  
    <link href="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/index.css">
    <script src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/jquery.js"></script>
    <script src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/bootstrap.js"></script>
    <script src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/fileinput.js"></script>
    <script src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/bootstrap-datetimepicker.js"></script>
    <script src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/distpicker.js"></script>
    <script src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/distpicker_002.js"></script>
    <script src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/bootstrap-datetimepicker_002.js"></script>
    <script src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/zh.js"></script>
    <script src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/jquery-ui.js"></script>
    <script src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/beautifyhtml.js"></script>
    <script src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/index.js"></script>
</head>

<body style="background-color:#f7f5f6;">
    <div class="container-fluid" style="padding:0px; margin:0px;">
        <div class="row-fluid clearfix">
            <div class="col-md-12 column">
                <div style="width:1080px; margin:0 auto; margin-top:20px;">
                    <div class="conference-cont" style=" margin-top:20px;">
                        <div class="set-til">第一步<span style="padding-left:10px;">报名表单设置</span></div>
                        <div class="wrapper wrapper-content" style="margin-top: 55px;">
                            <div class="row" style="border-left: 2px dashed rgba(0,0,0,0.12);border-right: 2px dashed rgba(0,0,0,0.12);border-bottom: 2px dashed rgba(0,0,0,0.12);">
                                <div id="colzuo" class="col-sm-9" style="border-right: 2px dashed rgba(0,0,0,0.12);">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>拖拽/点击右侧表单项到此区域</h5>
                                            <div class="ibox-tools">
                                                <button type="submit" class="btn btn-warning" data-clipboard-text="testing" id="copy-to-clipboard">复制代码</button>
                                            <button type="button" class="btn btn-yulan">预览</button>
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="row form-body form-horizontal m-t">
                                                <div class="col-md-12 droppable sortable ui-droppable ui-sortable">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div id="colyou" class="col-sm-3">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>自定义表单项</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <form role="form" class="form-horizontal m-t">
                                                <p><b>常用项</b></p>
                                                <table>
                                                    <tbody><tr>
                                                        <td>
                                                            <div id="name" class="draggable ui-draggable btntexts">
                                                                姓名
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div id="phone" class="draggable ui-draggable btntexts">
                                                                电话
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div id="email" class="draggable ui-draggable btntexts">
                                                                邮箱
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div id="card" class="draggable ui-draggable btntexts">
                                                                身份证
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div id="www" class="draggable ui-draggable btntexts">
                                                                个人网站
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div id="logo" class="draggable ui-draggable btntexts">
                                                                上传Logo
                                                            </div>
                                                        </td>
                                                       
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div id="sex" class="draggable ui-draggable btntexts">
                                                                性别
                                                            </div>
                                                        </td>
                                                         <td>
                                                            <div id="occupation" class="draggable ui-draggable btntexts">
                                                                职位
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div id="profile" class="draggable ui-draggable btntexts">
                                                                个人简介
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                                <p><b>自定义项</b></p>
                                                <div id="text" class="form-group draggable ui-draggable btntext">
                                                    <label class="col-sm-12"><i class="fa fa-arrows"></i> 文本框 <img src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/add_form_img01.png"></label>
                                                </div>
                                                <div id="select" class="form-group draggable ui-draggable btntext">
                                                    <label class="col-sm-12"><i class="fa fa-arrows"></i> 下拉框 <img src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/add_form_img05.png"></label>
                                                </div>
                                                <div id="radio" class="form-group draggable ui-draggable btntext">
                                                    <label class="col-sm-12"><i class="fa fa-arrows"></i> 单选 <img src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/add_form_img03.png"></label>
                                                </div>
                                                <div id="checkbox" class="form-group draggable ui-draggable btntext">
                                                    <label class="col-sm-12"><i class="fa fa-arrows"></i> 多选 <img src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/add_form_img04.png"></label>
                                                </div>
                                                <div id="textarea" class="form-group draggable ui-draggable btntext">
                                                    <label class="col-sm-12"><i class="fa fa-arrows"></i> 多行文本 <img src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/add_form_img02.png"></label>
                                                </div>
                                                <div id="datetime" class="form-group draggable ui-draggable btntext">
                                                    <label class="col-sm-12"><i class="fa fa-arrows"></i> 时间 <img src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/add_form_img06.png"></label>
                                                </div>
                                                <div id="file" class="form-group draggable ui-draggable btntext">
                                                    <label class="col-sm-12"><i class="fa fa-arrows"></i> 上传 <img src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/add_form_img07.png"></label>
                                                </div>
                                                <div id="picker" class="form-group draggable ui-draggable btntext">
                                                    <label class="col-sm-12"><i class="fa fa-arrows"></i> 省市区 <img src="%E7%99%BB%E5%BD%95%E5%90%8E%E5%88%9B%E5%BB%BA%E4%BC%9A%E8%AE%AE_files/add_form_img08.png"></label>
                                                </div>
                                            </form>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body></html>