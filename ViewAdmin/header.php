<?php	
	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php')	;	
		
?>

 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Website Truong bo mon</title>
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
 <ul id="nav1"><div align="right" style="color: #000099; font-size:14px;">Xin chào cán bộ <i style="color:#990000; font-size:18px;"> <?php echo $user['ten']; ?></i>, <a style=" color:#003366; font-size:14px; text-decoration:none; font-weight:bold;" href="index.php?f=logout" title="Đăng xuất">Đăng xuất</a></div> </ul>
   <?php  				  
				  	}
         		  ?>
  
  
  <div>
<ul id="nav">
<li><a href="index.php?f=QuanTri_Pccm1">Trang chủ</a></li>
<li><a href="index.php?f=...">Kế hoạch giảng dạy</a></li>

<li><a href="index.php?f=QuanTri_Pccm1">Phân công</a>
<ul>

<li><a href="index.php?f=QuanTri_Pccm1">Phân theo lớp</a>
<li><a href="index.php?f=QuanTri_Pccm1">Chuyên môn</a>
<li><a href="index.php?f=QuanTri_Covan&idMau=<?php $now = getdate();
												   $namHoc =  $now["year"]-1; 
												   $chuoi=$namHoc." "."lop"." "."canbo";
												   echo $chuoi; ?>">Cố vấn học tập</a></li>
<li><a href="index.php?f=QuanTri_TapBaiGiang">Tập bài giảng</a>
<!--<ul>
<li><a href="#">captcha</a></li>
<li><a href="#">gallery</a></li>
<li><a href="#">animation</a></li>
</ul>-->
</li>
<li><a href="index.php?f=QuanTri_Nckh">NCKH</a></li>
</ul>
</li>
<li><a href="#">Cập nhật</a>
<ul>
<li><a href="index.php?f=QuanTri_CanBo">Cập nhật cán bộ</a>
	<ul> <!-- menu con-->
		<li><a href="index.php?f=QuanTri_CanBo">Thông tin cán bộ</a></li>
		<li><a href="index.php?f=QuanTri_ChucVu">Chức vụ cán bộ</a></li>
		<li><a href="index.php?f=QuanTri_CanBoGiam">Đối tượng cán bộ</a></li>
	</ul>
</li>
<li><a href="index.php?f=QuanTri_DoiTuongGiam">Đối tượng giảm</a></li>
</ul>
</li>
<li><a href="#">Quản trị</a>
<ul>
<li><a href="index.php?f=QuanTri_Nganh">Ngành</a></li>
<li><a href="index.php?f=QuanTri_Lop">Lớp</a></li>
<li><a href="index.php?f=QuanTri_Mon">Môn học</a></li>
<li><a href="index.php?f=QuanTri_KhGd">Kế hoạch giảng dạy</a></li>
</ul>
</li>
<li><a href="#">Thống kê </a>
	<ul> <!-- menu con-->
		<li><a href="index.php?f=QuanTri_ThongKe">Thiếu tiết</a></li>
		<li><a href="index.php?f=QuanTri_ThongKeDu">Thừa tiết</a></li>
		<li><a href="index.php?f=QuanTri_ThongKeDu200">Thừa trên 200 tiết</a></li>
	</ul>
</li>
<li><a href="index.php?f=QuanTri_ThongTinCanBo">Thông Tin cá nhân</a></li>
</ul>
</div>
  
  
  
  
  
  
 
</div><!--end wrapper-->

</body>
</html>
