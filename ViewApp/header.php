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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
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
 <ul id="nav1"><div align="right" style="color: #fff; font-size:14px;">Xin chào <i style="color:#c70000; font-size:18px;"> Admin <?php echo $user['ten']; ?></i>, <a style=" color:#fff; font-size:14px; text-decoration:none; font-weight:bold;" href="index.php?f=logout" title="Đăng xuất"><i class="fa fa-power-off"></i> Đăng xuất</a></div> </ul>
   <?php  				  
				  	}
         		  ?>
  
  
  <div>
<ul id="nav">

<li><a href="index.php?f=QuanTri_CanBo">Cán bộ</a>
	<ul>
		<li><a href="index.php?f=QuanTri_ChucVu">Chức vụ</a></li>	
	</ul>
</li>
<li><a href="index.php?f=QuanTri_BoMon">Bộ môn</a>
</li>
<li><a href="index.php?f=QuanTri_Nganh">Ngành</a></li>
<li><a href="index.php?f=QuanTri_Lop">Lớp</a></li>
<li><a href="index.php?f=QuanTri_Mon">Môn học</a>
	<ul>
		<li><a href="index.php?f=QuanTri_MonNganh">Môn học ngành</a></li>	
	</ul>
</li>
<li><a href="index.php?f=QuanTri_DoiTuongGiam">Đối tượng giảm</a></li>
<li><a href="index.php?f=QuanTri_KhGd">Kế hoạch dạy</a>
<ul>
	<li><a href="index.php?f=QuanTri_ThemKH">Thêm kế hoạch giảng dạy</a></li>
	<li><a href="index.php?f=QuanTri_MTQ">Thêm môn tiên quyết</a></li>
</ul>
</li>
<li><a href="index.php?f=QuanTri_ThongTinCanBo">Đổi mật khẩu</a></li>

</div>
  
  
  
  
  
  
 
</div><!--end wrapper-->

</body>
</html>
