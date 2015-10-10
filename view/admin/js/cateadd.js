$(function () {

    $('input[type=submit]').click(function () {
        // 获取栏目名称
        var cate_name = $.trim($('input[name=cate_name]').eq(0).val());
        if(cate_name == '') {
            alert('栏目名称不能为空');
            $('input[name=cate_name]').focus();
        }

        // 获取父栏目id
        var parent_id = $('option:selected').val();

        // 获取栏目简介
        var cate_desc = $.trim($('textarea[name=cate_desc]').eq(0).val());

        // 发送异步请求
        $.post('cateaddhandle.php', {"cate_name": cate_name, "parent_id": parent_id, "cate_desc": cate_desc}, function (val) {
            if(val == "0") {
                // 添加栏目成功
                location.href = 'catelist.php';
            }
            else {
                // 添加栏目失败
                alert('添加栏目失败 请重试');
                $('input[name=cate_name]').focus();
            }
        })
    });

});