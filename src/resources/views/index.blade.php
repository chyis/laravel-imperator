@extends('Imperator::layouts.framework')

@section('pageTitle')
  首页面板
  @stop

@section('content')
    <!--页面主要内容-->
    <main class="lyear-layout-content">

      <div class="container-fluid">
        
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-primary">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">今日访问</p>
                  <p class="h3 text-white m-b-0">1</p>
                </div>
                <div class="pull-left"> <span class="img-avatar  bg-translucent"><i class="mdi mdi-nature-people fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-danger">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">用户总数</p>
                  <p class="h3 text-white m-b-0">9</p>
                </div>
                <div class="pull-left"> <span class="img-avatar bg-translucent"><i class="mdi mdi-account fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-success">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">浏览总量</p>
                  <p class="h3 text-white m-b-0">34,005</p>
                </div>
                <div class="pull-left"> <span class="img-avatar bg-translucent"><i class="mdi mdi-arrow-down-bold fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-purple">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">新增联系</p>
                  <p class="h3 text-white m-b-0">2 条</p>
                </div>
                <div class="pull-left"> <span class="img-avatar bg-translucent"><i class="mdi mdi-comment-outline fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">

          <div class="col-lg-6"> 
            <div class="card">
              <div class="card-header">
                <h4>每周访问</h4>
              </div>
              <div class="card-body">
                <canvas class="js-chartjs-bars"></canvas>
              </div>
            </div>
          </div>

          <div class="col-lg-6"> 
            <div class="card">
              <div class="card-header">
                <h4>最近咨询</h4>
              </div>
              <div class="card-body">
                <canvas class="js-chartjs-lines"></canvas>
              </div>
            </div>
          </div>

        </div>
        
        <div class="row">
          
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>待发布内容</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>文章标题</th>
                        <th>录入日期</th>
                        <th>截止日期</th>
                        <th>状态</th>
                        <th>进度</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>设计新主题</td>
                        <td>10/02/2019</td>
                        <td>12/05/2019</td>
                        <td><span class="label label-warning">草稿</span></td>
                        <td>
                          <div class="progress progress-striped progress-sm">
                            <div class="progress-bar progress-bar-warning" style="width: 45%;"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>网站重新设计</td>
                        <td>01/03/2019</td>
                       <td>12/04/2019</td>
                        <td><span class="label label-success">未发布</span></td>
                        <td>
                          <div class="progress progress-striped progress-sm">
                            <div class="progress-bar progress-bar-success" style="width: 30%;"></div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
@stop

@section('javascript')
  @parent
  <!--图表插件-->
  <script type="text/javascript" src="{{$staticDir}}/js/Chart.js"></script>
  <script type="text/javascript">
    $(document).ready(function(e) {
      var $dashChartBarsCnt  = jQuery( '.js-chartjs-bars' )[0].getContext( '2d' ),
              $dashChartLinesCnt = jQuery( '.js-chartjs-lines' )[0].getContext( '2d' );

      var $dashChartBarsData = {
        labels: ['周一', '周二', '周三', '周四', '周五', '周六', '周日'],
        datasets: [
          {
            label: '访问用户',
            borderWidth: 1,
            borderColor: 'rgba(0,0,0,0)',
            backgroundColor: 'rgba(51,202,185,0.5)',
            hoverBackgroundColor: "rgba(51,202,185,0.7)",
            hoverBorderColor: "rgba(0,0,0,0)",
            data: [2500, 1500, 1200, 3200, 4800, 3500, 1500]
          }
        ]
      };
      var $dashChartLinesData = {
        labels: ['2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014'],
        datasets: [
          {
            label: '咨询数量',
            data: [20, 25, 40, 30, 45, 40, 55, 40, 48, 40, 42, 50],
            borderColor: '#358ed7',
            backgroundColor: 'rgba(53, 142, 215, 0.175)',
            borderWidth: 1,
            fill: false,
            lineTension: 0.5
          }
        ]
      };

      new Chart($dashChartBarsCnt, {
        type: 'bar',
        data: $dashChartBarsData
      });

      var myLineChart = new Chart($dashChartLinesCnt, {
        type: 'line',
        data: $dashChartLinesData,
      });
    });
  </script>
@stop
