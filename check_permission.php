<?PHP 
  session_start();  
?>
<meta charset="utf-8">
<?php
$username = $_SESSION['username'];

include "config.inc.php";
echo $sql_user = "SELECT * FROM tb_user where  user_id ='$username'";
$query_user = $conn->query($sql_user);
if ($result_user  = $query_user->fetch_assoc()) {

	$x = 1;

	$_SESSION["login_ID"] =  $result_user['user_id'];  //---รหัสผู้ใช้งาน
	$_SESSION['user_level']=$result_user['level'];//---ระดับผู้ใช้งาน
	$_SESSION['st_year']=$result_user['level'];

	$_SESSION['st_year']=$row_profile['level'];

	$user_id  =  $result_user['user_id'];
    $today = date("Y-m-d H:i:s");	
	
	$sql_update = "UPDATE tb_user set unit_last_login = '$today' where user_id = '$user_id'";
	$conn->query($sql_update);


} else {

	$x = 2;
	
}


?>



<h1>ตรวจสอบสิทธิเข้าใช้งานระบบ </h1>
<h1>
	<?PHP
	echo   $_SESSION['STAFF_ID'];
	echo " > ";
	echo   $_SESSION['staff_name'];
	echo " > ";
	echo   $_SESSION['username'];
	?> 
</h1>


<?PHP if ($x == 1) { ?>

ผู้ใช้งาน : <?php echo $_SESSION['staff_name']; ?>
<?php
	$user_level = $_SESSION["user_level"];
	switch ($user_level) {
		case 4:
			echo " นทพ.ชั้นปี ที่ 4 ";  $statuss = 0; 	break;
		case 5:
			echo " นทพ.ชั้นปี ที่ 5 ";	$statuss = 0; break;
		case 6:
			echo " นทพ.ชั้นปี ที่ 6 ";	$statuss = 0; break;
		case 7:
			echo " นทพ.ชั้นปี ที่ จบ ";	$statuss = 0; break;
		default:
			echo " ผู้ใช้งานทั่วไป / เจ้าหน้าที่ / อาจารย์"; $statuss = 1;
	}

	echo " : ";
?>
	กรุณารอสักครู่....!! <img src="image/01-progress.gif" width="120" height="100" />
<?PHP
	if ($statuss == 1) { 
		echo "<META http-equiv=refresh content=6;url=admin/index.php>";
	}else{
		echo "<META http-equiv=refresh content=6;url=unit/index.php>";
	}
}
?>
<?PHP if ($x != 1) { ?>
	<p><span class="style1">ท่านยังไม่มีสิทธิในการเข้าใช้ระบบ กรุณาติดต่อเจ้าหน้าที่..!! </span>
	<br>  หน่วยทะเบียนและประเมินผลการศึกษา คณะทันตแพทยศาสตร์ <i class="fas fa-phone"></i> โทร 7529
	<img src="image/01-progress.gif" width="120" height="100" />

<?PHP
	echo "<META http-equiv=refresh content=6;url=logout.php>";
}
?>
	<br>
	<br>
	<a href="logout.php" class="btn btn-info"><i class="fas fa-power-off"></i> ออกจากระบบ </a>
