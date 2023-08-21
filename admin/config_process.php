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
if($_GET['edit_type_work']=='Y'){
$i=0;
while($i<=$_POST["st"]){
	$type_id=$_POST["type_id"][$i];
	$type_name=$_POST["type_name"][$i];
	$unit_list=$_POST["unit_list"][$i];
if($type_id!=''){
$sql_type_work_check = "select * from type_work where type_id='$type_id' ";
$result_type_work_check = mysql_query($sql_type_work_check);
$num_type_work_check = mysql_num_rows($result_type_work_check);
if($num_type_work_check==0){
	$sql_type_work_add = "insert into type_work VALUES ( '$type_id', '$type_name', '$unit_list')";
	$result_type_work_add = mysql_query($sql_type_work_add);
}else{
	$sql_type_work_up = "update type_work set type_name='$type_name',unit_list='$unit_list' where type_id='$type_id'";
	$result_type_work_up = mysql_query($sql_type_work_up);
	}
}$i++;}
?><script>alert("บันทึกข้อมูลเสร็จสิ้น!");</script>
<meta http-equiv="refresh" content="0;url='unit_config.php?">
<?}//End IF edit_type_work
?>
</body>
</html>