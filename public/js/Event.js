$(function () {
    EventQueryFrom();
    EventNewFrom();
});
//查询表单绑定
function EventQueryFrom() {
    var fVerification = new Array();
    fVerification['qv'] = function (event) {
        var obj = event;
        var val = obj.val().trim();
        if (val == '')
            return false;
        //if(CheckStringLength(val,4,20)==false){
        //    alert('账号：长度应为4-20');
        //    return false;
        //}
        return true;
    };
    BWForm('.EventQueryFrom', fVerification, null);
}
//新增表单绑定
function EventNewFrom() {
    var fVerification = new Array();
    fVerification['f_event_title'] = function (event) {
        var obj = event;
        var val = obj.val().trim();
        if (val == '')
            return false;
        if (CheckStringLength(val, 4, 50) == false) {
            alert('事件标题：长度应为4-50');
            return false;
        }
        return true;
    };
    fVerification['f_event_remark'] = function (event) {
        var obj = event;
        var val = obj.val().trim();
        if (val == '')
            return false;
        if (CheckStringLength(val, 10, 500) == false) {
            alert('事件内容：长度应为10-500');
            return false;
        }
        return true;
    };
    var fSubmit = function (event) {
        AjaxLoad("/Event/NewEventSubmit", ".EventNewFrom", null, function (data) {
            if (data == "") {
                window.location.href = "/";
            } else {
                alert(data);
            }
        }, function (req, msg) {
            alert("系统错误：" + msg);
        }, null, null);
    };
    BWForm('.EventNewFrom', fVerification, fSubmit);
}
function AddClient() {
    var obj = $('input[name="f_client_name"]');
    var f_client_name = obj.val().trim();
    if (f_client_name == '') {
        obj.focus();
        return;
    }
    if ($('.ClientItems input[name="f_clients"][value="' + f_client_name + '"]').length > 0) {
        obj.val('');
        obj.focus();
        //去除重复
        alert('该账号已添加');
        return;
    }
    //ClientItems
    var item = $('<span>' + f_client_name + ' <i class="fa fa-close"></i><input type="hidden" name="f_clients[]" value="' + f_client_name + '"/></span>');
    item.click(function () {
        $(this).remove();
    });
    $('.ClientItems').append(item);
    obj.val('');
    obj.focus();
}
function AddUrl() {
    var obj = $('input[name="f_url"]');
    var f_client_name = obj.val().trim();
    if (f_client_name == '') {
        obj.focus();
        return;
    }
    if ($('.UrlItems input[name="f_urls"][value="' + f_client_name + '"]').length > 0) {
        obj.val('');
        obj.focus();
        //去除重复
        alert('该地址已添加');
        return;
    }
    //ClientItems
    var item = $('<span>' + f_client_name + ' <i class="fa fa-close"></i><input type="hidden" name="f_urls[]" value="' + f_client_name + '"/></span>');
    item.click(function () {
        $(this).remove();
    });
    $('.UrlItems').append(item);
    obj.val('');
    obj.focus();
}