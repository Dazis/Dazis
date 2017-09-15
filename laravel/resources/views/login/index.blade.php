

<!DOCTYPE html>
<html>
<!--－ head.jade-->
<head>
    <title>搜狐账号</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="icon" href="https://s0.life.itc.cn/ppweb/images/favicon.ico"
          mce_href="https://s0.life.itc.cn/ppweb/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="https://s0.life.itc.cn/ppweb/images/favicon.ico"
          mce_href="https://s0.life.itc.cn/ppweb/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('/')}}css/normalize.css">
    <link rel="stylesheet" href="{{asset('/')}}css/home.css">
    <script type="text/javascript" src="{{asset('/')}}js/jquery.js" charset="UTF-8"></script>

    <script type="text/javascript" src="{{asset('/')}}js/jquery.placeholder.js"
            charset="UTF-8"></script>
    <script type="text/javascript" src="{{asset('/')}}js/passport20140402.js"
            charset="UTF-8"></script>
    <script type="text/javascript" src="{{asset('/')}}js/passport-2.js"
            charset="UTF-8"></script>

    <script src="{{asset('/')}}js/html5shiv.js"></script>

</head>
<body>
<!-- nav-->
<header>
    <div class="signin pull-right">还没帐号？<a href="{{url('signup')}}" target="_blank">立即注册</a></div>
    <div class="nav-logo"><a>搜狐通行证</a></div>
</header>
<!-- content-->
<div class="row bg-color">
    <div class="login-box clearfix">
        <div class="pull-left left-area">
            <h1 class="slogan">一证通行&nbsp;&nbsp;,&nbsp;&nbsp;&nbsp;畅享搜狐
                <small>同一账号登录搜狐视频、搜狐新闻、搜狐博客、搜狐焦点等搜狐旗下产品</small>
            </h1>
            <div class="carousel">
                <div class="stages clearfix"><img src="{{asset('/')}}picture/f0509d7dc0a14b7681093b1a00d52c63.gif"/></div>
            </div>
        </div>
        <div class="pull-right login-wrap icons">
            <div class="nav-tabs"><a href="javascript:;" class="active">普通登录</a></div>
            <div class="tabs-box">
                <form id="form" action="{{url('login/insert')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <section class="loginform">
                        <div class="control-group">
                            <label>
                                <a href="javascript:;" class="shortcut" id="dela">
                                    <i class="img-delete" id="del">&times;</i>
                                </a>
                                <i class="img-avator"></i>
                                <span class="ipt">
                                    <input name="userid" type="text" placeholder="请输入邮箱/手机号" tabindex="1" id="ipt">
                                </span>
                            </label>
                        </div>
                        <div class="control-group">
                            <label><i class="img-lock"></i><span class="ipt">
                      <input name="password" type="password" placeholder="请输入密码" tabindex="2"></span></label>
                        </div>
                        <div class="control-group code">
                            <span class="pull-right">
                                 <a class="auth" btn-action="captcha" onclick="javascript:re_captcha();">
                                     <img src="{{ URL('img/captcha/1') }}"  alt="验证码" title="刷新图片" width="100" height="40" id="c2c98f0de5a04167a9e427d883690ff6" border="0">
                                 </a>
                            </span>
                            <label>
                                <span class="ipt">
                                    <input name="captcha" placeholder="请输入验证码" tabindex="3" autocomplete="off" type="text">
                                </span>
                            </label>
                        </div>
                        <div class="alert-block txt-alert txt-center hide"></div>
                        <div class="assist clearfix">
                            <div class="pull-right"><a href="{{url('forget/forget')}}" target="_blank">忘记密码</a></div>
                            {{--<label>--}}
                                {{--<input name="rpwd" type="checkbox" tabindex="3"> 下次自动登录--}}
                            {{--</label>--}}
                        </div>
                        <div class="btnbox clearfix"><a href="javascript:;" btn-action="submit"
                                                        class="btn btn-large btn-yellow pull-left" tabindex="4">登录</a><a
                                    href="/signup" class="btn btn-large btn-yellow pull-right" tabindex="5" target="_blank">注册</a>
                        </div>
                    </section>
                </form>
            </div>
            <div class="pp-other">
                <h5><span><b class="line">其它登录方式</b></span></h5>

                <div class="pp-other-list clearfix sw-hide">
                    <a href="{{url('login/threeLogin')}}" title="QQ" tabindex=""
                       target="_blank"><i class="img-qq">QQ</i></a>
                </div>
                <div class="dropdown cboth"><a href="javascript:;"><i class="img-arrow-down"></i></a></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="info clearfix">
        <dl class="info-safe">
            <dt><i></i>安全保障</dt>
            <dd>全新的搜狐安全体系<br/>充分尊重个人隐私<br/>保障账号安全</dd>
        </dl>
        <dl class="info-login">
            <dt><i></i>一键登录</dt>
            <dd>支持多种登录方式<br/>手机或邮箱账号+密码登录<br/>手机动态码登录</dd>
        </dl>
        <dl class="info-service">
            <dt><i></i>贴心客服</dt>
            <dd>客服邮箱：webmaster@vip.sohu.com</dd>
            <dd>客服电话：010-58103760</dd>
        </dl>
    </div>
</div>
<!-- footer.jade-->
<footer>
    <div class="footer-content txt-center">
        <p><a href="http://corp.sohu.com" target="_blank">关于我们</a>&nbsp;|&nbsp;<a href="http://www.sohu.com"
                                                                                  target="_blank">搜狐首页</a>&nbsp;|&nbsp;<a
                    href="http://mail.sohu.com" target="_blank">搜狐邮箱</a>&nbsp;|&nbsp;<a href="/help" target="_blank">帮助</a>
        </p>

        <p>Copyright &copy; 2017 Sohu.com Inc. All Rights Reserved. 搜狐公司 版权所有</p>
    </div>
</footer>
<script type="text/javascript" src="{{asset('/')}}js/jquery.bxslider.js"
        charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('/')}}js/index.js" charset="UTF-8"></script>
<SCRIPT language=JavaScript src="{{asset('/')}}js/spv.1309051632.js"></SCRIPT>
<script>
    function re_captcha() {
        $url = "{{ URL('img/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
    }


    //验证手机号
    function checkMoblie(moblie){
        var preg = /^1[34578]\d{9}$/;
        if (preg.test(moblie)) {
            return true
        } else {

            return false;
        }
    }
    //验证邮箱
    function checkEmail(email){
        var preg = /^\w+[@]{1}\w+[.]\w+$/;
        if(preg.test(email)){
            return true;
        } else {
            return false;
        }
    }

    function code(obj){
        $.ajax({
            type:'post',
            url:'checkCode',
            data:{
              code:obj
            },success:function(data){
                var da = JSON.parse(data);
                if(da.error=='20001'){
                    return true;
                }else{
                    return false;
                }

            }
        });
    }

    function user(){

        var phone = $("input[name='userid']").val();

        if(phone == ""){
            $('#alert-block').removeClass('hide').html('请填写账号');
            return;
        }
        if(!checkMoblie(phone) || !checkEmail(phone)){
            $('#alert-block').removeClass('hide').html('密码错误');
            return;
        }else{
            var pwd = $("input[name='password']").val();
            $.ajax({
                type:'post',
                url:'login/checkUser',
                data:{
                    phone:phone,
                    password:pwd
                },success:function(data){
                    alert(data);return;
                    var da = JSON.parse(data);
                    if(da.error=='1'){
                        $('#alert-block').addClass('hide').html('');
                        return true;
                    }else{
                        $('#alert-block').removeClass('hide').html('用户名或密码错误');
                        return false;
                    }

                }
            });
        }
    }
    $(function(){
        $("#dela").click(function(){
            $(this).parent().children('.ipt').children('#ipt').val();
        });


        $(":input").focus(function(){
            $('.alert-block').addClass('hide').html('');
        });

        $('.pull-left').click(function(){
            var captcha = $("input[name='captcha']").val();
            $.ajax({
                type:'post',
                url:'checkCode',
                data:{
                    _token:"{{csrf_token()}}",
                    code:captcha
                },success:function(data){
                    var da = JSON.parse(data);
                    if(da.error!='20001'){
                        $('.alert-block').removeClass('hide').html('图形验证码错误');return false;
                    }else{
                        var phone = $("input[name='userid']").val();

                        if(phone == ""){
                            $('.alert-block').removeClass('hide').html('请填写账号');
                            return false;
                        }
                        if(!checkMoblie(phone) && !checkEmail(phone)){
                            $('.alert-block').removeClass('hide').html('用户名或者密码错误');
                            return false;
                        }else{
                            var pwd = $("input[name='password']").val();
                            $.ajax({
                                type:'post',
                                url:'checkUser',
                                data:{
                                    phone:phone,
                                    password:pwd
                                },success:function(data){

                                    var da = JSON.parse(data);
                                    if(da.error=='1'){
                                        $("#form").submit();
                                        $('.alert-block').addClass('hide').html('');
                                        return true;
                                    }else{
                                        $('.alert-block').removeClass('hide').html('用户名或密码错误');
                                        return false;
                                    }

                                }
                            });
                        }
                    }
                }
            });

//            if(user()){
//                $('#loginform').submit();
//            }else{
//                return false;
//            }

        });

    });


</script>
</body>
</html>
<script type="text/javascript">
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>
