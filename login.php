<?php
// start session.
	session_start();

	// connect to database.
	include("connect.php");
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Dent Unit</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link href="style.css" rel="stylesheet" type="text/css" /> 
  <link rel="stylesheet" href="stylesheets/foundation.min.css">
  <link rel="stylesheet" href="stylesheets/main.css">
  <link rel="stylesheet" href="stylesheets/app.css">
  <script src="javascripts/modernizr.foundation.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />
</head>
<body>
<?
	$user = trim($_POST['username']);
	$passwd = trim($_POST['password']);
	$passwd = MD5($passwd);

		// ค้นหาข้อมูลว่าเป็นอาจารย์หรือนักศึกษาหรือเจ้าหน้าที่
		$sql_query = "select * from tb_user where user_id = '$user' and user_pass = '$passwd' ";
		$result = mysql_query($sql_query,$handle) or die(mysql_error());
		$num_result = mysql_num_rows($result);
		if($num_result>='1'){
		$_SESSION['login_ID']=$user;
		$row_profile = mysql_fetch_assoc($result);
		$today=date("Y-m-d");	

		//////////////////////////////////
		$D_date=date("Y-m-d");
		$D_time=date("H:i:s");
		$D_work="Login";
		$sq_ck = "insert into tb_status_ck VALUES ( '', '$user', '$D_work', '$D_time', '$D_date')";
		$re_ck = mysql_query($sq_ck);
		//////////////////////////////////

		$sql_update = "update tb_user set unit_last_login = '$today' where user_id = '$user' and user_pass = '$passwd' ";
		$result_update = mysql_query($sql_update);
		if($row_profile['level']!=''){
			$_SESSION['st_year']=$row_profile['level'];
			?><meta http-equiv="refresh" content="0;url='unit/index.php"><?	
			// display error page.	
		}else{
			?><meta http-equiv="refresh" content="0;url='admin/index.php"><?	
		}
		}else{
		?>
			<script type="text/javascript">
			alert("User ID หรือ Password ผิดพลาด !");
			</script>
			<meta http-equiv="refresh" content="0;url='index.php">		
			<?
		}
	//exit;
?>
</body>
</html>