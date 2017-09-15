

















<!DOCTYPE html>
<html>
<!--－ head.jade-->

@section('header')
<head>
  <title>搜狐账号</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="_token" content="{!! csrf_token() !!}"/>
  <link rel="icon" href="http://s0.life.itc.cn/ppweb/images/favicon.ico" mce_href="http://s0.life.itc.cn/ppweb/images/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="http://s0.life.itc.cn/ppweb/images/favicon.ico" mce_href="http://s0.life.itc.cn/ppweb/images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="{{asset('/')}}css/normalize.css">
  <link rel="stylesheet" href="{{asset('/')}}css/reg.css">
  <script type="text/javascript" src="{{asset('/')}}js/jquery.js" charset="UTF-8"></script>
  <script type="text/javascript" src="{{asset('/')}}js/jquery.placeholder.js" charset="UTF-8"></script>
  <script type="text/javascript" src="{{asset('/')}}js/passport20140402.js" charset="UTF-8"></script>
  <script type="text/javascript" src="{{asset('/')}}js/passport-2.js" charset="UTF-8"></script>

  <script src="{{asset('/')}}js/html5shiv.js"></script>

</head>
@show
<body class="regPage">
<!-- nav-->









<header id="toolbar">
  <div class="nav-box clearfix">
    <ul class="nav nav-links pull-right">
      
        
          <li><a href="{{url('login/tologin')}}">登录搜狐通行证<b>&gt;&gt;</b></a></li>
        
        
      
    </ul>
    <ul class="nav nav-links">
      <li><a href="http://www.sohu.com/" target="_blank">搜狐首页</a></li>
      <li><span>|</span></li>
      <li><a href="http://tv.sohu.com/" target="_blank">搜狐视频</a></li>
      <li><span>|</span></li>
      <li><a href="http://k.sohu.com/index.html" target="_blank">搜狐新闻</a></li>
      <li><span>|</span></li>
      <li><a href="http://mp.sohu.com/" target="_blank">搜狐媒体平台</a></li>
    </ul>
  </div>
</header>

<div class="nav-logo"><a href="{{url('login/tologin')}}">搜狐通行证</a></div>
<!-- content-->
@yield('content')





<!-- footer.jade-->

@section('footer')
<footer>
  <div class="footer-content txt-center">
     <p>
        <a href="http://corp.sohu.com" target="_blank">关于我们</a>&nbsp;|&nbsp;
        <a href="http://www.sohu.com" target="_blank">搜狐首页</a>&nbsp;|&nbsp;
        <a href="http://mail.sohu.com" target="_blank">搜狐邮箱</a>&nbsp;|&nbsp;
        <a href="/help" target="_blank">帮助</a></p>
     <p>Copyright &copy; 2017 Sohu.com Inc. All Rights Reserved. 搜狐公司 版权所有</p>
  </div>
</footer>
{{--<script type="text/javascript" src="{{asset('/')}}js/regemail.js"></script>--}}
   <div class="modal confirm-boxs hide" style="height: 200px;">
       <div class="modal-title" style="margin-left: 450px;">
           <a href="javascript:;" class="btn-close" style="font-size: 30px;">×</a></div>
       <div class="modal-content tabs-box">
           <div class="control-group code">
               <span class="pull-right" style="margin-right: 90px;margin-top: 20px;">
                   <a class="auth" onclick="javascript:re_captcha();">
                       <img src="{{ URL('img/captcha/1') }}"  alt="验证码" title="刷新图片" width="100" height="40" id="c2c98f0de5a04167a9e427d883690ff6" border="0">
                   </a>
               </span>
               <label>
                   <span class="ipt" style="width: 100px;height: 40px;margin-top: 20px;display: inline-block;">
                       <input placeholder="请输入验证码" type="text" style="width: 200px;height: 37px;margin-left: 100px;" id="ipt">
                   </span>
               </label>
           </div>
           <div class="alert-block txt-alert" style="margin-left: 100px;font-size:12px;margin-top: 3px;">

           </div>
           <div class="btn-group" style="margin-top: 20px;margin-left: 140px;">
               <input value="确认" class="btn btn-xlarge btn-yellow" type="button">
           </div>
       </div>
   </div>

   <div class="modal-backdrops hide"></div>
<script>
    function re_captcha() {
        $url = "{{ URL('img/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
    }

    $('.btn-close').click(function(){
        $('.confirm-boxs').addClass('hide');
        $('.modal-backdrops').addClass('hide');
    });
</script>
<a class="btn-question" href="/help" target="_blank" style="margin-left: 362px;">
    <i>?</i>
    遇到问题
</a>
@show

<!--[if lt IE 7]>
<script>$('.footer-content > p:first').addClass('pull-right');</script>
<![endif]-->
<script type="text/javascript" src="{{asset('/')}}js/regcellphone.js"></script>



</body>
</html>
<script type="text/javascript">
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>