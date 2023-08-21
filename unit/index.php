<?php
    session_start();
$login_ID = $_SESSION['login_ID'];
if($login_ID == NULL){
?>
    <meta http-equiv="refresh" content="0;url='../index.php">
<?}?>
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
<SCRIPT LANGUAGE="JavaScript">
theUrl="change_pwd.php";
function doThePopUp() {
reWin = window.open(theUrl,'','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=500,height=200,top=200,left=100');
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
<table border="1" width="800" align="center">
	<tr>
		<td>
		<b>1.</b> <font color="red" size="3">สามารถจอง Unit และแก้ไข ของวันพรุ่งนี้ ได้มีเกิน 14.00 น. ยกเว้น วันพุธ จะไม่เกิน 10.00 น.</font>
		<br><br><b>2.</b> <font color="" size="3">สามารถจองล่วงหน้าสาขา  <u>Crown and Bridge </u> ได้ครั้งละ 1 คาบ</font>
		<br><br><b>3.</b> <font color="" size="3">สามารถจองล่วงหน้าสาขา อื่นๆ ยกเว้นสาขาตามข้อที่2 ไม่เกิน 10 คาบ</font>
		<br><br><b>4.</b> <font color="red" size="3">สาขา Operative สามารถจองล่วงหน้าได้ไม่เกิน 3 คาบ</font>
		<br><br><br><b>Update</b> <font color="red" size="3">ปลดล๊อค limit การจอง ข้อที่2 และ 3 ตั้งแต่วันที่ 09-10-2016 </font>
		</td>
	</tr>
	<tr>
		<td><a href ="javascript:doThePopUp()"><font color="blue" size="3"><b>เปลี่ยน Password</b></font></a></td>
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