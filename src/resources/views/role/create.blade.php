@extends('Imperator::layouts.form')

@section('stylesheet')
  @parent
  <!--标签插件-->
  <link rel="stylesheet" href="{{ $staticDir }}/js/jquery-tags-input/jquery.tagsinput.min.css">
@stop

@section('pageTitle')
  角色添加 - 管理员管理
@stop

@section('content')
    <!--页面主要内容-->
    <main class="kkadmin-layout-content">
      
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header"><h4>设置权限</h4></div>
              <div class="card-body">
                
                <form action="{{ URL::route('admin.role.store') }}" method="post">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="example-text-input">角色名称</label>
                    <input class="form-control" type="text" name="role-input" placeholder="新角色名称">
                  </div>
                  <div class="form-group">
                    <label for="example-text-input">角色标识</label>
                    <input class="form-control" type="text" name="role-code" placeholder="英文标识">
                  </div>
                  <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>
                          <label class="kkadmin-checkbox checkbox-primary">
                            <input name="checkbox" type="checkbox" id="check-all">
                            <span> 全选权限</span>
                          </label>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($privTree as $k=>$group)
                      <tr>
                        <td>
                          <label class="kkadmin-checkbox checkbox-primary">
                            <input name="groups[]" type="checkbox" class="checkbox-parent" dataid="id-{{$group['id']}}" value="{{$group['id']}}">
                            <span> {{$group['var_name']}}</span>
                          </label>
                        </td>
                      </tr>
                      @if(!empty($group['child']))
                        @foreach($group['child'] as $i=>$child)
                        <tr>
                          <td class="p-l-20">
                            <label class="kkadmin-checkbox checkbox-primary">
                              <input name="child[]" type="checkbox" class="checkbox-parent checkbox-child" dataid="id-{{$group['id']}}-{{$child['id']}}" value="{{$child['id']}}">
                              <span>{{$child['var_name']}}</span>
                            </label>
                          </td>
                        </tr>
                        @if(!empty($child['child']))
                        <tr>
                          <td class="p-l-40">
                            @foreach($child['child'] as $h=>$privilege)
                            <label class="kkadmin-checkbox checkbox-primary checkbox-inline">
                              <input name="rules[]" type="checkbox" class="checkbox-child" dataid="id-{{$group['id']}}-{{$child['id']}}-{{$privilege['id']}}" value="{{$privilege['id']}}">
                              <span> {{$privilege['name']}}</span>
                            </label>
                            @endforeach
                          </td>
                        </tr>
                        @endif
                        @endforeach
                      @endif
                    @endforeach
                    </tbody>
                  </table>
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
    </main>
    <!--End 页面主要内容-->
@stop

@section('javascript')
  @parent
  <!--标签插件-->
  <script type="text/javascript" src="{{ $staticDir }}/js/perfect-scrollbar.min.js"></script>
  <script type="text/javascript" src="js/chosen.jquery.min.js"></script>
  <script type="text/javascript">
    $(function(){
      //动态选择框，上下级选中状态变化
      $('input.checkbox-parent').on('change', function(){
        var dataid = $(this).attr("dataid");
        $('input[dataid^=' + dataid + '-]').prop('checked', $(this).is(':checked'));
      });
      $('input.checkbox-child').on('change', function(){
        var dataid = $(this).attr("dataid");
        dataid = dataid.substring(0, dataid.lastIndexOf("-"));
        var parent = $('input[dataid=' + dataid + ']');
        if($(this).is(':checked')){
          parent.prop('checked', true);
          //循环到顶级
          while(dataid.lastIndexOf("-") != 2){
            dataid = dataid.substring(0, dataid.lastIndexOf("-"));
            parent = $('input[dataid=' + dataid + ']');
            parent.prop('checked', true);
          }
        }else{
          //父级
          if($('input[dataid^=' + dataid + '-]:checked').length == 0){
            parent.prop('checked', false);
            //循环到顶级
            while(dataid.lastIndexOf("-") != 2){
              dataid = dataid.substring(0, dataid.lastIndexOf("-"));
              parent = $('input[dataid=' + dataid + ']');
              if($('input[dataid^=' + dataid + '-]:checked').length == 0){
                parent.prop('checked', false);
              }
            }
          }
        }
      });
    });
  </script>
@stop
