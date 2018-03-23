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
	require_once("lib/QuanTri_KhGd.php");	
	require_once("ViewAdmin/header.php");
	$now=getdate();
	$nh1=$now["year"];
	$sql="select max(sttKhoa) as khoa from chuongtrinhhoc";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
	
	//Lấy bộ môn
	$sql_maBm="select maBm from canbo where maCb='".$user['ms']."'";
	$query_maBm = mysqli_query($conn,$sql_maBm);
	$data_maBm = mysqli_fetch_array($query_maBm);
	
	$sql_Bm="select * from bomon where maBm='".$data_maBm['maBm']."'";
	$query_Bm = mysqli_query($conn,$sql_Bm);
	$data_Bm = mysqli_fetch_array($query_Bm);
	$maBm=$data_maBm['maBm'];
	
	
	isset($_POST["maNganh"])  ? $maNganh	=trim($_POST["maNganh"]) 	:	$maNganh= '';	
	isset($_POST["maMon"]) ? $maMon	=trim($_POST["maMon"]) :	$maMon= '';	
	isset($_POST["hk"]) 	? $hk 	=$_POST["hk"]  	:	$hk = '';	
	isset($_POST["sttKhoa"]) 	? $sttKhoa	 	=$_POST["sttKhoa"] 		:	$sttKhoa=$data["khoa"];	
	isset($_POST["he"]) 	? $he 	=$_POST["he"]  	:	$he = '1';	
	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= '';	
	
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
		
	
	//////////////////////////////////
	if (isset($_POST["btn_them"])) {					
			$address = "QuanTri_KhGd";
			ThemKhGd($conn, $address,$maNganh, $maMon,$he, $sttKhoa, $hk, $namHoc);		
	}	
	
	if (isset($_POST["btn_xoa"])) {	
			$chuoi=$_POST["btn_xoa"];	  								
			$ma =explode("+",$chuoi);//Tach ma Can bo va ma chuc vu ;	
			thongBao($ma[0]." ".$ma[1]." ".$ma[2]." ".$ma[3]." " .$ma[4]." ".$ma[5]);
			$address = "QuanTri_KhGd";
			XoaMon($conn, $address, $ma[0],$ma[1],$ma[2],$ma[3],$ma[4],$ma[5]);
			
	}	
	
	/*if (isset($_POST["btn_sua"])) {		  								
			if(!isset($_POST["chon"]))
			{
				thongBao("Bạn phải chọn lớp cần sửa thông tin trong bảng bên dưới trước khi ra lệnh chỉnh sửa!"); 
			
			}
			else
			{
				$ma_old = $_POST["chon"];
				$address = "QuanTri_Mon";							
				Sua($conn, $address, $ma_old, $maMon, $tenMon, $soTC, $LT, $TH);		
			}	
	}	
	
	if (isset($_POST["chon"])) {					
		$chon = $_POST["chon"];		
		$sql_chon = "SELECT * ".
				 	" FROM monhoc ".
					" where maMon = '".$chon."'";
		$query_chon = mysqli_query($conn,$sql_chon);
		$data_chon = mysqli_fetch_array($query_chon);	
		$maMon	= $data_chon["maMon"];
		$tenMon = $data_chon["tenMon"];	
		$soTC 	= $data_chon["soTc"];	
		$LT	 	= $data_chon["soTietLt"];	
		$TH 	= $data_chon["soTietTh"];							
	}*/
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action="index.php?f=QuanTri_KhGd">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1"> THÊM KẾ HOẠCH GIẢNG DẠY </h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
					  <tr>
                        <td height="35" width="140">Ngành: </td>
                        <td ><select name="maNganh" title="chọn mã ngành" >							 	
							<?php								
								$sql4 ="SELECT * FROM nganh where maBm='".$maBm."'";
								$query4 = mysqli_query($conn,$sql4);
								while ($data4 = mysqli_fetch_array($query4)) {
									  if($maNganh==$data4["maNganh"]) 											
									  {  ?>
										<option value='<?php echo $data4["maNganh"]; ?>' selected="selected"><?php echo $data4["tenNganh"]; ?></option>
									<?php 	} else {?>	
 										<option value='<?php echo $data4["maNganh"]; ?>' ><?php echo $data4["tenNganh"]; ?></option>
									<?php }	}?>
								
						  </select>	
						 </td>						
                      </tr>
					  <tr>
					  	<td height="35" width="140"> Hệ: </td>
                        <td ><select name="he" title="chọn hệ" >							 	
									<option value=1 selected="selected" >Cao đẳng</option>
									<option value=2 >trung cấp</option>
							 </select>						
					  </tr>					  
                      <tr>
                        <td height="35" width="140"> Học kỳ: </td>
                        <td ><select name="hk" >
								<option value=1 selected="selected" >1</option>
								<option value=2 >2</option>
							 </select>	
						 </td>						
                      </tr>
                      <tr>
                        <td height="35"> Năm học: </td>
						<td ><input type="text" name="namHoc" size="2"  onChange="this.form.submit()" value="<?php echo $namHoc; ?>"> - &nbsp;&nbsp;
							<input type="text" size="2" value="<?php echo ($namHoc+1); ?>" readonly="true">                 
						</td>                       
                      </tr>
                      <tr>
                        <td height="35"> Khóa: </td>
						<td ><input type="text" name="sttKhoa" size="1"  value="<?php echo $sttKhoa; ?>"> </td>                       
                      </tr>
					   <tr>
                        <td height="35"> Môn học: </td>
						<td ><select name="maMon" >							 	
							<?php								
								$sql4 ="SELECT * FROM monhoc order by tenMon";
								$query4 = mysqli_query($conn,$sql4);
								while ($data4 = mysqli_fetch_array($query4)) {
									  if($maNganh==$data4["maMon"]) 											
									  {  ?>
										<option value='<?php echo $data4["maMon"]; ?>' selected="selected"><?php echo $data4["tenMon"]."(".$data4["maMon"].")-".$data4["soTc"]." tín chỉ"; ?>								
										</option>
									<?php 	} else {?>	
 										<option value='<?php echo $data4["maMon"]; ?>' ><?php echo $data4["tenMon"]."(".$data4["maMon"].")-".$data4["soTc"]." tín chỉ"; ?>
										</option>
										
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
							<input  type="submit" value="THÊM MÔN HỌC" name="btn_them">     													
							<!--<input  type="submit" value="CHỈNH SỬA" name="btn_sua">    -->
						</td>
                      </tr>                  
                    </table>
			</center>		
			
			
			
    	    <table class="table"  >


	          	<thead>
					<tr >
					  <th width="20"> STT </th>
					  <th width="100"><center>Tên ngành</center></th>
 					  <th width="20"><center>Khóa</center></th>
				  	  <th width="10"><center>Học kì</center></th>
					  <th width="20"><center>Năm học</center></th>
					  <th width="130"><center>Tên môn</center></th>
  					  <th width="30"><center>Tín chỉ</center></th>
					  <th width="70">&nbsp;  </th>
					</tr>
				  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;	
					$tong=0;											 						 						 
					$sql_hienThi = 	"SELECT * FROM chuongtrinhhoc cth, monhoc mh, nganh n ".
									" Where cth.maNganh like '%".$maNganh."%'" .
									 "	 and cth.he = '".$he."'" .
									 "	 and sttKhoa like '%".$sttKhoa."%'" .						 
									 "	 and hocKi = '".$hk."'" .						 
									 "	 and namHoc like '%".$namHoc."%'".
									 "	 and cth.maMon=mh.maMon".
									 "	 and cth.maNganh=n.maNganh".
									" ORDER BY cth.namHoc, cth.hocKi ASC ";
					
									
					$query = mysqli_query($conn,$sql_hienThi);
					while ($row = mysqli_fetch_array($query)) {						    
						$tong+=$row["soTc"];
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td><?php echo $row["tenNganh"]; ?></td>	
						  <td><center><?php echo $row["sttKhoa"]; ?></center></td>	
						  <td><center><?php echo $row["hocKi"]; ?></center></td>	
						  <td><center><?php echo $row["namHoc"]; ?></center></td>
						  <td><?php echo $row["tenMon"]; ?></td>			
  						  <td><center><?php echo $row["soTc"]; ?></center></td>			
						  <td>	<center>					
							  
							  <?php
							  	$chuoi=$row["maNganh"]."+".$row["maMon"]."+".$row["he"]."+".$row["sttKhoa"]."+".$row["hocKi"]."+".$row["namHoc"];
							 ?>

							 <input type="image" name="btn_xoa"  value="<?php echo  $chuoi;?>"src="img/delete.png" width="20" height="20">		
						  </center></td>
						</tr>					
			  <?php }  ?>	
			  <tr>
			  	<td colspan="6" align="center"> Tổng số</td>
				<td><?php echo $tong?> </td>
			  </tr>				
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