<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/5
 * Time: 13:02
 */
require_once('./common/include.php');

$mu = new ModelUser('bl_cate');

$sql = "select c1.cate_id,c1.cate_name,c1.is_delete,c1.parent_id,c2.cate_name as parent_name from bl_cate as c1 left join bl_cate as c2 on c1.parent_id=c2.cate_id where c1.is_delete=1";

$catelist = $mu->getAll($sql);
//print_r($catelist);

require(ROOT . 'view/admin/templates/catetrash.html');