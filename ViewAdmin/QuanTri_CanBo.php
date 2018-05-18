<?php	
error_reporting( ~E_WARNING & ~E_NOTICE);
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
	<link rel="stylesheet" href="css/style.css" />
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
	require_once("ViewAdmin/header.php");	
	//include("header.php");
	
		//Lấy bộ môn
	$sql="select maBm from canbo where maCb='".$user['ms']."'";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
	
	$sql_Bm="select * from bomon where maBm='".$data['maBm']."'";
	$query_Bm = mysqli_query($conn,$sql_Bm);
	$data_Bm = mysqli_fetch_array($query_Bm);
	$maBm=$data['maBm'];
	
	
	isset($_POST["maCb"])  	? $maCb	=trim($_POST["maCb"]) 	:	$maCb= '';	
	isset($_POST["hoCb"]) 	? $hoCb	=trim($_POST["hoCb"]) 	:	$hoCb= '';	
	isset($_POST["tenCb"]) 	? $tenCb=trim($_POST["tenCb"]) 	:	$tenCb = '';	
	//isset($_POST["maBm"]) 	? $maBm	=trim($_POST["maBm"])	:	$maBm= '';	
	isset($_POST["matKhau"])? $matKhau=trim($_POST["matKhau"]):	$matKhau= '';	
	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= '';	



	
	//////////////////////////////////
	if (isset($_POST["btn_them"])) {					
			$address = "QuanTri_CanBo";
			ThemCanBo($conn, $address, $maCb, $hoCb, $tenCb, $maBm, $matKhau);		
	}	
	
	if (isset($_POST["btn_xoa"])) {		  								
			$maCb = $_POST["btn_xoa"];	
			$address = "QuanTri_CanBo";
			XoaCanBo($conn, $address, $maCb);
	}	
	
	if (isset($_POST["btn_sua"])) {		  								
			if(!isset($_POST["chon"]))
			{
				thongBao("Bạn phải chọn cán bộ cần sửa thông tin trong bảng bên dưới trước khi ra lệnh chỉnh sửa!"); 
			
			}
			else
			{
				$ma_old = $_POST["chon"];
				$address = "QuanTri_CanBo";							
				Sua($conn, $address, $ma_old, $maCb, $hoCb, $tenCb, $maBm, $matKhau);	
			}	
	}	
	
	
	if (isset($_POST["chon"])) {					
		$chon = $_POST["chon"];		
		$sql_chon = "SELECT * ".
				 	" FROM canbo ".
					" where maCb = '".$chon."'";
		$query_chon = mysqli_query($conn,$sql_chon);
		$data_chon = mysqli_fetch_array($query_chon);
		$maCb 	= $data_chon["maCb"];
		$hoCb 	= $data_chon["hoCb"];
		$tenCb	= $data_chon["tenCb"];
		$maBm	= $data_chon["maBm"];	
		$matKhau= $data_chon["matKhau"];	
		
	}	

?>

<div class="wrapper" style="background-color:#FFFFFF"> 
 		<div>
			  <form name="form1" method="POST" action="index.php?f=QuanTri_CanBo">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1" style="color: #333"> THÊM CÁN BỘ BỘ MÔN: <font color="#c70000"><?php echo $data_Bm['tenBm']; ?></font> </h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
					  <tr>
                        <td height="35" width="100"> Mã cán bộ: </td>
                        <td ><input type="text" name="maCb" size="15"  value="<?php echo $maCb; ?>"> </td>						
                      </tr>
                      <tr>
                        <td height="35"> Họ và tên lót: </td>
                        <td ><input type="text" name="hoCb" size="15"  value="<?php echo $hoCb; ?>"> 
		 					 Tên:
							 <input type="text" name="tenCb" size="5"  value="<?php echo $tenCb; ?>"> 
						</td>						
                      </tr>
                      <tr>
                        <td height="35"> Mật khẩu: </td>
						<td ><input type="text" name="matKhau" size="5"  value="<?php echo $matKhau; ?>"> </td>                       
                      </tr>
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                        <td colspan="3" height="55">		
							<input class="btn btn-custom"  type="submit" value="TÌM KIẾM" name="btn_tim"> 
							<input class="btn btn-custom"  type="submit" value="THÊM CÁN BỘ" name="btn_them">     													
							<input class="btn btn-custom"  type="submit" value="CHỈNH SỬA" name="btn_sua"> 						  
						</td>
                      </tr>                  
                    </table>
			</center>		
			
			
			
    	    <table class="table"  >

	          	<thead>
					<tr >
					  <th width="33"> STT </th>
					  <th width="100"><center>Mã cán bộ</center></th>
 					  <th width="220"><center>Họ Tên</center></th>
				  	  <th width="194"><center>Bộ Môn</center></th>
					  <th width="346"><center>Khoa / Đơn vị</center></th>
					  <th width="123">&nbsp;  </th>
					</tr>
				  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;
					$sql_hienThi = 	"SELECT * FROM canbo a, bomon b, khoa c ".
									" where a.maBm = b.maBm and b.maKhoa = c.maKhoa ".
									"	and maCb like '%".$maCb."%'".
									"	and hoCb like '%".$hoCb."%'".
									"	and tenCb like '%".$tenCb."%'".
									"	and a.maBm like '%".$maBm."%'".																		
									" ORDER BY b.maKhoa DESC ";
					$query = mysqli_query($conn,$sql_hienThi);
					while ($row = mysqli_fetch_array($query)) {						    
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td><?php echo $row["maCb"]; ?></td>	
						  <td><?php echo $row["hoCb"].' '.$row["tenCb"]; ?></td>	
						  <td><center><?php echo $row["tenBm"]; ?></center></td>	
						  <td><?php echo $row["tenKhoa"]; ?></td>
						  <td>	<center>
						  <?php
						  if($chon== $row["maCb"])  
						  {?>  	
								<input type="radio" name="chon" value='<?php echo $row["maCb"]; ?>' onClick="this.form.submit();" checked="checked">
							<?php } 
						  else {	?>  	
								<input type="radio" name="chon" value='<?php echo $row["maCb"]; ?>' onClick="this.form.submit();">
						  <?php } ?>					
						  
						  <input type="image" name="btn_xoa" onClick="return confirmAction()" value="<?php echo  $row["maCb"];?>"src="img/delete.png" width="20" height="20">
									
						  </center></td>
						</tr>					
			  <?php
			  		
				}
			  ?>					
			  </tbody>
			</table>
	
      	</div>
 
    	</div>
		</form>	
		</div>
		</div>
 
<?php include("footer.php");?>
</div><!--end wrapper--> 
</body>
</html>


