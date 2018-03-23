<?php	
	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php')	;	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Website Trưởngng bộ môn </title>
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
	require_once("lib/QuanTri_Lop.php");	
	require_once("ViewAdmin/header.php");
	
	
	$chuoi	= $_SESSION['idMau'];
	$ma =explode(" ",$chuoi);//Tach các cot
	$maCb=$ma[0]; 
	$namHoc=$ma[1];

	
		///Lấy ma khoa lớn nhất
	$sql_makhoa="select max(maKhoa) as maKhoa from khoa";
	$query_makhoa = mysqli_query($conn,$sql_makhoa);
	$data_makhoa = mysqli_fetch_array($query_makhoa);
	$maKhoa_max=$data_makhoa["maKhoa"];


	isset($_POST["maKhoa"]) ? $maKhoa=trim($_POST["maKhoa"])	:	$maKhoa= $maKhoa_max;
	
	///Lấy khóa lớn nhất
	$sql="select max(sttKhoa) as khoa from chuongtrinhhoc";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
	$khoa_max=$data["khoa"];
	$khoa_max1=$khoa_max-1;
	$khoa_max2=$khoa_max-2;
	
	
	isset($_POST["maLop"]) ? $maLop=trim($_POST["maLop"])	:	$maLop= '';
	isset($_POST["tenLop"]) ? $tenLop=trim($_POST["tenLop"]):	$tenLop= '';	
	isset($_POST["maNganh"])? $maNganh=trim($_POST["maNganh"]):	$maNganh = '';	
	isset($_POST["sttKhoa"])? $sttKhoa=trim($_POST["sttKhoa"]):	$sttKhoa ='';	
	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= '';	
	isset($_POST["he"])	? $he=trim($_POST["he"])	:	$he= '';	
	
	
	//////////////////////////////////
	if (isset($_POST["btn_them"])) {					
			$address = "QuanTri_Lop";
			ThemLop($conn, $address, $maLop,$tenLop, $maNganh, $sttKhoa,$he);		
	}	
	
	if (isset($_POST["btn_xoa"])) {		  								
			$maLop = $_POST["btn_xoa"];	
			$address = "QuanTri_Lop";
			XoaLop($conn, $address, $maLop);
	}	
	
	if (isset($_POST["btn_sua"])) {		  								
			if(!isset($_POST["chon"]))
			{
				thongBao("Bạn phải chọn lớp cần sửa thông tin trong bảng bên dưới trước khi ra lệnh chỉnh sửa!"); 
			
			}
			else
			{
				$ma_old = $_POST["chon"];
				$address = "QuanTri_Lop";							
				SuaLop($conn, $address, $ma_old, $maLop,$tenLop, $maNganh, $sttKhoa,$he);	
			}	
	}	
	
	
	if (isset($_POST["chon"])) {					
		$chon = $_POST["chon"];		
		$sql_chon = "SELECT * ".
				 	" FROM lop ".
					" where maLop = '".$chon."'";
		$query_chon = mysqli_query($conn,$sql_chon);
		$data_chon = mysqli_fetch_array($query_chon);
		$maLop 	= $data_chon["maLop"];
		$tenLop	= $data_chon["tenLop"];
		$maNganh= $data_chon["maNganh"];
		$sttKhoa= $data_chon["sttKhoa"];	
		$he=$data_chon["he"];
	}	
?>
	
 <div class="wrapper" style="background-color:#FFFFFF"> 
 <div>
		
	    <form name="form1" method="POST" action="index.php?f=QuanTri_Lop1&idMau=<?php echo $maCb." ".$namHoc;?>" >
	 	<div class="container">
      		<div class="row">	

			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >				
					 <tr>
 						<td>			<h3 class="style1"> TÌM LỚP HỌC THEO KHOA </h3></td>                      
                        <td >
						<select name="maKhoa"   onchange="this.form.submit();">							 	
							<?php								
								$sql_khoa ="SELECT * FROM khoa ";
								$query_khoa = mysqli_query($conn,$sql_khoa);
								while ($data_khoa = mysqli_fetch_array($query_khoa)) {
									    if($maKhoa==$data_khoa["maKhoa"]) 											
									  {  ?>
										<option value='<?php echo $data_khoa["maKhoa"]; ?>' selected="selected"><?php echo $data_khoa["tenKhoa"]; ?></option>
									<?php 	} else {?>	
 										<option value='<?php echo $data_khoa["maKhoa"]; ?>' ><?php echo $data_khoa["tenKhoa"]; ?></option>
									<?php }	}?>
								
						  </select>		
						</td>                       
						  
                      </tr>
                    
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                      
                      </tr>                
                    </table>
			</center>		
			
			
			
    	    <table class="table"  >
          		<h3 class="style1"> Danh sách các lớp học</h3>
	          	<thead>
					<tr >
					  <th width="33"> STT </th>
					  <th width="80"><center>Mã Lớp</center></th>
					  <th width="340"><center>Tên Lớp</center></th>
 					  <th width="60"><center>Khóa</center></th>
				  	  <th width="272"><center>Ngành</center></th>
					  <th width="98"><center>Hệ</center></th>

					</tr>
				  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;
/*					$sql_hienThi = 	"SELECT * FROM lop a, nganh b, bomon bm".
									" where bm.maKhoa= '".$maKhoa."'".
									"    and b.maBm = bm.maBm ". 
									" 	 and a.maNganh = b.maNganh ".
									" ORDER BY he,sttKhoa Desc ";*/
									
					$sql_hienThi=	"SELECT * FROM lop l ".
												" WHERE (sttKhoa= '".$khoa_max."'".
												" or sttKhoa= '".$khoa_max1."'".
												" or sttKhoa= '".$khoa_max2."')".
												" and maNganh in (select maNganh from nganh n".
												" where n.maBm in (select maBm from bomon where maKhoa='".$maKhoa."'))".
												" order by sttKhoa desc";				
					$query = mysqli_query($conn,$sql_hienThi);
					while ($row = mysqli_fetch_array($query)) {						    
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
					      <td><?php echo $row["maLop"];
						  		  $chuoi=$maCb." ".$namHoc." ".$row["maLop"];
						   ?></td>
						  <td>

							<a href="index.php?f=QuanTri_Pccm&idMau=<?php  echo $chuoi; ?>">
						  	<?php echo $row["tenLop"]; ?></a>						  
						  </td>	
						  <td><center><?php echo $row["sttKhoa"]; ?></center></td>	
						  <td><?php 
						  		$sql_tenNganh=	"SELECT tenNganh FROM nganh n ".
												" WHERE maNganh='".$row["maNganh"]."'";
			  					$query_tenNganh = mysqli_query($conn,$sql_tenNganh);
								$row_tenNganh = mysqli_fetch_array($query_tenNganh);
						  		echo $row_tenNganh["tenNganh"]; ?>
						  </td>	
  						  <td><?php 
						  			if ($row["he"]==1)	echo "Cao Đẳng";
									else echo "Trung cấp"	
									
								 ?></td>	
						
						</tr>					
			  <?php		}		  ?>					
			  </tbody>
			</table>	
      	</div>
 
    	</div>
		</form>	
</div>
</div>

	


	
	
<?php 	require_once("footer.php");?>
</div><!--end wrapper--> 
</body>
</html>