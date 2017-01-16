@extends('LayoutMain')
<?php /* ============================== */?>
@section('title','账号信息')
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
        <div class="ListItem">
            <div class="ListTitle"><i class="fa fa-adjust"></i> {{$tmpClient->f_name}} 信息</div>
        </div>
        <div class="ListLine"></div>
        <div class="ListGroup">
            <div class="ListItem">
                <div class="ListTitle"><i class="fa fa-pencil-square-o"></i> 相关描述</div>
            </div>
            <div class="ListItem">
                @foreach ($tmpListEvent as $event)
                    <a href="{{ asset('/Event/ShowEvent/?id='.$event->f_id) }}">
                        <div class="ListLink">
                            <div class="ListTitle2">{{$event->f_title}}</div>
                            <div class="ListTitle3"><i class="fa fa-group"></i> {{$event->f_group_count}}
                                <i class="fa fa-link"></i> {{$event->f_url_count}}
                                <div class="floatRight">{{$event->f_create_time}}</div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="ListItem">
                <a href="{{ asset('/Event/NewEvent/?id='.$tmpClient->f_name) }}" class="ListBtn">添加新描述</a>
            </div>
        </div>
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
