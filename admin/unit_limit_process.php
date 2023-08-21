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
if($_POST['unit_m']!=''){
$num_date = cal_days_in_month( CAL_GREGORIAN , $_POST['unit_m'] , $_POST['unit_y'] ) ;
$i=1;
while($i<=$num_date){
	$result_type = mysql_query("select * from type_work order by type_id ");
	while ($show_type = mysql_fetch_assoc($result_type)){

		$limit_M_type4=$_POST["limit_M_type4"][$show_type['type_id']][$i];
		$limit_M_type5=$_POST["limit_M_type5"][$show_type['type_id']][$i];
		$limit_M_type6=$_POST["limit_M_type6"][$show_type['type_id']][$i];
		$limit_M_type7=$_POST["limit_M_type7"][$show_type['type_id']][$i];
		$limit_A_type4=$_POST["limit_A_type4"][$show_type['type_id']][$i];
		$limit_A_type5=$_POST["limit_A_type5"][$show_type['type_id']][$i];
		$limit_A_type6=$_POST["limit_A_type6"][$show_type['type_id']][$i];
		$limit_A_type7=$_POST["limit_A_type7"][$show_type['type_id']][$i];
		$date_unit=$_POST['unit_y']."-".$_POST['unit_m']."-".$i;

if(($limit_M_type4!='')||($limit_M_type5!='')||($limit_M_type6!='')||($limit_M_type7!='')){
$sql_se_M = "select * from tb_unit_limit where unit_date='$date_unit' and unit_time='M' and type_id='$show_type[type_id]' ";
$result_se_M = mysql_query($sql_se_M);
$num_se_M = mysql_num_rows($result_se_M);
if($num_se_M==0){
	$sql_in_M = "insert into tb_unit_limit VALUES ('$date_unit', 'M', '$show_type[type_id]', '$limit_M_type4', '$limit_M_type5', '$limit_M_type6', '$limit_M_type7')";
	$result_in_M = mysql_query($sql_in_M);
}else{
	$sql_up_M = "update tb_unit_limit set unit_limit4='$limit_M_type4',unit_limit5='$limit_M_type5', unit_limit6='$limit_M_type6', unit_limit7='$limit_M_type7' where unit_date='$date_unit' and unit_time='M' and type_id='$show_type[type_id]'";
	$result_up_M = mysql_query($sql_up_M);
	}
}

if(($limit_A_type4!='')||($limit_A_type5!='')||($limit_A_type6!='')||($limit_A_type7!='')){
$sql_se_A = "select * from tb_unit_limit where unit_date='$date_unit' and unit_time='A' and type_id='$show_type[type_id]' ";
$result_se_A = mysql_query($sql_se_A);
$num_se_A = mysql_num_rows($result_se_A);
if($num_se_A==0){
	$sql_in_A = "insert into tb_unit_limit VALUES ('$date_unit', 'A', '$show_type[type_id]', '$limit_A_type4', '$limit_A_type5', '$limit_A_type6', '$limit_A_type7')";
	$result_in_A = mysql_query($sql_in_A);
}else{
	$sql_up_A = "update tb_unit_limit set unit_limit4='$limit_A_type4',unit_limit5='$limit_A_type5', unit_limit6='$limit_A_type6', unit_limit7='$limit_A_type7' where unit_date='$date_unit' and unit_time='A' and type_id='$show_type[type_id]'";
	$result_up_A = mysql_query($sql_up_A);
	}
}
}$i++;}
?><script>alert("บันทึกข้อมูลเสร็จสิ้น!");</script>
<meta http-equiv="refresh" content="0;url='unit_limit.php?mo_id=<?=$_POST['unit_m']?>&ye_id=<?=$_POST['unit_y']?>">
<?}//End IF edit_type_work

?>
</body>
</html>