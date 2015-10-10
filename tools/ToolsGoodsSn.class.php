<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/6
 * Time: 17:21
 * file: ToolsGoodsSn
 */

Class ToolsGoodsSn {

    // 生成唯一的10位的货单号
    public static function GetGoodsSn() {
        $_mu = new ModelUser('bl_goods');

        $sn = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);
//        $sn = mt_rand(0,17);
        $res = $_mu->select(array('goods_sn'), 'goods_sn="' . $sn . '"');
        if($res) {
            return self::GetGoodsSn();
        }
        else {
            return $sn;
        }
    }

    // 生成唯一的订单号 15位
    public static function GetOrderSn() {
        $moi = new ModelOrderInfo('bl_order_info');

        $sn = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 15);
        $res = $moi->select(array('order_sn'), 'order_sn="' . $sn . '"');
        if($res) {
            return self::GetOrderSn();
        }
        else {
            return $sn;
        }
    }
}