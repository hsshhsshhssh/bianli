<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/7
 * Time: 16:10
 * file: front/registerhandle.php  检查用户名是否重复
 */
require_once('./common/include.php');
require_once(ROOT . 'tools/email/mySendEmail.class.php');

// 获得数据库实例
$mu = new ModelUser('bl_user');

// 判断操作的类型 chkuname为检查用户名是否重复
$type = $_POST['type'];
//print_r($_POST);

// 检查用户名是否重复
if($type == 'chkuname') {
    // 获得待检查的用户名
    if(empty($_POST['username'])) {
        echo "1"; return;
    }
    else {
        $username = $_POST['username'];
    }
    $sql = "select count(*) from bl_user where username='" . $username . "'";
    $res = $mu->getOne($sql);
    if($res != 0) {
        // 重复
        echo "1";return;
    }
    else {
        echo "0";return;
    }
}
else if($type == 'register') {
    $data = array(
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'email' => $_POST['email']
    );

    $res = $mu->insert($data);
    if($res != 1) {
        echo "1";return ;
    }
    else {
        // 注册成功
        //smtp服务器
        $as = array (
            "user" => "2094171067@qq.com",
            "password" => "a19940622"
        );
        // 发件邮箱
        $af = array(
            "add" => "2094171067@qq.com",
            "name" => "from " . '便利店'
        );
        // 收件邮箱
        $at = array(
            "add" => $data["email"],
            "name" => "to hssh"
        );
        // 邮件主题
        $title = "欢迎注册成为便利店会员 请激活";

        // 邮件内容body
        $url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']) . '/registeractive.php';
        $url .= "?username=" . $data['username'];
        $body = $data["username"] . ": 注册成功 " . '<a href="' . $url . '"target="_blank">请点击该地址</a></br>' . '激活你的账号';

        $mail = new MySendEmail($as, $af, $at, $title, $body);
        if($mail->mySend()) {
            echo "0";return ;
        }
        else {
            echo "1";return;
        }
    }
}