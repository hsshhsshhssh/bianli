$(function () {

    // 还原
    $('.catereturn').click(function () {

        // 获取id catereturn
        var cate_id = $(this).attr('id').substr(10);
        var parent_id = $(this).attr('parent_id');
        //console.log(cate_id, parent_id);

        // 发送异步事件
        $.post('catetrashhandle.php', {"cate_id": cate_id, "parent_id":parent_id, "type":"return"}, function (res) {
            //console.log(res);
            if(res == 2 ) {
                alert('父栏目还在回收站\n先还原父栏目');
                return false;
            }
            else if(res != 0) {
                alert('还原失败');
            }
            else {
                alert('还原成功');
            }
            location.href = 'catetrash.php';
        });

        // 阻止a标签的链接事件发生
        return false;
    });


    // 彻底删除
    $('.catedrop').click(function () {

        // 获取id  catedrop
        var cate_id = $(this).attr('id').substr(8);
        var parent_id = $(this).attr('parent_id');
        //console.log(cate_id);

        if(!confirm('彻底删除？(慎重处理)')) {
            return false;
        }

        $.post('catetrashhandle.php', {"cate_id": cate_id,"parent_id":parent_id, "type": "drop"}, function (res) {
            console.log(res);
            if(res != 0) {
                // 彻底删除失败
                alert('彻底删除失败');
            }
            else {
                alert('彻底删除成功');
            }
            location.href = 'catetrash.php';
        });

        // 阻止啊标签的链接事件发生
        return false;
    });

});