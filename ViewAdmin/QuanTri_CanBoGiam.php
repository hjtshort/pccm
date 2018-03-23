<?php	
	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php')	;	
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
			color: #0000CC;
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
	require_once("lib/QuanTri_CanBoGiam.php");	
	require_once("ViewAdmin/header.php");
	
		
	
	
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
	$sql="select max(sttKhoa) as khoa from chuongtrinhhoc";
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
	
	isset($_POST["maDt"]) 	? $maDt=trim($_POST["maDt"])	:	$maDt='';	
	
	
	
	isset($_POST["maCb"])  ? $maCb	=trim($_POST["maCb"]) 	:	$maCb= '';	

	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= 0;	

	
	//////////////////////////////////
	if (isset($_POST["btn_them"])) {					
			$address = "QuanTri_CanBoGiam";
			ThemCbG($conn, $address, $maCb, $maDt,$namHoc);		
	}	
	
	if (isset($_POST["btn_xoa"])) {		  								
			$chuoiXoa = $_POST["btn_xoa"];
			$maCb=explode("+",$chuoiXoa);//Tach ma Can bo va ma chuc vu
			$address = "QuanTri_CanBoGiam";
			//thongBao("Ban muon xoa".$maCb[0]."đung kho?");
			XoaCbG($conn, $address, $maCb[0],$maCb[1],$namHoc);
			
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
				
				$maCb = $maCbCv[0];

				$address = "QuanTri_CanBoGiam";							
				Sua($conn, $address, $maCb, $maDt,$namHoc);		
			}	
	}	
	
	
	if (isset($_POST["chon"])) {					
		$chon = $_POST["chon"];	
		$maCbCv=explode("+",$chon);//Tach ma Can bo va ma chuc vu	
		//$sql_chon = "SELECT * ".
			//	 	" FROM canbo".
				//	" where maCb = '".$maCb[0]."'";
		//$query_chon = mysqli_query($conn,$sql_chon);
		//$data_chon = mysqli_fetch_array($query_chon);	
		//$maCb	= $data_chon["maCb"];
		$maCb=$maCbCv[0];
//		$sql_chon1 = "SELECT * ".
	//			 	" FROM chucvu".
		//			" where maCv = '".$maCb[1]."'";
		//$query_chon1 = mysqli_query($conn,$sql_chon1);
		//$data_chon1 = mysqli_fetch_array($query_chon1);	

		$maDt = $maCbCv[1];
	}
	
	
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action="index.php?f=QuanTri_CanBoGiam">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1">CÁN BỘ THUỘC ĐỐI TƯỢNG GIẢM </font> &nbsp;&nbsp;	Năm học: 
							<input type="text" name="namHoc" size="2"  onChange="this.form.submit()" value="<?php echo $namHoc; ?>"> - &nbsp;&nbsp;
							<input type="text" size="2" value="<?php echo ($namHoc+1); ?>" readonly="true">

			
			</h3>

			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
					  <tr>
					    <td height="35" width="120"> Cán bộ bộ môn: </td>
                       <td width="202">        
							<select name="maCb" >	
							<?php
							 
								$sql1="select maCb, CONCAT(hoCb,' ',tenCb) as 'ten' from canbo ".
									" where maBm='".$maBm."'";
								
								$query1= mysqli_query($conn,$sql1);
								while ($data1 = mysqli_fetch_array($query1)) {
								if($maCb==$data1["maCb"]) 											
									{  ?>
											<option value='<?php echo $data1["maCb"]; ?>' selected="selected"><?php echo $data1["ten"];  ?></option>
									 <?php }	else { ?>
											<option value='<?php echo $data1["maCb"]; ?>'><?php echo $data1["ten"]; ?></option>
									<?php   }	
							   }
							   
							   ?>
						  </select>					    </td>   					
                         <td height="35" width="120"> Đối tượng giảm: </td>
                       <td width="202">        
							<select name="maDt" >	
							<?php
							 
								$sql1="select * from doituonggiam ";

								
								$query1= mysqli_query($conn,$sql1);
								while ($data1 = mysqli_fetch_array($query1)) {
								if($maDt==$data1["maDt"]) 											
									{  ?>
										<option value='<?php echo $data1["maDt"]; ?>' selected="selected"><?php echo $data1["tenDt"]."-".$data1["soTietGiam"]." t";  ?></option>
									 <?php }	else { ?>
											<option value='<?php echo $data1["maDt"]; ?>'><?php echo $data1["tenDt"]."-".$data1["soTietGiam"]." t"; ?></option>
									<?php   }	
							   }
							   
							   ?>
						  </select>	
						    <a href="index.php?f=QuanTri_DoiTuongGiam"> <img src="img/add_2.png"  width="20" height="20" title="Thêm đối tượng giảm" /> </a>
						  
						     </td>   	
					  
						
						</tr>
                     
                      
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                        <td colspan="3" height="55"><input  type="submit" value="GHI NHẬN" name="btn_them">
							                        <input  type="submit" value="CHỈNH SỬA" name="btn_sua" /></td>
                      </tr>                  
                    </table>
			</center>		
			
			
			
    	   <table class="table"  >
          		<h3 class="style1"> Danh sách CÁN BỘ THUỘC ĐỐI TƯỢNG GIẢM</h3>
	          	<thead>
					<tr >
					  <th width="33"> STT </th>
					  <th width="255"><center>Tên Cán bộ</center></th>
  					  <th width="285"><center>Tên Đối tượng giảm</center></th>
 					  <th width="138"><center>Số tiết được giảm</center></th>
					  <th width="131">&nbsp;  </th>
					</tr>
			  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;		
					$sql_hienThi="select * from canbogiam c, canbo a, doituonggiam b".
					" where c.namHoc='".$namHoc."'".
					" and c.maCb=a.maCb ".
					" and b.maDt=c.maDt ";


					$query3 = mysqli_query($conn,$sql_hienThi);
					while ($row3 = mysqli_fetch_array($query3)) {						    
							$chuoi=$row3["maCb"]."+".$row3["maDt"];
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td><?php echo $row3["hoCb"]." ".$row3["tenCb"]; ?></td>	
						  <td><?php echo $row3["tenDt"]; ?></td>	
						  <td><?php echo $row3["soTietGiam"]; ?></td>	

						  <td>						
							   <?php
							    
							  if($chon== $chuoi)  
							  {?>  	
									<input type="radio" name="chon" value='<?php echo $chuoi; ?>' onClick="this.form.submit();" checked="checked">
								<?php } 
							  else {	?>  	
									<input type="radio" name="chon" value='<?php echo $chuoi; ?>' onClick="this.form.submit();">
							  <?php }

							   ?>
							<input type="image" name="btn_xoa" onClick="return confirmAction()"  value="<?php echo $chuoi;?>"src="img/delete.png" width="20" height="20">		
							 
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