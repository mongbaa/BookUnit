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
<h1>Report</h1>
<p>
<form action="unit_report.php" method="get">
<table align="center">
<tr>
	<td><select name="report_id" class="border01">
		<option value='unit' <?if($_GET['report_id']=='unit'){echo " selected";} ?>> Unit </option>
		<option value='all' <?if($_GET['report_id']=='all'){echo " selected";} ?>> All </option>
	</select>
	</td>
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
<?/////////////////////////  Start Unit  //////////////////////////////////////?>
<?if($_GET['report_id']=='unit'){?>
<table border="1" width="900" align="center">
<?
$i=0;
$con_date=explode("-",$_GET['unit_date']);
$go_date= $con_date[2]."-".$con_date[1]."-".$con_date[0];
$sql_unit_select = "select * from tb_unit where type_id = '$_GET[type_id]' and unit_date = '$go_date' and unit_time = '$_GET[unit_time]' and unit_st = '1' and unit_no != '' order by unit_no ";
$result_unit_select = mysql_query($sql_unit_select);
?>
<tr>
<?
while($row_unit_select = mysql_fetch_assoc($result_unit_select)){
if(($i % 3)==0){echo "</tr><tr>";}?>
<td <?if($row_unit_select['user_id']==$login_ID){?>bgcolor="#9EFE93"<?}?>>
	<table width="100%" high="100%">
		<tr><td>UNIT :</td><td colspan="3"><?=$row_unit_select['unit_no']?></td></tr>
		<tr><td>ชื่อ - สกุล</td><td colspan="2">
			<?
			$result_user = mysql_query("select * from tb_user where user_id = '$row_unit_select[user_id]' ");
			while ($show_user = mysql_fetch_assoc($result_user)){?>
			<?=$show_user['user_fname'];?> <?=$show_user['user_lname'];?>
		</td><td>ชั้นปี :<?=$show_user['level'];?></td><?}?></tr>
		<tr><td>งานที่ทำ :</td>
		<td colspan="3">
			<?
			$result_plan = mysql_query("select * from tb_plan where plan_id = '$row_unit_select[unit_work]' ");
			while ($show_plan = mysql_fetch_assoc($result_plan)){
			echo $show_plan['plan'];}?>
		</td></tr>
		<tr><td>อาจารย์ :</td>
		<td colspan="3">
			<?
			$sql_tea = "select *  from tb_unit_zone tz ";
			$sql_tea .= "left join tb_teacher tt on tt.teacher_id = tz.teacher_id ";
			$sql_tea .= "where unit_date = '$go_date' and unit_time = '$_GET[unit_time]' ";
			$result_tea = mysql_query($sql_tea);
			while($show_tea = mysql_fetch_assoc($result_tea)){				
				$con_tea=explode(",",$show_tea['unit_list']);
				$te=0;
				while($te<=count($con_tea)){
					if($row_unit_select['unit_no']==$con_tea[$te]){						
							echo "อ.".$show_tea['teacher_fname']."  ".$show_tea['teacher_lname'];
					}$te++;
				}
			}?>
		</td></tr>
	</table>
</td>
<?$i++;}?>
</table>
<?}?>
<?/////////////////////////  End ZONE  //////////////////////////////////////?>

<?/////////////////////////  Start ALL  //////////////////////////////////////?>
<?if($_GET['report_id']=='all'){?>
<h3>Report ประจำเดือน
<?
$sh_mo=explode("-",$_GET['unit_date']);
			if($sh_mo[1]=='1'){echo "มกราคม";}elseif($sh_mo[1]=='2'){echo "กุมภาพันธ์";}elseif($sh_mo[1]=='3'){echo "มีนาคม";}elseif($sh_mo[1]=='4'){echo "เมษายน";}elseif($sh_mo[1]=='5'){echo "พฤษภาคม";}elseif($sh_mo[1]=='6'){echo "มิถุนายน";}elseif($sh_mo[1]=='7'){echo "กรกฎาคม";}elseif($sh_mo[1]=='8'){echo "สิงหาคม";}elseif($sh_mo[1]=='9'){echo "กันยายน";}elseif($sh_mo[1]=='10'){echo "ตุลาคม";}elseif($sh_mo[1]=='11'){echo "พฤศจิกายน";}elseif($sh_mo[1]=='12'){echo "ธันวาคม";}
?></h3>
<table border="1" width="900" align="center">
		<tr align="center">
				<td>Date</td>
				<td>Time</td>
		<?$result_type = mysql_query("select * from type_work order by type_id ");
		while ($show_type = mysql_fetch_assoc($result_type)){?>
		<td><?=substr($show_type['type_name'], 0, 5);?></td>
		<?}?>
</tr>
<?
$mo_id=explode("-",$_GET['unit_date']);
$num_date = cal_days_in_month( CAL_GREGORIAN , $mo_id[1] , $mo_id[2] ) ;
$i=1;while($i<=$num_date){?>	
<tr align="center">
				<td rowspan=2><?=$i?>/<?=$mo_id[1]?>/<?=$mo_id[2]?>
				</td>
				<td>เช้า</td>
		<?$result_type = mysql_query("select * from type_work order by type_id ");
		while ($show_type = mysql_fetch_assoc($result_type)){?>
		<td>
			<?
			$date_check_ul_M=$mo_id[2]."-".$mo_id[1]."-".$i;
			$result_check_ul_M = mysql_query("select * from tb_unit_limit where unit_date='$date_check_ul_M' and unit_time='M' and type_id='$show_type[type_id]' ");
			$show_check_ul_M = mysql_fetch_assoc($result_check_ul_M);
			$sum_M=$show_check_ul_M['unit_limit4']+$show_check_ul_M['unit_limit5']+$show_check_ul_M['unit_limit6']+$show_check_ul_M['unit_limit7'];

			$result_check_unit_cont_M = mysql_query("select * from tb_unit where unit_date='$date_check_ul_M' and unit_time='M' and type_id='$show_type[type_id]' ");
			$show_check_unit_cont_M = mysql_num_rows($result_check_unit_cont_M);
			?>
			<?if($show_check_unit_cont_M==0){echo " ";
			}else{echo $show_check_unit_cont_M;				
			}?> / <font color="red"><b><?=$sum_M?></b></font>
		</td>
		<?}?>
</tr>
<tr align="center">
				<td>บ่าย</td>
		<?$result_type = mysql_query("select * from type_work order by type_id ");
		while ($show_type = mysql_fetch_assoc($result_type)){?>
		<td>
			<?
			$date_check_ul_A=$mo_id[2]."-".$mo_id[1]."-".$i;
			$result_check_ul_A = mysql_query("select * from tb_unit_limit where unit_date='$date_check_ul_A' and unit_time='A' and type_id='$show_type[type_id]' ");
			$show_check_ul_A = mysql_fetch_assoc($result_check_ul_A);
			$sum_A=$show_check_ul_A['unit_limit4']+$show_check_ul_A['unit_limit5']+$show_check_ul_A['unit_limit6']+$show_check_ul_A['unit_limit7'];
			
			$result_check_unit_cont_A = mysql_query("select * from tb_unit where unit_date='$date_check_ul_A' and unit_time='A' and type_id='$show_type[type_id]' ");
			$show_check_unit_cont_A = mysql_num_rows($result_check_unit_cont_A);
			?>
			<?if($show_check_unit_cont_A==0){echo " ";
			}else{echo $show_check_unit_cont_A;				
			}?> / <font color="red"><b><?=$sum_A?></b></font>
		</td>
		<?}?>
</tr>
<?$i++;}?>
</table>
<?}?>
<?/////////////////////////  End ALL  //////////////////////////////////////?>
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