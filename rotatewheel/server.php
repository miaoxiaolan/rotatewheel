<?php
header('content-type:application/json');
// 允许所有来源访问
header('Access-Control-Allow-Origin:*');
//允许访问的方式
// header('Access-Control-Allow-Method:POST,GET');
// require_once "../../DBHelper.php";
// $con=new  DBHelper();
$res=0;
$jf=$_POST['integral'];
$userid=$_POST['userid'];
$num;
if( 60<=$jf){
    $jf=$jf-60;
    //修改积分数据
    // $result = $con->exec('integral',["jf"=>$jf],"update","userid=".$userid);
    $rd=rand(0,100);  

    if($rd<=65){
        $num=0;
    }elseif($rd <= 95){
        $num=rand(1,6);
    }else{
        $num=7;
    }
   

}else{
    $num=8;
}

echo json_encode($num);