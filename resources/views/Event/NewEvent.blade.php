@extends('LayoutMain')
<?php /* ============================== */?>
@section('title','新增账号信息')
<?php /* ============================== */?>
@section('header')
    <?php /* header begin */?>
    <link href="{{ asset('/css/Event.css') }}" rel="stylesheet">
    <?php /* header end */?>
@endsection
<?php /* ============================== */?>
@section('content')
    <?php /* content begin */?>
    <div class="HomeRegister BWList">
        <form class="EventNewFrom BWForm" action="{{ asset('/Event/NewEventSubmit') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="ListItem">
                <div class="ListTitle"><i class="fa fa-adjust"></i> 新增账号信息</div>
            </div>
            <div class="ListLine"></div>
            <div class="ListGroup">
                <div class="ListItem">
                    <div class="ListTitle"><i class="fa fa-group"></i> 相关账号</div>
                </div>
                <div class="ListItem">
                    <div class="FormGroup">
                        <div class="FormLeft"><i class="fa fa-user"></i></div>
                        <a class="FormRight" href="javascript:AddClient()"><i class="fa fa-plus"></i></a>
                        <div class="FormInput FormInput2">
                            <input class="FormText" type="text" name="f_client_name" value="{{$f_name}}"/>

                            <div class="FormTip">使用到账号(点右边按钮可继续添加)</div>
                            <div class="FormInputItems ClientItems">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ListLine"></div>
            <div class="ListGroup">
                <div class="ListItem">
                    <div class="ListTitle"><i class="fa fa-group"></i> 事件描述</div>
                </div>
                <div class="ListItem">
                    <div class="FormGroup">
                        <div class="FormLeft"><i class="fa fa-envelope"></i></div>
                        <div class="FormInput">
                            <input class="FormText" type="text" name="f_event_title"/>

                            <div class="FormTip">标题(长度小于50)</div>
                        </div>
                    </div>
                </div>
                <div class="ListItem">
                    <div class="FormGroup">
                        <div class="FormLeft"><i class="fa fa-ellipsis-h"></i></div>
                        <div class="FormInput">
                            <textarea class="FormTextMul" name="f_event_remark"></textarea>

                            <div class="FormTip">描述内容(长度小于500)</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ListLine"></div>
            <div class="ListGroup">
                <div class="ListItem">
                    <div class="ListTitle"><i class="fa fa-map-marker"></i> 相关地址(增加可信度)</div>
                </div>
                <div class="ListItem">
                    <div class="FormGroup">
                        <div class="FormLeft"><i class="fa fa-navicon"></i></div>
                        <a class="FormRight" href="javascript:AddUrl()"><i class="fa fa-plus"></i></a>
                        <div class="FormInput FormInput2">
                            <input class="FormText" type="text" name="f_url"/>

                            <div class="FormTip">相关地址(点右边按钮可继续添加)</div>
                            <div class="FormInputItems UrlItems">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ListLine"></div>
            <div class="ListItem">
                <div class="FormGroup">
                    <input class="FormSubmit" type="submit" title="确定" value="确定"/>
                </div>
            </div>
        </form>
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
    <script src="{{ asset('/js/Event.js') }}"></script>
    <?php /* scripts end */?>
@endsection
