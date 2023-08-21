<?php
    session_start();
$login_ID = $_SESSION['login_ID'];
$st_year=$_SESSION['st_year'];
if($login_ID == NULL){
?>
<font color="red" size='4'>* จำนวน Unit ที่รองรับ&nbsp;<u>&nbsp;<b><?=$limit_u?></b>&nbsp;</u>&nbsp;ที่</font></h3>
<font color="#000000" size='2'>ปี 4</font>&nbsp;&nbsp;<font color="#01AC04" size='2'>ปี 5</font>&nbsp;&nbsp;<font color="#0009FF" size='2'>ปี 6</font>&nbsp;&nbsp;<font color="#FF0000" size='2'>ปี 6S</font>&nbsp;&nbsp;
    <meta http-equiv="refresh" content="0;url='../index.php">
<?}
if(($login_ID=='')/*||(($_GET['type_id']=='1')&&(($login_ID=='stest')))*/){
echo "<script type='text/javascript'>alert('ไม่ได้รับสิทธืในการจองสาขา OPER นะครับ');</script>";
?><meta http-equiv="refresh" content="0;url='unit_list.php'"><?
}
include("../connect.php");
$type_id=$_GET['type_id'];
$limit_tr=0;
list($d1_d, $d1_m, $d1_y) = explode("-", date("d-m-Y"));
list($d2_d, $d2_m, $d2_y) = explode("-", $_GET['unit_date']);
$d1 = mktime(0,0,0,$d1_m, $d1_d, $d1_y);
$d2 = mktime(0,0,0,$d2_m, $d2_d, $d2_y);
$diff = ($d2 - $d1) /(60*60*24);

$con_date=explode("-",$_GET['unit_date']);
$go_date=$con_date[2]."-".$con_date[1]."-".$con_date[0];
$result_check_ul = mysql_query("select * from tb_unit_limit where unit_date='$go_date' and unit_time='$_GET[unit_time]' and type_id='$type_id' ");
$show_check_ul = mysql_fetch_assoc($result_check_ul);
$limit_4=$show_check_ul['unit_limit4'];
$limit_5=$show_check_ul['unit_limit5'];
$limit_6=$show_check_ul['unit_limit6'];
$limit_7=$show_check_ul['unit_limit7'];
$limit_u=$limit_4+$limit_5+$limit_6+$limit_7;

/*if(($diff >'1')||(($diff =='1')&&(date("H")<'12'))){//Check Date
$limit_tr=$limit_u/2;
}elseif(($diff =='1')&&(date("H")<'14')){//Check Date
$limit_tr=$limit_u;
}else{
$limit_tr=$limit_u;
}*/
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
<script type="text/javascript">
$(function(){
	$("#unit_date").datepicker({
	dateFormat: 'dd-mm-yy'
	});
});
</script>
</head>
<body>
<div class="row page_wrap">
    <!-- page wrap -->
    <div class="twelve columns">
      <!-- page wrap -->

      <div class="row">
        <div class="nine columns header_nav">
            <ul id="menu-header" class="nav-bar horizontal">
              <li><a href="index.php">Home</a></li>

              <li class=""><a href="unit_list.php">จอง Unit</a></li>
              
              <li class=""><a href="unit_profile.php">ประวัติการจอง</a></li>

			  <li class=""><a href="unit_report.php">Report</a></li>

			  <li class=""><a href="../logout.php">Logout</a></li>

            </ul><script type="text/javascript">
           //<![CDATA[
           $('ul#menu-header').nav-bar();
            //]]>
            </script>
          </div>
          
          <div class="three columns header_logo">
             <img src="../images/logo.png" class="hide-for-small" alt="site name" />
          </div>
          
        </div><!-- END Header -->

	        <div class="row hide-for-small">
      
        <div class="twelve columns">
           <div class="heading_dots" align="center">
<?
$sql_type = "select * from type_work where type_id = '$type_id' ";
$result_type = mysql_query($sql_type);

while($row_type = mysql_fetch_assoc($result_type)){
$type_name=$row_type['type_name'];
}
?>
<h1><?=$type_name?></h1>
<p>
<form action="unit_form.php" method="get">
<table>
<tr>
	<td><input id="type_id" name="type_id" type="hidden" value="<?=$type_id?>">
	<input id="unit_date" name="unit_date" type="text" size="10" value="<?=$_GET['unit_date']?>"></td>
	<td><select id="unit_time" name="unit_time">
	<option>--</option>
	<option value="M" <?if($_GET['unit_time']=='M'){echo 'selected=selected';}?>>เช้า</option>
	<option value="A" <?if($_GET['unit_time']=='A'){echo 'selected=selected';}?>>บ่าย</option>
	</select></td>
	<td><input type="submit" value=" ค้นหา "></td>
</tr>
</table>
</form>
</p>
<table border="1" width="1200" align="center">
<tr>
	<td rowspan="2" align="center" valign="top">
<h3>UNIT : <font color="red" size='4'>* จำนวน Unit ที่รองรับ&nbsp;<u>&nbsp;<b><?=$limit_u?></b>&nbsp;</u>&nbsp;ที่  <br></font></h3>
<font color="#000000" size='2'>ปี 4</font>&nbsp;&nbsp;<font color="#01AC04" size='2'>ปี 5</font>&nbsp;&nbsp;<font color="#0009FF" size='2'>ปี 6</font>&nbsp;&nbsp;<font color="#FF0000" size='2'>ปี 6S</font>&nbsp;&nbsp;
<?
if(($_GET['type_id']=='3')||($_GET['type_id']=='1')){//////CB
?>
<table width="900"><?////// Static?>
		<tr>
				<td width="20">ลำดับ</td>
				<td width="20"><center>วันที่<br>เวลา</center></td>
				<td width="40">ID</td>			
				<td width="120">ชื่อ - สกุล</td>	
				<td width="120">Plan</td>
				<td width="120">Detail</td>
				<td width="50">Unit</td>
				<td width="70">
<?
list($d1_d, $d1_m, $d1_y) = explode("-", date("d-m-Y"));
list($d2_d, $d2_m, $d2_y) = explode("-", $_GET['unit_date']);
$d1 = mktime(0,0,0,$d1_m, $d1_d, $d1_y);
$d2 = mktime(0,0,0,$d2_m, $d2_d, $d2_y);
$diff = ($d2 - $d1) /(60*60*24);
echo "แก้ไข";
?>
			</td>
			<td>
<?
			echo "ลบ";
?>
			</td>
			</tr>
<?
$i=1;$j=0;
$con_date=explode("-",$_GET['unit_date']);
$go_date=$con_date[2]."-".$con_date[1]."-".$con_date[0];

$sql_unit_select = "select * from tb_unit tu ";
$sql_unit_select .= "left join tb_user ts on tu.user_id = ts.user_id ";
$sql_unit_select .= "where tu.unit_date = '$go_date' and tu.unit_time = '$_GET[unit_time]' and tu.type_id = '$_GET[type_id]' ";
$day_to=date("d")+1;
$sh_date_to=date("Y")."-".date("m")."-".$day_to;
$sql_unit_select .= "order by tu.id ";
$result_unit_select = mysql_query($sql_unit_select);
$num_check_se = mysql_num_rows($result_unit_select);

while($row_unit_select = mysql_fetch_assoc($result_unit_select)){
$sql_user_se = "select * from tb_user where user_id = '$row_unit_select[user_id]' ";
$result_user_se = mysql_query($sql_user_se);
while($row_user_se = mysql_fetch_assoc($result_user_se)){
$user_name=$row_user_se['user_fname']."  ".$row_user_se['user_lname'];
}
echo "<tr align=center><td>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $i;
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo "</td><td>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo "<center>".$row_unit_select['in_date']."<br>".$row_unit_select['in_time']."</center>";
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo "</td><td>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $row_unit_select['user_id'];
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo "</td><td align=left>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $user_name;
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo "</td><td>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
$sql_plan_id = "select * from tb_plan where plan_id = '$row_unit_select[unit_work]' ";
$result_plan_id = mysql_query($sql_plan_id);
$row_plan_id= mysql_fetch_assoc($result_plan_id);
echo $row_plan_id['plan'];
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo  "</td><td>";

if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $row_unit_select['unit_detail'];
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo  "</td>";

echo  "<td>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $row_unit_select['unit_no'];
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo  "</td>";
echo  "<td>";
if(($row_unit_select['user_id']==$login_ID)&&($row_unit_select['unit_st']!='0')&&($diff>=0)){//Check Date
?><a href="unit_form.php?work_id=<?=$row_unit_select['id']?>&unit_date=<?=$_GET['unit_date']?>&unit_time=<?=$_GET['unit_time']?>&type_id=<?=$type_id?>" onclick="return confirm('ต้องการแก้ไขข้อมูล')">แก้ไข</a><?}
echo  "</td>";
echo  "<td>";
if(($row_unit_select['unit_st']!='0')&&($row_unit_select['user_id']==$login_ID)){
?><a href="unit_cancel.php?f2s=2&work_id=<?=$row_unit_select['id']?>&unit_date=<?=$_GET['unit_date']?>&unit_time=<?=$_GET['unit_time']?>&type_id=<?=$type_id?>&unit_st=0" onclick="return confirm('ต้องการยกเลิกการจอง')">ยกเลิกจอง</a><?}//แก้ให้มันยกเลิกตัวเอง
echo "</td>";
echo "</tr>";
$i++;$j++;
}
?>
</table>
<?
}else{
$year_ck=4;
while($year_ck<=7){
$sql_unit_select_ck_list = "select 	tu.id from tb_unit tu ";
$sql_unit_select_ck_list .= "left join tb_user ts on tu.user_id = ts.user_id ";
$sql_unit_select_ck_list .= "where tu.unit_date = '$go_date' and tu.unit_time = '$_GET[unit_time]' and tu.type_id = '$_GET[type_id]' ";
$result_unit_select_ck_list = mysql_query($sql_unit_select_ck_list);
$num_check_se_ck_list = mysql_num_rows($result_unit_select_ck_list);
$ck_i=1; 
while($row_check_se_ck_list = mysql_fetch_assoc($result_unit_select_ck_list)){
if($ck_i<=$num_check_se_ck_list){
$ck_list_all[$ck_i]=$row_check_se_ck_list['id'];
}
$ck_i++;}
?>
<table width="700"><?////// Static?>
<tr>
				<td width="470" colspan="7">ชั้นปีที่ <?=$year_ck?> : <font color="red" size='2'><u><?if($year_ck=='4'){echo $limit_4." UNIT";}elseif($year_ck=='5'){echo $limit_5." UNIT";}elseif($year_ck=='6'){echo $limit_6." UNIT";}elseif($year_ck=='7'){echo $limit_7." UNIT";}?></u></font></td>
</tr>
		<tr>
				<td width="20">ลำดับ</td>
				<td width="20"><center><font color="red">ลำดับรวม </font><br>วันที่ <br>เวลา</center></td>
				<td width="40">Student ID</td>			
				<td width="120">ชื่อ - สกุล</td>	
				<td width="120">Plan</td>
				<td width="120">Detail</td>
				<td width="50">Unit</td>
				<td width="70">
<?
list($d1_d, $d1_m, $d1_y) = explode("-", date("d-m-Y"));
list($d2_d, $d2_m, $d2_y) = explode("-", $_GET['unit_date']);
$d1 = mktime(0,0,0,$d1_m, $d1_d, $d1_y);
$d2 = mktime(0,0,0,$d2_m, $d2_d, $d2_y);
$diff = ($d2 - $d1) /(60*60*24);
if(($diff >'1')||(($diff =='1')&&(date("H")<'12'))){//Check Date
echo "Edit";
}
?>
			</td>
							<td width="70">
<?
if(($diff >'1')||(($diff =='1')&&(date("H")<'12'))){//Check Date
echo "Edit";
}
?>
			</td></tr>
<?
$i=1;$j=0;
$con_date=explode("-",$_GET['unit_date']);
$go_date=$con_date[2]."-".$con_date[1]."-".$con_date[0];

$sql_unit_select = "select * from tb_unit tu ";
$sql_unit_select .= "left join tb_user ts on tu.user_id = ts.user_id ";
$sql_unit_select .= "where tu.unit_date = '$go_date' and tu.unit_time = '$_GET[unit_time]' and tu.type_id = '$_GET[type_id]' ";
$sql_unit_select .= "and ts.level='$year_ck' ";
$day_to=date("d")+1;
$sh_date_to=date("Y")."-".date("m")."-".$day_to;
$sql_unit_select .= "order by tu.id ";
$result_unit_select = mysql_query($sql_unit_select);
$num_check_se = mysql_num_rows($result_unit_select);

while($row_unit_select = mysql_fetch_assoc($result_unit_select)){
$sql_user_se = "select * from tb_user where user_id = '$row_unit_select[user_id]' ";
$result_user_se = mysql_query($sql_user_se);
while($row_user_se = mysql_fetch_assoc($result_user_se)){
$user_name=$row_user_se['user_fname']."  ".$row_user_se['user_lname'];
}
echo "<tr align=center><td>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $i;
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo "</td><td>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
	$ck_i=1; 
	while($ck_i<=$num_check_se_ck_list){
	if($ck_list_all[$ck_i]==$row_unit_select['id']){
	echo "<center><font color=red>".$ck_i."</font><br>".$row_unit_select['in_date']."<br>".$row_unit_select['in_time']."</center>";
	}
	$ck_i++;}
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo "</td><td>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $row_unit_select['user_id'];
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo "</td><td align=left>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $user_name;
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo "</td><td>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
$sql_plan_id = "select * from tb_plan where plan_id = '$row_unit_select[unit_work]' ";
$result_plan_id = mysql_query($sql_plan_id);
$row_plan_id= mysql_fetch_assoc($result_plan_id);
echo $row_plan_id['plan'];
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo  "</td><td>";

if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $row_unit_select['unit_detail'];
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo  "</td>";

echo  "<td>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $row_unit_select['unit_no'];
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo  "</td>";
echo  "<td>";
if(($row_unit_select['user_id']==$login_ID)&&($row_unit_select['unit_st']!='0')&&($diff>=0)){//Check Date
?><a href="unit_form.php?work_id=<?=$row_unit_select['id']?>&unit_date=<?=$_GET['unit_date']?>&unit_time=<?=$_GET['unit_time']?>&type_id=<?=$type_id?>" onclick="return confirm('ต้องการแก้ไขข้อมูล')">แก้ไข</a><?}
echo  "</td>";
echo  "<td>";
if(($row_unit_select['unit_st']!='0')&&($row_unit_select['user_id']==$login_ID)){
?><a href="unit_cancel.php?f2s=2&work_id=<?=$row_unit_select['id']?>&unit_date=<?=$_GET['unit_date']?>&unit_time=<?=$_GET['unit_time']?>&type_id=<?=$type_id?>&unit_st=0" onclick="return confirm('ต้องการยกเลิกการจอง')">ยกเลิกจอง</a><?}//แก้ให้มันยกเลิกตัวเอง
echo "</td></tr>";
$i++;$j++;
}
?>
</table>
<hr>
<?$year_ck++;
}//End While
}//End if CB?>
	</td>
	<td align="center" valign="top">
<?
if($_GET['work_id']!=''){
$sql_unit_edit = "select * from tb_unit where id = '$_GET[work_id]' ";
$result_unit_edit = mysql_query($sql_unit_edit);
while($row_unit_edit = mysql_fetch_assoc($result_unit_edit)){

list($d1_y, $d1_m, $d1_d) = explode("-", date("Y-m-d"));
list($d2_y, $d2_m, $d2_d) = explode("-", $row_unit_edit['unit_date']);
$d1 = mktime(0,0,0,$d1_m, $d1_d, $d1_y);
$d2 = mktime(0,0,0,$d2_m, $d2_d, $d2_y);
$diff = ($d2 - $d1) /(60*60*24);

//if(($diff >'1')||(($diff =='1')&&(date("H")<'14'))){//Check Date
?>
	<form action="unit_update.php" method="post">
	<table>
		<tr>
			<td colspan="2">
			วันที่ : <?$con_date=explode("-",$row_unit_edit['unit_date']);echo $con_date[2]."-".$con_date[1]."-".$con_date[0];?>
			<input type="hidden" name="unit_date" value="<?=$row_unit_edit['unit_date']?>">
			</td>
			<td colspan="2">
			ช่วง : <?if($row_unit_edit['unit_time']=='M'){echo "เช้า";}elseif($row_unit_edit['unit_time']=='A'){echo "บ่าย";}?>
			<input type="hidden" name="unit_time" value="<?=$row_unit_edit['unit_time']?>">
			</td>
		</tr>
		<tr>
			<td>ID</td>
			<td colspan="3"><?=$row_unit_edit['user_id']?>
			<input type="hidden" name="u_id" value="<?=$row_unit_edit['user_id']?>">
			</td>
		</tr>
		<tr>
			<td>ชื่อ - สกุล</td>
			<td colspan="3">
<?
$sql_user = "select * from tb_user where user_id = '$row_unit_edit[user_id]' ";
$result_user = mysql_query($sql_user);
while($row_user = mysql_fetch_assoc($result_user)){
echo $row_user['user_fname']."  ".$row_user['user_lname'];
}
?>
			</td>
		</tr>
		<tr>
			<td>Plan Work</td>
			<td colspan="3">
<select name="unit_work" class="border01">
<option value="">--เลือก--</option>
<?
$result_plan = mysql_query("select * from tb_plan where type_id='$row_unit_edit[type_id]' ");
while ($show_plan = mysql_fetch_assoc($result_plan))
{
?>
<option value='<?=$show_plan['plan_id']?>' <?if($row_unit_edit['unit_work']==$show_plan['plan_id']){echo " selected";} ?>> 
<?=$show_plan['plan'];?></option>
<?
}
?>
</select>
			</td>
		</tr>
		<tr>
			<td>Detail Work<br><br>ซี่ฟัน  ด้าน ราก<font color=red><b>*</b></font><br>ระบุอาจารย์ </td>
			<td colspan="3">
				<textarea id="unit_detail" name="unit_detail" rows="5" cols="30"><?=substr($row_unit_edit['unit_detail'], 0)?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center">
			<br>
				<input type="hidden" name="type_id" value="<?=$type_id?>">
				<input type="hidden" name="edit_work" value="Y">
				<input type="submit" value=" แก้ไข ">&nbsp;&nbsp;<a href="unit_del.php?work_id=<?=$_GET['work_id']?>&unit_date=<?=$_GET['unit_date']?>&unit_time=<?=$_GET['unit_time']?>&type_id=<?=$type_id?>" onclick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')"><input type="button" value=" ลบ "></a>
			</td>
		</tr>
	</table>
	</form>
<?
//}else{echo "ไม่สามารถทำการจองของวันที่ ".$_GET['unit_date']." ได้";}//end form N
}}else{
list($d1_y, $d1_m, $d1_d) = explode("-", date("Y-m-d"));
list($d2_y, $d2_m, $d2_d) = explode("-", $go_date);
$d1 = mktime(0,0,0,$d1_m, $d1_d, $d1_y);
$d2 = mktime(0,0,0,$d2_m, $d2_d, $d2_y);
$diff = ($d2 - $d1) /(60*60*24);

//if(($diff >'1')||(($diff =='1')&&(date("H")<'14'))){//Check Date
?>
	<form action="unit_process.php" method="post">
	<table>
		<tr>
			<td colspan="2">
			วันที่ : <?=$_GET['unit_date']?>
			<input type="hidden" name="unit_date" value="<?$con_date=explode("-",$_GET['unit_date']);
echo $con_date[2]."-".$con_date[1]."-".$con_date[0];?>">
			</td>
			<td colspan="2">
			ช่วง : <?if($_GET['unit_time']=='M'){echo "เช้า";}elseif($_GET['unit_time']=='A'){echo "บ่าย";}?>
			<input type="hidden" name="unit_time" value="<?=$_GET['unit_time']?>">
			</td>
		</tr>
		<tr>
			<td>ID</td>
			<td colspan="3"><?=$login_ID?>
			<input type="hidden" name="u_id" value="<?=$login_ID?>">
			</td>
		</tr>
		<tr>
			<td>ชื่อ - สกุล</td>
			<td colspan="3">
<?
$sql_user = "select * from tb_user where user_id = '$login_ID' ";
$result_user = mysql_query($sql_user);
while($row_user = mysql_fetch_assoc($result_user)){
echo $row_user['user_fname']."  ".$row_user['user_lname'];
}
?>
			</td>
		</tr>
		<tr>
			<td>Plan Work</td>
			<td colspan="3">
<select name="unit_work" class="border01">
<option value="">--เลือก--</option>
<?
$result = mysql_query("select * from tb_plan where type_id='$type_id' ");
$num_field = mysql_num_fields($result);
while ($show = mysql_fetch_object($result))
{
?>
<option value='<?=$show->plan_id;?>'> <?=$show->plan;?></option>
<?
}
?>
</select>
			</td>
		</tr>
		<tr>
			<td>Detail Work<br><br>ซี่ฟัน  ด้าน ราก<font color=red><b>*</b></font><br>ระบุอาจารย์ </td>
			<td colspan="3">
				<textarea id="unit_detail" name="unit_detail" rows="5" cols="30"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center">
			<br>
				<input type="hidden" name="min_tr" value="<?=$j?>">
				<input type="hidden" name="max_tr" value="<?=$$limit_u?>">
				<input type="hidden" name="type_id" value="<?=$type_id?>">
				<input type="submit" value="บันทึกการจอง">
			</td>
		</tr>
	</table>
	</form>
<?//}else{echo "ไม่สามารถทำการจองของวันที่ ".$_GET['unit_date']." ได้";}//end form N
}
?>
	</td>
</tr>
<tr>
	<td>
<?
$sql_type2 = "select * from type_work where type_id = '$type_id' ";
$result_type2 = mysql_query($sql_type2);

while($row_type2 = mysql_fetch_assoc($result_type2)){
	$unit_list=$row_type2['unit_list'];
}
?>
	</td>
</tr>
</table>
		   </div>
         </div>
         
      </div><!-- end row -->
 
		  <script type="text/javascript">
          //<![CDATA[
          $('ul#menu3').nav-bar();
          //]]>
          </script>

      </div>

    </div><!-- end page wrap) -->
    <!-- Included JS Files (Compressed) -->
    <script src="javascripts/foundation.min.js" type="text/javascript">
</script> <!-- Initialize JS Plugins -->
     <script src="javascripts/app.js" type="text/javascript">
</script>
</body>
</html>