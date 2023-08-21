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
<script type="text/javascript"> 
            function printTable(tableprint) { 
                var printContents = document.getElementById(tableprint).innerHTML; 
                var originalContents = document.body.innerHTML; 
                document.body.innerHTML = printContents; 
                window.print(); 
                document.body.innerHTML = originalContents; 
            } 
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

		   </div>
         </div>
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
                <center><font class="fontthai"><B>ตั้งแต่วันที่
                        <select name="from_date_day" class="borderthai" onChange='document.ins_date.submit();'>
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
                        <input type="text" name="from_date_year" value="<?= $from_date_year ?>"/>&nbsp;ถึง&nbsp;
                        <select name="to_date_day" class="borderthai" onChange='document.ins_date.submit();'>
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
                        <select name="to_date_month" class="borderthai" onChange='document.ins_date.submit();'>
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
                        <input type="text" name="to_date_year" value="<?= $to_date_year ?>"/>&nbsp;
                        <input type="submit" value="แสดงผล"/>
                    </B>&nbsp;<a href="?id=1&CC=<?= $CC ?>&type_work=<?=$type_work?>&std_year=<?= $std_year ?>&from_date_day=<?= $from_date_day ?>&from_date_month=<?= $from_date_month ?>&from_date_year=<?= $from_date_year ?>&to_date_day=<?= $to_date_day ?>&to_date_month=<?= $to_date_month ?>&to_date_year=<?= $to_date_year ?>">Print</a></font></center>
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

        switch ($to_date_month) {
            case 1:
                $to_date_month_show = "มกราคม";
                break;
            case 2:
                $to_date_month_show = "กุมภาพันธ์";
                break;
            case 3:
                $to_date_month_show = "มีนาคม";
                break;
            case 4:
                $to_date_month_show = "เมษายน";
                break;
            case 5:
                $to_date_month_show = "พฤษภาคม";
                break;
            case 6:
                $to_date_month_show = "มิถุนายน";
                break;
            case 7:
                $to_date_month_show = "กรกฎาคม";
                break;
            case 8:
                $to_date_month_show = "สิงหาคม";
                break;
            case 9:
                $to_date_month_show = "กันยายน";
                break;
            case 10:
                $to_date_month_show = "ตุลาคม";
                break;
            case 11:
                $to_date_month_show = "พฤศจิกายน";
                break;
            default:
                $to_date_month_show = "ธันวาคม";
        }

        ?>
                        <center><font class="fontthai"><B>รายงานสรุปจำนวนคาบที่ลงปฎิบัติงานนับจาก Conduct</B></font></center>
						<center><font class="fontthai"><B>ตั้งแต่วันที่ <?= $from_date_day ?> <?= $from_date_month_show ?> <?= $from_date_year ?> ถึง <?= $to_date_day ?> <?= $to_date_month_show ?> <?= $to_date_year ?></B></font></center>

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

                        //$query = "select * from student where student_id in (4860006,4860015,4860039,4860045) ";
                        $query = "select * from tb_user where level in (" . $std_year . ") order by level , user_id asc ";
                        $result = mysql_query($query);
                        $iq5 = 0;

        ?>
                        <table width="100%" border="1" cellspacing="0" cellpadding="0" align="center">
						<tr class='font01'>
                                        <td align="center" colspan="19"><font color="#FF0000"><B>-----------&nbsp;ชั้นปีที่ <?= $std_year ?>&nbsp;-----------</B></font></td>
                                    </tr>
                                    <tr class='font01'>
                                        <td align="center"><B>รหัสนักศึกษา</B></td>
                                        <td align="center"><B>ชื่อ-สกุล</B></td>
                                        <td align="center"><B>จำนวนครั้งที่ลงทั้งหมด</B></td>
										<?
											$result_type =mysql_query("select * from type_work order by type_id asc ");
											while($date_type=mysql_fetch_assoc($result_type)){
											echo "<td align=center><B>".$date_type['type_name']."</B></td>";
											}
										?>
                                    </tr>
            <?

                        while ($row_result = mysql_fetch_assoc($result)) {
                            $sql_cn = "select * from tb_unit where user_id = '$row_result[user_id]' and unit_date >= '$first_date' and unit_date <= '$next_date' and unit_no!='' ";                           

                            $sql_cn_1 = $sql_cn;
                            $sql_cn_1 .= "and type_id='1' ";
                            $result_cn_1 = mysql_query($sql_cn_1);
                            $cn_1 = mysql_num_rows($result_cn_1);

							$sql_cn_2 = $sql_cn;
                            $sql_cn_2 .= "and type_id='2' ";
                            $result_cn_2 = mysql_query($sql_cn_2);
                            $cn_2 = mysql_num_rows($result_cn_2);

							$sql_cn_3 = $sql_cn;
                            $sql_cn_3 .= "and type_id='3' ";
                            $result_cn_3 = mysql_query($sql_cn_3);
                            $cn_3 = mysql_num_rows($result_cn_3);
							
							$sql_cn_4 = $sql_cn;
                            $sql_cn_4 .= "and type_id='4' ";
                            $result_cn_4 = mysql_query($sql_cn_4);
                            $cn_4 = mysql_num_rows($result_cn_4);

							$sql_cn_5 = $sql_cn;
                            $sql_cn_5 .= "and type_id='5' ";
                            $result_cn_5 = mysql_query($sql_cn_5);
                            $cn_5 = mysql_num_rows($result_cn_5);

							$sql_cn_6 = $sql_cn;
                            $sql_cn_6 .= "and type_id='6' ";
                            $result_cn_6 = mysql_query($sql_cn_6);
                            $cn_6 = mysql_num_rows($result_cn_6);

							$sql_cn_7 = $sql_cn;
                            $sql_cn_7 .= "and type_id='7' ";
                            $result_cn_7 = mysql_query($sql_cn_7);
                            $cn_7 = mysql_num_rows($result_cn_7);							

            ?>
                            <tr class='font01'>
                                <td align="center"><?= $row_result["user_id"] ?></td>
                                <td align="left"><?= $row_result["user_fname"] ?>&nbsp;<?= $row_result["user_lname"] ?></td>                                
                                <td align="center"><?= $cn_1+$cn_2+$cn_3+$cn_4+$cn_5+$cn_6+$cn_7+$cn_8+$cn_9+$cn_10+$cn_11+$cn_12 ?></td>                                
								<td align="center"><?= $cn_1 ?></td>
								<td align="center"><?= $cn_2 ?></td>
								<td align="center"><?= $cn_3 ?></td>
								<td align="center"><?= $cn_4 ?></td>
								<td align="center"><?= $cn_5 ?></td>
								<td align="center"><?= $cn_6 ?></td>
								<td align="center"><?= $cn_7 ?></td>
                            </tr>
<?

                        }//--end while student

?>
        </table>
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