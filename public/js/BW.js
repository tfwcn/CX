//Ajax
var isAjax = false;
function AjaxLoad(url, formID, fuBeforeSend, fuSuccess, fuError, fuComplete, fData, fIsShowLoading, fType) {
    if (isAjax) {
        alert('請耐心等待上一次的操作完成！');
        return false;
    }

    //拿全部數據后
    var formData = {};
    if (fData) {
        formData = fData;
    } else {
        if (formID)
            formData = $(formID).serialize(); //獲取表單數據
    }

    if(fType==null){
        fType="post";
    }

    isAjax = true;
    window.setTimeout(function () {
        $.ajax(new function () {
            this.dataType = "html";
            this.type = fType;
            this.url = url;
            this.cache = false;
            this.data = formData;
            this.beforeSend = function (req) {
                if (fIsShowLoading != false) {
                    BWShowLoading();//Loading
                }
                if ($.isFunction(fuBeforeSend)) {
                    fuBeforeSend(req);
                }
            };
            this.success = function (data) {
                if (fIsShowLoading != false) {
                    BWCloseLoading();//Loading
                }
                if ($.isFunction(fuSuccess)) {
                    fuSuccess(data);
                }
            };
            this.error = function (req, msg) {
                isAjax = false;
                if (fIsShowLoading != false) {
                    BWCloseLoading();//Loading
                }
                if ($.isFunction(fuError)) {
                    //req.statusText
                    fuError(req, msg);
                }
            };
            this.complete = function (req, msg) {
                isAjax = false;
                if (fIsShowLoading != false) {
                    BWCloseLoading();//Loading
                }
                if ($.isFunction(fuComplete)) {
                    fuComplete(req, msg);
                }
            };
        });
    }, 200);
}
//显示信息
function BWShowMsg(msg) {
    //颜色初始化
    var color = '';
    var colorError = '';
    var colorInfo = '';
    var colorWarning = '';
}
//显示Loading
function BWShowLoading() {
    if ($('.BWLoading').length > 0)
        return;
    var BWLoading = $('<div class="BWLoading"><div class="BWLoadingBG"></div><div class="BWLoadingItem"><i class="fa fa-spinner fa-pulse"></i></div></div>');
    $('body').append(BWLoading);
}
//关闭Loading
function BWCloseLoading() {
    $('.BWLoading').remove();
}
//弹出窗口,obj:父标签对象,id,url:地址
function BWShowWin(obj, id, url) {
    var BWWinBox = $('<div id="BWWinBox_' + id + '" class="BWWinBox">');
    var BWWinBoxHeader = $('<div class="BWWinBoxHeader">');
    BWWinBoxHeader.append('<div class="BWWinBoxReturn" onclick="BWCloseWin(\'' + id + '\')"><i class="fa fa-chevron-left"></i></div>');
    var BWWinBoxTitle = $('<div class="BWWinBoxTitle"></div>');
    BWWinBoxHeader.append(BWWinBoxTitle);
    var BWWinBoxBody = $('<div class="BWWinBoxBody"></div>');
    var BWWinBoxLoad = $('<div class="BWWinBoxLoad"><i class="fa fa-spinner fa-pulse"></i></div>');
    BWWinBoxBody.append(BWWinBoxLoad);
    var BWWinBoxFrame = $('<iframe frameborder="0" style="height: 100%;width: 100%;"></iframe>');
    BWWinBoxBody.append(BWWinBoxFrame);
    BWWinBoxFrame.hide();
    BWWinBox.append(BWWinBoxHeader);
    BWWinBox.append(BWWinBoxBody);
    BWWinBox.hide();
    $(obj).append(BWWinBox);
    BWWinBox.fadeIn('normal');
    BWShowWinAjaxId.push(id);
    BWWinBoxFrame.load(function () {
        BWWinBoxTitle.html(BWWinBoxFrame.contents().attr("title"));
        BWWinBoxLoad.hide();
        BWWinBoxFrame.show();
    });
    BWWinBoxFrame.attr('src', url);
}
function BWCloseWin(id) {
    var nowId = BWShowWinAjaxId.pop();
    BWShowWinAjaxId.push(nowId);
    if (id == null)
        id = nowId;
    var BWWinBox = $('#BWWinBox_' + id);
    BWWinBox.fadeOut('normal', function () {
        $('#BWWinBox_' + id).remove();
        if (id != nowId) {
            BWShowWinAjaxId.push(nowId);
        }
    });
}
//弹出窗口,ajax异步加载,obj:父标签对象,id,url:地址
var BWShowWinAjaxId = new Array();//窗口堆栈
function BWShowWinAjax(obj, id, url, fData) {
    var BWWinBox = $('<div id="BWWinBox_' + id + '" class="BWWinBox">');
    var BWWinBoxHeader = $('<div class="BWWinBoxHeader">');
    BWWinBoxHeader.append('<div class="BWWinBoxReturn" onclick="BWCloseWin(\'' + id + '\')"><i class="fa fa-chevron-left"></i></div>');
    var BWWinBoxTitle = $('<div class="BWWinBoxTitle"></div>');
    BWWinBoxHeader.append(BWWinBoxTitle);
    var BWWinBoxBody = $('<div class="BWWinBoxBody"></div>');
    var BWWinBoxLoad = $('<div class="BWWinBoxLoad"><i class="fa fa-spinner fa-pulse"></i></div>');
    BWWinBoxBody.append(BWWinBoxLoad);
    BWWinBox.append(BWWinBoxHeader);
    BWWinBox.append(BWWinBoxBody);
    BWWinBox.hide();
    $(obj).append(BWWinBox);
    BWWinBox.fadeIn('normal');
    BWShowWinAjaxId.push(id);
    AjaxLoad(url, null, null, function (data) {
        var rethtml = $(data);
        BWWinBoxLoad.remove();
        BWWinBoxBody.append(rethtml);
        BWWinBoxTitle.html(BWWinBoxBody.find('.BWShowWinTitle').html());
    }, function (req, msg) {
        //alert("加载错误：" + msg);
        BWWinBoxLoad.remove();
        var center = $('<div style="text-align: center"></div>');
        var reload = $('<a href="javascript:return false;">点击重试</a>');
        center.html('加载错误！');
        center.append(reload);
        BWWinBoxBody.append(center);
        reload.click(function () {
            BWShowWinAjaxReload(id, url, fData);
        });
        //记录错误日志
        isAjax = false;
        AjaxLoad('/Log/Error/', null, null, null, null, null, {
            f_type: 'BWShowWinAjax',
            f_msg: 'id:' + id + ',url:' + url + ',fData:' + fData
        });
    }, null, fData, false);
}
function BWShowWinAjaxReload(id, url, fData) {
    var nowId = BWShowWinAjaxId.pop();
    BWShowWinAjaxId.push(nowId);
    if (id == null)
        id = nowId;
    var BWWinBox = $('#BWWinBox_' + id);
    var BWWinBoxTitle = BWWinBox.find('.BWWinBoxTitle');
    var BWWinBoxBody = BWWinBox.find('.BWWinBoxBody');
    var BWWinBoxLoad = $('<div class="BWWinBoxLoad"><i class="fa fa-spinner fa-pulse"></i></div>');
    BWWinBoxTitle.html('');
    BWWinBoxBody.html('');
    BWWinBoxBody.append(BWWinBoxLoad);
    AjaxLoad(url, null, null, function (data) {
        var rethtml = $(data);
        BWWinBoxLoad.remove();
        BWWinBoxBody.append(rethtml);
        BWWinBoxTitle.html(BWWinBoxBody.find('.BWShowWinTitle').html());
    }, function (req, msg) {
        //alert("加载错误：" + msg);
        BWWinBoxLoad.remove();
        var center = $('<div style="text-align: center"></div>');
        var reload = $('<a href="javascript:return false;">点击重试</a>');
        center.html('加载错误！');
        center.append(reload);
        BWWinBoxBody.append(center);
        reload.click(function () {
            BWShowWinAjaxReload(id, url, fData);
        });
    }, null, fData, false);
}
//激活表单功能，fVerification:控件验证事件数组，fSubmit:提交事件
function BWForm(obj, fVerification, fSubmit) {
    //var BWFormObj = $(obj).find('.BWForm');
    var BWFormObj = $(obj);
    if (BWFormObj.length == 0)
        return;
    //初始化所有输入框
    var listInput = BWFormObj.find('.FormInput');
    listInput.each(function () {
        var tmpFormText = $(this).find('.FormText,.FormTextMul');
        var tmpFormTip = $(this).find('.FormTip');
        tmpFormTip.click(function () {
            tmpFormText.focus();
        });
        tmpFormText.keydown(function () {
            tmpFormTip.hide();
        });
        tmpFormText.keyup(function () {
            if (tmpFormText.val() != '') {
                tmpFormTip.hide();
            } else {
                tmpFormTip.show();
            }
        });
        tmpFormText.change(function () {
            if (tmpFormText.val() != '') {
                tmpFormTip.hide();
            } else {
                tmpFormTip.show();
            }
        });
        tmpFormText.blur(function () {
            if (tmpFormText.val() != '') {
                tmpFormTip.hide();
            } else {
                tmpFormTip.show();
            }
        });
        if (tmpFormText.val() != '') {
            tmpFormTip.hide();
        } else {
            tmpFormTip.show();
        }
    });
    //设置控件验证事件
    if (fVerification != null) {
        var tmpListInput = BWFormObj.find('input,textarea');
        tmpListInput.each(function () {
            var tmpName = $(this).attr('name');
            if (fVerification[tmpName] != null) {
                $(this).focusout($(this), function (event) {
                    fVerification[tmpName](event.data);
                });
            }
        });
    }
    //设置提交事件
    BWFormObj.submit(BWFormObj, function (event) {
        if (fVerification != null) {
            for (i in fVerification) {
                var tmpInput = event.data.find('input[name="' + i + '"],textarea[name="' + i + '"]');
                if (fVerification[i](tmpInput) == false) {
                    return false;
                }
            }
        }
        if (fSubmit != null) {
            fSubmit(event.data);
            return false;
        } else {
            BWShowLoading();
        }
        return true;
    });
}
//显示信息
function BWShowObjAutoHide(obj) {
    var BWShowObj = $(obj);
    BWShowObj.show();
    $(document).one('mousedown', BWShowObj, function (event) {
            event.data.hide();
        }
    );
}
//验证字符串长度
function CheckStringLength(str, min, max) {
    var len = str.length;
    if (min != null && len < min)
        return false;
    if (max != null && len > max)
        return false;
    return true;
}
//验证邮箱地址格式
function CheckMailFormat(str) {
    return true;
}