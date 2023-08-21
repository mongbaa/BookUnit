<?
session_start();

if($_SESSION["login_ID"]==""){
	?><meta http-equiv="refresh" content="0;url='../index.php"><?
}else{
	$login_ID=$_SESSION["login_ID"];
}
	// connect to database.
	include("../connect.php");
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Dent Unit</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link href="style.css" rel="stylesheet" type="text/css" /> 
</head>
<body>
<?
$unit_date=$_POST["unit_date"];
$unit_time=$_POST["unit_time"];
$u_id=$_POST["u_id"];
$unit_work=$_POST["unit_work"];
$unit_detail=$_POST["unit_detail"];
$unit_no=$_POST["unit_no"];
$unit_type=$_POST["unit_type"];
$type_id=$_POST["type_id"];

	//////////////////////////////////
	$D_date=date("Y-m-d");
	$D_time=date("H:i:s");
	$D_work="Update Type=".$type_id."/ Date=".$unit_date."/ Time=".$unit_time."/ Unit_No=".$unit_no;
	$sq_ck = "insert into tb_status_ck VALUES ( '', '$login_ID', '$D_work', '$D_time', '$D_date')";
	$re_ck = mysql_query($sq_ck);
	//////////////////////////////////

if($unit_work!=""){
//------------------- tb_user สมาชิก
 $sql_se = "select * from tb_unit where user_id='$u_id' and unit_date='$unit_date' and unit_time='$unit_time' and unit_st!=0 ";
$result_se = mysql_query($sql_se);
$num_se = mysql_num_rows($result_se);
if($num_se==1){
	$sql_up = "update tb_unit set unit_work='$unit_work', unit_detail='$unit_detail' where user_id='$u_id' and unit_date='$unit_date' and unit_time='$unit_time' and type_id='$type_id' ";
	$result_up = mysql_query($sql_up);
echo "<script type='text/javascript'>alert('บันทึกข้อมูลเสร็จสิ้น');</script>";
}
}else{echo "<script type='text/javascript'>alert('ข้อมูลไม่ครบถ้วน');</script>";}
$con_date=explode('-',$unit_date);$go_date=$con_date[2]."-".$con_date[1]."-".$con_date[0];
?>
<meta http-equiv="refresh" content="0;url='unit_form.php?type_id=<?=$type_id?>&unit_date=<?=$go_date?>&unit_time=<?=$unit_time?>'">
</body>
</html>