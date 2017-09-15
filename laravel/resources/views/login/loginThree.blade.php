<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">






<head>
    <meta http-equiv="Content-Type" content="text/html; charset=GBK" />
    <title>搜狐通行证 - Passport 连接服务</title>
    <script type="text/javascript" src="{{asset('/')}}js/prototype.js"></script>
    <link rel="stylesheet" type="text/css" href="//a2.itc.cn/passport/css/oauth/style2.css"/>

    <script>
        function getBrowser() {
            var Sys = {};
            var ua = navigator.userAgent.toLowerCase();
            var s;
            (s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :
                    (s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :
                            (s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :
                                    (s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :
                                            (s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0;
            return Sys;
        }

        function resizeWindow(e) {
            var Browser = getBrowser();
            var size = {'width' : 710, 'height' : 630};
            if (Browser.ie) {
                if ('8.0' == Browser.ie) {
                    size = {'width' : 710, 'height' : 610};
                } else if ('7.0' == Browser.ie) {
                    size = {'width' : 710, 'height' : 610};
                } else if ('6.0' == Browser.ie) {
                    size = {'width' : 710, 'height' : 610};
                } else {
                    size = {'width' : 710, 'height' : 610};
                }
            } else if (Browser.chrome) {
                size = {'width' : 710, 'height' : 550};
            } else if (Browser.safari) {
                size = {'width' : 710, 'height' : 610};
            }

            window.resizeTo(size.width, size.height);
        }

        function checkAgree() {
            $('agree_btn').disabled=!$('useragree').checked;
            if ($('agree_btn').disabled) {
                $('agree_btn').removeClassName('p_button');
                $('agree_btn').addClassName('p_button_disabled');
            } else {
                $('agree_btn').removeClassName('p_button_disabled');
                $('agree_btn').addClassName('p_button');
            }
        }


        var repeatsubmit = false;

        function submitForm() {
            if ($('useragree').checked) {
                if(repeatsubmit){
                    return;
                }
                setTimeout(clearSubmit, 5000);
                repeatsubmit = true;
                $('agreementFrm').submit();
            } else {
                alert('您只有同意搜狐服务协议才能继续');
            }
        }

        function clearSubmit(){
            repeatsubmit = false;
        }
    </script>
</head>

<body>
<div id="frame">
    <div class="pic_head"></div>
    <!--login_content-->
    <div class="login_content">
        <!--con_left-->
        <div class="con_left">
            <form id="agreementFrm" name="agreementFrm" method="post" action="{{url('login/agreeThree')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <p> 亲爱的 <span>{{$nickname}}</span>，欢迎您来到搜狐网，请点击“激活”立即开始体验</p>

                <p>
                    <label for="new_name">取个更好听的名字吧：</label>
                        <input type="text" id="new_name" name="uniqname" class="" value="qq_{{$nickname}}" style="width:150px;" />
                    <span style="color:red;display: block;margin-left: 130px;"> </span>
                </p>


                {{--<input type="hidden" name="logo" value="//a1.itc.cn/passport/images/connect/pic_qq.jpg"></input>--}}
                {{--<input type="hidden" name="token" value="8939b07fd06d33d9bc6e60488aa14b94"></input>--}}
                {{--<input type="hidden" name="uid" value="A352D3F2BA65158C34034F84C9D775A0"></input>--}}
                {{--<input type="hidden" name="timestamp" value="1505372856614"></input>--}}
                {{--<input type="hidden" name="provider" value="qq"></input>--}}
                {{--<input type="hidden" name="openapptype" value=""></input>--}}
                {{--<input type="hidden" name="nick" value="ybPBow=="></input>--}}


                <input type="button" alt="激活" value="" class="button_jihuo" id="agree_btn" onclick="submitForm()" />
                <p style="text-align:center;margin:16px 0 0 6px">
                    <input type="checkbox" id="useragree" name="useragree" checked="checked" value="true" style="width: 14px;height: 14px;padding: 0px;margin: 0px;vertical-align: middle;" />
                    &nbsp;&nbsp;同意<a href="http://passport.sohu.com/web/serviceitem.jsp" target="_blank">搜狐服务协议</a>
                </p>
            </form>
        </div>
        <!--end con_left-->

        <!--con_right-->
        <div class="con_arr">
            <div class="other">
                <img src="//a1.itc.cn/passport/images/connect/pic_qq.jpg" border="0" />
            </div>
        </div>
        <!--end con_right-->
    </div>
    <!--end login_content-->

</div>
</body>
</html>
