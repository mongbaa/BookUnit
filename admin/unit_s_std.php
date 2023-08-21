<?php
    session_start();
$login_ID = $_SESSION['login_ID'];

if (isset($_GET['from_date_day'])) {
	$from_date_day = $_GET['from_date_day'];
} else {
	$from_date_day = 1;
}

if (isset($_GET['from_date_month'])) {
	$from_date_month = $_GET['from_date_month'];
} else {
	$from_date_month = 1;
}

if (isset($_GET['from_date_year'])) {
	$from_date_year = $_GET['from_date_year'];
} else {
	$from_date_year = date("Y") + 543;
}

if (isset($_GET['to_date_day'])) {
	$to_date_day = $_GET['to_date_day'];
} else {
	$to_date_day = 1;
}

if (isset($_GET['to_date_month'])) {
	$to_date_month = $_GET['to_date_month'];
} else {
	$to_date_month = 1;
}

if (isset($_GET['to_date_year'])) {
	$to_date_year = $_GET['to_date_year'];
} else {
	$to_date_year = date("Y") + 543;
}

$type_work = $_GET['type_work'];
$std=$_GET['std'];
$std_all=$_GET['std_all'];

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
</head>
<body>
<form action="unit_s_std.php" method="get">
<table align="center">
	<tr>
		<td>ค้นหาข้อมูล นักศึกษา ID :</td>
		<td>
		<input type="text" name="std" size="10" placeholder="S ตามด้วยรหัสนักศึกษา" value=<?=$std?>>
		<input type="checkbox" name="std_all" value="Y" <? if($std_all=='Y'){echo " checked";}?>> นักศึกษาทั้งหมด
		</td>
		<td>สาขา :</td>
		<td><select name="type_work" class="borderthai">
                                    <option value="1"<?
                                    if($type_work == 1){
                                        echo "selected";
                                    }
                            ?>>Operative</option>

                                    <option value="2"<?
                                    if($type_work == 2){
                                        echo "selected";
                                    }
                            ?>>Endodontics</option>

                                <option value="3"<?
                                    if($type_work == 3){
                                        echo "selected";
                                    }
                            ?>>Crown and Bridge</option>

                                <option value="4"<?
                                    if($type_work == 4){
                                        echo "selected";
                                    }
                            ?>>Periodontics</option>

                                <option value="5"<?
                                    if($type_work == 5){
                                        echo "selected";
                                    }
                            ?>>Prosthodontics</option>

                                <option value="6"<?
                                    if($type_work == 6){
                                        echo "selected";
                                    }
                            ?>>Oral diagnosis</option>

                                <option value="7"<?
                                    if($type_work == 7){
                                        echo "selected";
                                    }
                            ?>>Preventive</option>                                
							<option value=""<?
                                    if($type_work == ""){
                                        echo "selected";
                                    }
                            ?>>ALL</option>
                                </select>
		</td>
		<td>ตั้งแต่วันที่ :</td>
		<td><select name="from_date_day" class="borderthai">
                            <?

                            for ($i = 1; $i <= 31; $i++) {

                                ?>
                                <option value="<?= $i ?>"<?

                        if ($from_date_day == $i) {
                            echo "selected";
                        }

                                ?>><?= $i ?></option>
                                        <?

                                    }

                                    ?>
                        </select>&nbsp;
                        <select name="from_date_month" class="borderthai">
                            <option value="1"<?

                                if ($from_date_month == 1) {
                                    echo "selected";
                                }

                                    ?>>ม.ค.</option>
                            <option value="2"<?

                                if ($from_date_month == 2) {
                                    echo "selected";
                                }

                                    ?>>ก.พ.</option>
                            <option value="3"<?

                                if ($from_date_month == 3) {
                                    echo "selected";
                                }

                                    ?>>มี.ค.</option>
                            <option value="4"<?

                                if ($from_date_month == 4) {
                                    echo "selected";
                                }

                                    ?>>เม.ย.</option>
                            <option value="5"<?

                                if ($from_date_month == 5) {
                                    echo "selected";
                                }

                                    ?>>พ.ค.</option>
                            <option value="6"<?

                                if ($from_date_month == 6) {
                                    echo "selected";
                                }

                                    ?>>มิ.ย.</option>
                            <option value="7"<?

                                if ($from_date_month == 7) {
                                    echo "selected";
                                }

                                    ?>>ก.ค.</option>
                            <option value="8"<?

                                if ($from_date_month == 8) {
                                    echo "selected";
                                }

                                    ?>>ส.ค.</option>
                            <option value="9"<?

                                if ($from_date_month == 9) {
                                    echo "selected";
                                }

                                    ?>>ก.ย.</option>
                            <option value="10"<?

                                if ($from_date_month == 10) {
                                    echo "selected";
                                }

                                    ?>>ต.ค.</option>
                            <option value="11"<?

                                if ($from_date_month == 11) {
                                    echo "selected";
                                }

                                    ?>>พ.ย.</option>
                            <option value="12"<?

                                if ($from_date_month == 12) {
                                    echo "selected";
                                }

                                    ?>>ธ.ค.</option>
                        </select>&nbsp;พ.ศ.
                        <input type="text" name="from_date_year" value="<?= $from_date_year ?>"/>
					</td>
					<td>ถึง&nbsp; :</td>
					<td><select name="to_date_day" class="borderthai">
                            <?

                            for ($i = 1; $i <= 31; $i++) {

                                ?>
                                <option value="<?= $i ?>"<?

                        if ($to_date_day == $i) {
                            echo "selected";
                        }

                                ?>><?= $i ?></option>
                                        <?

                                    }

                                    ?>
                        </select>&nbsp;
                        <select name="to_date_month" class="borderthai">
                            <option value="1"<?

                                if ($to_date_month == 1) {
                                    echo "selected";
                                }

                                    ?>>ม.ค.</option>
                            <option value="2"<?

                                if ($to_date_month == 2) {
                                    echo "selected";
                                }

                                    ?>>ก.พ.</option>
                            <option value="3"<?

                                if ($to_date_month == 3) {
                                    echo "selected";
                                }

                                    ?>>มี.ค.</option>
                            <option value="4"<?

                                if ($to_date_month == 4) {
                                    echo "selected";
                                }

                                    ?>>เม.ย.</option>
                            <option value="5"<?

                                if ($to_date_month == 5) {
                                    echo "selected";
                                }

                                    ?>>พ.ค.</option>
                            <option value="6"<?

                                if ($to_date_month == 6) {
                                    echo "selected";
                                }

                                    ?>>มิ.ย.</option>
                            <option value="7"<?

                                if ($to_date_month == 7) {
                                    echo "selected";
                                }

                                    ?>>ก.ค.</option>
                            <option value="8"<?

                                if ($to_date_month == 8) {
                                    echo "selected";
                                }

                                    ?>>ส.ค.</option>
                            <option value="9"<?

                                if ($to_date_month == 9) {
                                    echo "selected";
                                }

                                    ?>>ก.ย.</option>
                            <option value="10"<?

                                if ($to_date_month == 10) {
                                    echo "selected";
                                }

                                    ?>>ต.ค.</option>
                            <option value="11"<?

                                if ($to_date_month == 11) {
                                    echo "selected";
                                }

                                    ?>>พ.ย.</option>
                            <option value="12"<?

                                if ($to_date_month == 12) {
                                    echo "selected";
                                }

                                    ?>>ธ.ค.</option>
                        </select>&nbsp;พ.ศ.
                        <input type="text" name="to_date_year" value="<?= $to_date_year ?>"/>
		</td>
		<td><input type="submit" value=" ค้นหา "></td>
	</tr>
</table>
</form>
<?
$from_date_year = $from_date_year - 543;
					if ($from_date_month < 10) {
						$from_date_month = "0" . $from_date_month;
					}
					if ($from_date_day < 10) {
						$from_date_day = "0" . $from_date_day;
					}
					$to_date_year = $to_date_year - 543;
					if ($to_date_month < 10) {
						$to_date_month = "0" . $to_date_month;
					}
					if ($to_date_day < 10) {
						$to_date_day = "0" . $to_date_day;
					}
					$first_date = $from_date_year . "-" . $from_date_month . "-" . $from_date_day;
					$next_date = $to_date_year . "-" . $to_date_month . "-" . $to_date_day;

	$result_user = mysql_query("select * from tb_user where user_id = '$std' ");
		while ($show_user = mysql_fetch_assoc($result_user)){
		echo "<b>นทพ. ".$show_user['user_fname']."  ".$show_user['user_lname'];
		echo "ชั้นปี :".$show_user['level']."</b>";}
?>
<br>
<br>
<table align="center"><?////// Static?>
		<tr align="center">
				<td>ลำดับ</td>
				<td>รหัส นทพ</td>
				<td>ชื่อ - สกุล</td>
				<td width="100">วันที่</td>			
				<td>เวลา</td>	
				<td>สาขา</td>
				<td>งาน</td>
				<td>Unit</td>
				<td>อาจารย์</td>
			</tr>
<?
$i=1;
if($std_all=="Y"){
$sql_unit_select = "select * from tb_unit where user_id like '%$std%' ";
}else{
$sql_unit_select = "select * from tb_unit where user_id = '$std' ";
}

if($type_work <>""){
$sql_unit_select .= "and type_id='$type_work' ";
}
$sql_unit_select .= "and unit_date >= '$first_date' and unit_date <='$next_date' ";
$sql_unit_select .= "order by unit_date desc ";
$result_unit_select = mysql_query($sql_unit_select);
while($row_unit_select = mysql_fetch_assoc($result_unit_select)){
?>
<tr>
	<td><?if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}?><?=$i?><?if($row_unit_select['unit_st']=='0'){echo "</strike>";}?></td>
	<td><?if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}?><?=$row_unit_select['user_id']?><?if($row_unit_select['unit_st']=='0'){echo "</strike>";}?></td>
	<td><?if($row_unit_select['unit_st']=='0'){echo "<strike style='color:red'>";}?>
	<?
		$result_user_show = mysql_query("select * from tb_user where user_id = '$row_unit_select[user_id]' ");
		while ($show_user_show = mysql_fetch_assoc($result_user_show)){
		echo "นทพ. ".$show_user_show['user_fname']."  ".$show_user_show['user_lname'];}
	?>
	<?if($row_unit_select['unit_st']=='0'){echo "</strike>";}?></td>	
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
</tr>
<?$i++;
}
?>
</table>
</body>
</html>