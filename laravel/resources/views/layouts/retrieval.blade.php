@include('blade.headers')

<div class="nav-logo"><a href="//passport.sohu.com">搜狐通行证</a><span class="spot">.</span><span class="forget">忘记密码</span></div>
<!-- content-->
<div class="content">
    <div id="password-body" class="row">
        <div class="bg-fox icons"><i class="img-fox"></i></div>
        <section class="agreement">
            <div class="step-box">
                <ul>
                    <li class="step-on">
                        <div class="step-num">1</div><span class="step-word step1">输入账号</span>
                    </li>
                    <li>
                        <div class="step-num">2</div><span class="step-word step2">选择重置方式</span>
                    </li>
                    <li>
                        <div class="step-num">3</div><span class="step-word step3">重置密码</span>
                    </li>
                </ul>
            </div>
            <div class="table-wraper table-wraper-wang">
                <div class="table-box icons">
                    <form id="regForm" action="" class="regForm clearfix">
                        <div class="control-group hide">
                            <input type="text"><input type="text">
                        </div>
                        <div class="control-group">
                            <label><span class="tit tit-wang">账号</span><span class="ipt ipt-wang">
                      <input type="text" name="userid" autocomplete="off" tabindex="1"></span></label>
                            <div class="txt-info"><i class="img-error hide"></i>请输入账号</div>
                        </div>
                        <div class="control-group">
                            <label class="verification"><span class="tit tit-wang">验证码</span><span id="ipt-wang-diff" class="ipt">
                      <input type="text" name="captcha" autocomplete="off" tabindex="2"><span class="code-image"><img src="../picture/e5cd3a561d3142648a789ccc2c7cd136.gif"></span></span><a href="javascript:;" class="change-code">换一张</a>
                            </label>
                            <div class="txt-info">请输入验证码</div>
                            <div class="txt-info hide"><i class="img-error"></i>免费获取手机验证码</div>
                            <div class="txt-info hide"><i class="img-sucess"></i></div>
                        </div>
                        <div class="control-group mg-top">
                            <div id="pd-left-wang" class="pd-left btn-group"><span>
                      <input id="save-wang" type="button" value="下一步" class="btn btn-xlarge btn-yellow" tabindex="3"></span>
                                <div id="txt-info-wang" class="txt-info txt-alert"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- footer-->





<footer>
  <div class="footer-content txt-center">
    <p><a href="http://corp.sohu.com" target="_blank">关于我们</a>&nbsp;|&nbsp;<a href="http://www.sohu.com" target="_blank">搜狐首页</a>&nbsp;|&nbsp;<a href="http://mail.sohu.com" target="_blank">搜狐邮箱</a>&nbsp;|&nbsp;<a href="/help" target="_blank">帮助</a></p>
    <p>Copyright &copy; 2017 Sohu.com Inc. All Rights Reserved. 搜狐公司 版权所有</p>
  </div>
</footer>

<script type="text/javascript" src="../js/password_forgotten.js" charset="UTF-8"></script>
</body>



</html>
