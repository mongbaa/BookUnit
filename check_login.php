<?php

if(session_id() == '') { // For versions of PHP < 5.4.0

    session_start();  

  }


/*
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}*/

//set_charset("utf8")
header('Content-Type: text/html; charset=utf-8');
//--- SHOW ERROR PHP 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




		//--- Chack PSU Passport
		$wsdl = "https://passport.psu.ac.th/authentication/authentication.asmx?wsdl";
		$client  = new SoapClient($wsdl,
		array(
				"trace" => 1,	// enable trace to view what is happening
				"exceptions" => 0,	// disable exceptions
				"cache_wsdl" => 0) // disable any caching on the wsdl, encase you alter the wsdl server
		);
		$params = array(
				'username' => trim($_POST["username"]) ,
				'password' => $_POST["password"] 
		);
		$data = $client->Authenticate($params);

		//if (true){ //  ทดสอบเข้าระบบ
		if ($data->AuthenticateResult == 1) {		
			
			$staff = $client->GetStaffDetails($params); 		
			$staff_detail = $staff->GetStaffDetailsResult;
			
			$staff_id=$staff_detail->string[0];
		    $id_card=$staff_detail->string[3];
			$fac_id=$staff_detail->string[4];

			if($fac_id==15){
				
			$staff_name = iconv('UTF-8', 'UTF-8', $staff_detail->string[1]).' '.iconv('UTF-8', 'UTF-8', $staff_detail->string[2]);
			$staff_fname = iconv('UTF-8', 'UTF-8', $staff_detail->string[1]);
			$staff_lname = iconv('UTF-8', 'UTF-8', $staff_detail->string[2]);


			$_SESSION["STAFF_ID"] =  $staff_id;  //---ถ้าเป็น บุคลากร staff_id เป็นรหัสบุคลากร  แต่ถ้าเป็นนักศึกษา คือ รหัสนักศึกษา
			$_SESSION["staff_name"] =  $staff_name;  //---$staff_name เป็นชื่อของบุคลากรและนักศึกษาา
			$_SESSION["username"] = $_POST["username"]; 
			$_SESSION["fac_id"] = $fac_id;



		



$unit_last_login = date('Y-m-d');
$username = $_POST["username"]; 	
include "config.inc.php";
$sql_user = "SELECT * FROM tb_user where user_id ='$username' ";
$query_user = $conn->query($sql_user);
if ($result_user  = $query_user->fetch_assoc()) {

}else{



	if(is_int($staff_id)){ //ตรวจสอบค่า integer
		$level = "'4'";

		$sql_in = "INSERT INTO tb_user (ID, user_id, user_pass, user_fname, user_lname, level, unit_last_login) VALUES (NULL, '$username', MD5('00000'), '$staff_fname', '$staff_lname', '4', '$unit_last_login');";
		$conn->query($sql_in);

		
		} else {
		$level = "NULL" ;
		
		$sql_in = "INSERT INTO tb_user (ID, user_id, user_pass, user_fname, user_lname, level, unit_last_login) VALUES (NULL, '$username', MD5('00000'), '$staff_fname', '$staff_lname', NULL, '$unit_last_login');";
		$conn->query($sql_in);
	
		
		
		}


}


		 	header ("Location: check_permission.php"); //--- ตรวจสอบบุคลากรภายในคณะเท่านั้นที่อนุญาติ
				
			}else{

			header ("Location: index.php"); //--- ตรวจสอบบุคลากรภายในคณะเท่านั้นที่อนุญาติ  	
				
			}
			
			
			

			
			
		} else {	
			echo "<script language='javascript'>" ;
			echo "alert('Username หรือ Password ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง..!!');window.location='index.php' " ;
			echo "</script>"; //window.location='../index.php
		}
	
?>