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
$type_id=$_POST["type_id"];
$ed_unit=$_POST["edit_work"];

if(($unit_work!='')&&($unit_date!='')&&($unit_time!='')){
//------------------- tb_user สมาชิก
$sql_se = "select * from tb_unit where user_id='$u_id' and unit_date='$unit_date' and unit_time='$unit_time' and unit_st='1' ";
$result_se = mysql_query($sql_se);
$num_se = mysql_num_rows($result_se);
if($num_se==0){
	//////////////////////////////////
	$D_date=date("Y-m-d");
	$D_time=date("H:i:s");
	$D_work="Insert ID=".$u_id."/ Type=".$type_id."/ Date=".$unit_date."/ Time=".$unit_time."/ Unit_No=".$unit_no;
	$sq_ck = "insert into tb_status_ck VALUES ( '', '$login_ID', '$D_work', '$D_time', '$D_date')";
	$re_ck = mysql_query($sq_ck);
	//////////////////////////////////
	$sql_in = "insert into tb_unit VALUES ( '', '$u_id', '$unit_work', '$unit_detail', '$unit_no', '$type_id', '$unit_no', '$unit_date', '$unit_time', '1', '$D_time', '$D_date')";
	$result_in = mysql_query($sql_in);
echo "<script type='text/javascript'>alert('บันทึกข้อมูลเสร็จสิ้น');</script>";
}else{
	if($ed_unit=='Y'){
	if($unit_no=="Null"){$unit_no="";}
	//////////////////////////////////
	$D_date=date("Y-m-d");
	$D_time=date("H:i:s");
	$D_work="Update ID=".$u_id."/ Type=".$type_id."/ Date=".$unit_date."/ Time=".$unit_time."/ Unit_No=".$unit_no;
	$sq_ck = "insert into tb_status_ck VALUES ( '', '$login_ID', '$D_work', '$D_time', '$D_date')";
	$re_ck = mysql_query($sq_ck);
	//////////////////////////////////
		$sql_up = "update tb_unit set unit_work='$unit_work', unit_no='$unit_no', unit_detail='$unit_detail' where user_id='$u_id' and unit_date='$unit_date' and unit_time='$unit_time' and type_id='$type_id' ";
		$result_up = mysql_query($sql_up);
		echo "<script type='text/javascript'>alert('Update บันทึกข้อมูลเสร็จสิ้น');</script>";
	}else{
		$sql_se_recall = "select * from tb_unit where user_id='$u_id' and unit_date='$unit_date' and unit_time='$unit_time' and unit_st='1' and unit_work='311' ";
$result_se_recall = mysql_query($sql_se_recall);
$num_se_recall = mysql_num_rows($result_se_recall);
if($num_se_recall!=0){
//////////////////////////////////
	$D_date=date("Y-m-d");
	$D_time=date("H:i:s");
	$D_work="Insert Type=".$type_id."/ Date=".$unit_date."/ Time=".$unit_time."/ Unit_No=".$unit_no;
	$sq_ck = "insert into tb_status_ck VALUES ( '', '$login_ID', '$D_work', '$D_time', '$D_date')";
	$re_ck = mysql_query($sq_ck);
//////////////////////////////////
	
	$sql_in = "insert into tb_unit VALUES ( '', '$u_id', '$unit_work', '$unit_detail', '$unit_no', '$type_id', '', '$unit_date', '$unit_time', '1', '$D_time', '$D_date')";
	$result_in = mysql_query($sql_in);
	
	
echo "<script type='text/javascript'>alert('บันทึกข้อมูลเสร็จสิ้น');</script>";
}else{
		echo "<script type='text/javascript'>alert('ทำการจองใน วัน และ เวลา นี้แล้ว');</script>";
	}	
	}	
	}
}else{
echo "<script type='text/javascript'>alert('ข้อมูลไม่ครบถ้วน');</script>";
}
$con_date=explode('-',$unit_date);$go_date=$con_date[2]."-".$con_date[1]."-".$con_date[0];
?>
<meta http-equiv="refresh" content="0;url='unit_unit.php?type_id=<?=$type_id?>&unit_date=<?=$go_date?>&unit_time=<?=$unit_time?>'">
</body>
</html>