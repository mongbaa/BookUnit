<?php
    session_start();
$login_ID = $_SESSION['login_ID'];
if($login_ID == NULL){
?>
    <meta http-equiv="refresh" content="0;url='../index.php">
<?}
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
<br><table width="400" align="center" border="1" bgcolor="#FFFADA">
<?
$sql = "select * from tb_unit where id = '$_GET[work_id]' ";
$result = mysql_query($sql);
while($row_se = mysql_fetch_assoc($result)){
?>
<tr>
			<td colspan="4" height="30">
			<b>&nbsp;วันที่ :</b> <?=$row_se['unit_date']?>
			&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
			<b>ช่วง :</b> <?if($row_se['unit_time']=='M'){echo "เช้า";}elseif($row_se['unit_time']=='A'){echo "บ่าย";}?>
			</td>
		</tr>
		<tr>
			<td height="30"><b>&nbsp;รหัสนักศึกษา :</b></td>
			<td height="30" colspan="3">&nbsp;&nbsp;<?=$row_se['user_id']?>
			</td>
		</tr>
		<tr>
			<td height="30"><b>&nbsp;ชื่อ - สกุล :</b></td>
			<td height="30" colspan="3">&nbsp;
<?
$sql_user = "select * from tb_user where user_id = '$row_se[user_id]' ";
$result_user = mysql_query($sql_user);
while($row_user = mysql_fetch_assoc($result_user)){
echo $row_user['user_fname']."  ".$row_user['user_lname'];
}
?>
			</td>
		</tr>
		<tr>
			<td height="30"><b>&nbsp;Unit Work :</b></td>
			<td height="30" colspan="3">&nbsp;
<?
$result = mysql_query("select * from tb_plan where plan_id='$row_se[unit_work]' ");
while ($show = mysql_fetch_object($result))
{ ?>
<?=$show->plan;
}?>
		</td>
		</tr>
		<tr>
			<td height="30"><b>&nbsp;Unit Detail :</b></td>
			<td height="30" colspan="3"><br>&nbsp;<textarea id="unit_detail" name="unit_detail" rows="5" cols="30"><?=$row_se['unit_detail']?></textarea><br><br></td>
		</tr>
<?}?>
	</table>
</body>
</html>