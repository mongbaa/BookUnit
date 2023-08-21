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
$unit_st=$_GET["unit_st"];

$sql_check_se = "select * from tb_unit ut ";
$sql_check_se .= "right join tb_user ur on ut.user_id = ur.user_id ";
$sql_check_se .= "where ut.id='$work_id' ";
$result_check_se = mysql_query($sql_check_se);
$show_check_se = mysql_fetch_assoc($result_check_se);
$num_check_se = mysql_num_rows($result_check_se);
$unit_no=$show_check_se['unit_no'];
$user_year=$show_check_se['level'];
$con_date=explode("-",$unit_date);
$go_date=$con_date[2]."-".$con_date[1]."-".$con_date[0];
//////////////////////////////////
	$sql_se_ck = "select * from tb_unit where id='$work_id' ";
	$result_se_ck = mysql_query($sql_se_ck);
	$show_check_se_ck = mysql_fetch_assoc($result_se_ck);
	$u_id=$show_check_se_ck['user_id'];
	$D_date=date("Y-m-d");
	$D_time=date("H:i:s");
	$D_work="Cancle ID=".$u_id."/ Type=".$type_id."/ Date=".$unit_date."/ Time=".$unit_time."/ Unit_No=".$unit_no."/ unit_st=".$unit_st;
	$sq_ck = "insert into tb_status_ck VALUES ( '', '$login_ID', '$D_work', '$D_time', '$D_date')";
	$re_ck = mysql_query($sq_ck);
	//////////////////////////////////
if($num_check_se=='1'){
$sql_check = "select * from tb_unit ut ";
$sql_check .= "right join tb_user ur on ut.user_id = ur.user_id ";
$sql_check .= "where ut.unit_date='$go_date' and ut.unit_time='$unit_time' and ut.type_id='$type_id' and ut.unit_no='' and ut.unit_st!='0' ";
if(($type_id=='2')||($type_id=='4')||($type_id=='6')||($type_id=='7')){
$sql_check .= "and ur.level = '$user_year' ";
}
$sql_check .= "order by ut.id asc LIMIT 1 ";
$result_check = mysql_query($sql_check);
while($show_check = mysql_fetch_assoc($result_check)){
$sql_up_ch = "update tb_unit set unit_no='$unit_no' where id='$show_check[id]' and unit_st!='0' ";
$result_up_ch = mysql_query($sql_up_ch);
}
$sql_up = "update tb_unit set unit_st='$unit_st', unit_no='' where id='$work_id' ";
$result_up = mysql_query($sql_up);
echo "<script type='text/javascript'>alert('Update บันทึกข้อมูลเสร็จสิ้น');</script>";
}
?>
<meta http-equiv="refresh" content="0;url='unit_unit.php?type_id=<?=$type_id?>&unit_date=<?=$unit_date?>&unit_time=<?=$unit_time?>'">
</body>
</html>