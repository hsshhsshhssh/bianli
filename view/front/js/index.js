$(function () {

    //// 客户服务 和 网站导航的下拉菜单
    //$(".dropdown").hover(function() {
    //    // 显示
    //    $(this).find('ul').eq(0).css("visibility", "visible");
    //}, function () {
    //    // 隐藏
    //    $(this).find('ul').eq(0).css("visibility", "hidden");
    //});


    //// 会员中心 和 购物车的下拉菜单
    //$(".memcar").hover(function () {
    //    // 显示
    //    $(this).find('div').eq(0).css("visibility", "visible");
    //    $(this).css('background-color', "#ffffff");
    //}, function () {
    //    // 隐藏
    //    $(this).find('div').eq(0).css("visibility", "hidden");
    //    $(this).css('background-color', "#fafafa");
    //});
    //
    //
    //// 全部商品的右侧菜单
    //$(".cate_item").hover(function () {
    //    // 显示
    //    $(this).find('div').eq(0).css("visibility", "visible");
    //}, function () {
    //    // 隐藏
    //    $(this).find('div').eq(0).css("visibility", "hidden");
    //});


    // 显示全部商品的下拉菜单
    $("#cate_all_div").css("visibility", "visible");

    // 广告轮播
    $("#ad").slide({
        titCell:".hd ul",
        mainCell:".bd ul",
        effect:"fold",
        interTime:3500,
        delayTime:500,
        autoPlay:true,
        autoPage:true,
        trigger:"click"
    });


    // 显示楼层中的具体商品
    $(".fd_detail").eq(0).css("display", "block");

    // 楼层具体商品的显示
    $(".fd_title ul li").hover(function () {
        // 找到当前楼层的fd_detail
        $(this).parent().parent().parent().find(".fd_detail").css("display", "none");
        $(this).parent().parent().parent().find(".fd_detail").eq($(this).index()).css("display", "block");

        $(".fd_title ul li").find("a").css("color", "#000000");
        $(".fd_title ul li").css("border-bottom-color", "#aaaaaa");
        $(this).find("a").eq(0).css("color", "#E4393C");
        $(this).css("border-bottom-color", "#E4393C");
    }, function () {
        // do nothing
    });
});