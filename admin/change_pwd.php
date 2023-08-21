<?php
    session_start();
$login_ID = $_SESSION['login_ID'];
if($login_ID == NULL){
?>
    <meta http-equiv="refresh" content="0;url='../index.php">
<?}

// connect to database.
include("../connect.php");

// เรียกข้อมูลของนักศึกษาออกมา.
	$sql_query = "select * from tb_user where user_id = '$login_ID' ";
	$result = mysql_query($sql_query,$handle) or die(mysql_error());

	$data_student_call = mysql_fetch_array($result);
?>
<html>
<head>
<title>ระบบคลีนิกรวมนักศึกษา คณะทันตแพทยศาสตร์ มหาวิทยาลัยสงขลานครินทร์</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link href="../class/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="change_pwd" id="change_pwd" method="post" action="pass_process.php">
  <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="400" border="0" align="center" cellpadding="0" cellspacing="2" class="bordertlb02">
          <tr bgcolor="#99CCFF"> 
            <td colspan="2" class="fontthai"><strong>เปลี่ยนรหัสผ่าน :.</strong></td>
          </tr>
          <tr> 
            <td align="right" class="font01"><strong>Username :</strong></td>
            <td align="left"><strong><?=$data_student_call["user_id"]?></strong></td>
          </tr>
          <tr> 
            <td align="right" class="font01"><strong>Old Password :</strong></td>
            <td align="left"><input name="oldpass" type="password" class="border01"></td>
          </tr>
          <tr> 
            <td align="right" class="font01"><strong>New Password :</strong></td>
            <td align="left"><input name="newpass" type="password" class="border01"></td>
          </tr>
          <tr> 
            <td align="right" class="font01"><strong>Confirm Password :</strong></td>
            <td align="left"><input name="comfirmpass" type="password" class="border01"></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr align="center"> 
            <td colspan="2"><input name="Submit" type="submit" class="border01" value="Change">&nbsp;<input name="Submit2" type="reset" class="border01" value="Cancel"> </td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>

<?mysql_close($handle);?>