@extends('LayoutMain')
<?php /* ============================== */?>
@section('title','信息管理')
<?php /* ============================== */?>
@section('header')
    <?php /* header begin */?>
    <link href="{{ asset('/css/Home.css') }}" rel="stylesheet">
    <?php /* header end */?>
@endsection
<?php /* ============================== */?>
@section('content')
    <?php /* content begin */?>
            用户信息管理（该功能未开放）<a href="{{ asset('/Home/LoginOut/') }}">注销登录</a>
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
