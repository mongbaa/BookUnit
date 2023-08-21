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
<h1>Report</h1>
<p>
<form action="unit_limit.php" method="get">
<table align="center">
<tr>
	<td><select name="mo_id" class="border01">
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
	</td>
	<td><select name="ye_id" class="border01">
		<?		
		$max_s=date("Y")+5;
		if($_GET['ye_id']==''){$_GET['ye_id']=date("Y");}
		$j=date("Y");
		while($j<=$max_s){?>
		<option value='<?echo $j;?>' <?if($_GET['ye_id']==''){if(date("Y")==$j){echo " selected";}}else{if($_GET['ye_id']==$j){echo " selected";}} ?>>
		<?echo $j;?>
		</option>
		<?$j++;}?>
	</select>
	</td>
	<td><input type="submit" value=" ค้นหา "></td>
</tr>
</table>
</form>
</p>
<form action="unit_limit_process.php" method="post">
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
$num_date = cal_days_in_month( CAL_GREGORIAN , $_GET['mo_id'] , $_GET['ye_id'] ) ;
$i=1;while($i<=$num_date){?>	
<tr align="center">
				<td rowspan=2><?=$i?>/<?=$_GET['mo_id']?>/<?=$_GET['ye_id']?>
					<input type="hidden" name="unit" value="<?echo $_GET['ye_id']."-".$_GET['mo_id']."-".$i;?>">
				</td>
				<td>เช้า <br>Y4<br>Y5<br>Y6<br>Y7</td>
		<?$result_type = mysql_query("select * from type_work order by type_id ");
		while ($show_type = mysql_fetch_assoc($result_type)){?>
		<td>
			<?
			$date_check_ul_M=$_GET['ye_id']."-".$_GET['mo_id']."-".$i;
			$result_check_ul_M = mysql_query("select * from tb_unit_limit where unit_date='$date_check_ul_M' and unit_time='M' and type_id='$show_type[type_id]' ");
			$show_check_ul_M = mysql_fetch_assoc($result_check_ul_M);
			?>
			<input type="text" name="limit_M_type4[<?=$show_type['type_id']?>][<?=$i?>]" value="<?=$show_check_ul_M['unit_limit4']?>" placeholder="Y4" size="1">
			<input type="text" name="limit_M_type5[<?=$show_type['type_id']?>][<?=$i?>]" value="<?=$show_check_ul_M['unit_limit5']?>" placeholder="Y5" size="1">
			<input type="text" name="limit_M_type6[<?=$show_type['type_id']?>][<?=$i?>]" value="<?=$show_check_ul_M['unit_limit6']?>" placeholder="Y6" size="1">
			<input type="text" name="limit_M_type7[<?=$show_type['type_id']?>][<?=$i?>]" value="<?=$show_check_ul_M['unit_limit7']?>" placeholder="Y7" size="1">
		</td>
		<?}?>
</tr>
<tr align="center">
				<td>บ่าย <br>Y4<br>Y5<br>Y6<br>Y7</td>
		<?$result_type = mysql_query("select * from type_work order by type_id ");
		while ($show_type = mysql_fetch_assoc($result_type)){?>
		<td>
			<?
			$date_check_ul_A=$_GET['ye_id']."-".$_GET['mo_id']."-".$i;
			$result_check_ul_A = mysql_query("select * from tb_unit_limit where unit_date='$date_check_ul_A' and unit_time='A' and type_id='$show_type[type_id]' ");
			$show_check_ul_A = mysql_fetch_assoc($result_check_ul_A);
			?>
			<input type="text" name="limit_A_type4[<?=$show_type['type_id']?>][<?=$i?>]" value="<?=$show_check_ul_A['unit_limit4']?>" placeholder="Y4" size="1">
			<input type="text" name="limit_A_type5[<?=$show_type['type_id']?>][<?=$i?>]" value="<?=$show_check_ul_A['unit_limit5']?>" placeholder="Y5" size="1">
			<input type="text" name="limit_A_type6[<?=$show_type['type_id']?>][<?=$i?>]" value="<?=$show_check_ul_A['unit_limit6']?>" placeholder="Y6" size="1">
			<input type="text" name="limit_A_type7[<?=$show_type['type_id']?>][<?=$i?>]" value="<?=$show_check_ul_A['unit_limit7']?>" placeholder="Y7" size="1">
		</td>
		<?}?>
</tr>
<?$i++;}?>
</table>
<input type="hidden" name="unit_m" value="<?=$_GET['mo_id']?>">
<input type="hidden" name="unit_y" value="<?=$_GET['ye_id']?>">
<input type="submit" value="Save">
</form>
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