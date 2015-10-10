<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/6
 * Time: 12:19
 * file: uploadimg.php
 */
require_once('./common/include.php');

// 获得上传文件的信息
$tempfile = $_FILES['goods_img'];

// 上传成功
if($tempfile['error'] == 0) {
    // 是POST上传
    if(is_uploaded_file($tempfile['tmp_name'])) {
        // 获取文件后缀名
        $arr = explode('.', $tempfile['name']);
        $ext = end($arr);

        // 生成文件的路径
        $partname = time() . '_' . mt_rand(10000,99999) . '.' . $ext;
        $filename = ROOT . 'data/images/temp/' . $partname;

        if(move_uploaded_file($tempfile['tmp_name'], $filename)) {
            echo "<script type='text/javascript'> parent.document.getElementById('uploadimgtips').innerHTML='上传成功';parent.document.getElementById('uploadimgtips').style.color='green';parent.document.getElementById('img_name').innerHTML='$partname'</script>";
            return;
        }
    }
}

echo "<script type='text/javascript'> parent.document.getElementById('uploadimgtips').innerHTML='上传失败';parent.document.getElementById('uploadimgtips').style.color='red'</script>";
return;