














<!DOCTYPE html>
<html>
<!-- html head-->


<head>
    <title>搜狐账号</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="icon" href="http://s0.life.itc.cn/ppweb/images/favicon.ico" mce_href="http://s0.life.itc.cn/ppweb/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://s0.life.itc.cn/ppweb/images/favicon.ico" mce_href="http://s0.life.itc.cn/ppweb/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('/')}}css/normalize_3.css">
    <link rel="stylesheet" href="{{asset('/')}}css/reg_2.css">
    <link rel="stylesheet" href="{{asset('/')}}css/password.css">
    <script type="text/javascript" src="{{asset('/')}}js/jquery.js" charset="UTF-8"></script>
    <script type="text/javascript" src="{{asset('/')}}js/jquery.placeholder.js" charset="UTF-8"></script>
    <script type="text/javascript" src="{{asset('/')}}js/passport20140402.js" charset="UTF-8"></script>
    <script type="text/javascript" src="{{asset('/')}}js/passport-2.js" charset="UTF-8"></script>

    <script src="{{asset('/')}}js/html5shiv.js"></script>

</head>

<body class="regOther regPage" pageToken="e205e1015b9cd02991c3b3e514f5d220">
<!-- nav-->


<header>
    <div class="nav-box clearfix">
        <ul class="nav nav-links pull-right">
            <li><a href="{{url('login/index')}}">登陆搜狐通行证<b>&gt;&gt;</b></a></li>
        </ul>
        <ul class="nav nav-links">
            <li><a href="{{url('index/show')}}" target="_blank">搜狐首页</a></li>
        </ul>
    </div>
</header>

<div class="nav-logo"><a href="{{url('login/index')}}">搜狐通行证</a><span class="spot">.</span><span class="forget">忘记密码</span></div>
<!-- content-->

@yield('content')

<!-- footer-->




@section('footer')
<footer>
    <div class="footer-content txt-center">
        <p><a href="http://corp.sohu.com" target="_blank">关于我们</a>&nbsp;|&nbsp;<a href="http://www.sohu.com" target="_blank">搜狐首页</a>&nbsp;|&nbsp;<a href="http://mail.sohu.com" target="_blank">搜狐邮箱</a>&nbsp;|&nbsp;<a href="/help" target="_blank">帮助</a></p>
        <p>Copyright &copy; 2017 Sohu.com Inc. All Rights Reserved. 搜狐公司 版权所有</p>
    </div>
</footer>
@show
<script type="text/javascript" src="{{asset('/')}}js/password_forgotten.js" charset="UTF-8"></script>
</body>


</html>
<script type="text/javascript">
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>