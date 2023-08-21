
<?php
include("connect.php");
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Dent Unit</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link href="style.css" rel="stylesheet" type="text/css" /> 
  <link rel="stylesheet" href="stylesheets/foundation.min.css">
  <link rel="stylesheet" href="stylesheets/main.css">
  <link rel="stylesheet" href="stylesheets/app.css">
  <script src="javascripts/modernizr.foundation.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" media="all" type="text/css" href="class/jquery-ui.css" />
	<link rel="stylesheet" media="all" type="text/css" href="class/jquery-ui-timepicker-addon.css" />
	<script type="text/javascript" src="class/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="class/jquery-ui.min.js"></script>
	<script type="text/javascript" src="class/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="class/jquery-ui-sliderAccess.js"></script>
	
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
			  <li><a href="sys.html" target="_blank">System</a></li>
			  <li><a href="unit_zone.php" target="_blank">Unit zone</a></li>
            </ul><script type="text/javascript">
           //<![CDATA[
           $('ul#menu-header').nav-bar();
            //]]>
            </script>
          </div>
		  
 </div>

	        <div class="row hide-for-small">
      
        <div class="twelve columns">
           <div class="heading_dots" align="center">
<h1>Unit zone</h1>
<p>
<form  action="<?php echo  $_SERVER['PHP_SELF']?>"  method="get">
<table width="395" align="center">
<tr>
	<td><label>
<select name="type_id"  class="border01" required>
<option value=""> -- เลือกสาขา --</option>
<?php
include("connect.php");
$sql_tw= "SELECT * FROM type_work ORDER BY type_work.type_id ASC";
$query_tw = mysql_query($sql_tw);
while($result_tw = mysql_fetch_assoc($query_tw)){
?>
<option value="<?php echo $result_tw['type_id'];?>" <?php if(@$_GET['type_id']==$result_tw['type_id']){ echo "selected"; }?> ><?php echo $result_tw['type_name'];?></option>
<?php }?>
</select>



<?php if(isset($_GET['type_id'])){?>
<br>
<select name="teacher_id"  class="border01">
<option value=""> -- เลือกอาจารย์ --</option>
<?php
if(isset($_GET['type_id'])){ $type_id=$_GET['type_id']; }else{  $type_id="";}
include("connect.php");
echo $sql_th= "SELECT * FROM tb_teacher where  tb_teacher.type_id=$type_id ORDER BY tb_teacher.teacher_id ASC";
$query_th = mysql_query($sql_th);
while($result_th = mysql_fetch_assoc($query_th)){
?>
<option value="<?php echo $result_th['teacher_id'];?>" <?php if(@$_GET['teacher_id']==$result_th['teacher_id']){ echo "selected"; }?> ><?php echo $result_th['teacher_fname'];?> <?php echo $result_th['teacher_lname'];?> </option>
<?php }?>
</select>

<?php }?>
		
		
		
	</label></td>
	<td><input name="submit" type="submit" value=" ค้นหา "></td>
</tr>
</table>
</form>



<?php if(isset($_GET['type_id'])){?>


<table width="100%" border="1">
  <tr>
    <td width="15%">วันที่</td>
    <td width="14%">ช่วงเวลา</td>
    <td width="16%">สาขา</td>
    <td width="16%">&nbsp;อาจารย์</td>
    <td width="14%">zone </td>
    <td width="18%">unit</td>
    </tr>
	
	
<?php
include("connect.php");
if(isset($_GET['type_id'])){ $type_id=$_GET['type_id']; }else{  $type_id="";}
if(isset($_GET['teacher_id'])){ $teacher_id=$_GET['teacher_id']; }else{  $teacher_id="";}


$sql= "SELECT * FROM tb_unit_zone , type_work , tb_teacher where

 tb_unit_zone.type_id=type_work.type_id  and  tb_unit_zone.teacher_id=tb_teacher.teacher_id 
 and   tb_unit_zone.type_id like '%$type_id%' and  tb_unit_zone.teacher_id like '%$teacher_id%' 
 
 
 
 ORDER BY tb_unit_zone.unit_date DESC LIMIT 0 , 100";
$query = mysql_query($sql);
while($result = mysql_fetch_assoc($query)){
?>
  <tr>
    <td><?php echo $result['unit_date'];?></td>
    <td><?php echo $result['unit_time'];?></td>
    <td><?php echo $result['type_name'];?></td>
    <td><?php echo $result['teacher_fname'];?> <?php echo $result['teacher_lname'];?></td>
    <td><?php echo $result['unit_zone'];?></td>
    <td><textarea name="" cols="" rows="4" disabled="disabled"><?php echo $result['unit_list'];?></textarea></td>
    </tr>
<?php }?>
	
</table>
</p>
<?php }?>


	    
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