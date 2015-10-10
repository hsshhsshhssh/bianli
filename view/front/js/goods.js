/*****file: goods.js********/
$(function () {

    $("#cate_all_div").hide(0);

    // 图片放大
    $('.jqzoom').jqzoom({
        zoomType: 'standard',
        lens: true,
        preloadImages: false,
        alwaysOn: false,
        zoomWidth: 400,
        zoomHeight: 400,
        title: false
    });

    // 小图片轮放
    $('.gsups_prev').eq(0).click(function () {
        //console.log(parseInt($("#gsup_small_div ul").css("left")));
        if(parseInt($("#gsup_small_div ul").css("left")) <= -496)
            return;
        $("#gsup_small_div ul").stop(false,true).animate({"left":"-=62"},200);
    });
    $('.gsups_next').eq(0).click(function () {
        //console.log(parseInt($("#gsup_small_div ul").css("left")));
        if(parseInt($("#gsup_small_div ul").css("left")) >= 62)
            return;
        $("#gsup_small_div ul").stop(false,true).animate({"left":"+=62"},200);
    });


    // 点击小照片
    $("#gsup_small_div ul li").click(function () {
        $('#gsup_small_div ul li').css("border-color", "#999999");
        $('#gsup_small_div ul li').css("border-width", "1px");
        $(this).css("border-color", "#E4393C");
        $(this).css("border-width", "2px");
    });
    // 刚开始
    $('#gsup_small_div ul li').eq(0).css("border-color", "#E4393C");
    $('#gsup_small_div ul li').eq(0).css("border-width", "2px");


    // 商品的具体描述
    $("#gsdf_title ul li").click(function () {
        // 标记对应的title
        //$("#gsdf_title ul li").css("border-top-color", "#aaaaaa");
        $("#gsdf_title ul li").css("border-top-width", "0");
        $(this).css("border-top-width","3px");

        // 显示相对应的信息
        $(".gsdfb_div").css("display", 'none');
        $(".gsdfb_div").eq($(this).index()).css("display", "block");
    });
    // 刚开始
    $("#gsdf_title ul li").eq(0).css("border-top-width","4px");
    $(".gsdfb_div").eq(0).css("display", "block");


    // 初始化输入框 购买数量
    var buy_total = 1;
    $('input[name=buy_total]').val(1);
    $('input[name=buy_total]').keyup(function () {
        if($(this).val().match(/^\d*$/) == null) {
            alert('参数不合法');
            $(this).val(1);
        }
        buy_total =  parseInt($('input[name=buy_total]').val());
        var max_total = parseInt($("#s_goods_total").html());
        if(buy_total > max_total){
            $('input[name=buy_total]').val(max_total);
            buy_total = max_total;
        }

        setprice();
    });
    // 购买商品加1 减1
    $('.buy_inc').click(function () {
        //alert('aa');
        buy_total =  parseInt($('input[name=buy_total]').val());
        var max_total = parseInt($("#s_goods_total").html());
        if(buy_total < max_total){
            $('input[name=buy_total]').val(buy_total + 1);
        }
        else {
            $('input[name=buy_total]').val(max_total);
        }
        setprice();
    });
    $('.buy_dec').click(function () {
        buy_total =  parseInt($('input[name=buy_total]').val());
        if(buy_total > 1) {
            $('input[name=buy_total]').val(buy_total - 1);
        }
        else {
            $('input[name=buy_total]').val(1);
        }
        setprice();
    });

    // 设置总价格
    function setprice() {
        $num = parseInt($('input[name=buy_total]').val());
        $price = parseInt($('.gsusi_dprice>span>span').html());
        //console.log($num,$price);
        $('#total_price').html($num * $price);
    }


    // 加入购物车
    $('#goods_buy').click(function () {

        var goods_id = parseInt($(this).attr('data'));

        location.href = 'flow.php?type=buy&goods_id=' + goods_id + '&num=' + buy_total;

    });

});