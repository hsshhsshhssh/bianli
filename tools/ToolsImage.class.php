<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/8
 * Time: 15:35
 */
Class ToolsImage {

    // 修改图片的大小
    public static function ResizeImage($src, $width, $height, $type='mid'){
        if(!is_file($src)) {
            return;
        }

        // 获得原图片
        $src_img = imagecreatefromjpeg($src);
        $src_size = getimagesize($src);

        // 创建新图片 不要指定颜色
        $dst_img = imagecreatetruecolor($width, $height);

        // 拷贝图片
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $width, $height, $src_size[0], $src_size[1]);

        // 保存图片
        $filename = substr($src, 0, strrpos($src, '.')) . '_' . $type . '.jpg';
        imagejpeg($dst_img, $filename);
        return $filename;
    }


}