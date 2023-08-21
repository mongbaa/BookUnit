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

              <li class=""><a href="unit_config.php">Config</a></li>
              
              <li class=""><a href="unit_limit.php">Limit</a></li>

			  <li class=""><a href="unit_unit.php">UNIT</a></li>

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
<h1>UNIT</h1>
<p>
<form action="unit_unit.php" method="get">
<table align="center">
<tr>
	<td><select name="type_id" class="border01">
		<option value="">--เลือก--</option>
		<?
		$result_type = mysql_query("select * from type_work ");
		while ($show_type = mysql_fetch_assoc($result_type))
		{
		?>
		<option value='<?=$show_type['type_id']?>' <?if($_GET['type_id']==$show_type['type_id']){echo " selected";} ?>> 
		<?=$show_type['type_name'];?></option>
		<?
		}
		?>
	</select>
	</td>
	<td><input id="unit_date" name="unit_date" type="text" size="10" value="<?=$_GET['unit_date']?>"></td>
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
<table border="1" width="100%" align="center">
<tr>
	<td align="center" valign="top">
<h3>UNIT : <?
$con_date=explode("-",$_GET['unit_date']);
$go_date=$con_date[2]."-".$con_date[1]."-".$con_date[0];
$result_check_ul = mysql_query("select * from tb_unit_limit where unit_date='$go_date' and unit_time='$_GET[unit_time]' and type_id='$_GET[type_id]' ");
$show_check_ul = mysql_fetch_assoc($result_check_ul);
$limit_4=$show_check_ul['unit_limit4'];
$limit_5=$show_check_ul['unit_limit5'];
$limit_6=$show_check_ul['unit_limit6'];
$limit_7=$show_check_ul['unit_limit7'];
$limit_u=$limit_4+$limit_5+$limit_6+$limit_7;
?><font color="red" size='4'>* จำนวน Unit ที่รองรับ&nbsp;<u>&nbsp;<b><?=$limit_u?></b>&nbsp;</u>&nbsp;ที่</font></h3>
<font color="#000000" size='2'>ปี 4</font>&nbsp;&nbsp;<font color="#01AC04" size='2'>ปี 5</font>&nbsp;&nbsp;<font color="#0009FF" size='2'>ปี 6</font>&nbsp;&nbsp;<font color="#FF0000" size='2'>ปี 6S</font>&nbsp;&nbsp;








<?php //////////////////////////////////////////////////////////////////////////////////////////
//if(($_GET['type_id']=='3') ||($_GET['type_id']=='1')){//////CB
if($_GET['type_id']=='3'){//////CB
?><table><?////// Static?>
		<tr>
				<td>ลำดับ</td>
				<td width="20"><center>วันที่<br>เวลา</center></td>
				<td>Student ID</td>			
				<td>ชื่อ - สกุล</td>	
				<td>Plan</td>
				<td>Detail</td>
				<td>Unit</td>
				<td>แก้ไข-ลบ</td>
				<td>สถานะ</td>
			</tr>
<?
$i=1;$j=0;
$con_date=explode("-",$_GET['unit_date']);
$go_date=$con_date[2]."-".$con_date[1]."-".$con_date[0];

$sql_unit_select = "select * from tb_unit ut ";
$sql_unit_select .= "right join tb_user ur on ut.user_id = ur.user_id ";
$sql_unit_select .= "where ut.unit_date = '$go_date' and ut.unit_time = '$_GET[unit_time]' and ut.type_id = '$_GET[type_id]' and ut.unit_st != 0 order by ut.id ";

$result_unit_select = mysql_query($sql_unit_select);
while($row_unit_select = mysql_fetch_assoc($result_unit_select)){
$sql_user_se = "select * from tb_user where user_id = '$row_unit_select[user_id]' ";
$result_user_se = mysql_query($sql_user_se);
while($row_user_se = mysql_fetch_assoc($result_user_se)){
$user_name=$row_user_se['user_fname']."  ".$row_user_se['user_lname'];
}
echo "<tr align=center>";
echo "<td>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $i;
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo "</td>";
echo "<td>";
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
echo "</td>";
echo "<td align=left>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $user_name;
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo "</td>";

echo "<td>";
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

echo "<td align=left>".$row_unit_select['unit_no']."</td>";

echo "<td><a href=unit_unit.php?work_id=".$row_unit_select['id']."&unit_date=".$_GET['unit_date']."&unit_time=".$_GET['unit_time']."&type_id=".$_GET['type_id'].">แก้ไข</a></td><td>";
if($row_unit_select['unit_st']=='1'){
	echo "<a href=unit_cancel.php?work_id=".$row_unit_select['id']."&unit_date=".$_GET['unit_date']."&unit_time=".$_GET['unit_time']."&type_id=".$_GET['type_id']."&unit_st=0>ยกเลิกจอง</a>";
}elseif($row_unit_select['unit_st']=='0'){
	echo "<a href=unit_cancel.php?work_id=".$row_unit_select['id']."&unit_date=".$_GET['unit_date']."&unit_time=".$_GET['unit_time']."&type_id=".$_GET['type_id']."&unit_st=1>จองunit</a>";
}
echo "</td></tr>";
$i++;$j++;
}
?>
</table>







<?php ///////End CB
}else{


$year_ck=4;
while($year_ck<=7){

	
$sql_unit_select_ck_list = "select 	tu.id  , tu.unit_st from tb_unit tu ";
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
		<table bgcolor=<?if($year_ck=='5'){echo "#F1F8E0";}elseif($year_ck=='6'){echo "#E0F2F7";}elseif($year_ck=='7'){echo "#FBEFEF";}?>><?////// Static?>
		<tr>
				<td colspan="8">ชั้นปีที่ <?=$year_ck?> : <font color="red" size='2'><u><?if($year_ck=='4'){echo $limit_4." UNIT";}elseif($year_ck=='5'){echo $limit_5." UNIT";}elseif($year_ck=='6'){echo $limit_6." UNIT";}elseif($year_ck=='7'){echo $limit_7." UNIT";}?></u></font></td>
		</tr>
		<tr>
				<td>ลำดับ</td>
				<td width="20"><center><font color="red">ลำดับรวม </font><br>วันที่ <br>เวลา</center></td>
				<td>Student ID</td>			
				<td>ชื่อ - สกุล</td>	
				<td>Plan</td>
				<td>Detail</td>
				<td>Unit</td>
				<td>แก้ไข-ลบ</td>
				<td>สถานะ</td>
			</tr>
<?
$i=1;$j=0;
$con_date=explode("-",$_GET['unit_date']);
$go_date=$con_date[2]."-".$con_date[1]."-".$con_date[0];
//echo "<br>";

$sql_unit_select = "select * from tb_unit ut ";
$sql_unit_select .= "right join tb_user ur on ut.user_id = ur.user_id ";
//$sql_unit_select .= "where ut.unit_date = '$go_date' and ut.unit_time = '$_GET[unit_time]' and ut.type_id = '$_GET[type_id]' and ur.level = '$year_ck' and ut.unit_st != 0  order by ut.id ";
$sql_unit_select .= "where ut.unit_date = '$go_date' and ut.unit_time = '$_GET[unit_time]' and ut.type_id = '$_GET[type_id]' and ur.level = '$year_ck'  order by ut.id ";
$result_unit_select = mysql_query($sql_unit_select);
while($row_unit_select = mysql_fetch_assoc($result_unit_select)){

//echo "<br>";
$sql_user_se = "select * from tb_user where user_id = '$row_unit_select[user_id]' ";
$result_user_se = mysql_query($sql_user_se);
while($row_user_se = mysql_fetch_assoc($result_user_se)){
$user_name=$row_user_se['user_fname']."  ".$row_user_se['user_lname'];
}
echo "<tr align=center>";
echo "<td>";
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
echo "</td>";
echo "<td>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $row_unit_select['user_id'];
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo "</td>";
echo "<td align=left>";
if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}
elseif($row_unit_select['level']==4){echo "<font color='#000000'>";}
elseif($row_unit_select['level']==5){echo "<font color='#01AC04'>";}
elseif($row_unit_select['level']==6){echo "<font color='#0009FF'>";}
elseif($row_unit_select['level']==7){echo "<font color='#FF0000'>";}
echo $user_name;
if($row_unit_select['unit_st']=='0'){echo "</strike>";}else{echo "</font>";}
echo "</td>";

echo "<td>";
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
?>
<td align=left><?=$row_unit_select['unit_no']?></td>
<td><a href="unit_unit.php?work_id=<?=$row_unit_select['id']?>&unit_date=<?=$_GET['unit_date']?>&unit_time=<?=$_GET['unit_time']?>&type_id=<?=$_GET['type_id']?>" onClick="return confirm('ต้องการแก้ไขข้อมูล')">แก้ไข</a></td><td>


<?if($row_unit_select['unit_st']=='1'){?>


<a href="unit_cancel.php?work_id=<?=$row_unit_select['id']?>&unit_date=<?=$_GET['unit_date']?>&unit_time=<?=$_GET['unit_time']?>&type_id=<?=$_GET['type_id']?>&unit_st=0"  onclick="return confirm('ต้องการยกเลิกการจอง')">ยกเลิกจอง</a>

<? }elseif($row_unit_select['unit_st']=='0'){?>

<a href="unit_cancel.php?work_id=<?=$row_unit_select['id']?>&unit_date=<?=$_GET['unit_date']?>&unit_time=<?=$_GET['unit_time']?>&type_id=<?=$_GET['type_id']?>&unit_st=1" onClick="return confirm('ต้องการเปลี่ยนสถานะ')">จองunit</a>

<?}
echo "</td></tr>";
$i++;$j++;
}
?>
</table>
<hr>
<?$year_ck++;
}//End While
}//End Else If CB
?>

	</td>
	<td align="center" valign="top">
<?
if($_GET['work_id']!=''){
$sql_unit_edit = "select * from tb_unit where id = '$_GET[work_id]' ";
$result_unit_edit = mysql_query($sql_unit_edit);
while($row_unit_edit = mysql_fetch_assoc($result_unit_edit)){
?>
	<form action="unit_process.php" method="post">
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
			<td>Detail Work</td>
			<td colspan="3">
				<textarea id="unit_detail" name="unit_detail" rows="5" cols="30"><?=substr($row_unit_edit['unit_detail'], 0)?></textarea>
			</td>
		</tr>
		<tr>
			<td>Unit No.</td>
			<td colspan="3">
			<select name="unit_no" class="border01">
				<option value="Null">--เลือก--</option>
				<?
				$result_no = mysql_query("select * from type_work where type_id='$_GET[type_id]' ");
				while ($show_no = mysql_fetch_assoc($result_no))
				{
				$unit_list=explode(',',$show_no['unit_list']);
				$cont_no = count($unit_list);
				$cn=0;while($cn<=$cont_no){
				$sql_unit_no_color = "select * from tb_unit where unit_date = '$go_date' and unit_time = '$_GET[unit_time]' and type_id = '$_GET[type_id]' and unit_no='$unit_list[$cn]' ";
$result_unit_no_color = mysql_query($sql_unit_no_color);
$num_unit_no_color = mysql_num_rows($result_unit_no_color);
if(($num_unit_no_color!=1)||($row_unit_edit['unit_no']==$unit_list[$cn])){
				?>
				<option value='<?=$unit_list[$cn]?>' <?if($row_unit_edit['unit_no']==$unit_list[$cn]){echo " selected";} ?>> 
				<?=$unit_list[$cn];?>
				</option>
				<?
				}
				$cn++;}				
				}
				?>
			</select>
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center">
			<br>
				<input type="hidden" name="type_id" value="<?=$_GET['type_id']?>">
				<input type="hidden" name="edit_work" value="Y">
				<input type="submit" value=" แก้ไข ">&nbsp;&nbsp;<a href="unit_del.php?work_id=<?=$_GET['work_id']?>&unit_date=<?=$_GET['unit_date']?>&unit_time=<?=$_GET['unit_time']?>&type_id=<?=$_GET['type_id']?>" onClick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')"><input type="button" value=" ลบ "></a>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" onClick="location.href='unit_unit.php?unit_date=<?=$_GET['unit_date']?>&unit_time=<?=$_GET['unit_time']?>&type_id=<?=$_GET['type_id']?>'" value=" เพิ่ม ">
			</td>
		</tr>
	</table>
	</form>
<?}}else{
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
			<td colspan="3"><input type="text" name="u_id" placeholder="s ตามด้วยรหัส นทพ.">
			</td>
		</tr>
		<tr>
			<td>Plan Work</td>
			<td colspan="3">
<select name="unit_work" class="border01">
<option value="">--เลือก--</option>
<?
$result = mysql_query("select * from tb_plan where type_id='$_GET[type_id]' ");
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
			<td>Detail Work</td>
			<td colspan="3">
				<textarea id="unit_detail" name="unit_detail" rows="5" cols="30"></textarea>
			</td>
		</tr>
		<tr>
			<td>Unit No.</td>
			<td colspan="3">
				<select name="unit_no" class="border01">
				<option value="NULL">--เลือก--</option>
				<?
				$result_no = mysql_query("select * from type_work where type_id='$_GET[type_id]' ");
				$show_no = mysql_fetch_assoc($result_no);
				$unit_list=explode(',',$show_no['unit_list']);
				$cont_no = count($unit_list);
				$cn=0;while($cn<=$cont_no){
				$sql_unit_no_color = "select * from tb_unit where unit_date = '$go_date' and unit_time = '$_GET[unit_time]' and type_id = '$_GET[type_id]' and unit_no='$unit_list[$cn]' ";
$result_unit_no_color = mysql_query($sql_unit_no_color);
$num_unit_no_color = mysql_num_rows($result_unit_no_color);
if($num_unit_no_color!=1){
				?>
				<option value='<?=$unit_list[$cn]?>' <?if($row_unit_edit['unit_no']==$unit_list[$cn]){echo " selected";} ?>> 
				<?=$unit_list[$cn];?>
				</option>
				<?
				}
				$cn++;
				}				
				?>
			</select>
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center">
			<br>
				<input type="hidden" name="type_id" value="<?=$_GET['type_id']?>">
				<input type="submit" value="บันทึกการจอง">
			</td>
		</tr>
	</table>
	</form>
<?
}
?>
	</td>
</tr>
<tr>
	<td colspan="2"><hr></td>
</tr>
<?////// ZONE?>
<tr>
<td>
<h3>ZONE</h3>
		<table><?////// Static?>
		<tr>
				<td>ชื่อ</td>
				<td>Teacher</td>			
				<td>Unit List</td>
				<td>แก้ไข</td>
			</tr>
<?
$i=1;$j=0;
$con_date=explode("-",$_GET['unit_date']);
$go_date=$con_date[2]."-".$con_date[1]."-".$con_date[0];
$sql_zone_select = "select * from tb_unit_zone where unit_date = '$go_date' and unit_time = '$_GET[unit_time]' and type_id = '$_GET[type_id]' ";
$result_zone_select = mysql_query($sql_zone_select);
while($row_zone_select = mysql_fetch_assoc($result_zone_select)){
$sql_tea_se = "select * from tb_teacher where teacher_id = '$row_zone_select[teacher_id]' ";
$result_tea_se = mysql_query($sql_tea_se);
while($row_tea_se = mysql_fetch_assoc($result_tea_se)){
$tea_name=$row_tea_se['teacher_fname']."  ".$row_tea_se['teacher_lname'];
}
echo "<tr align=center>
				<td>".$row_zone_select['unit_zone']."</td>
				<td align=left>".$tea_name."</td>	
				<td><div wigth=100>";

$list_unit_zone=explode(",",$row_zone_select['unit_list']);
$cont_arr=count($list_unit_zone);
$cot_un=0;
while($cot_un<=$cont_arr){
	$sql_unit_select = "select * from tb_unit where unit_date = '$go_date' and unit_time = '$_GET[unit_time]' and type_id = '$_GET[type_id]' and unit_no='$list_unit_zone[$cot_un]' ";
	$result_unit_select = mysql_query($sql_unit_select);
	$num_unit_select = mysql_num_rows($result_unit_select);
   if($num_unit_select>='1'){
		echo "<b><font color=red>".$list_unit_zone[$cot_un]."</font></b> ,";
	}else{echo $list_unit_zone[$cot_un]." ,";}	
$cot_un++;}		
				echo"</div></td>
				<td><a href=unit_unit.php?zone_id=".$row_zone_select['id']."&unit_date=".$_GET['unit_date']."&unit_time=".$_GET['unit_time']."&type_id=".$_GET['type_id'].">แก้ไข</a></td></tr>";
$i++;$j++;
}?>
</table>
</td>
<td>
<?
if($_GET['zone_id']!=''){
$sql_zone_edit = "select * from tb_unit_zone where id = '$_GET[zone_id]' ";
$result_zone_edit = mysql_query($sql_zone_edit);
while($row_zone_edit = mysql_fetch_assoc($result_zone_edit)){
?>
	<form action="unit_zone_process.php" method="post">
	<table>
		<tr>
			<td colspan="2">
			วันที่ : <?=$_GET['unit_date']?>
			<input type="hidden" name="unit_date" value="<?$con_date=explode("-",$_GET['unit_date']);
			echo $con_date[2]."-".$con_date[1]."-".$con_date[0];?>">
			</td>
			<td colspan="2">
			ช่วง : <?if($row_zone_edit['unit_time']=='M'){echo "เช้า";}elseif($row_zone_edit['unit_time']=='A'){echo "บ่าย";}?>
			<input type="hidden" name="unit_time" value="<?=$row_zone_edit['unit_time']?>">
			</td>
		</tr>
		<tr>
			<td>Zone Name :</td>
			<td colspan="3"><?=$row_zone_edit['unit_zone']?>
			<input type="hidden" name="zone_name" value="<?=$row_zone_edit['unit_zone']?>">
			</td>
		</tr>
		<tr>
			<td>Teacher :</td>
			<td colspan="3">
			<select name="teacher_id" class="border01">
				<option value="">--เลือก--</option>
				<?
				$result_tea = mysql_query("select * from tb_teacher where type_id='$_GET[type_id]' ");
				while ($show_tea = mysql_fetch_assoc($result_tea)){?>
				<option value='<?=$show_tea['teacher_id']?>' <?if($row_zone_edit['teacher_id']==$show_tea['teacher_id']){echo " selected";} ?>> 
				<?=$show_tea['teacher_id'];?></option>
				<?}?>
			</select>
			</td>
		</tr>
		<tr>
			<td>Unit list</td>
			<td colspan="3">
				<textarea id="unit_list" name="unit_list" rows="5" cols="30"><?=substr($row_zone_edit['unit_list'], 0)?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center">
			<br>
				<input type="hidden" name="type_id" value="<?=$_GET['type_id']?>">
				<input type="hidden" name="edit_zone" value="Y">
				<input type="submit" value=" แก้ไข ">&nbsp;&nbsp;<a href="location.href='unit_del.php?zone_id=<?=$_GET['zone_id']?>&unit_date=<?=$_GET['unit_date']?>&unit_time=<?=$_GET['unit_time']?>&type_id=<?=$_GET['type_id']?>'" onclick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')"><input type="button" value=" ลบ ">&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" onClick="location.href='unit_unit.php?unit_date=<?=$_GET['unit_date']?>&unit_time=<?=$_GET['unit_time']?>&type_id=<?=$_GET['type_id']?>'" value=" เพิ่ม ">
			</td>
		</tr>
	</table>
	</form>
<?}}else{
?>
	<form action="unit_zone_process.php" method="post">
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
			<td>Zone Name :</td>
			<td colspan="3"><input type="text" name="zone_name">
			</td>
		</tr>
		<tr>
			<td>Teacher :</td>
			<td colspan="3">
			<select name="teacher_id" class="border01">
				<option value="">--เลือก--</option>
				<?
				$result_tea = mysql_query("select * from tb_teacher where type_id='$_GET[type_id]' ");
				while ($show_tea = mysql_fetch_assoc($result_tea)){?>
				<option value='<?=$show_tea['teacher_id']?>' <?if($row_zone_edit['teacher_id']==$show_tea['teacher_id']){echo " selected";} ?>> 
				<?=$show_tea['teacher_fname'];?>  <?=$show_tea['teacher_lname'];?></option>
				<?}?>
			</select>
			</td>
		</tr>
		<tr>
			<td>Unit list</td>
			<td colspan="3">
				<textarea id="unit_list" name="unit_list" rows="5" cols="30"><?
	$result_type = mysql_query("select * from type_work where type_id='$_GET[type_id]' ");
		while ($show_type = mysql_fetch_assoc($result_type)){echo substr($show_type['unit_list'], 0);}?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center">
			<br>
				<input type="hidden" name="type_id" value="<?=$_GET['type_id']?>">
				<input type="submit" value="บันทึก ">
			</td>
		</tr>
	</table>
	</form>
<?
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