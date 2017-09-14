

<!DOCTYPE html>
<html>
<!--－ head.jade-->
<head>
    <title>搜狐账号</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" href="https://s0.life.itc.cn/ppweb/images/favicon.ico"
          mce_href="https://s0.life.itc.cn/ppweb/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="https://s0.life.itc.cn/ppweb/images/favicon.ico"
          mce_href="https://s0.life.itc.cn/ppweb/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/home.css">
    <script type="text/javascript" src="../js/jquery.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../js/jquery.placeholder.js"
            charset="UTF-8"></script>
    <script type="text/javascript" src="../js/passport20140402.js"
            charset="UTF-8"></script>
    <script type="text/javascript" src="../js/passport-2.js"
            charset="UTF-8"></script>
    <!-- Le HTML5 shiv, for IE6-8 support of HTML5 elements--><!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
<!-- nav-->
<header>
    <div class="signin pull-right">还没帐号？<a href="//passport.sohu.com/signup" target="_blank">立即注册</a></div>
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
                <div class="stages clearfix"><img src="../picture/f0509d7dc0a14b7681093b1a00d52c63.gif"/></div>
            </div>
        </div>
        <div class="pull-right login-wrap icons">
            <div class="nav-tabs"><a href="javascript:;" class="active">普通登录</a></div>
            <div class="tabs-box">
                <form id="loginform" action="" class="clearfix">
                    <section class="loginform">
                        <div class="control-group">
                            <label><a href="javascript:;" class="shortcut"><i class="img-delete">&times;</i></a><i
                                    class="img-avator"></i><span class="ipt">
                      <input name="userid" type="text" placeholder="请输入邮箱/手机号" tabindex="1"></span></label>
                        </div>
                        <div class="control-group">
                            <label><i class="img-lock"></i><span class="ipt">
                      <input name="password" type="password" placeholder="请输入密码" tabindex="2"></span></label>
                        </div>
                        <div class="alert-block txt-alert txt-center hide">用户名或密码错误</div>
                        <div class="assist clearfix">
                            <div class="pull-right"><a href="/forget_password/input_user" target="_blank">忘记密码</a></div>
                            <label>
                                <input name="rpwd" type="checkbox" tabindex="3"> 下次自动登录
                            </label>
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
                    <a href="/openlogin/request.action?provider=qq&appid=9998&ru=/" title="QQ" tabindex="-1"
                       target="_blank"><i class="img-qq">QQ</i></a>
                    <a href="/openlogin/request.action?provider=sina&appid=9998&ru=/" title="新浪微博" tabindex="-1"
                       target="_blank"><i class="img-sina">新浪微博</i></a>
                    <a href="https://plus.sohu.com/spassport/bind/40000001/wechat?ru=https://passport.sohu.com" title="微信"
                       tabindex="-1" target="_blank"><i class="img-weixin">微信</i></a>
                    <a href="https://plus.sohu.com/spassport/bind/40000001/renren?ru=https://passport.sohu.com"
                       title="人人网" tabindex="-1" target="_blank"><i class="img-renren">人人网</i></a>
                    <a href="/openlogin/request.action?provider=baidu&appid=9998&ru=/" title="百度" tabindex="-1"
                       target="_blank"><i class="img-baidu">百度</i></a>
                    <a href="/openlogin/request.action?provider=taobao&appid=9998&ru=/" title="淘宝" tabindex="-1"
                       target="_blank"><i class="img-taobao">淘宝</i></a>
                    <a href="/openlogin/request.action?provider=t.qq&appid=9998&ru=/" title="腾讯微博" tabindex="-1"
                       target="_blank"><i class="img-qqweibo">腾讯微博</i></a>
                    <a href="/openlogin/request.action?provider=kaixin&appid=1019&ru=https://passport.sohu.com"
                       title="开心网" tabindex="-1" target="_blank"><i class="img-kaixin">开心网</i></a>
                    <a href="/openlogin/request.action?provider=alipay&appid=1019&ru=https://passport.sohu.com"
                       title="支付宝" tabindex="-1" target="_blank"><i class="img-zhifubao">支付宝</i></a>
                    
                    
                    <a href="/openlogin/request.action?provider=douban&appid=9998&ru=/" title="豆瓣" tabindex="-1"
                       target="_blank"><i class="img-douban">豆瓣</i></a>
                    <a href="/openlogin/request.action?provider=tianyi&appid=9998&ru=/" title="天翼" tabindex="-1"
                       target="_blank"><i class="img-tianyi">天翼</i></a>
                    
                    
                    <a href="/openlogin/request.action?provider=qihoo360&appid=9998&ru=/" title="奇虎360" tabindex="-1"
                       target="_blank"><i class="img-360">奇虎360</i></a>
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
<script type="text/javascript" src="../js/jquery.bxslider.js"
        charset="UTF-8"></script>
<script type="text/javascript" src="../js/index.js" charset="UTF-8"></script>
<SCRIPT language=JavaScript src="../js/spv.1309051632.js"></SCRIPT>
</body>
</html>
