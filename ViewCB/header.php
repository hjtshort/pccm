<?php	
	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php')	;	
		
?>

 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Website Cán bộ</title>
<link href="ViewAdmin/style.css" rel="stylesheet" type="text/css" />
<link href="ViewAdmin/style1.css" rel="stylesheet" type="text/css" />
</head>

<body>

  
  <div class="header">
  	<img src="ViewAdmin/image/bn copy.jpg" alt="hinh" />
  </div>
  <?php
				 
				 $user  = is_logged();
	            if (isset($user))
        		    {
?>
 <ul id="nav1"><div align="right" style="color: #000099; font-size:14px;">Xin chào cán bộ <i style="color:#990000; font-size:18px;"> <?php echo $user['ten']; ?></i>, <a style=" color:#003366; font-size:14px; text-decoration:none; font-weight:bold;" href="index.php?f=logout">Đăng xuất</a></div> </ul>
   <?php  				  
				  	}
					
         		  ?>
  
  
  <div>
<ul id="nav">
<li><a href="index.php?f=QuanTri_Pccm1">Trang chủ</a></li>
<li><a href="index.php?f=QuanTri_Pccm1">Phân công của bộ môn</a></li>
<li><a href="#">Thống kê </a>
	<ul> <!-- menu con-->
		<li><a href="index.php?f=QuanTri_ThongKe">Thiếu tiết</a></li>
		<li><a href="index.php?f=QuanTri_ThongKeDu">Thừa tiết</a></li>
		<li><a href="index.php?f=QuanTri_ThongKeDu200">Thừa trên 200 tiết</a></li>
	</ul>
</li>

<li><a href="index.php?f=QuanTri_ThongTinCanBo">Thông tin cá nhân</a></li>
<li><a href="index.php?f=QuanTri_KhGd">Kế hoạch giảng dạy </a></li>
<li><a href="index.php?f=QuanTri_MTQ">Môn tiên quyết </a></li>

</ul>
</div>
  
  
  
  
  
  
 
</div><!--end wrapper-->

</body>
</html>
