@extends('LayoutMain')
<?php /* ============================== */?>
@section('title','描述信息')
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
            <div class="ListTitle"><i class="fa fa-adjust"></i> {{$tmpEvent->f_title}}</div>
        </div>
        <div class="ListLine"></div>
        <div class="ListGroup">
            <div class="ListItem">
                {{$tmpEvent->f_remark}}
            </div>
        </div>
        <div class="ListLine"></div>
        <div class="ListGroup">
            <div class="ListItem">
                <div class="ListTitle"><i class="fa fa-group"></i> 相关账号</div>
            </div>
            <div class="ListItem">
                @foreach ($tmpListClient as $client)
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
        </div>
        <div class="ListLine"></div>
        <div class="ListGroup">
            <div class="ListItem">
                <div class="ListTitle"><i class="fa fa-map-marker"></i> 相关地址</div>
            </div>
            <div class="ListItem">
                @if(count($tmpListUrl)>0)
                    @foreach ($tmpListUrl as $url)
                        <div class="ListLink">
                            <div class="ListTitle2">{{$url->f_url}}</div>
                        </div>
                    @endforeach
                @else
                    <div class="ListLink">
                        <div class="ListTitle2">无</div>
                    </div>
                @endif
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
