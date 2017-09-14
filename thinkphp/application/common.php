<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Db;
// 应用公共文件
    // 邮件发送
    function send_mail($tomail, $name, $subject = '', $body = '', $attachment = null) {
        $mail = new \PHPMailer\PHPMailer\PHPMailer();           //实例化PHPMailer对象
        $mail->CharSet = 'UTF-8';           //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
        $mail->IsSMTP();                    // 设定使用SMTP服务
        $mail->SMTPDebug = 0;               // SMTP调试功能 0=关闭 1 = 错误和消息 2 = 消息
        $mail->SMTPAuth = true;             // 启用 SMTP 验证功能
        $mail->SMTPSecure = 'ssl';          // 使用安全协议
        $mail->Host = "smtp.qq.com"; // SMTP 服务器
        $mail->Port = 465;                  // SMTP服务器的端口号
        $mail->Username = "jyc514@foxmail.com";    // SMTP服务器用户名
        $mail->Password = "pnigymuwxbvrcdcg";     // SMTP服务器密码
        $mail->SetFrom('jyc514@foxmail.com', 'static7');
        $replyEmail = '';                   //留空则为发件人EMAIL
        $replyName = '花间提壶小贾总';                    //回复名称（留空则为发件人名称）
        $mail->AddReplyTo($replyEmail, $replyName);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($tomail, $name);
        if (is_array($attachment)) { // 添加附件
            foreach ($attachment as $file) {
                is_file($file) && $mail->AddAttachment($file);
            }
        }
        return $mail->Send() ? true : $mail->ErrorInfo;
    }
    // 查询当前用户所属权限
    function exends($userId){
        $data = Db::table('user_role')->where('userId',$userId)->select();
         $goods = array();
        $box ='';
        foreach ($data AS $key => $val)
        {
            $goods[$key]['roleId']           = $val['roleId'];
            $box.= ",".$val['roleId'];
        }
        $box=ltrim($box,",");
        return $box;
    }