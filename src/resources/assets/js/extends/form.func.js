/**
 * @name KKForm
 * @description
 * @example
 *
 * @author Jerry Li dream_imperator@163.com
 * @supported http://service.yuncongtec.com/ui/tools/tableTools
 * @copyright @www.yuncongtec.com
 **/

jQuery.validator.addMethod("isPhone", function(value, element) {
    var length = value.length;
    return this.optional(element) || (length == 11 && /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/.test(value));
}, "请正确填写您的手机号码。");

// 电话号码验证
jQuery.validator.addMethod("isTel", function(value, element) {
    var tel = /^(\d{3,4}-)?\d{7,8}$/g; // 区号－3、4位 号码－7、8位
    return this.optional(element) || (tel.test(value));
}, "请正确填写您的电话号码。");
// 匹配密码，以字母开头，长度在6-12之间，必须包含数字和特殊字符。
jQuery.validator.addMethod("isPwd", function(value, element) {
    var str = value;
    if (str.length < 6 || str.length > 18)
        return false;
    if (!/^[a-zA-Z]/.test(str))
        return false;
    if (!/[0-9]/.test(str))
        return fasle;
    return this.optional(element) || /[^A-Za-z0-9]/.test(str);
}, "以字母开头，长度在6-12之间，必须包含数字和特殊字符。");

function success(msg,  url="") {
    kkadmin.loading('show');
    // 假设ajax提交操作
    setTimeout(function() {
        kkadmin.loading('hide');
        kkadmin.notify(msg, 'success', 3000);
    }, 1e3)
}

function error(msg, url="") {
    kkadmin.loading('show');
    // 假设ajax提交操作
    setTimeout(function() {
        kkadmin.loading('hide');
        kkadmin.notify(msg, 'danger', 100);
    }, 1e3)
}
