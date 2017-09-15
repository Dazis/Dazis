<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Gregwar\Captcha\CaptchaBuilder;
use Session;

class ImgController extends Controller
{
    public function captcha($tmp)
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Session::flash('img', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }


//    public function code(){
////        $time = date("Y-m-d H:i:s",1505291788);
////        echo $time;die;
//        echo Session::get('img');
//    }
    //
    //

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

    //(获取手机短信验证码)
    public function msgCode(Request $request){
        $phone = $request->input('phone');
        $code = rand(0,9).rand(0,9).rand(0,9).rand(0,9);
        Session::set('code',$code);
        $url = 'http://api.k780.com/?app=sms.send&tempid=51015&param=usernm%3Dadmin%26code%3D'.$code.'&phone='.$phone.'&appkey=23760&sign=e9d71c5357903f13aa5c68ddcf799cab&format=json';
    //{"success":"1","result":{"status":"OK","phone":"15313712394","qty":"1"}}
        $data = curl($url,true,0,0);

        $value = json_decode($data);
        $arr = array('success'=>$value->success,'msg'=>'this is success');
        echo json_encode($arr);
    }
    //验证手机短信验证码
    public function checkCap(Request $request){
        $cap = $request->input('cap');
        $code = Session::get('code');
        if($cap == $code) {
            echo 1;
        }else {
            echo 0;
        }
    }
}
