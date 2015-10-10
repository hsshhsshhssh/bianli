<?php 
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/4
 * Time: 12:01
 * file: /front/index.php  前台首页
 */

require_once('./common/include.php');


$res = ToolsInfClassify::ClassifyForMul($ALLCATE);
$catelist = $res[0]['child'];
//print_r($catelist);


// 获得商品 查询两次数据库 bl_cate一次 goods_id一次 两次的结果合并再无限极分类
// 获得前5栏目的cate_id及子栏目cate_id
$allCateId = array_slice($catelist, 0, 5);
$allCateId = array_get_by_key($allCateId, 'cate_id');

// 获得这些cate_id的所有商品
$sql = "select c.cate_id,c.cate_name,c.parent_id from bl_cate as c where c.cate_id in (" . implode(',',$allCateId) . ')';
$res1 = $mc->getAll($sql);


$sql = "select g.goods_id, g.goods_name, g.cate_id as parent_id, g.cate_id_temp as cate_id, g.goods_img, g.goods_price from bl_goods as g where g.cate_id in (" . implode(',',$allCateId) . ')';
$res2 = $mg->getAll($sql);

// 无限极分类整合成(cate_id的)一维数组

$alllist = ToolsInfClassify::ClassifyForMul(array_merge($res1,$res2), 1);


require(ROOT . 'view/front/index.html');


/************************function***********************************************************************/
// 返回cate_id的值
function array_get_by_key(array $array, $string){
    if (!trim($string)) return false;
//    preg_match_all("/\"$string\";\w{1}:(?:\d+:|)(.*?);/", serialize($array), $res);
    preg_match_all("/\"$string\";\w{1}:\d+:\"(\d+)\"(.*?);/", serialize($array), $res);
    return $res[1];
}