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
<h1>Config</h1>
<form action="config_process.php?edit_type_work=Y" method="post">
<table align="center">
	<tr>
		<td width="30">No.</td>
		<td width="150">สาขา</td>
		<td width="390">List Unit</td>
	</tr>
	<?$st=0;
	$result_type = mysql_query("select * from type_work order by type_id ");
		while ($show_type = mysql_fetch_assoc($result_type)){?>
		<tr><td><input type="hidden" name="type_id[<?=$st?>]" value="<?=$show_type['type_id']?>" size="1"><?=$show_type['type_id']?></td>
		<td><input type="text" name="type_name[<?=$st?>]" value="<?=$show_type['type_name'];?>" size="10"></td>
		<td><input type="text" name="unit_list[<?=$st?>]" value="<?=$show_type['unit_list'];?>"></td></tr>
		<?$st++;}?>
		<tr><td><input type="hidden" name="st" value="<?=$st?>"><input type="text" name="type_id[<?=$st?>]" size="1" maxlength="2"></td>
		<td><input type="text" name="type_name[<?=$st?>]" size="10"></td>
		<td><input type="text" name="unit_list[<?=$st?>]"></td></tr>
		<tr><td colspan="4"><center><input type="submit" value="บันทึก"></center></td></tr>
</table>
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