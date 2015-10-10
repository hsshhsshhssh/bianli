$(function () {

    // 搜索点击事件
    $('#search').click(function () {
        //获得cate_id
        var cate_id = $.trim($('select[name=cate_id]').val());
        console.log(cate_id);

        // 跳转页面
        location.href = 'goodstrash.php?cate_id=' + cate_id;
    });

    // 还原
    $('.a_return').click(function () {
        // 获得cate_id goods_id
        var temp = $(this).attr('id').split('&');
        var goods_id = temp[temp.length-2];
        var cate_id = temp[temp.length-1];
        //console.log(goods_id, cate_id);

        // 异步请求
        $.post('goodstrashhandle.php', {"type": "return", "goods_id": goods_id}, function (res) {
            if(res != 0) {
                //还原失败
                alert('还原失败 请重试');
            }
            else {
                alert('还原成功');
                location.href = 'goodstrash.php?cate_id=' + cate_id;
            }
        });
    });


    // 彻底删除
    $('.a_fulldel').click(function () {

        // 获得cate_id goods_id
        var temp = $(this).attr('id').split('&');
        var goods_id = temp[temp.length-2];
        var cate_id = temp[temp.length-1];
        //console.log(goods_id, cate_id);

        if(!confirm("确定彻底删除 " + goods_id + " 号商品")) {
            return false;
        }

        // 异步请求
        $.post('goodstrashhandle.php', {"type": "fulldel", "goods_id": goods_id}, function (res) {
            if(res != 0) {
                //还原失败
                alert('彻底删除失败 请重试');
            }
            else {
                alert('彻底删除成功');
                location.href = 'goodstrash.php?cate_id=' + cate_id;
            }
        });
    });
});