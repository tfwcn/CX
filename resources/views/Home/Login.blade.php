@extends('LayoutMain')
<?php /* ============================== */?>
@section('title','登录')
<?php /* ============================== */?>
@section('header')
    <?php /* header begin */?>
    <link href="{{ asset('/css/Home.css') }}" rel="stylesheet">
    <?php /* header end */?>
@endsection
<?php /* ============================== */?>
@section('content')
    <?php /* content begin */?>
    <div class="HomeLogin BWList">
        <form class="LoginFrom BWForm">
            <div class="ListItem">
                <div class="ListTitle"><i class="fa fa-adjust"></i> 登录</div>
            </div>
            <div class="ListLine"></div>
            <div class="ListItem">
                <div class="FormGroup">
                    <div class="FormLeft"><i class="fa fa-user"></i></div>
                    <div class="FormInput">
                        <input class="FormText" type="text" name="f_login_name"/>

                        <div class="FormTip">邮箱地址</div>
                    </div>
                </div>
            </div>
            <div class="ListItem">
                <div class="FormGroup">
                    <div class="FormLeft"><i class="fa fa-lock"></i></div>
                    <div class="FormInput">
                        <input class="FormText" type="password" name="f_login_password"/>

                        <div class="FormTip">密码</div>
                    </div>
                </div>
            </div>
            <div class="ListItem">
                <div class="FormGroup">
                    <input class="FormSubmit" type="submit" title="登录" value="登录"/>
                </div>
            </div>
        </form>
        <div class="ListLine"></div>
        <div class="ListItem" style="text-align: right"><a href="{{ asset('/Home/Register/') }}"><i
                        class="fa fa-user-plus"></i> 注册账号&gt;&gt;
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
