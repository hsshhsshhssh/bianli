$(function () {

    // 删除商品
    $(".catedel").click(function () {
        // 获取cate_id catedel
        var cate_id = $(this).attr('id').substr(7);
        //console.log(cate_id);

        // 先判断要删除的栏目是否有父栏目 res为子栏目的数量
        $.post('catedelhandle.php', {"cate_id": cate_id, "type": "query"}, function (res) {
            if (res != 0) {
                // 存在子栏目
                if (confirm("该栏目存在子栏目！！\n会把子栏目全部删除是否继续？")) {
                    // 删除
                    del(cate_id);
                }
                else {
                    // 不删除
                }
            }
            else {
                // 不存在子栏目
                if (confirm("是否删除该栏目？")) {
                    // 删除
                    del(cate_id);
                }
                else {
                    //不删除
                }
            }
        });
        return false;
    });

    // 删除栏目
    function del(cate_id) {
        // 删除
        $.post('catedelhandle.php', {"cate_id": cate_id, "type": "delete"}, function (res) {
            if (res == 0) {
                // 删除栏目成功
                alert('删除栏目成功')
            }
            else {
                // 删除栏目失败
                alert('删除栏目失败');
            }

            // 刷新
            location.href = "catelist.php";
        });
    }

});