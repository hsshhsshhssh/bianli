<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/4
 * Time: 16:14
 * file: ToolsVerifyCode.class.php 生成验证码
 */

session_start();

$num = '';
for($i=0; $i<4; $i++){
    $num .= dechex(mt_rand(0, 15));
}
$_SESSION['verify'] = $num;

$imagewidth = 60;
$imageheight = 18;
//创建画布
$image = imagecreate($imagewidth, $imageheight);

// 设置背景颜色
imagecolorallocate($image, 240, 240, 240);

// 添加文字
for($i=0; $i<strlen($num); $i++) {
    $randColor = imagecolorallocate($image, mt_rand(0, 50), mt_rand(0, 50), mt_rand(0, 50));
    $x = $imagewidth*$i/4 + mt_rand(2, 5);
    $y = mt_rand(1, $imageheight/4);
    imagestring($image, 5, $x, $y, $num[$i], $randColor);
}

//添加干扰点
for($i=0; $i<200; $i++) {
    $randColor = imageColorallocate($image, mt_rand(100, 250), mt_rand(100, 250), mt_rand(100, 250));
    imagesetpixel($image, mt_rand(0, 60), mt_rand(0, 18), $randColor);
}

header('content-type: image/png');
imagepng($image);
imagedestroy($image);