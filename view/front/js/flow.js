$(function () {

    $("#konshop").click(function () {
        //alert('aa');
        location.href = 'index.php';

    });


    $('input[name=buy_total]').keyup(function () {
        var goods_id = parseInt($(this).attr('id').substr(7));

        if($(this).val().match(/^\d*$/) == null) {
            alert('参数不合法');
            $(this).val(1);
            return;
        }
        var goods_num = parseInt($(this).val());

        console.log(goods_num);
    });
    // 购买商品加1
    $('.buy_inc').click(function () {
        // inc_one
        var goods_id = parseInt($(this).attr('id').substr(7));

        location.href = 'flow.php?type=inc_one&goods_id=' + goods_id;
    });

    // 购买商品减1
    $('.buy_dec').click(function () {
        var goods_id = parseInt($(this).attr('id').substr(7));

        location.href = 'flow.php?type=dec_one&goods_id=' + goods_id;
    });

    // 设置总价格
    function setprice(index) {

    }

});