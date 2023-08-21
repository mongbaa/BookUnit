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
<h1>ประวัติการจอง Unit</h1>
<p>
<form action="unit_profile.php" method="get">
<table align="center">
<tr>
	<td><select name="mo_id" class="border01">
		<option value="">--เลือก--</option>
		<?
		$i=1;
		if($_GET['mo_id']==''){$_GET['mo_id']=date("m");}
		while($i<=12){?>
		<option value='<?if($i<10){echo "0".$i;}else{echo $i;}?>' <?if($_GET['mo_id']==''){if(date("m")==$i){echo " selected";}}else{if($_GET['mo_id']==$i){echo " selected";}} ?>>
		<?
			if($i=='1'){echo "มกราคม";}elseif($i=='2'){echo "กุมภาพันธ์";}elseif($i=='3'){echo "มีนาคม";}elseif($i=='4'){echo "เมษายน";}elseif($i=='5'){echo "พฤษภาคม";}elseif($i=='6'){echo "มิถุนายน";}elseif($i=='7'){echo "กรกฎาคม";}elseif($i=='8'){echo "สิงหาคม";}elseif($i=='9'){echo "กันยายน";}elseif($i=='10'){echo "ตุลาคม";}elseif($i=='11'){echo "พฤศจิกายน";}elseif($i=='12'){echo "ธันวาคม";}
		?>
		</option>
		<?$i++;}?>
	</select>
	</td><td>
	<select name="y_id" class="border01">
		<option value="">--เลือก--</option>
		<?
		$i=1;
		$full_y=date("Y")-3;
		if($_GET['y_id']==''){$_GET['y_id']=date("Y");}
		while($full_y<=date("Y")){?>
		<option value='<?echo $full_y;?>' <?if($_GET['y_id']==''){if(date("Y")==$full_y){echo " selected";}}else{if($_GET['y_id']==$full_y){echo " selected";}} ?>>
		<?
			echo $full_y;
		?>
		</option>
		
		
		
		<?$full_y++;}?>
		
		<?$full_y1=date("Y")+1;?>
		<option value='<?echo $full_y1;?>' <?if($_GET['y_id']==''){if(date("Y")==$full_y1){echo " selected";}}else{if($_GET['y_id']==$full_y1){echo " selected";}} ?>>
		<?
			echo $full_y1;
		?>
		</option>
	</select>
	</td>
	<td><input type="submit" value=" ค้นหา "></td>
</tr>
</table>
</form>
</p>
		<table align="center"><?////// Static?>
		<tr align="center">
				<td>ลำดับ</td>
				<td>วันที่</td>			
				<td>เวลา</td>	
				<td>สาขา</td>
				<td>งาน</td>
				<td>Unit</td>
				<td>อาจารย์</td>
				<td>แก้ไข</td>
				<td>ยกเลิก</td>
				<td></td>
			</tr>
<?
$i=1;
$y_id=date("Y");
$sql_unit_select = "select * from tb_unit where user_id = '$login_ID' and MONTH(unit_date) = '$_GET[mo_id]' and YEAR(unit_date) = '$_GET[y_id]' order by unit_date asc, unit_time desc ";
$result_unit_select = mysql_query($sql_unit_select);
while($row_unit_select = mysql_fetch_assoc($result_unit_select)){
?>
<tr>
	<td><?if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}?><?=$i?><?if($row_unit_select['unit_st']=='0'){echo "</strike>";}?></td>
	<td><?if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}?><?=$row_unit_select['unit_date']?><?if($row_unit_select['unit_st']=='0'){echo "</strike>";}?></td>	
	<td><?if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}?><?if($row_unit_select['unit_time']=='M'){echo "เช้า";}elseif($row_unit_select['unit_time']=='A'){echo "บ่าย";}?><?if($row_unit_select['unit_st']=='0'){echo "</strike>";}?></td>
	<td><?if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}?>
<?
$sql_type_work = "select * from type_work where type_id = '$row_unit_select[type_id]' ";
$result_type_work = mysql_query($sql_type_work);
while($row_type_work= mysql_fetch_assoc($result_type_work)){
echo $row_type_work['type_name'];
}
?>
	<?if($row_unit_select['unit_st']=='0'){echo "</strike>";}?></td>	
		<td><?if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}?>
<?
$sql_type_plan = "select * from tb_plan where plan_id = '$row_unit_select[unit_work]' ";
$result_type_plan = mysql_query($sql_type_plan);
while($row_type_plan= mysql_fetch_assoc($result_type_plan)){
echo $row_type_plan['plan'];
}
?>
	<?if($row_unit_select['unit_st']=='0'){echo "</strike>";}?></td>	
	<td>
		<?if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}?><?=$row_unit_select['unit_no'];?><?if($row_unit_select['unit_st']=='0'){echo "</strike>";}?>
		</td>	
	<td><?
			$sql_tea = "select *  from tb_unit_zone tz ";
			$sql_tea .= "left join tb_teacher tt on tt.teacher_id = tz.teacher_id ";
			$sql_tea .= "where unit_date = '$row_unit_select[unit_date]' and unit_time = '$row_unit_select[unit_time]' ";
			$result_tea = mysql_query($sql_tea);
			while($show_tea = mysql_fetch_assoc($result_tea)){				
				$con_tea=explode(",",$show_tea['unit_list']);
				$te=0;
				while($te<=count($con_tea)){
					if(($row_unit_select['unit_no']==$con_tea[$te])&&($row_unit_select['unit_no']!='')){						
							echo "อ.".$show_tea['teacher_fname']."  ".$show_tea['teacher_lname'];
					}$te++;
				}
			}?>
	</td>
	<td>
		<?
		list($d1_y, $d1_m, $d1_d) = explode("-", date("Y-m-d"));
		list($d2_y, $d2_m, $d2_d) = explode("-", $row_unit_select['unit_date']);
		$d1 = mktime(0,0,0,$d1_m, $d1_d, $d1_y);
		$d2 = mktime(0,0,0,$d2_m, $d2_d, $d2_y);
		$diff = ($d2 - $d1) /(60*60*24);
		$con_date=explode("-",$row_unit_select['unit_date']);
		$go_date=$con_date[2]."-".$con_date[1]."-".$con_date[0];
		if(($row_unit_select['user_id']==$login_ID)&&($row_unit_select['unit_st']!='0')&&($diff>=0)){//Check Date
		?><a href="unit_form.php?work_id=<?=$row_unit_select['id']?>&unit_date=<?=$go_date?>&unit_time=<?=$row_unit_select['unit_time']?>&type_id=<?=$row_unit_select['type_id']?>" onclick="return confirm('ต้องการแก้ไขข้อมูล')">แก้ไข</a><?
		}
		?>
	</td>
	<td>
		<?
		if(($row_unit_select['unit_st']!='0')&&($row_unit_select['user_id']==$login_ID)){
		?><a href="unit_cancel.php?f2s=1&work_id=<?=$row_unit_select['id']?>&unit_date=<?=$go_date?>&unit_time=<?=$row_unit_select['unit_time']?>&type_id=<?=$row_unit_select['type_id']?>&unit_st=0" onclick="return confirm('ต้องการยกเลิกการจอง')">ยกเลิกจอง</a><?
		}
		?>
	</td>
</tr>
<?$i++;
}
?>
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