<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/7
 * Time: 19:44
 * file: front/loginhandle.php 验证登录信息
 */

require_once('./common/include.php');
$mu = new ModelUser('bl_user');

$username = $_POST['username'];
$password = $_POST['password'];
$rem = $_POST['rem'];

$sql = "select * from bl_user where username='" . $username . "' && password='" . $password . "'";
$res = $mu->getRow($sql);
//print_r($res);
// 用户名或密码错误
if(!$res) {
    echo "1"; return;
}

// 未激活
if($res['is_active'] == 0) {
    echo "2"; return;
}

// 记住密码  记住一个星期
if($rem == 'yes') {
    setcookie('name', $username, time()+3600*24*7);
}
else {
    setcookie('name', '', time()-1);
}

// 登录成功 更新用户信息
$ip = get_client_ip();
$time = time();
$_SESSION['name'] = $res['username'];
$res = $mu->update(array('logintime'=>$time, 'loginip'=>$ip), "id=" . $res['id']);


// 添加该用户的购物车内容
if(is_file(ROOT . 'data/shoppingCart/' . $_SESSION['name'])) {

    $_SESSION['cart_temp'] = array();
    // 判断此时（未登录）购物里是否有内容
    if( !$cart->isEmpty()) {
        // 不为空
        $_SESSION['cart_temp'] = $cart->getItems();
    }

    // 清空购物车
    $cart->clear();
    // 添加该用户的购物车内容  执行完这一句之后 $cart仍然为空 重新申请实例时$cart才不为空
    $_SESSION['cart'] = unserialize(file_get_contents(ROOT . 'data/shoppingCart/' . $_SESSION['name']));

    $cart = ToolsShoppingCart::GetCart();  // 同步$cart 和 $_SESSION_['cart'] 即$cart = $_SESSION['cart']

    // 将原来购物车中的内容添加到新购物车中
    if(isset($_SESSION['cart_temp'])) {
        $cart->cartMerge($_SESSION['cart_temp']);
        unset($_SESSION['cart_temp']);
    }

      //for debug
//    print_r($cart->getItems());
//    print_r($_SESSION['cart']);
//    print_r($_SESSION['cart_temp']);
}

echo "0";return;

