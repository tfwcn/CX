<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>承信白名单 - @yield('title')</title>

    <link href="{{ asset('/css/BW.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/Common.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/LayoutMain.css') }}" rel="stylesheet">
    {{--http://www.bootcdn.cn/--}}
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    @yield('header')
</head>
<body>
<div class="body">
    <div class="contentBody">
        <div class="header">
            <div class="title"><a href="{{ asset('') }}">承信白名单</a></div>
            <div class="qrcode" onclick="BWShowObjAutoHide('#urlQrcode');"><i class="fa fa-qrcode"></i>
                <div id="urlQrcode"></div>
            </div>

        </div>
        <div class="middle">
            @yield('content')
        </div>
    </div>
    <div class="footer">
        @yield('footer')
    </div>
</div>
        <!-- Scripts -->
<script src="//cdn.bootcss.com/jquery/2.2.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
<script src="//cdn.bootcss.com/blueimp-md5/2.1.0/js/md5.js"></script>
<script src="{{ asset('/js/BW.js') }}"></script>
<script src="{{ asset('/js/Common.js') }}"></script>
<script language="JavaScript">
    $('#urlQrcode').qrcode({width: 200, height: 200, correctLevel: 0, text: "{{ asset('/') }}"});
</script>
@yield('scripts')
</body>
</html>
