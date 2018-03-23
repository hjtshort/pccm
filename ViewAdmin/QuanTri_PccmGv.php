<?php	
	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php')	;	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Website Trưởng bộ môn-Phân công chuyên môn </title>
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
	require_once("lib/QuanTri_Pccm.php");	
	require_once("ViewAdmin/header.php");
	$now=getdate();
	$nh1=$now["year"];
	$sql="select max(sttKhoa) as khoa from chuongtrinhhoc";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
	
	
	
	
	isset($_POST["maCb"])  ? $maCb	=trim($_POST["maCb"]) 	:	$maCb= '';	
	//isset($_POST["namHoc"])  ? $namHoc	=trim($_POST["maCb"]) 	:	$namHoc= '';	
	//isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= '';	
	 	if (isset($_POST["namHoc"])) 
		 	$namHoc	=trim($_POST["namHoc"]);
	else if (isset($_SESSION['namHoc'])) 
		$namHoc	= $_SESSION['namHoc'];
	else		
		$namHoc	=  '';
	//thongBao($namHoc);
	thongBao($_SESSION['namHoc']);
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
			$address = "QuanTri_pccmGv";
			$maCb_dangPc=$maCb;
			
			header('Location: index.php?f='.$address);	
			exit;
			//ThemKhGd($conn, $address,$maNganh, $maMon,$he, $sttKhoa, $hk, $namHoc);		
	}	
	
	if (isset($_POST["btn_xoa"])) {	
			$chuoi=$_POST["btn_xoa"];	  								
			$ma =explode("+",$chuoi);//Tach các cot
			
			$address = "QuanTri_Pccm";
			XoaPccm($conn, $address, $ma[0],$ma[1],$ma[2],$ma[3],$ma[4]);
			
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
	     <form name="form1" method="POST" action="index.phpf=QuanTri_PccmGv&namHoc=<?php echo $namHoc; ?>">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1">Phân công chuyên môn </h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
					 <tr>
                        <td height="35"> Năm học: </td>
						<td ><input type="text" name="namHoc" size="2"  onChange="this.form.submit()" value="<?php echo $namHoc; ?>"> - &nbsp;&nbsp;
							<input type="text" size="2" value="<?php echo ($namHoc+1); ?>" readonly="true">                 
						</td>                       
                      </tr>
					 <tr>
                        <td height="35" width="140"> Cán bộ: </td>
						<td >
						<select name="maCb" >	
							<?php 
								$sql="select maBm from canbo where maCb='".$user['ms']."'";
								$query = mysqli_query($conn,$sql);
								$data = mysqli_fetch_array($query);
								$sql1="select maCb, CONCAT(hoCb,' ',tenCb) as 'ten' from canbo where maBm='".$data['maBm']."'";
								$query1= mysqli_query($conn,$sql1);
								while ($data1 = mysqli_fetch_array($query1)) {
								if($maCb==$data1["maCb"]) 											
									{  ?>
											<option value='<?php echo $data1["maCb"]; ?>' selected="selected"><?php echo $data1["ten"];  ?></option>
									 <?php }	else { ?>
											<option value='<?php echo $data1["maCb"]; ?>'><?php echo $data1["ten"]; ?></option>
									<?php   }	
							   }?>
						  </select>		
						</tr>
					 
                     
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                        <td colspan="3" height="55">		
							<input  type="submit" value="TÌM KIẾM" name="btn_tim"> 
							<input  type="submit" value="THÊM PHÂN CÔNG" name="btn_them">     													
							<!--<input  type="submit" value="CHỈNH SỬA" name="btn_sua">    -->
						</td>
                      </tr>                  
                    </table>
			</center>		
			
			
			
    	    <table class="table" border="1"  >
          		<h3 class="style1"> Danh sách các môn học đã phân công   </h3>

	          	<thead>
					<tr >
					  <th width="10"  align="center" valign="middle"> STT </th>
					  <th width="50"  ><center>Lớp</center></th>
 					  <th width="10"  ><center>Số lượng</center></th>
				  	  <th width="30"  ><center>Môn học</center></th>
					  <th width="10"  ><center>Tín chỉ</center></th>
					  <th width="20" colspan="2"  ><center>Số tiết</center></th>
					  <th width="20" colspan="2"  ><center>Số tiết thực dạy</center></th>
					  <th width="20"   ><center>NCKH</center></th>				  
  					  <th width="20"  ><center>CVHT</center></th>				  
					  <th width="20"   ><center>Đoàn thể</center></th>				  
  					  <th width="20"  ><center>Chức vụ</center></th>				  
 					  <th width="20"   ><center>Hoạt động khác</center>  </th>				  
   					  <th width="20"   ><center>Tổng qui đổi</center></th>				  
   					  <th width="20"   ><center>Ghi chú</center></th>				  
					  <th width="30">&nbsp;  </th>
					</tr>
					<tr >
						<th width="10">&nbsp;  </th>
						<th width="50">&nbsp;  </th>
						<th width="10">&nbsp;  </th>
						<th width="30">&nbsp;  </th>
						<th width="10">&nbsp;  </th>
						<th width="20"><center> HK 1</center></th>
						<th width="20"><center> HK 2</center></th>
						<th width="20"><center> LT</center></th>
						<th width="20"><center> TH</center></th>					
						<th width="20">&nbsp;  </th>
						<th width="20">&nbsp;  </th>
						<th width="20">&nbsp;  </th>
						<th width="20">&nbsp;  </th>
						<th width="20">&nbsp;  </th>
						<th width="20">&nbsp;  </th>
						<th width="20">&nbsp;  </th>
						<th width="30">&nbsp;  </th>
					</tr>
			  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;	
					$tong=0;											 						 						 
/*					$sql_hienThi = 	"SELECT * FROM chuongtrinhhoc cth, monhoc mh, nganh n ".
									" Where cth.maNganh like '%".$maNganh."%'" .
									 "	 and cth.he = '".$he."'" .
									 "	 and sttKhoa like '%".$sttKhoa."%'" .						 
									 "	 and hocKi = '".$hk."'" .						 
									 "	 and namHoc like '%".$namHoc."%'".
									 "	 and cth.maMon=mh.maMon".
									 "	 and cth.maNganh=n.maNganh".
									" ORDER BY cth.namHoc, cth.hocKi ASC ";*/
									
					$sql_hienThi= "SELECT * FROM pcday d, lop l, monhoc mh".
								" where d.maLop=l.malop".
								" and d.maCb='".$maCb."'".
								" and d.maMon=mh.maMon";
									
					$sql_hienThi1="SELECT * FROM nckh nc".
								" where nc.maCb='".$maCb."'".
								"and nc.namHoc='".$namHoc."'";			
								
					$query1 = mysqli_query($conn,$sql_hienThi1);
					$num_rows = mysqli_num_rows($query1);	
					$nc=0;				
					if ($num_rows>0) $nc=1;//có nckh thì bật biến nc=1
					
					
					/////Tap bai giang
					$sql_hienThi2="SELECT * FROM tapbaigiang tbg".
								" where tbg.maCb='".$maCb."'".
								"and tbg.namHoc='".$namHoc."'";			
								
					$query2 = mysqli_query($conn,$sql_hienThi2);
					$num_rows2 = mysqli_num_rows($query2);	
					$tbg=0;				
					if ($num_rows2>0) $tbg=1;//có nckh thì bật biến nc=1
					
									
					$query = mysqli_query($conn,$sql_hienThi);
					while ($row = mysqli_fetch_array($query)) {		
						
						//$tong+=$row["soTc"];
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td width="30"><?php echo $row["tenLop"]; ?></td>	
						  <td><?php echo $row["siSo"]; ?></td>	
						  <td width="50"><?php echo $row["tenMon"]; ?></td>	
  						  <td><?php echo $row["soTc"]; ?></td>	
						  <td><?php if ($row["hocKi"]==1) echo $row["soTietLt"]+$row["soTietTh"]; else echo " "; ?></td>	
						  <td><?php if ($row["hocKi"]==2) echo $row["soTietLt"]+$row["soTietTh"]; else echo " "; ?></td>	
					  	  <td><?php  echo $row["soTietLt"]; ?></td>	
						  <td><?php  echo $row["soTietTh"]; ?></td>	
						  <td ><?php  if ($nc==1){
						  							echo "NCKH"."<br>" ;
													$nc=0;//Để không in những dòng sau
						  						}
									if ($tbg==1){
						  							echo "TBG";
													$tbg=0;//Để không in những dòng sau
						  						}			
												
												 ?></td>	
						  <td><?php echo " " ?></td>
						  <td><?php  echo ""; ?></td>			
  						  <td><?php "" ?></td>			
   						  <td><?php "" ?></td>	
						  <td><?php //////Tổng qui đổi, nếu trung cấp hệ =2, cao đẳng hệ =1
						  		$tongtam=0;
						  		if ($row["he"]==2) echo $tongtam=($row["soTietLt"]+$row["soTietTh"])*0.7;
								else {
										if ($row["siSo"]<=50)echo $tongtam=($row["soTietLt"]+$row["soTietTh"]);
										else if ($row["siSo"]<=80)
											echo $tongtam=($row["soTietLt"]+$row["soTietTh"])*1.1;												
										else 	echo $tongtam=($row["soTietLt"]+$row["soTietTh"])*1.2;
									}	
								$tong+=$tongtam;	
						  
						  
						   ?></td>			
						    <td><?php "" //Cot ghi chu?></td>	
						  <td>						
							  
							  <?php
							  	$chuoi=$row["maCb"]."+".$row["maLop"]."+".$row["maMon"]."+".$row["hocKi"]."+".$row["namHoc"];
							 ?>

							 <input type="image" name="btn_xoa"  value="<?php echo  $chuoi;?>"src="img/delete.png" width="20" height="20">		
						  </td>
						</tr>					
			  <?php }  ?>	
			  <tr>
			  	<td colspan="14" align="center"> Tổng số</td>
				<td><?php echo $tong?> </td>
				<td> </td>
				<td></td>
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