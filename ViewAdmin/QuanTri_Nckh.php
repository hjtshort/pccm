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
	require_once("lib/QuanTri_Nckh.php");	
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
	
	
	
	
	
	isset($_POST["maCb"])  ? $maCb	=trim($_POST["maCb"]) 	:	$maCb= '';	

	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= 0;	

	isset($_POST["soTiet"]) 	? $soTiet=trim($_POST["soTiet"])	:	$soTiet=104;		
	//////////////////////////////////
	if (isset($_POST["btn_them"])) {					

			$address = "QuanTri_Nckh";
			Them($conn, $address, $maCb, $namHoc, $soTiet);		
	}	
	

	if (isset($_POST["btn_xoa"])) {		  								
			$chuoiXoa = $_POST["btn_xoa"];
			$maCb=$chuoiXoa;
			$address = "QuanTri";
			//thongBao("Ban muon xoa".$maCb[0]."đung kho?");
			Xoa($conn, $address, $maCb,$namHoc);
			
	}	
	
	if (isset($_POST["btn_sua"])) {		  								
			if(!isset($_POST["chon"]))
			{
				thongBao("Bạn phải chọn cán bộ cần sửa số tiết trong bảng bên dưới trước khi ra lệnh chỉnh sửa!"); 
			
			}
			else
			{
				$chon = $_POST["chon"];	
				$maCb=$chon;
							
				$address = "QuanTri_Nckh";							
				Sua($conn, $address, $maCb, $namHoc, $soTiet);		
			}	
	}	
	
	
	if (isset($_POST["chon"])) {					
		$chon = $_POST["chon"];		
		$sql_chon = "SELECT * ".
				 	" FROM nckh ".
					" where maCb = '".$chon."'".
					" and namHoc='".$namHoc."'";
		$query_chon = mysqli_query($conn,$sql_chon);
		$data_chon = mysqli_fetch_array($query_chon);	
		$maCb	= $data_chon["maCb"];
		$soTiet= $data_chon["soTiet"];	

	}	
	
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action="index.php?f=QuanTri_Nckh">
	 	<div class="container">
      		<div class="row">
      		  <h3 class="style1">GHI NHẬN CÁN BỘ  NGHIÊN CỨU KHOA HỌC &nbsp;&nbsp;	Năm học: 
							<input type="text" name="namHoc" size="2"  onChange="this.form.submit()" value="<?php echo $namHoc; ?>"> - &nbsp;&nbsp;
							<input type="text" size="2" value="<?php echo ($namHoc+1); ?>" readonly="true">
			</h3>

			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
					  <tr>
					    <td height="35" width="171"> Cán bộ bộ môn: </td>
                       <td width="261">        
							<select name="maCb" >	
							<?php
							 
								$sql1="select maCb, CONCAT(hoCb,' ',tenCb) as 'ten' from canbo ".
									" where maBm='".$maBm."'";
//									" and maCb not in (select maCb from nckh where namHoc='".$namHoc."')";
								
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
						  </select>	 
					    </td>
						 <td width="346">Số tiết</td> <td width="171"> <input type="text" name="soTiet" size="2"  value=<?php echo $soTiet;?> > </td>
					  </tr>
						 <tr>
					     
                        <td height="10" colspan="5"> <input class="btn btn-custom"  type="submit" value="Ghi nhận" name="btn_them">
						<input  class="btn btn-custom" type="submit" value="CHỈNH SỬA" name="btn_sua" />
						</td>						 
					  </tr>
                      <tr>
                        <td colspan="3" height="30"></td>
                      </tr>                  
                    </table>
			</center>		
			
			
			
    	    <table class="table"  >

	          	<thead>
					<tr >
					  <th width="20"> STT </th>
					  <th width="320"><center>Tên Cán bộ</center></th>
						 <th width="68"><center>
 						    Số tiết
 					  </center></th>
					  <th width="70">&nbsp;  </th>
					</tr>
			  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;		
					$sql_hienThi="select a.maCb,CONCAT(hoCb,' ',tenCb) as 'ten', soTiet from canbo a,nckh b".
					" where a.maCb=b.maCb ".
					" and namHoc='".$namHoc."'".
					" and a.maBm='".$maBm."'".
					"order by a.maCb desc";							 						 						 
					$query3 = mysqli_query($conn,$sql_hienThi);
					while ($row3 = mysqli_fetch_array($query3)) {						    
							
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td><?php echo $row3["ten"]; ?></td>	
							<td><?php echo $row3["soTiet"]; ?></td>	

						  <td><center>						
							   <?php
							  if($chon== $row3["maCb"])  
							  {?>  	
									<input type="radio" name="chon" value='<?php echo $row3["maCb"]; ?>' onClick="this.form.submit();" checked="checked">
								<?php } 
							  else {	?>  	
									<input type="radio" name="chon" value='<?php echo $row3["maCb"]; ?>' onClick="this.form.submit();">
							  <?php } ?>
							<input type="image" name="btn_xoa" onClick="return confirmAction()" value="<?php echo $row3["maCb"];?>"src="img/delete.png" width="20" height="20">		
							 </center>
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