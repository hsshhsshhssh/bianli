<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/4
 * Time: 22:19
 * 无限极分类
 */
class ToolsInfClassify {

    // 返回一维数组
    public static function ClassifyForOne($arr, $parent_id=0, $lev=0, $html='---') {
        $temp = array();
        foreach($arr as $k=>$v) {
            if($v['parent_id'] == $parent_id) {
                $v['lev'] = $lev;
//                $v['html'] = str_repeat($html, $lev+1);
                $temp[] = $v;
                $temp = array_merge($temp, self::ClassifyForOne($arr, $v['cate_id'], $lev+1, $html));
            }
        }

        return $temp;
    }
    //变种之返回子孙id
    public static function ChildrenId($arr, $parent_id) {
        $temp = array();
        foreach($arr as $k=>$v) {
            if($v['parent_id'] == $parent_id) {
                $temp[] = $v['cate_id'];
                $temp = array_merge($temp, self::ChildrenId($arr, $v['cate_id']));
            }
        }
        return $temp;
    }


    // 返回多维数组
    public static function ClassifyForMul($arr, $parent_id=0, $lev=0, $html='---') {
        $temp = array();
        foreach($arr as $k=>$v) {
            if($v['parent_id'] == $parent_id) {
                $v['lev'] = $lev;
//                $v['html'] = str_repeat($html, $lev+1);
                $v['child'] = self::ClassifyForMul($arr, $v['cate_id'], $lev+1, $html);
                $temp[] = $v;
            }
        }

        return $temp;
    }


    // 返回家谱树
    public static function FamilyTree ($arr, $cate_id) {
        $temp = array();
        while($cate_id != 0) {
            foreach($arr as $k=>$v) {
                if($v['cate_id'] == $cate_id) {
                    $temp[]= $v;
                    $cate_id = $v['parent_id'];
                    break;
                }
            }
        }
        return array_reverse($temp);

    }

    // 返回家谱树--递归实现
    public static function FamilyTree2($arr, $cate_id) {
        $temp = array();
        foreach($arr as $k=>$v) {
            if($v['cate_id'] == $cate_id) {
                $temp[] = $v;
                $temp = array_merge(self::FamilyTree2($arr, $v['parent_id']), $temp);
            }
        }

        return $temp;
    }
}