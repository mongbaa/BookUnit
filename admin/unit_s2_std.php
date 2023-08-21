<?php
    session_start();
$login_ID = $_SESSION['login_ID'];
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Dent Unit</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link href="style.css" rel="stylesheet" type="text/css" /> 
  <link rel="stylesheet" href="../stylesheets/foundation.min.css">
  <link rel="stylesheet" href="../stylesheets/main.css">
  <link rel="stylesheet" href="../stylesheets/app.css">
  <script src="../javascripts/modernizr.foundation.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" media="all" type="text/css" href="../class/jquery-ui.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../class/jquery-ui-timepicker-addon.css" />
	<script type="text/javascript" src="../class/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="../class/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../class/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="../class/jquery-ui-sliderAccess.js"></script>
</head>


<form action="" method="get">
  <table width="40%" border="1" align="center">
  <tr>
    <td width="7%">&nbsp;</td>
    <td width="23%">ชั้นปี :</td>
    <td width="70%">
	<?php 
	  $level=$_GET['level'];
	   $type_id=$_GET['type_work'];
	?>
	<select name="level" required>
      <option value=""<?php if($level == ''){  echo "selected"; } ?>>-----เลือกชั้นปี-----</option>
	  <option value="4"<?php if($level == '4'){  echo "selected"; } ?>>-----ปี 4-----</option>
	  <option value="5"<?php if($level == '5'){  echo "selected"; } ?>>-----ปี 5-----</option>
	  <option value="6"<?php if($level == '6'){  echo "selected"; } ?>>-----ปี 6-----</option>
	  <option value="7"<?php if($level == '7'){  echo "selected"; } ?>>-----ปี 6s -----</option>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>สาขา : </td>
    <td><select name="type_work" required>
      <option value=""<?php  if($type_id == ''){  echo "selected"; } ?>>-----เลือก สาขา-----</option>
      <?php
       
	   include("../connect.php");
	    $sql_typework= "select * from type_work ";
	    $query_typework = mysql_query($sql_typework);
		while ($result_typework = mysql_fetch_assoc($query_typework)){
?>
      <option value="<?=$result_typework['type_id']?>"<?  if($type_id == $result_typework['type_id']){  echo "selected"; } ?>>
      <?=$result_typework['type_name']?>
      </option>
      <?php }?>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>ค้นหา :</td>
    <td><label>
      <input type="submit" name="Submit" value="ค้นหา">
    </label></td>
  </tr>
</table>
</form>




<p>&nbsp;</p>

<p>&nbsp;</p>
<?php if(($level=='') && ($type_id=='')){ }else{?>
<table width="80%" border="1" align="center">
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="23%">รหัสนักศึกษา</td>
    <td width="24%">ชื่อ - สกุล </td>
    <td width="18%"><div align="center">ได้ Unit </div></td>
    <td width="16%"><div align="center">ยกเลิก Unit </div></td>
	<td width="15%"><div align="center"> คงเหลือ </div></td>
  </tr>
  <?php 
       
	    include("../connect.php");
	    $sql_user = "select * from tb_user where level = '$level'";
	    $query_user = mysql_query($sql_user);
		while ($result_user = mysql_fetch_assoc($query_user)){
		
  ?>
  <tr>
    <td>&nbsp;</td>
    <td><?=$result_user['user_id'];?> </td>
    <td><?=$result_user['user_fname'];?> <?=$result_user['user_lname'];?></td>
    <td><div align="center">
	<?php
	    $user_id=$result_user['user_id'];
	    $sql_unit1 = "select * from tb_unit where user_id='$user_id' and  type_id='$type_id' and unit_st=1";
	    $query_unit1 = mysql_query($sql_unit1);
		echo $numrow1=mysql_num_rows($query_unit1);	
	?>
	</div></td>
    <td><div align="center">
		<?php
	    
	    $sql_unit2 = "select * from tb_unit where user_id='$user_id' and  type_id='$type_id' and unit_st=0";
	    $query_unit2 = mysql_query($sql_unit2);
		echo $numrow2=mysql_num_rows($query_unit2);	
	?></div></td>
	 <td><div align="center"><?=$numrow1-$numrow2;?></div></td>
  </tr>
  
  <?php }?>
  
  
</table>


  <?php }?>