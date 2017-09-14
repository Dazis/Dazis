<?php
namespace app\index\controller;
use think\Session;
class Product extends \think\Controller
{
    public function __construct(){
        parent::__construct();
        $session = Session::get('name');
        if($session==""){
            $this->error('请先登录', 'Login/index');
        }
    }
    //产品管理列表
    public function pro_list(){
    	return $this->fetch('pro_list');
    }
    //产品分类列表
    public function type_list(){
    	return $this->fetch('type_list');
    }
    //添加产品
    public function product_add(){
        return $this->fetch('product_add');
    }
   
    //添加分类
    public function product_type_add(){
        return $this->fetch('product_type_add');
    }
}
