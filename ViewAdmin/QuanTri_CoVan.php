<?php	

	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php');	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Website Trưởng bộ môn </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="ViewAdmin/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

   	<style type="text/css">
		.style1 {
			color: #333;
		}
	</style>
	
	<SCRIPT LANGUAGE="JavaScript">
      function confirmAction() {
        return confirm("Bạn có chắc xóa không?")
      }
 
</SCRIPT>
	
</head>
<body>
 <div class="wrapper" style="background-color:#FFFFFF"> 
<?php
	require_once("ViewAdmin/header.php");
	require_once("lib/QuanTri_CoVan.php");	
	
	
		
	
	
	//////////////////////////////////
	if (isset($_POST["namHoc"])) {		
		if( $_POST["namHoc"]=='')
		{		
			$now = getdate();
			$namHoc =  $now["year"]-1; 	
		}	
		else if( !is_numeric($_POST["namHoc"]))
			thongBao("Vui lòng nhập năm học là một số");
		else if( $_POST["namHoc"]<2010 & $_POST["namHoc"]>2050)
			thongBao("Vui lòng nhập năm học là một số hợp lệ");
		else
			$namHoc =	$_POST["namHoc"];			
	}		
	else
		{		
			$now = getdate();
			$namHoc =  $now["year"]-1; 	
			
		}	
	
	///Lấy khóa lớn nhất
	$sql="select max(sttKhoa) as khoa from lop";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
	$khoa_max=$data["khoa"];
	$khoa_max1=$khoa_max-1;
	$khoa_max2=$khoa_max-2;
	
	
	/////Lay maBm
		$sql_bm="select maBm from canbo where maCb='".$user['ms']."'";
		$query_bm = mysqli_query($conn,$sql_bm);
		$data_bm = mysqli_fetch_array($query_bm);
		$maBm=$data_bm["maBm"];
	
	isset($_POST["maLop"]) 	? $maLop=trim($_POST["maLop"])	:	$maLop='';	
	
	
	
	isset($_POST["maCb"])  ? $maCb	=trim($_POST["maCb"]) 	:	$maCb= '';	

	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= 0;	

	
	//////////////////////////////////
	if (isset($_POST["btn_them"])) {			
			
			$address = "QuanTri_CoVan";
			thongbao($address);
			ThemCv($conn, $address, $maCb, $maLop,$namHoc);		
	}	
	
	if (isset($_POST["btn_xoa"])) {		  								
			$chuoiXoa = $_POST["btn_xoa"];
			$maCb=explode("+",$chuoiXoa);//Tach ma Can bo va ma chuc vu
			$address = "QuanTri_CoVan";
			//thongBao("Ban muon xoa".$maCb[0]."-".$maCb[1]." ".$namHoc."đung kho?");
			
			XoaCvGv($conn, $address, $maCb[0],$maCb[1],$namHoc);
			
	}	
	
	if (isset($_POST["btn_sua"])) {		  								
			if(!isset($_POST["chon"]))
			{
				thongBao("Bạn phải chọn lớp cần sửa thông tin trong bảng bên dưới trước khi ra lệnh chỉnh sửa!"); 
			
			}
			else
			{
				$chon = $_POST["chon"];	
				$maCbCv=explode("+",$chon);//Tach ma Can bo va ma chuc vu	
				
				$ma_Cbold = $maCbCv[0];
				$ma_Cvold = $maCbCv[1];
				$address = "QuanTri_CoVan";							
				Sua($conn, $address, $ma_Cbold, $ma_Cvold, $maCb, $maCv);		
			}	
	}	
	
	
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action="index.php?f=QuanTri_CoVan">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1">PHÂN CÔNG CỐ VẤN HỌC TẬP/GVCN </font> &nbsp;&nbsp;	Năm học: 
							<input type="text" name="namHoc" size="4"  onChange="this.form.submit()" value="<?php echo $namHoc; ?>"> - &nbsp;&nbsp;
							<input type="text" size="4" value="<?php echo ($namHoc+1); ?>" readonly="true">

			
			</h3>

			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="846" border="1" >
					  <tr>
					    <td height="35" width="136"> Lớp thuộc bộ môn: </td>
                       <td width="249">        
							<select name="maLop" >
							<option value=''>chọn lớp</option>
                            <?php														
									if($maLop!= '')
									{								
										$sql7 = "SELECT * FROM lop ".
												" WHERE maLop= '".$maLop."'";												
										$query7 = mysqli_query($conn,$sql7);
										$data7 = mysqli_fetch_array($query7);									
									 ?>
							

                            <?php } 	
										$sql8 = "SELECT * FROM lop ".
												" WHERE maLop!= '".$maLop."'".
												" and (sttKhoa= '".$khoa_max."'".
												" or sttKhoa= '".$khoa_max1."'".
												" or sttKhoa= '".$khoa_max2."')".
												" and maNganh in (select maNganh from nganh n".
												" where n.maBm='".$maBm."')".
												" and maLop not in (select maLop from cvht".
												" where namHoc='".$namHoc."')".
												" order by sttKhoa desc";
												
												
											
										$query8 = mysqli_query($conn,$sql8);
										while ($data8 = mysqli_fetch_array($query8)) {
									  ?>
                            <option value='<?php echo $data8["maLop"]; ?>'><?php echo $data8["tenLop"]." - K".$data8["sttKhoa"]; ?></option>
                            <?php } ?>
                          </select>
<!--                        <span class="tim"> (Tìm <input type="text" name="tim_lop" size="15"  onChange="this.form.submit()" value="<?php echo $tim_lop; ?>"> ) </span>-->
						
						<a href="index.php?f=QuanTri_CoVan_Lop"> <img src="img/dt.png" alt="Ko co hình" width="20" height="20" title="Tìm tất cả các lớp" /> </a>
						</td>   					
                        <td height="35" width="141">	
						<?php if ($chon==0) echo "Cán bộ chưa cố vấn"; else echo "Cán bộ đã cố vấn";?>	
						<td width="202" >
						<select name="maCb" >	
							<?php 
								if ($chon==0){
								$sql1="select maCb, CONCAT(hoCb,' ',tenCb) as 'ten' from canbo ".
									" where maBm='".$maBm."'".
									" and maCb not in (select maCb from cvht ".
									" where namHoc='".$namHoc."')";
								
								$query1= mysqli_query($conn,$sql1);
								while ($data1 = mysqli_fetch_array($query1)) {
								if($maCb==$data1["maCb"]) 											
									{  ?>
											<option value='<?php echo $data1["maCb"]; ?>' selected="selected"><?php echo $data1["ten"];  ?></option>
									 <?php }	else { ?>
											<option value='<?php echo $data1["maCb"]; ?>'><?php echo $data1["ten"]; ?></option>
									<?php   }	
							   }}
							   else {
							   	$sql1="select maCb, CONCAT(hoCb,' ',tenCb) as 'ten' from canbo ".
									" where maBm='".$maBm."'".
									" and maCb in (select maCb from cvht ".
									" where namHoc='".$namHoc."')";
								
								$query1= mysqli_query($conn,$sql1);
								while ($data1 = mysqli_fetch_array($query1)) {
								if($maCb==$data1["maCb"]) 											
									{  ?>
											<option value='<?php echo $data1["maCb"]; ?>' selected="selected"><?php echo $data1["ten"];  ?></option>
									 <?php }	else { ?>
											<option value='<?php echo $data1["maCb"]; ?>'><?php echo $data1["ten"]; ?></option>
									<?php   }	
							   }
							   }
							   ?>
					    </select>	 </td>
					    <td width="84" height="44" colspan="3"><input class="btn btn-custom"  type="submit" value="PHÂN CÔNG" name="btn_them"></td>							
					  <tr>
						  	<td></td>
							<td></td>
						     <td><input type="radio" name="chon" value='0' onClick="this.form.submit(); " > Chưa cố vấn<br /></td>
							<td><input type="radio" name="chon" value='1' onClick="this.form.submit(); "> Đã cố vấn<br /></td>
							

					  </tr>
						
						</tr>
                     
                      
					 
              </table>
			</center>		
			
			
			
    	    <table class="table table-hover"  >

	          	<thead>
					<tr >
					  <th width="20"> STT </th>
					  <th width="100"><center>Tên lớp</center></th>
 					  <th width="320"><center>Tên Cán bộ cố vấn</center></th>
					  <th width="70">&nbsp;  </th>
					</tr>
				  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;		
					$sql_hienThi="select a.maCb,CONCAT(hoCb,' ',tenCb) as 'ten', tenLop, b.maLop, sttKhoa from canbo a,cvht b, lop c".
					" where a.maCb=b.maCb and b.maLop=c.maLop".
					" and a.maBm='".$maBm."'".
					" and namHoc='".$namHoc."'".
					"order by sttKhoa desc";							 						 						 
					$query3 = mysqli_query($conn,$sql_hienThi);
					while ($row3 = mysqli_fetch_array($query3)) {						    
							$chuoi=$row3["maCb"]."+".$row3["maLop"];//Noi chuoi de lay ma can bo va ma chuc vu
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td><?php echo $row3["tenLop"]." K-".$row3["sttKhoa"]; ?></td>	
						  <td><?php echo $row3["ten"]; ?></td>	

						  <td>						
							  
							<input type="image" name="btn_xoa" onClick="return confirmAction()" value="<?php echo $chuoi;?>"src="img/delete.png" width="20" height="20">		
							 
						  </td>
						</tr>					
			  <?php }  ?>					
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