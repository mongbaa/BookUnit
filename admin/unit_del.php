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
$unit_date=$_GET["unit_date"];
$unit_time=$_GET["unit_time"];
$type_id=$_GET["type_id"];
$work_id=$_GET["work_id"];
$zone_id=$_GET["zone_id"];
if($work_id!=''){
	//////////////////////////////////
	$sql_se_ck = "select * from tb_unit where id='$work_id' ";
	$result_se_ck = mysql_query($sql_se_ck);
	$show_check_se_ck = mysql_fetch_assoc($result_se_ck);
	$u_id=$show_check_se_ck['user_id'];
	$D_date=date("Y-m-d");
	$D_time=date("H:i:s");
	$D_work="Delete ID=".$u_id."/ Type=".$type_id."/ Date=".$unit_date."/ Time=".$unit_time."/ Unit_No=".$unit_no;
	$sq_ck = "insert into tb_status_ck VALUES ( '', '$login_ID', '$D_work', '$D_time', '$D_date')";
	$re_ck = mysql_query($sq_ck);
	//////////////////////////////////
$sql_in = "delete from tb_unit where id='$work_id'";
$result_in = mysql_query($sql_in);
}
if($zone_id!=''){
$sql_in = "delete from tb_unit_zone where id='$zone_id'";
$result_in = mysql_query($sql_in);
}
echo "<script type='text/javascript'>alert('บันทึกข้อมูลเสร็จสิ้น');</script>";
?>
<meta http-equiv="refresh" content="0;url='unit_unit.php?type_id=<?=$type_id?>&unit_date=<?=$unit_date?>&unit_time=<?=$unit_time?>'">
</body>
</html>