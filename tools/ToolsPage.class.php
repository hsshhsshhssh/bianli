<?php

/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/7
 * Time: 10:47
 * files: ToolsPage.class.php 分页类
 */
// 分页类
class ToolsPage
{
    // 传人的参数:
    // 1、总条数 $list_total
    // 2、每页显示的条数
    // 3、当前显示的页面 $page
    // 返回的参数:
    // 1、页码数组
    // 分页显示
    public static function DividePage($list_per_page, $list_total, $page, $url="goodslist.php?XXX=XXX")
    {
        $page_total = ceil($list_total / $list_per_page); // 总页数

        // 总页数大于5
        if ($page_total >= 5) {
            if ($page == 1 || $page == 2) {
                $first_page = 1;
            }
            else if ($page == $page_total || $page == $page_total - 1) {
                $first_page = $page_total - 4;
            }
            else {
                $first_page = $page - 2;
            }
            $pages = array(); // 显示的页数（共5页） 并标记当前的页码
            for ($i = $first_page; $i < $first_page + 5; $i++) {
                if ($i != $page) {
                    $pages[$i] = '[' . $i . ']';
                } else {
                    $pages[$i] = $i;
                }
            }
        } // 总页数少于5
        else {  //$first_page = 1;
            $pages = array();
            for ($i = 1; $i <= $page_total; $i++) {
                if ($i != $page) {
                    $pages[$i] = '[' . $i . ']';
                }
                else {
                    $pages[$i] = $i;
                }
            }
        }
//        return $pages;
        $prev_page = $page-1;
        $next_page = $page+1;

//        parse_url(url)

        // 也可用定界符>>>
        $html = "<table id=\"page-table\" cellspacing=\"0\">";
        $html .= "<tr>";
        $html .= "<td align=\"right\" nowrap=\"true\">";
        $html .= "<a href=\"" . $url . "&page=1\" title='第1页'>首页&lt;&lt;</a>&nbsp;&nbsp;";
        $html .="<a href=\"" . $url . "&page=" . $prev_page . "\" title='上一页'>[上一页]</a>&nbsp;&nbsp;&nbsp;&nbsp;";
        foreach($pages as $k=>$v) {
            $html .= "<a href=\"" . $url . "&page=" . $k . "\" title='第1页'>" . $v . "</a>&nbsp;&nbsp;";
        }
        $html .="&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"" . $url . "&page=" . $next_page . "\" title='下一页'>[下一页]</a>&nbsp;&nbsp;";
        $html .="<a href=\"" . $url . "&page=" . $page_total . "\" title='第8页'>&gt;&gt;尾页</a>";

        $html .= "</td>";
        $html .= "</tr>";
        $html .= "</table>";

        return array(
            "pages" => $pages,
            "html" => $html
        );
    }


}