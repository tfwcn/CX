<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>我要举报网 - @yield('title')</title>

    <link href="{{ asset('/css/BW.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/Common.css') }}" rel="stylesheet">
    {{--http://www.bootcdn.cn/--}}
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    {{--<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">--}}
    {{--<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css">--}}
    @yield('header')
</head>
<body>
@yield('content') @yield('footer')
        <!-- Scripts -->
<script src="//cdn.bootcss.com/jquery/2.2.0/jquery.min.js"></script>
{{--<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>--}}
{{--<script src="//cdn.bootcss.com/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>--}}
{{--<script src="//cdn.bootcss.com/bootstrap-validator/0.5.3/js/language/zh_CN.min.js"></script>--}}
<script src="//cdn.bootcss.com/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
<script src="//cdn.bootcss.com/blueimp-md5/2.1.0/js/md5.min.js"></script>
<script src="{{ asset('/js/BW.js') }}"></script>
<script src="{{ asset('/js/Common.js') }}"></script>
@yield('scripts')
</body>
</html>
