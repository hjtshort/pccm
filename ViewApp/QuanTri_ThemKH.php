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
	<link href="ViewAdmin/style1.css" rel="stylesheet" type="text/css" />
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
		.form-upload{
			display: flex;
  			align-items: center;
  			justify-content: center;
		}

		.form-upload{
			border-radius: 5px;
   			background-color: #f2f2f2;
    		padding: 20px;
		}

		.from-control{
			padding:5px;
		}
	</style>


</head>

<body>



 <div class="wrapper" style="background-color:#FFFFFF">

  <?php
	 require_once("lib/QuanTri_CanBo.php");
	 require_once("ViewApp/header.php");


?>

		<div class="form-upload">
		<form id="upload" action="#" method="post" enctype="multipart/form-data">
	    		<div class="form-group">
				<label for="">Tải lên tập tin Excel môn học !</label>
			</div>
			<div>
			<select name="mabm" >															
							 	<?php																					
									$sql_g = "select maKhoa, tenKhoa from khoa";									
									$query_g = mysqli_query($conn,$sql_g);								
									while ($data_g = mysqli_fetch_array($query_g)) {	
								?>										 
									<optgroup label='<?php echo $data_g["tenKhoa"]; ?>'>
									<?php								
										$sql4 ="SELECT maBm, tenBm FROM bomon b, khoa c".
														" WHERE b.maKhoa=c.maKhoa and ".																											
														"		c.maKhoa = 	'".$data_g["maKhoa"]."'";	
										$query4 = mysqli_query($conn,$sql4);
										while ($data4 = mysqli_fetch_array($query4)) {
											if($maBm==$data4["maBm"]) 											
											{  ?>
												<option value='<?php echo $data4["maBm"]; ?>' selected="selected"><?php echo $data4["tenBm"]; ?></option>
											 <?php }	else { ?>
												<option value='<?php echo $data4["maBm"]; ?>'><?php echo $data4["tenBm"]; ?></option>
									<?php   }	
									   }?>
								</optgroup>
							   <?php 	}?>
						  </select>
			</div>
			<div class="form-group">
				<input class="form-control" type="file" name="file" id="files">
			</div>

			<div class="form-group">
				<input class="btn btn-custom" type="submit" value="Tải lên" name="submit">
			</div>
			<div class="ketqua">
			</div>
		</form>

		</div>

<?php include("footer.php");?>
</div><!--end wrapper-->
</body>
<script>
$(document).ready(function (e) {
	$("#upload").on('submit',(function(e) {
	e.preventDefault();
	data = new FormData($("#upload"));

	console.log(data);
	$.ajax({
	url: "./Lib/upload.php", // Url to which the request is send
	type: "POST",             // Type of request to be send, called as method
	data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
	contentType: false,       // The content type used when sending data to the server.
	cache: false,             // To unable request pages to be cached
	processData:false,        // To send DOMDocument or non processed data file it is set to false
	success: function(data)   // A function to be called if request succeeds
	{
		$('.ketqua').html(data);
		console.log(data);
	}
	});
	}));
});
</script>
</html>


