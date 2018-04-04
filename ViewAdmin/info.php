<?php	
	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php')	;	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Thông tin sinh viên </title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/style.css" />
	<style type="text/css">
		body{
			background-color: #c70000;
			font-size: 18px;
		}
		.center{
			display: flex;
			justify-content: center;
		}
		h1{
			margin-bottom: 30px;
		}
		p{
			font-weight: bold;
		}
		a{
			color: #2196F3;
			transition: 0.3s;
		}
		a:hover{
			text-decoration: none;
			color: #0D47A1;
		}

	</style>
</head>
<body>
<div class="container"> 
	<div class="center">
		<div class="col-md-8">
			<div class="panel paneldefault" style="margin-top: 20%">
				<div class="panel-body">
					<h1 class="text-center">THÔNG BÁO</h1>
					<p>Đây là nội dung thông tin admin</p>
					<p>Click để đến: <a href="index.php?f=Quantri" id="thoat">Trang quản trị </a></p>
				</div>
			</div>
		</div>
	</div>
</div>
</html>