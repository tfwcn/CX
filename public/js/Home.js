$(function () {
    LoginForm();
    RegisterForm();
});
//登录表单绑定
function LoginForm() {
    //var tmpRegisterFrom = $('.LoginFrom');
    var fVerification = new Array();
    fVerification['f_login_name']=function(event){
        var obj=event;
        var val=obj.val();
        if(val=='')
            return false;
        //if(CheckStringLength(val,4,20)==false){
        //    alert('账号：长度应为4-20');
        //    return false;
        //}
        return true;
    };
    fVerification['f_login_password']=function(event){
        var obj=event;
        var val=obj.val();
        if(val=='')
            return false;
        //if(CheckStringLength(val,6,20)==false){
        //    alert('密码：长度应为6-20');
        //    return false;
        //}
        return true;
    };
    var fSubmit=function(event){
        var f_login_name= $('.LoginFrom').find("input[name='f_login_name']");
        var f_login_password= $('.LoginFrom').find("input[name='f_login_password']");
        var fdata={};
        fdata['f_login_name']=f_login_name.val();
        fdata['f_login_password']=md5(f_login_name.val()+f_login_password.val());
        AjaxLoad("/Home/LoginSubmit", ".LoginFrom", null, function(data) {
            if (data == "") {
                window.location.href = "/";
            } else {
                alert(data);
            }
        }, function(req, msg) {
            alert("系统错误：" + msg);
        }, null, fdata);
    };
    BWForm('.HomeLogin', fVerification,fSubmit);
}
//注册表单绑定
function RegisterForm() {
    //var tmpRegisterFrom = $('.RegisterFrom');
    var fVerification = new Array();
    //fVerification['f_login_name']=function(event){
    //    var obj=event;
    //    var val=obj.val();
    //    if(val=='')
    //        return false;
    //    if(CheckStringLength(val,4,20)==false){
    //        alert('账号：长度应为4-20');
    //        return false;
    //    }
    //    return true;
    //};
    fVerification['f_login_password']=function(event){
        var obj=event;
        var val=obj.val();
        if(val=='')
            return false;
        if(CheckStringLength(val,6,20)==false){
            alert('密码：长度应为6-20');
            return false;
        }
        return true;
    };
    fVerification['f_login_password2']=function(event){
        var obj=event;
        var val=obj.val();
        if(val=='')
            return false;
        var f_login_password= $('.HomeRegister').find("input[name='f_login_password']");
        if(f_login_password.val()!=val){
            alert('两次输入的密码不一致');
            return false;
        }
        return true;
    };
    fVerification['f_mail']=function(event){
        var obj=event;
        var val=obj.val();
        if(val=='')
            return false;
        if(CheckMailFormat(val)==false){
            alert('邮箱地址有误');
            return false;
        }
        return true;
    };
    fVerification['f_mail_key']=function(event){
        var obj=event;
        var val=obj.val();
        if(val=='')
            return false;
        return true;
    };
    fVerification['f_show_name']=function(event){
        var obj=event;
        var val=obj.val();
        if(val=='')
            return false;
        if(CheckStringLength(val,2,10)==false){
            alert('昵称：长度应为2-10');
            return false;
        }
        return true;
    };
    var fSubmit=function(event){
        AjaxLoad("/Home/RegisterSubmit", ".RegisterFrom", null, function(data) {
            if (data == "") {
                window.location.href = "/Home/RegisterSuccess";
            } else {
                alert(data);
            }
        }, function(req, msg) {
            alert("系统错误：" + msg);
        }, null, null);
    };
    BWForm('.HomeRegister', fVerification,fSubmit);
}
//发送邮件
function SendMail(){
    var obj= $('.HomeRegister').find('.MailKey');
    obj.removeAttr('href');
    var time_length=30;
    var interval;
    function time_count() {
        time_length--;
        obj.html(time_length);
        if (time_length <= 0) {
            obj.html('<i class="fa fa-external-link"></i>');
            obj.attr('href','javascript:SendMail()');
        } else {
            interval = setTimeout(time_count, 1000);
        }
    }
    interval = setTimeout(time_count, 100);
    var f_mail= $('.HomeRegister').find("input[name='f_mail']");
    var fdata={};
    fdata['mailTo']=f_mail.val();
    AjaxLoad("/Home/RegisterMail", null, null, function(data) {
        if (data == "") {
            alert('发送成功');
        } else {
            obj.html('<i class="fa fa-external-link"></i>');
            obj.attr('href','javascript:SendMail()');
            clearTimeout(interval);
            alert(data);
        }
    }, function(req, msg) {
        obj.html('<i class="fa fa-external-link"></i>');
        obj.attr('href','javascript:SendMail()');
        clearTimeout(interval);
        alert("系统错误：" + msg);
    }, null, fdata);
}