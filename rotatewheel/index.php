<?php
require_once "../../DBHelper.php";
$con = new  DBHelper();
$sql="select 	lby_id, lbyurl, lbyimg, lbyclick, lbytitle from laboratory where lby_id=1";
$res = $con->getAll($sql);
$clickCount = ++$res[0]['lbyclick'];
$con->exec('laboratory', ["lbyclick" => $clickCount], "update", "lby_id=1");
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery转盘抽奖</title>
    <link rel="stylesheet" href="../css/demo.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/awardRotate.js"></script>
    <script>
        $(function() {
            var rotateTimeOut = function() {
                $('#rotate').rotate({
                    angle: 0,
                    animateTo: 2160,
                    duration: 8000,
                    callback: function() {
                        alert('网络超时，请检查您的网络设置！');
                    }
                });
            };
            //转盘状态控制
            var bRotate = false;

            var rotateFn = function(awards, angles, txt) {
                bRotate = !bRotate;
                $('#rotate').stopRotate();
                $('#rotate').rotate({
                    angle: 0,
                    animateTo: angles + 1800,
                    duration: 8000,
                    callback: function() {
                        alert(txt);
                        bRotate = !bRotate;
                    }
                })
            };

            $('.pointer').click(function() {

                if (bRotate) return;

                // var item = rnd(0, 7);
                // 后端服务控制返回
                var item;
                $.ajax({
                    type: 'post',
                    url: "server.php",
                    data: {
                        integral: "60",
                        userid: '1'
                    },
                    dataType: "json",
                    async: false,
                    success: function(data) {
                        item = data;
                        // console.log(item);
                    },
                });
                switch (item) {
                    case 0:
                        // var angle = [26, 88, 137, 185, 235, 287, 337];
                        rotateFn(0, 337, '未中奖');
                        break;
                    case 1:
                        //var angle = [88, 137, 185, 235, 287];
                        rotateFn(1, 26, '免单4999元');
                        break;
                    case 2:
                        //var angle = [137, 185, 235, 287];
                        rotateFn(2, 88, '免单50元');
                        break;
                    case 3:
                        //var angle = [137, 185, 235, 287];
                        rotateFn(3, 137, '免单10元');
                        break;
                    case 4:
                        //var angle = [185, 235, 287];
                        rotateFn(4, 185, '免单5元');
                        break;
                    case 5:
                        //var angle = [185, 235, 287];
                        rotateFn(5, 185, '免单5元');
                        break;
                    case 6:
                        //var angle = [235, 287];
                        rotateFn(6, 235, '免分期服务费');
                        break;
                    case 7:
                        //var angle = [287];
                        rotateFn(7, 287, '提高白条额度');
                        break;
                    case 8:
                        alert('积分不足');
                        break;
                }

                // console.log(item);
            });
        });
        //本地概率控制
        // function rnd(n, m) {
        //     var random= Math.random();

        //     return Math.floor(random * (m - n + 1) + n)
        // }
    </script>
</head>

<body>
    <div class="turntable-bg">
        <div class="pointer"><img src="./pointer.png" alt="pointer"></div>
        <div class="rotate"><img id="rotate" src="./turntable.png" alt="turntable" style="transform: rotate(287deg);">
        </div>
    </div>
    <p style="text-align: center;">
        有后台控制的奖项概率：
        当积分满足60时可以参与抽奖，抽奖后扣除60积分。
        未中奖的概率是：65%；
        免单、免分期的的奖项概率是：30%
        提高白条额度的概率是：5%
    </p>


</body>

</html>