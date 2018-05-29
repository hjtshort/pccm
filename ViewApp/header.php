<?php	
	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php')	;	
		
?>


  <header>
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
  
  
  <div class="container-fluid">
		<div class="row">
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
					<li><a href="index.php?f=QuanTri_ThemKH">Thêm kế hoạch DH </a></li>
					<li><a href="index.php?f=QuanTri_MTQ">Thêm môn tiên quyết</a></li>
				</ul>
				</li>
				<li><a href="index.php?f=QuanTri_ThongTinCanBo">Đổi mật khẩu</a></li>
				</ul>
		</div>
</div>
</header>
  