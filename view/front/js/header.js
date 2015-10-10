/*********file:header.js***********/
$(function () {
    // 会员中心 和 购物车的下拉菜单
    $(".memcar").hover(function () {
        // 显示
        $(this).find('div').eq(0).css("visibility", "visible");
        $(this).css('background-color', "#ffffff");
    }, function () {
        // 隐藏
        $(this).find('div').eq(0).css("visibility", "hidden");
        $(this).css('background-color', "#fafafa");
    });


    // 全部商品的右侧菜单
    $(".cate_item").hover(function () {
        // 显示
        $(this).find('div').eq(0).css("visibility", "visible");
    }, function () {
        // 隐藏
        $(this).find('div').eq(0).css("visibility", "hidden");
    });
});