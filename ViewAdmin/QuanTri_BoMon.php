<?php	
	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php')	;	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Website Truong bo mon </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="ViewAdmin/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
		
		
		<style type="text/css">
		.style1 {
			color: #0000CC;
		}
		</style>
   
</head>
<body>
<div class="wrapper" style="background-color:#FFFFFF"> 
<?php
	require_once("lib/QuanTri_BoMon.php");	
	include("header.php");
	
	isset($_POST["tenBm"]) 	? $tenBm=trim($_POST["tenBm"]) 	:	$tenBm = '';	
	isset($_POST["maKhoa"]) ? $maKhoa=trim($_POST["maKhoa"]):	$maKhoa= '';	
	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= '';	
	
	//////////////////////////////////
	if (isset($_POST["btn_them"])) {					
			$address = "QuanTri_BoMon";
			ThemBoMon($conn, $address, $tenBm, $maKhoa);		
	}	
	
	if (isset($_POST["btn_xoa"])) {		  								
			$maBm = $_POST["btn_xoa"];	
			$address = "QuanTri_BoMon";
			XoaBoMon($conn, $address, $maBm);
	}	
	
	if (isset($_POST["btn_sua"])) {		  								
			if(!isset($_POST["chon"]))
			{
				thongBao("Bạn phải chọn lớp cần sửa thông tin trong bảng bên dưới trước khi ra lệnh chỉnh sửa!"); 
			
			}
			else
			{
				$ma_old = $_POST["chon"];
				$address = "QuanTri_BoMon";							
				Sua($conn, $address, $ma_old, $tenBm, $maKhoa);
			}	
	}	
	
	if (isset($_POST["chon"])) {					
		$chon = $_POST["chon"];		
		$sql_chon = "SELECT * ".
				 	" FROM bomon ".
					" where maBm = '".$chon."'";
		$query_chon = mysqli_query($conn,$sql_chon);
		$data_chon = mysqli_fetch_array($query_chon);	
		$tenBm	= $data_chon["tenBm"];
		$maKhoa= $data_chon["maKhoa"];	
	}	
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
		<div>
	    <form name="form1" method="POST" action="index.php?f=QuanTri_BoMon">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1"> THÊM BỘ MÔN </h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
					  <tr>
                        <td height="35" width="100"> Tên bộ môn: </td>
                        <td ><input type="text" name="tenBm" size="20"  value="<?php echo $tenBm; ?>"> </td>						
                      </tr>                    
                      <tr>
                        <td height="35"> Khoa/Đơn vị: </td>
						<td >
						<select name="maKhoa" >
							<?php								
								$sql4 ="SELECT * FROM khoa ";
								$query4 = mysqli_query($conn,$sql4);
								while ($data4 = mysqli_fetch_array($query4)) { 
									if($maKhoa==$data4["maKhoa"]) 											
									{  ?>
										<option value='<?php echo $data4["maKhoa"]; ?>' selected="selected"><?php echo $data4["tenKhoa"]; ?></option>
									<?php } else {?>
										<option value='<?php echo $data4["maKhoa"]; ?>' ><?php echo $data4["tenKhoa"]; ?></option>	
								<?php }	}?>
						  </select>		
						</td>                       
                      </tr>                      
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                        <td colspan="3" height="55">		
							<input  type="submit" value="TÌM KIẾM" name="btn_tim"> 
							<input  type="submit" value="THÊM BỘ MÔN" name="btn_them">     													
							<input  type="submit" value="CHỈNH SỬA" name="btn_sua">    
						</td>
                      </tr>                  
                    </table>
			</center>		
			
			
			
    	    <table class="table"  >
          		<h3 class="style1"> Danh sách các bộ môn</h3>
	          	<thead>
					<tr >
					  <th width="20"> STT </th>
					  <th width="390"><center>Tên bộ môn</center></th>
					  <th width="400"><center>Khoa/Đơn vị</center></th>
					  <th width="70">&nbsp;  </th>
					</tr>
				  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;						
					$sql_hienThi = 	"SELECT * FROM bomon b, khoa c ".
									" where b.maKhoa = c.maKhoa ".
									"   and tenBm like '%".$tenBm."%'" .
									"   and b.maKhoa like '%".$maKhoa."%'".
									" ORDER BY b.maBm DESC ";
					$query = mysqli_query($conn,$sql_hienThi);
					while ($row = mysqli_fetch_array($query)) {						    
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td><?php echo $row["tenBm"]; ?></td>	
						  <td><?php echo $row["tenKhoa"]; ?></td>
						  <td>			
							  <?php
							  if($chon== $row["maBm"])  
							  {?>  	
									<input type="radio" name="chon" value='<?php echo $row["maBm"]; ?>' onClick="this.form.submit();" checked="checked">
								<?php } 
							  else {	?>  	
									<input type="radio" name="chon" value='<?php echo $row["maBm"]; ?>' onClick="this.form.submit();">
							  <?php } ?>
										
								<input type="image" name="btn_xoa"  value="<?php echo  $row["maBm"];?>"src="img/delete.png" width="20" height="20">		
						  </td>
						</tr>					
			  <?php } ?>					
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