<?php
header('content-type:application/json');
// 允许所有来源访问
header('Access-Control-Allow-Origin:*');
//允许访问的方式
// header('Access-Control-Allow-Method:POST,GET');
require_once "DBHelper.php";
$con=new  DBHelper();



$res=0;
$jf=$_POST['integral'];
$userid=$_POST['userid'];
if( 60<=$jf){
    $jf=$jf-60;
    //修改积分数据
    $result = $con->exec('integral',["jf"=>$jf],"update","userid=".$userid);
    rand(0,6);
    echo json_encode($result);

}