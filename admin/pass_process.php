<?php
    session_start();
$login_ID = $_SESSION['login_ID'];
if($login_ID == NULL){
?>
    <meta http-equiv="refresh" content="0;url='../index.php">
<?}
// connect to database.
require("../connect.php");
?>
<html>
<head>
<title>ระบบคลีนิกรวมนักศึกษา คณะทันตแพทยศาสตร์ มหาวิทยาลัยสงขลานครินทร์</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link href="../class/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?
$sql_query = "select * from tb_user where user_id = '$login_ID' ";
$result = mysql_query($sql_query,$handle) or die(mysql_error());
$check = mysql_num_rows($result);
if($check != 0)// ตรวจสอบว่า login_ID นี้มีอยู่หรือไม่(ถ้ามี)
{ 
	$data_pwd = mysql_fetch_assoc($result);
	$oldpwd = $data_pwd["user_pass"];
	$MD5_oldpass = MD5($_POST['oldpass']);
	if($MD5_oldpass != $oldpwd)
	{
	?>
		<link href="../class/style.css" rel="stylesheet" type="text/css">
		<table width="400" align="center">
			<tr>
				<td align="center"><font color= '#FF00000' size='2' face='MS Sans Serif, Tahoma, sans-serif'>
					<a href ="javascript:history.go(-1);"><h2>กรุณาใส่รหัสผ่านเดิมให้ถูกต้องด้วย</h2><a></font>
				</td>
			</tr>
		</table>
	<?
	}
	else if(
			(strcmp($_POST['oldpass'],"") == 0) ||
			(strcmp($_POST['newpass'],"") == 0) ||
			(strcmp($_POST['comfirmpass'],"") == 0)
	)
	{
	?>
		<link href="../class/style.css" rel="stylesheet" type="text/css">
		<table width="400" align="center">
			<tr>
				<td align="center"><font color= '#FF00000' size='2' face='MS Sans Serif, Tahoma, sans-serif'>
					<a href ="javascript:history.go(-1);"><h2>กรุณากรอกข้อมูลให้ครบด้วย</h2><a></font>
				</td>
			</tr>
		</table>
	<?
	}
	else if(strcmp($_POST['newpass'],$_POST['comfirmpass']) != 0)
	{
		?>
		<link href="../class/style.css" rel="stylesheet" type="text/css">
		<table width="400" align="center">
			<tr>
				<td align="center"><font color= '#FF00000' size='2' face='MS Sans Serif, Tahoma, sans-serif'>
					<a href ="javascript:history.go(-1);"><h2>กรุณากรอกรหัสผ่านใหม่ให้ตรงกันทั้งสองช่องด้วย</h2><a></font>
				</td>
			</tr>
		</table>
	<?
	}
	else
	{
	$MD5_newpass = MD5($_POST['newpass']);
	$sql_query = "update tb_user set user_pass='$MD5_newpass' where user_id = '$login_ID' ";
	$result = mysql_query($sql_query,$handle) or die(mysql_error());
?>
	<link href="../class/style.css" rel="stylesheet" type="text/css">
	<table width="400" align="center">
		<tr><tr>&nbsp;</td></tr>
		<tr>
			<td align="center"><font color= '#FF00000' size='2' face='MS Sans Serif, Tahoma, sans-serif'>
				<a href ="javascript:window.close();">&lt;&lt;&lt; <h2>แก้ไขรหัสผ่านเรียบร้อยแล้ว กรุณา Login ใหม่อีกครั้ง</h2> &gt;&gt;&gt;<a></font>
			</td>
		</tr>
	</table>
<?
	}
}

mysql_close($handle);
?>
</body>
</html>