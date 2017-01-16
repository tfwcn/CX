@extends('LayoutMain')
<?php /* ============================== */?>
@section('title','查询')
<?php /* ============================== */?>
@section('header')
    <?php /* header begin */?>
    <link href="{{ asset('/css/Event.css') }}" rel="stylesheet">
    <?php /* header end */?>
@endsection
<?php /* ============================== */?>
@section('content')
    <?php /* content begin */?>
    <div class="BWList">
        @if($isLogin)
        @else
            {{--<div class="ListItem">--}}
            {{--<span class="col2">--}}
            {{--<a href="{{ asset('/Home/Login/') }}" class="ListLBtn">登录</a>--}}
            {{--</span><span class="col2">--}}
            {{--<a href="{{ asset('/Home/Register/') }}" class="ListRBtn">注册</a>--}}
            {{--</span>--}}
            {{--</div>--}}
            {{--<div class="ListLine"></div>--}}
        @endif
        <form class="EventQueryFrom BWForm" action="{{ asset('/') }}">
            <div class="ListItem">
                <span class="col1">
                <div class="FormGroup">
                    <div class="FormLeft"><i class="fa fa-user"></i></div>
                    <div class="FormInput">
                        <input class="FormText" type="text" name="qv" value="{{ $f_name }}"/>

                        <div class="FormTip">账号/昵称</div>
                    </div>
                </div>
            </span>
            </div>
            <div class="ListItem">
                    <span class="col1">
        <div class="FormGroup">
            <input class="FormSubmit" type="submit" title="查询" value="查询"/>
        </div>
                    </span>
            </div>
        </form>
        <div class="ListLine"></div>
        <div class="ListItem"><span class="col1"><a href="{{ asset('/Event/NewEvent/') }}" class="ListBtn"><i
                            class="fa fa-plus"></i> 新增</a></span>
        </div>
        @if(count($listClient)>0)
            <div class="ListLine"></div>
            <div class="ListGroup">
                <div class="ListItem">
                    <div class="ListTitle"><i class="fa fa-search"></i> 查询结果</div>
                </div>
                <div class="ListItem">
                    @foreach ($listClient as $client)
                        <a href="{{ asset('/Event/ShowClient/?id='.$client->f_id) }}">
                            <div class="ListLink">
                                <div class="ListTitle2">{{$client->f_name}}</div>
                                <div class="ListTitle3"><i class="fa fa-pencil-square-o"></i> {{$client->f_group_count}}
                                    <div class="floatRight">{{$client->f_create_time}}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="ListItem textCenter">
                    <a href="{{ asset('/Event/NewEvent/') }}">没找到资料？点击添加一个</a>
                </div>
            </div>
        @else
            <div class="ListLine"></div>
            <div class="ListGroup">
                <div class="ListItem">
                    <div class="ListTitle"><i class="fa fa-search"></i> 查询结果</div>
                </div>
                <div class="ListItem">
                    没找到相关信息
                </div>
                <div class="ListItem textCenter">
                    <a href="{{ asset('/Event/NewEvent/') }}">没找到资料？点击添加一个</a>
                </div>
            </div>
        @endif
    </div>
    <?php /* content end */?>
@endsection
<?php /* ============================== */?>
@section('footer')
    <?php /* footer begin */?>
    <div class="BWTab">
        <span class="col2">
            <div class="TabSelectItem">
                <div class="TabItemIcon"><i class="fa fa-search"></i></div>
                <div class="TabItemTitle">查询</div>
            </div>
        </span><span class="col2">
            <a href="{{ asset('/Home/UserInfo/') }}">
                <div class="TabItem">
                    <div class="TabItemIcon"><i class="fa fa-user"></i></div>
                    <div class="TabItemTitle">信息管理</div>
                    {{--<div class="TabItemPoint">122</div>--}}
                </div>
            </a>
        </span>
    </div>
    <?php /* footer end */?>
@endsection
<?php /* ============================== */?>
@section('scripts')
    <?php /* scripts begin */?>
    <script src="{{ asset('/js/Event.js') }}"></script>
    <?php /* scripts end */?>
@endsection
