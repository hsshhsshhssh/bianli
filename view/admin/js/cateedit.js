$(function () {

    // 修改提交
    $('input[type=submit]').click(function () {

        // 获取cate_name
        var cate_name = $.trim($('input[name=cate_name]').val());
        if(cate_name == '') {
            alert('栏目名称不能为空');
            return ;
        }

        // 获取父栏目id
        var parent_id = $('option:selected').val();

        // 获取栏目简介cate_desc
        var cate_desc = $.trim($('textarea[name=cate_desc]').val());

        // 获取cate_id
        var cate_id = $('input[name=cate_id]').val();

        // 发送异步请求
        $.post('cateedithandle.php', {"cate_name": cate_name, "parent_id":parent_id, "cate_desc":cate_desc,"cate_id":cate_id}, function (res) {
            //console.log(res);
            if(res == 2){
                alert('父栏目选取不合法');
                return;
            }
            else if(res != 0) {
                alert('编辑失败 请重试');
            }
            else {
                alert('编辑成功');
                location.href = 'catelist.php';
            }
        });

    });

});