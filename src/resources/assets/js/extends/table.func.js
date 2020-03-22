/**
* @name KKTableList
* @description
* @example
*
* @author Jerry Li dream_imperator@163.com
* @supported http://service.yuncongtec.com/ui/tools/tableTools
* @copyright @www.yuncongtec.com
**/

function  tableTools(containerID, checkID) {
    var pageNo = 1;

    /*定一个函数来用来想一个元素中动态添加指定的class属性值
         * -参数：
         *         obj 目标元素
         *         cn 要添加的class值
         */
    function addClass(obj,cn){
        //判断，防止cn有了还执行函数多次添加
        if(!hasClass(obj,cn)){
            obj.className += " "+cn;
        }

    }
    /*判断一个元素中是否含有指定的class属性值
     * 如果有，返回true
     */
    function hasClass(obj,cn){
        //判断obj中有没有cn class，正则表达式
        var reg=new RegExp("\\b"+cn+"\\b");

        return reg.test(obj.className);
    }
    /*删除一个元素中的指定class属性值
     */
    function removeClass(obj,cn){
        //创建一个正则表达式
        var reg=new RegExp("\\b"+cn+"\\b");
        //删除跟正则式符合的class
        obj.className=obj.className.replace(reg," ");
    }
    /*切换一个class
     * 如果元素中有该class，则删除；没有，则添加
     */
    function toggleClass(obj,cn){
        if(hasClass(obj,cn)){
            removeClass(obj,cn);
        }else{
            addClass(obj,cn);
        }
    }

    function getSlt() {
        var checkID = [];//定义一个空数组

        $("input[name='check']:checked").each(function(i){//把所有被选中的复选框的值存入数组
            checkID[i] =$(this).val();
        });
        return checkID;
    }

    function load() {

    }

    function enableSlt() {

    }

    function disableSlt() {

    }

    function xoneSlt() {

    }

    /*获取ids,批量删除*/
    function deleteSlt() {
        var ids = '';
        $('input:checkbox').each(function(){
            if(this.checked == true){
                ids += this.value + ',';
            }
        });
        //layer.alert(ids);return;
        //下面的ajax根据自己的情况写
        layer.confirm('批量删除后不可恢复，谨慎操作！', {icon: 7, title: '警告'}, function (index) {
            $.ajax({
                type: 'POST',
                url: '你的url地址?ids=' + ids,
                data: {"1": "1"},
                dataType: 'json',
                success: function (data) {
                    if (data.code == 200) {
                        $(obj).parents("tr").remove();
                        layer.msg(data.message, {icon: 1, time: 1000});
                    } else {
                        layer.msg(data.message, {icon: 2, time: 3000});
                    }
                },
                error: function (data) {
                    console.log(data.msg);
                },
            });
        });
    }
}
