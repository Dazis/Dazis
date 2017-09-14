@include('blade.headers')
<div class="nav-logo"><a href="//passport.sohu.com">搜狐通行证</a></div>
<!-- content-->
<div class="content">
  <div class="row">
    <div class="bg-fox icons"><i class="img-fox"></i></div>
    <div class="table-wraper">
      <ul class="nav nav-tabs icons">
        <li class="active"><a href="/signup"><i class="img-cellphone"></i>手机注册</a></li>
        <li><span>|</span></li>
        <li><a href="/signup?signupType=email"><i class="img-email"></i>邮箱注册</a></li>
      </ul>
      <div class="table-box icons">
        <form id="regForm" action="/signup/mobile_signup" class="regForm clearfix" method="post">
          <div class="control-group hide">
            <input type="text"><input type="password">
          </div>
          <div class="control-group">
            <label><span class="tit">手机号码</span><span class="ipt">
                    <input type="text" value="" name="mobile" tabindex="1" autocomplete="off"></span></label>
            <div class="txt-info">注册成功后即可使用手机号码登录</div>
          </div>
          <div class="control-group">
            <label class="passport"><span class="tit">设置密码</span><span class="ipt">
                    <input type="password" value="" name="password" tabindex="2" autocomplete="off"></span></label>
            <div class="txt-info dobule-line">
              <p>6-16位，英文（区分大小写）、数字或常用符号</p>
              <p class="pw-lev"><i></i><i></i><i></i></p>
            </div>
          </div>
          <div class="control-group">
            <label class="verification"><span class="tit">验证码</span><span class="ipt">
                    <input type="text" value="" name="captcha" tabindex="3"></span><a href="javascript:;" class="btn btn-small" btn-act="captcha">点击获取</a>
            </label>
            <div class="txt-info">免费获取手机验证码</div>
          </div>
          <div class="control-group mg-top">
            <div class="pd-left"><span>
                    <label><input type="checkbox" name="agree" tabindex="4">同意</label><a href="/signup/show_agreement" target="_blank">《搜狐服务协议》</a></span>
              <div class="txt-info"></div>
            </div>
          </div>
          <div class="control-group mg-top">
            <div class="pd-left btn-group"><span>
                    <input type="submit" value="立即注册" class="btn btn-xlarge btn-yellow" tabindex="5"></span>
              <div class="txt-info"></div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- footer.jade-->





<footer>
  <div class="footer-content txt-center">
    <p><a href="http://corp.sohu.com" target="_blank">关于我们</a>&nbsp;|&nbsp;<a href="http://www.sohu.com" target="_blank">搜狐首页</a>&nbsp;|&nbsp;<a href="http://mail.sohu.com" target="_blank">搜狐邮箱</a>&nbsp;|&nbsp;<a href="/help" target="_blank">帮助</a></p>
    <p>Copyright &copy; 2017 Sohu.com Inc. All Rights Reserved. 搜狐公司 版权所有</p>
  </div>
</footer>

<!--[if lt IE 7]>
<script>$('.footer-content > p:first').addClass('pull-right');</script>
<![endif]-->
<script type="text/javascript" src="../js/regcellphone.js"></script>
</body>
</html>
