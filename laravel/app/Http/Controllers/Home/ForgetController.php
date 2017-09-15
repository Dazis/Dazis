<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserInfo;


class ForgetController extends Controller
//忘记密码

{

    public function forget(){
        return view('forget/show');
    }
    //重置方式页面
    public function two(Request $request){
        $data = $request->input();
        $user = array('phone'=>$data['userid']);
        $info = UserInfo::sel($user);
        $email = empty($info->email) ? "": $info->email;

        $userid = substr_replace($data['userid'], '****', 3, 4);
        if($email == ''){
            $mail = '';
        }else{
            $mail = substr_replace($email,'***',3,3);
        }

        $arr = array('userid'=>$userid,'email'=>$mail);

        Session::set('user',$data['userid']);
        if(!empty($email)){
            Session::set('email',$email);
        }

        return view('forget/two',$arr);
    }

    public function rePwd(){
        $user = Session::get('user');
        $userid = substr_replace($user, '****', 3, 4);
        return view('forget/repwd',['user'=>$userid]);
    }
    //验证手机号
    public function checkUser(Request $request) {
        $data = $request->input();
        $data = UserInfo::findPhone($data['phone']);
        if($data) {
            $arr = array('error'=>1,'msg'=>'手机号存在');
        } else {
            $arr = array('error'=>0,'msg'=>'该用户不存在');
        }
        echo json_encode($arr);
    }
    //验证图形验证码
    public function checkCaptcha(Request $request){
        $captcha = $request->input('captcha');
        $imgCode = Session::get('img');
        if ($captcha != $imgCode) {
            $arr =  array('error'=>10003,'msg'=>'请输入正确的图片验证码');
        } else {
            $arr =  array('error'=>20001,'msg'=>'正确');
        }
        echo json_encode($arr);
    }

    //邮箱验证
    public function toEmail(){
        $email = Session::get('email');
        $mail = substr_replace($email,'***',3,3);

        return view('forget/email',['email'=>$email,'mail'=>$mail]);
    }

    public function email(Request $request){

        $getEmail = $request->input('email');

        $code = rand(1000,9999);
        Session::set('msgCode',$code);
        $flag = Mail::raw('验证码:'.$code,function($message){
            $email = Session::get('email');
            $message->from('1494682032@qq.com','天天健康');
            $message->subject('邮件主题 发送邮箱验证码');
            $message->to($email);

        });
        if($flag){
            return redirect('forget/toEmail');
        }
    }


    public function checkMsgCode(Request $request){
        $data = $request->input();
        $code = Session::get('msgCode');
        if($code == $data['code']){
            $arr = array('error'=>1,'msg'=>'success');
        }else{
            $arr = array('error'=>0,'msg'=>'fail');
        }
        echo json_encode($arr);
    }

    public function upd(Request $request){
        $data = $request->input();

        $arr = array('email'=>$data['email'],'password'=>md5($data['password']));
        $da = UserInfo::replace($arr);
        print_r($da);die;
        if($da){
            return redirect('login/tologin');
        }else{
            return redirect('login/tologin');
        }
    }

}
