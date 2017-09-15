<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserInfo;

class LoginController extends Controller
{
    public function tologin(){
        return view('login.index');
    }
    //存session  登录成功
    public function insert(Request $request){
        $data = $request->input();

        if(preg_match("/^1[34578]{1}\d{9}$/",$data['userid'])){
            $arr = array('phone'=>$data['userid'],'password'=>md5($data['password']));
        }else {
            $arr = array('email'=>$data['userid'],'password'=>md5($data['password']));
        }

        $da = UserInfo::sel($arr);
        if($da){
            Session::set('user',$data['userid']);
            return redirect('index/show');
        }
    }

    public function checkUser(Request $request){
        $data = $request->input();
        if(preg_match("/^1[34578]{1}\d{9}$/",$data['phone'])){
            $arr = array('phone'=>$data['phone'],'password'=>$data['password']);
        }else{
            $arr = array('email'=>$data['phone'],'password'=>$data['password']);
        }
        $da = UserInfo::PhonePwd($arr);
        if($da){
            $arr = array('error'=>1,'msg'=>'this is success');
        }else{
            $arr = array('error'=>0,'msg'=>'this is error');
        }
        echo json_encode($arr);
    }

    //验证图形验证码
    public function checkCode(Request $request){
        $code = $request->input('code');
        $imgCode = Session::get('img');
        if ($code != $imgCode) {
            $arr =  array('error'=>10003,'msg'=>'请输入正确的图片验证码');
        } else {
            $arr =  array('error'=>20001,'msg'=>'正确');
        }
        echo json_encode($arr);
    }

    public function threeLogin(){
        $code_url="https://graph.qq.com/oauth2.0/authorize";
        //$callback=urlencode(CALLBACK_URL);
        $params=[
            //授权类型（必须 固为code）
            'response_type'=>'code',
            //申请QQ登录成功后，分配给应用的appid （必须）
            'client_id'=>CLIENT_ID,
            //成功授权后的回调地址 （必须）
            'redirect_uri'=>CALLBACK_URL,
            //client端的状态值 （必须）
            'state'=>uniqid(),
            //请求用户授权时向用户显示的可进行授权的列表 （可选）
            'scope'=>'get_user_info,add_t'
        ];
        $str=http_build_query($params);
        //print_r($str);die;
        //生成授权登陆地址
        $auth_url=$code_url.'?'.$str;
        //print_r($auth_url);die;
        //跳转到授权登陆地址
        header('location:'.$auth_url);
    }

    public function findThree(Request $request){
        $data = $request->input();
        $openData = UserInfo::openId($data['openid']);
        if($openData){
            Session::set('openid',$data['openid']);
            Session::set('nickname',$data['nickname']);
            return redirect('index/show');
        }else{
            Session::set('openid',$data['openid']);
            Session::set('nickname',$data['nickname']);
//            $nickname = $data['nickname'];
//            $url = 'http://www.shjk.com/login/openLogin?nickname='.$nickname;
//            header("Location:$url");
            return redirect('login/openLogin');
        }
    }

    public function openLogin(Request $request){

        return view('login.loginThree',['nickname'=>Session::get('nickname')]);
    }

    public function agreeThree(Request $request){
        $data = $request->input();
        $openid = Session::get('openid');
        $nickname = $data['uniqname'];
        $arr = array('openId'=>$openid,'nickname'=>$nickname);
        $data = UserInfo::add($arr);
        if($data){
            return redirect('index/show');
        }else {
            return Redirect::back();
        }
    }
}
