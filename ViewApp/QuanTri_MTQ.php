<?php
	if (!defined('IN_SITE'))
 	 	header('Location: ../index.php')	;

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Website Trưởngng bộ môn</title>
<link href="ViewAdmin/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="ViewAdmin/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

	<SCRIPT LANGUAGE="JavaScript">
      function confirmAction() {
        return confirm("Bạn có chắc xóa không?")
      }
 	</SCRIPT>

	<style type="text/css">
		.style1 {
			color: #0000CC;
		}
		
	</style>


</head>

<body>



 <div class="wrapper" style="background-color:#FFFFFF">

  <?php
	 require_once("lib/QuanTri_CanBo.php");
     require_once("ViewApp/header.php");
     require_once("function.php");
    ?>
    <div class="container">
        <div class="row">
       <div class="col-md-6">
            <label for="">Chọn môn: </label>
          <div class="chonmon">
          <select name="" id="">
                <option value="">Chọn môn</option>
            </select>
          </div>
       </div>
       <div class="col-md-6">
       <label for="">Chọn môn tiên quyết</label>
       <div class="chonmontienquyet">
       <select name="" id="">
                <option value="">Chọn môn tiên quyết</option>
            </select>
       </div>
       </div>
        </div>
    </div>



<?php include("footer.php");?>
</div><!--end wrapper-->
</body>

</html>


