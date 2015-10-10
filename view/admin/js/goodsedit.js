/*file: goodsedit.js*/
/*
代码与goodsadd.js 相似 只是验证变量出事值都为真
 */

/**file:goodsadd.js***/
$(function () {

    // 图片文件的格式
    var suffixs = ['jpg', 'jpeg', 'gif', 'bmp', 'png'];

    // 禁止submit按钮
    $('#sureadd').attr("disabled", false);

    // 验证结果变量 必填
    var chkname = 1, chkprice = 1, chkimg = 1;
    var goods_name = '', goods_price = '0', goods_img = '';
    // 选填 填的话 有格式要求
    var chkweight = 1, chknum = 1, chksn = 1;
    var goods_weight = '', goods_num = "1", goods_sn = '';
    // 不用验证
    var  cate_id = 1, is_best = 0, is_new = 0, is_hot = 0, on_sale = 1, goods_key = '';

    // 获取商品名称goods_name
    $('input[name=goods_name]').eq(0).keyup(function () {
        goods_name = $.trim($(this).val());
        if (goods_name == '') {
            // 不通过
            $(this).parent().find("span").eq(0).css("color", "red").html('商品名不能空');
            chkname = 0;
        }
        else {
            // 通过
            $(this).parent().find("span").eq(0).css("color", "green").html("通过");
            chkname = 1;
        }
        chkAll();
    });

    // 验证货号 非必要 填的话要10位数字后字母
    $('input[name=goods_sn]').eq(0).keyup(function () {
        goods_sn = $.trim($(this).val());
        if (goods_sn == '' || goods_sn.match(/^[0-9a-zA-Z]{10}$/) != null) {
            // 通过
            $('#goods_sn_notice').css("color", "green").html("通过");
            chksn = 1;
        }
        else {
            // 不通过
            $('#goods_sn_notice').css("color", "red").html('数字或字母共10位');
            chksn = 0;
        }
        chkAll();
    });

    // 获得cate_id
    $('select[name=cate_id]').change(getCateId);
    function getCateId() {
        cate_id = $('select[name=cate_id]').val();
        //console.log(cate_id);
    }

    // 获得商品价格 goods_price 必须数(整数 数字 小数点)
    $('input[name=shop_price]').keyup(function () {
        goods_price = $.trim($(this).val());
        if (goods_price.match(/^\d+([\d\.]\d+)?$/) == null) {
            // 不通过
            $(this).parent().find('span').eq(0).css("color","red").html('价格格式不对');
            chkprice = 0;
        }
        else {
            // 通过
            $(this).parent().find("span").eq(0).css("color","green").html("通过");
            chkprice = 1;
        }
        chkAll();
    });

    // 处理图片文件上传
    $('#uploadimgbtn').css('visibility', 'hidden');
    $('#uploadimgtips').css('visibility', 'hidden');
    // 获得上传图片文件
    $('input[name=goods_img]').change(function () {
        goods_img = $.trim(($(this).val()));
        //console.log(goods_img);
        var suf = goods_img.split('.');
        if(suffixs.indexOf(suf[suf.length-1]) == -1) {
            // 后缀名不对
            $("#goods_img_tips").css("color", "red").html("图片后缀名不对");
            chkimg = 0;
            $('#uploadimgbtn').css('visibility', 'hidden');
            $('#uploadimgtips').css('visibility', 'hiddem');
        }
        else {
            // 通过
            $("#goods_img_tips").css("color", "green").html("通过");
            //chkimg = 1;
            $('#uploadimgbtn').css('visibility', 'visible');
            $('#uploadimgtips').css('visibility', 'visible').css('color', 'red').html('未上传');
        }
        chkAll();
    });
    // 上传文件
    $('#uploadimg').submit(function () {
        var ifname = 'up' + Math.random();
        $('<iframe name="' + ifname + '" width="0" height="0" frameBorder="0"></iframe>').appendTo($('body'));
        $(this).attr('target',ifname);
        $('#uploadimgtips').css('color','blue').html('正在上传...');
        chkimg = 1;
        chkAll();
    });

    // 获得商品重量
    $('input[name=goods_weight]').eq(0).keyup(function () {
        //alert('aa');
        goods_weight = $.trim($(this).val());
        if(goods_weight == '') {
            // 通过
            $("#goods_weight_tips").css("color", "#c0c0c0").html("可选");
            chkweight = 1;
            goods_weight = "0";
        }
        else if(goods_weight.match(/^\d+([\d\.]\d+)?$/) != null) {
            // 通过
            $("#goods_weight_tips").css("color", "green").html("通过");
            chkweight = 1;
            goods_weight = getWeight();
        }
        else {
            // 不通过
            $("#goods_weight_tips").css("color", "red").html("格式不对");
            chkweight = 0;
            goods_weight = "0";
        }
        chkAll();
        //console.log(goods_weight);
    });
    // 根据单位调整重量
    $('select[name=weight_unit]').change(function () {
        goods_weight = getWeight();
        console.log(goods_weight);
    })


    // 获取商品库存数量
    $('input[name=goods_number]').keyup(function () {
        goods_num = $.trim($(this).val());
        if(goods_num == '') {
            // 通过
            $("#goods_num_tips").css("color", "#c0c0c0").html("选填");
            chknum = 1;
            goods_num = "0";
        }
        else if(goods_num.match(/^\d+$/) != null) {
            // 通过
            $("#goods_num_tips").css("color", "green").html("通过");
            chknum = 1;
        }
        else {
            // 不通过
            $("#goods_num_tips").css("color", "red").html("格式不对");
            chknum = 0;
            goods_num = "0";
        }
        chkAll();
    });


    // 获取是否精品
    $('input[name=is_best]').change(getIsBest);
    function getIsBest() {
        if($('input[name=is_best]').attr('checked')) {
            is_best = 1;
        }
        else {
            is_best = 0;
        }
    }

    // 获取是否新品
    $('input[name=is_new]').change(getIsNew);
    function getIsNew() {
        if($('input[name=is_new]').attr('checked')) {
            is_new = 1;
        }
        else {
            is_new = 0;
        }
    }

    // 获取是否热销
    $('input[name=is_hot]').change(getIsHot);
    function getIsHot() {
        if($('input[name=is_hot]').attr('checked')) {
            is_hot = 1;
        }
        else {
            is_hot = 0;
        }
    }

    // 获取是否上架
    $('input[name=is_on_sale]').change(getOnSale);
    function getOnSale() {
        if($('input[name=is_on_sale]').attr('checked')) {
            on_sale = 1;
        }
        else {
            on_sale = 0;
        }
    }


    //// 商品的详细描述 keditor
    //KindEditor.ready(function (K) {
    //    window.editor = K.creator('#editor_id');
    //});

    // 表单提交
    $('#sureadd').click(function () {

        // 获得编辑器的内容
        editor.sync();
        var goods_details = $('#editor_id').val();

        //获得最新的信息
        getCateId();
        getIsBest();
        getIsHot();
        getIsNew();
        getOnSale();
        // 获得post数据
        var postDate = {
            "goods_id": parseInt($('#goods_id').html()),
            "goods_name": $.trim($('input[name=goods_name]').eq(0).val()),
            "goods_sn":  $.trim($('input[name=goods_sn]').eq(0).val()),
            "goods_price": $.trim($('input[name=shop_price]').eq(0).val()),
            "goods_img": $('#img_name').html(),
            "goods_weight": getWeight(),
            "goods_total": $.trim($('input[name=goods_number]').eq(0).val()),
            "cate_id": cate_id,
            "is_best": is_best,
            "is_new": is_new,
            "is_hot": is_hot,
            "on_sale": on_sale,
            "goods_key": $.trim($('input[name=goods_key]').val()),
            "goods_desc": $.trim($('textarea[name=goods_desc]').val()),
            "seller_note": $.trim($('textarea[name=seller_note]').val()),
            "goods_details": goods_details
        }
        //console.log(postDate);return;
        // 发送异步请求
        $.post('goodsedithandle.php', postDate, function (res) {
            console.log(res);
            if(res != 0) {
                // 不成功
                alert('编辑商品失败 请重试');
            }
            else {
                // 成功
                alert('编辑商品成功');
            }
        });


        // 屏蔽form submit事件
        return false;
    });


    // 计算商品重量
    function getWeight() {
        var weight = $.trim($('input[name=goods_weight]').val())
        var unit = $('select[name=weight_unit]').val();
        return weight*unit; // 字符串的运算也能通过
    }

    //function chkimgupload() {
    //    console.log($('#uploadimgtips').html());
    //    if($('#uploadimgtips').css('color')=='green') {
    //        chkimg = 1;
    //    }
    //    else {
    //        chkimg = 0;
    //    }
    //}

    // 判断所有格式是否正确
    function chkAll() {
        //console.log(chkimg , chkname , chknum , chkprice , chksn, chkweight);
        if(chkimg && chknum && chkprice && chksn && chkweight){
            $('#sureadd').attr('disabled', false);
        }
        else {
            $('#sureadd').attr('disabled', true);
        }
    }


});


