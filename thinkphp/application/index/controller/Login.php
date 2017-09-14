<?php
namespace app\index\controller;
use think\Request;
use think\Db;
use think\Session;
class Login extends \think\Controller
{
	    public function index()
    {
        return $this->fetch('index');
    }
    public function login_add(Request $request){
    	$nickname = Request::instance()->param('userName');// 接受用户名
    	$password = Request::instance()->param('password');// 接受用户密码
    	$pwd 	  = md5($password);
    	$name 	  = Db::table('user')->where('nickname',$nickname)->where('password',$pwd)->find();
        $userId   = $name['userId'];
    	if($name){
            Session::set('name',$nickname);
    		Session::set('userId',$userId);
            $userId=Session::get('userId');
            $name = Session::get('name');
            if($name!='KevinJia'){
                $data = exends($userId);
                print_r($data);die;
            }
    		$this->success('登陆成功,有效期24分钟', 'Index/page1');
    	}else{
    		$this->error('请检查用户名和密码是否正确', 'Login/index');
    	}
    }
    public function login_out(Request $request)
    {
        session(null);
        $this->success('退出成功,欢迎下次到来', 'Login/index');
    }
}