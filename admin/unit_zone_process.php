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
$zone_name=$_POST["zone_name"];
$teacher_id=$_POST["teacher_id"];
$unit_list=$_POST["unit_list"];
$type_id=$_POST["type_id"];
$ed_zone=$_POST["edit_zone"];
if(($zone_name!='')&&($unit_date!='')&&($unit_time!='')){
//------------------- tb_user สมาชิก
$sql_se_zone = "select * from tb_unit_zone where unit_zone='$zone_name' and unit_date='$unit_date' and unit_time='$unit_time' ";
$result_se_zone = mysql_query($sql_se_zone);
$num_se_zone = mysql_num_rows($result_se_zone);
if($num_se_zone==0){
	$sql_in_zone = "insert into tb_unit_zone VALUES ( '', '$unit_date', '$unit_time', '$zone_name', '$type_id', '$teacher_id', '$unit_list')";
	$result_in_zone = mysql_query($sql_in_zone);
echo "<script type='text/javascript'>alert('บันทึกข้อมูลเสร็จสิ้น');</script>";
}else{
	if($ed_zone=='Y'){
		$sql_up_zone = "update tb_unit_zone set unit_list='$unit_list', teacher_id='$teacher_id' where unit_zone='$zone_name' and unit_date='$unit_date' and unit_time='$unit_time' and type_id='$type_id' ";
		$result_up_zone = mysql_query($sql_up_zone);
		echo "<script type='text/javascript'>alert('Update บันทึกข้อมูลเสร็จสิ้น');</script>";
	}else{echo "<script type='text/javascript'>alert('ชื่อโซนซ้ำครับ');</script>";}
	}
}else{
echo "<script type='text/javascript'>alert('ข้อมูลไม่ครบถ้วน');</script>";
}
$con_date=explode('-',$unit_date);$go_date=$con_date[2]."-".$con_date[1]."-".$con_date[0];
?>
<meta http-equiv="refresh" content="0;url='unit_unit.php?type_id=<?=$type_id?>&unit_date=<?=$go_date?>&unit_time=<?=$unit_time?>'">
</body>
</html>