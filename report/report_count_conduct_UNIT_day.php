<?
if (isset($_POST['from_date_day'])) {
    $from_date_day = $_POST['from_date_day'];
} else {
    if (isset($_GET['from_date_day'])) {
        $from_date_day = $_GET['from_date_day'];
    } else {
        $from_date_day = 1;
    }
}
if (isset($_POST['from_date_month'])) {
    $from_date_month = $_POST['from_date_month'];
} else {
    if (isset($_GET['from_date_month'])) {
        $from_date_month = $_GET['from_date_month'];
    } else {
        $from_date_month = 1;
    }
}
if (isset($_POST['from_date_year'])) {
    $from_date_year = $_POST['from_date_year'];
} else {
    if (isset($_GET['from_date_year'])) {
        $from_date_year = $_GET['from_date_year'];
    } else {
        $from_date_year = date("Y") + 543;
    }
}
if (isset($_POST['to_date_day'])) {
    $to_date_day = $_POST['to_date_day'];
} else {
    if (isset($_GET['to_date_day'])) {
        $to_date_day = $_GET['to_date_day'];
    } else {
        $to_date_day = 1;
    }
}
if (isset($_POST['to_date_month'])) {
    $to_date_month = $_POST['to_date_month'];
} else {
    if (isset($_GET['to_date_month'])) {
        $to_date_month = $_GET['to_date_month'];
    } else {
        $to_date_month = 1;
    }
}
if (isset($_POST['to_date_year'])) {
    $to_date_year = $_POST['to_date_year'];
} else {
    if (isset($_GET['to_date_year'])) {
        $to_date_year = $_GET['to_date_year'];
    } else {
        $to_date_year = date("Y") + 543;
    }
}

$type_work = $_REQUEST['type_work'];
if($type_work == ""){
    $type_work = 0;
}

if (isset($_POST['std_year'])) {
    $std_year = $_POST['std_year'];
} else {
    if (isset($_GET['std_year'])) {
        $std_year = $_GET['std_year'];
    } else {
        $std_year = "5,6";
    }
}
if (isset($_POST['CC'])) {
	$CC = $_POST['CC'];
}elseif (isset($_GET['CC'])) {
	$CC = $_GET['CC'];
}else{
	$CC="CC";
}
$ay=$from_date_year-543;
if ($id == 1) {
    header('Content-type:application/ms-excel');
    header('Content-Disposition:attachment;filename="AY'.$ay.'_'.$CC.'_Conduct_Num_Type'.$type_work.'.xls"');
}

// connect to database.
include '../connect.php';
include 'function_report.php';

?>
<html>
    <head>
        <title>รายงานสรุปจำนวนคาบที่ลงปฎิบัติงานของนักศึกษาทั้งหมด</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?

        if ($id != 1) {

        ?>
            <link href="../../class/style.css" rel="stylesheet" type="text/css">
        <?

        }

        ?>
    </head>

    <body>
        <?

        if ($id != 1) {

            ?>
            <form name="ins_date" method="post" action="" onsubmit='actiontype(this);'>
                <center>
                    <font class="fontthai">ชั้นปีที่ </font>
                    <select name="std_year" class="borderthai" onChange='document.ins_date.submit();'>
                        <option value="4" <?

        if ($std_year == "4") {
            echo "selected";
        }

            ?>>4</option>
			<option value="5" <?

        if ($std_year == "5") {
            echo "selected";
        }

            ?>>5</option>
                        <option value="6" <?

                            if ($std_year == "6") {
                                echo "selected";
                            }

            ?>>6</option>
                        <option value="5,6" <?

                            if ($std_year == "5,6") {
                                echo "selected";
                            }

            ?>>5,6</option>
                    </select>
                </center>
                <center><font class="fontthai"><B>เดือน :                       
                        <select name="from_date_month" class="borderthai" onChange='document.ins_date.submit();'>
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
                        <input type="text" name="from_date_year" value="<?= $from_date_year ?>"/>&nbsp;
						<select name="type_work" class="borderthai" onChange='document.ins_date.submit();'>
                                    <option value="1"<?
                                    if($type_work == 1){
                                        echo "selected";
                                    }
                            ?>>X-ray</option>

                                    <option value="2"<?
                                    if($type_work == 2){
                                        echo "selected";
                                    }
                            ?>>Pedodontics</option>

                                <option value="3"<?
                                    if($type_work == 3){
                                        echo "selected";
                                    }
                            ?>>Orthodontics</option>

                                <option value="4"<?
                                    if($type_work == 4){
                                        echo "selected";
                                    }
                            ?>>Operative</option>

                                <option value="5"<?
                                    if($type_work == 5){
                                        echo "selected";
                                    }
                            ?>>Endodontics</option>

                                <option value="6"<?
                                    if($type_work == 6){
                                        echo "selected";
                                    }
                            ?>>Crown and Bridge</option>

                                <option value="7"<?
                                    if($type_work == 7){
                                        echo "selected";
                                    }
                            ?>>Periodontics</option>

                                <option value="8"<?
                                    if($type_work == 8){
                                        echo "selected";
                                    }
                            ?>>Prosthodontics</option>

                                <option value="9"<?
                                    if($type_work == 9){
                                        echo "selected";
                                    }
                            ?>>Surgery</option>

                                <option value="10"<?
                                    if($type_work == 10){
                                        echo "selected";
                                    }
                            ?>>Oral diagnosis</option>
								<option value="11"<?
                                    if($type_work == 11){
                                        echo "selected";
                                    }
                            ?>>Preventive</option>
								<option value="12"<?
                                    if($type_work == 12){
                                        echo "selected";
                                    }
                            ?>>OPD</option>
							<option value="ALL"<?
                                    if($type_work == ALL){
                                        echo "selected";
                                    }
                            ?>>ALL</option>
                                </select>&nbsp;
                        <input type="submit" value="แสดงผล"/>
                    </B>&nbsp;<a href="?id=1&CC=<?= $CC ?>&type_work=<?=$type_work?>&std_year=<?= $std_year ?>&from_date_month=<?= $from_date_month ?>&from_date_year=<?= $from_date_year ?>">Print</a></font></center>
            </form>
            <?

        }
        switch ($from_date_month) {
            case 1:
                $from_date_month_show = "มกราคม";
                break;
            case 2:
                $from_date_month_show = "กุมภาพันธ์";
                break;
            case 3:
                $from_date_month_show = "มีนาคม";
                break;
            case 4:
                $from_date_month_show = "เมษายน";
                break;
            case 5:
                $from_date_month_show = "พฤษภาคม";
                break;
            case 6:
                $from_date_month_show = "มิถุนายน";
                break;
            case 7:
                $from_date_month_show = "กรกฎาคม";
                break;
            case 8:
                $from_date_month_show = "สิงหาคม";
                break;
            case 9:
                $from_date_month_show = "กันยายน";
                break;
            case 10:
                $from_date_month_show = "ตุลาคม";
                break;
            case 11:
                $from_date_month_show = "พฤศจิกายน";
                break;
            default:
                $from_date_month_show = "ธันวาคม";
        }

        ?>
                        <center><font class="fontthai"><B>รายงานสรุปจำนวนคาบที่ลงปฎิบัติงานนับจาก ระบบ จอง UNIT</B></font></center>
						<center><font class="fontthai"><B>เดือน <?= $from_date_month_show ?> ปี <?= $from_date_year ?></B></font></center>

        <?
					$from_date_year = $from_date_year - 543;
					if ($from_date_month < 10) {
						$from_date_month = "0" . $from_date_month;
					}					
					$first_date = $from_date_year . "-" . $from_date_month . "-01";
					$timeDate = strtotime($first_date);
					$lastDay = date("t", $timeDate);


                         $query = "select * from tb_user where level in (" . $std_year . ") order by level , user_id asc ";
                        $result = mysql_query($query);
                        $iq5 = 0;

        ?>
                        <table width="100%" border="1" cellspacing="0" cellpadding="0" align="center">
						<tr class='font01'>
                                        <td align="center" colspan="<?=$lastDay+3?>"><font color="#FF0000"><B>-----------&nbsp;ชั้นปีที่ <?= $std_year ?>&nbsp;-----------</B></font></td>
                                    </tr>
                                    <tr class='font01'>
                                        <td align="center"><B>รหัสนักศึกษา</B></td>
                                        <td align="center"><B>ชื่อ-สกุล</B></td>
										<?
										$i=1;
										while($i<=$lastDay){
											echo "<td align=center><B>".$i."</B></td>";
										$i++;
										}
										?>                                       
										<td align="center"><B>Total</B></td>
                                    </tr>
            <?
                        while ($row_result = mysql_fetch_assoc($result)) {
			?>
			<tr class='font01'>
			<td align="center"><?= $row_result["user_id"] ?></td>
            <td align="left"><?= $row_result["user_fname"] ?>&nbsp;<?= $row_result["user_lname"] ?></td>
			<?
							$j=1;
							$sum_con=0;
							while($j<=$lastDay){
							$from_date_day = "";
							$ck_date="";
							if ($j < 10) {
								$from_date_day = "0" . $j;
							}else{
								$from_date_day = $j;
							}
							$ck_date=$from_date_year."-".$from_date_month."-".$from_date_day;
							
							$sql_con = "select * from tb_unit e ";
							$sql_con .= "where e.user_id = '$row_result[user_id]' ";
							if($type_work<>'ALL'){$sql_con .= "and e.type_id='$type_work' ";}
							$sql_con .= "and e.unit_no != '' ";
                            $sql_con .= "and e.unit_date = '$ck_date' ";

							$result_con = mysql_query($sql_con);
							$count_con = mysql_num_rows($result_con);
							$sum_con=$sum_con+$count_con;
							if($count_con==0){$count_con="";}
							echo "<td align=center>".$count_con."</td>";
							$j++;
							}
            ?>        
							<td><?=$sum_con?></td>
                            </tr>
<?
                        }//--end while student

?>
        </table>
    </body>
</html>
