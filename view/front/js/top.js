/******file:top.js********/
$(function () {

    // 客户服务 和 网站导航的下拉菜单
    $(".dropdown").hover(function() {
        // 显示
        $(this).find('ul').eq(0).css("visibility", "visible");
    }, function () {
        // 隐藏
        $(this).find('ul').eq(0).css("visibility", "hidden");
    });

});