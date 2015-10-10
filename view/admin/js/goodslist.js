/***file: goodslist.js****/

$(function () {

    // 搜索点击按钮
    $("#search").click(function () {
        var cate_id = parseInt($('select[name=cate_id]').val());
        //console.log(cate_id);

        // 跳转页面
        location.href = 'goodslist.php?cate_id=' + cate_id;
    });

    // 删除商品
    $('.a_del_class').click(function () {
        // 获取cate_id
        var temp = $(this).attr('id').split('&');
        var goods_id = temp[temp.length-2];
        var cate_id = temp[temp.length-1];
        //console.log(goods_id, cate_id);
        // 商品中不存在父子关系 直接删除就行
        if(!confirm('是否删除 '+ goods_id +' 号商品')) {
            return false;
        }

        $.get('goodsdelhandle.php?goods_id=' + goods_id, function (res) {
            if(res != 0) {
                // 删除失败
                alert('删除失败 请重试');
            }
            else {
                alert('删除成功');
                location.href = 'goodslist.php?cate_id=' + cate_id;
            }

        })
    });


});