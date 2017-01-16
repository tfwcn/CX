@extends('LayoutMain')
<?php /* ============================== */?>
@section('title','用户注册')
<?php /* ============================== */?>
@section('header')
    <?php /* header begin */?>
    <link href="{{ asset('/css/Home.css') }}" rel="stylesheet">
    <?php /* header end */?>
@endsection
<?php /* ============================== */?>
@section('content')
    <?php /* content begin */?>
    <div class="HomeRegister BWList">
        <form class="RegisterFrom BWForm">
            <div class="ListItem">
                <div class="ListTitle"><i class="fa fa-adjust"></i> 用户注册</div>
            </div>
            <div class="ListLine"></div>
            <div class="ListItem">
                {{--<div class="FormGroup">--}}
                {{--<div class="FormLeft"><i class="fa fa-user"></i></div>--}}
                {{--<div class="FormInput">--}}
                {{--<input class="FormText" type="text" name="f_login_name"/>--}}

                {{--<div class="FormTip">账号(长度为4-20，由数字、字母和下划线组成)</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="FormGroup">
                    <div class="FormLeft"><i class="fa fa-envelope"></i></div>
                    <div class="FormInput">
                        <input class="FormText" type="text" name="f_mail"/>

                        <div class="FormTip">邮箱地址(用于接收注册验证码，激活账号)</div>
                    </div>
                </div>
            </div>
            <div class="ListItem">
                <div class="FormGroup">
                    <div class="FormLeft"><i class="fa fa-lock"></i></div>
                    <div class="FormInput">
                        <input class="FormText" type="password" name="f_login_password"/>

                        <div class="FormTip">密码(长度为6-20)</div>
                    </div>
                </div>
            </div>
            <div class="ListItem">
                <div class="FormGroup">
                    <div class="FormLeft"><i class="fa fa-ellipsis-h"></i></div>
                    <div class="FormInput">
                        <input class="FormText" type="password" name="f_login_password2"/>

                        <div class="FormTip">再次输入密码</div>
                    </div>
                </div>
            </div>
            <div class="ListItem">
                <div class="FormGroup">
                    <div class="FormLeft"><i class="fa fa-dot-circle-o"></i></div>
                    <a class="FormRight MailKey" href="javascript:SendMail()"><i class="fa fa-external-link"></i></a>

                    <div class="FormInput FormInput2">
                        <input class="FormText" type="text" name="f_mail_key"/>

                        <div class="FormTip">验证码(点击按钮发送验证码到邮箱)</div>
                    </div>
                </div>
            </div>
            <div class="ListItem">
                <div class="FormGroup">
                    <div class="FormLeft"><i class="fa fa-street-view"></i></div>
                    <div class="FormInput">
                        <input class="FormText" type="text" name="f_show_name"/>

                        <div class="FormTip">昵称(长度为2-10,显示名称，注册后不能更改)</div>
                    </div>
                </div>
            </div>
            <div class="ListItem">
                <div class="FormGroup">
                    <input class="FormSubmit" type="submit" title="注册" value="注册"/>
                </div>
            </div>
        </form>
        <div class="ListLine"></div>
        <div class="ListItem" style="text-align: right"><a href="{{ asset('/Home/Login/') }}"><i class="fa fa-user"></i> 登录账号&gt;&gt;
            </a></div>
    </div>
    <?php /* content end */?>
@endsection
<?php /* ============================== */?>
@section('footer')
    <?php /* footer begin */?>
    <div class="BWTab">
        <span class="col2">
            <a href="{{ asset('/') }}">
                <div class="TabItem">
                    <div class="TabItemIcon"><i class="fa fa-search"></i></div>
                    <div class="TabItemTitle">查询</div>
                </div>
            </a>
        </span><span class="col2">
            <div class="TabSelectItem">
                <div class="TabItemIcon"><i class="fa fa-user"></i></div>
                <div class="TabItemTitle">信息管理</div>
            </div>
        </span>
    </div>
    <?php /* footer end */?>
@endsection
<?php /* ============================== */?>
@section('scripts')
    <?php /* scripts begin */?>
    <script src="{{ asset('/js/Home.js') }}"></script>
    <?php /* scripts end */?>
@endsection
