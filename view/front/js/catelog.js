/*******flie:catelog.js**********/
$(function () {

    //不会消除影响
    //隐藏全部商品的下拉菜单
    //$("#cate_all_div").css("visibility", "hidden");
    ////全部商品的下拉菜单
    //$("#cate_all>a, #cate_all_div").hover(function () {
    //    // 显示
    //    $("#cate_all_div").eq(0).css("visibility", "visible");
    //}, function () {
    //    // 隐藏
    //    $("#cate_all_div").eq(0).css("visibility", "hidden");
    //});

    //// 会消除影响
    //// 隐藏全部商品的下拉菜单
    $("#cate_all_div").hide(0); //会消除影响
    //// 全部的下拉菜单
    //$("#cate.all>a, #cate_all_div").hover(function () {
    //    // 显示
    //    $("#cate_all_div").show(0);
    //    //alert('aa');
    //}, function () {
    //    // 隐藏
    //    $("#cate_all_div").hide(0);
    //});
});