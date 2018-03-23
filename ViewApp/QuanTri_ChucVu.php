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
	
	<SCRIPT LANGUAGE="JavaScript">
      function confirmAction() {
        return confirm("Bạn có chắc xóa không?")
      }
 	</SCRIPT>
	
</head>
<body>
 <div class="wrapper" style="background-color:#FFFFFF"> 
<?php
	require_once("lib/QuanTri_ChucVu.php");	
	require_once("ViewApp/header.php");
	
	isset($_POST["maCb"])  ? $maCb	=trim($_POST["maCb"]) 	:	$maCb= '';	
	isset($_POST["maCv"]) ? $maCv	=trim($_POST["maCv"]) :	$maCv= '';	
	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= '';	
	
	//////////////////////////////////
	if (isset($_POST["btn_them"])) {					
			$address = "QuanTri_ChucVu";
			ThemCv($conn, $address, $maCb, $maCv);		
	}	
	
	if (isset($_POST["btn_xoa"])) {		  								
			$chuoiXoa = $_POST["btn_xoa"];
			$maCb=explode("+",$chuoiXoa);//Tach ma Can bo va ma chuc vu
			$address = "QuanTri_ChucVu";
			XoaCvGv($conn, $address, $maCb[0],$maCb[1]);
			//thongBao("Ban muon xoa".$maCb[0]."đung kho?");
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
				$address = "QuanTri_ChucVu";							
				Sua($conn, $address, $ma_Cbold, $ma_Cvold, $maCb, $maCv);		
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

		$maCv = $maCbCv[1];
	}
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action="index.php?f=QuanTri_ChucVu">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1"> THÊM CHỨC VỤ CÁN BỘ </h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
					  <tr>
                        <td height="35" width="140"> Cán bộ: </td>
						<td >
						<select name="maCb" >	
							<?php 
								$sql="select maBm from canbo where maCb='".$user['ms']."'";
								$query = mysqli_query($conn,$sql);
								$data = mysqli_fetch_array($query);
								$sql1="select maCb, CONCAT(hoCb,' ',tenCb) as 'ten' from canbo";
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
                        <td height="35" width="140"> Chức vụ: </td>
                        <td >
						<select name="maCv" >
							<?php
								$sql2="select * from chucvu";
								$query2 = mysqli_query($conn,$sql2);
								while ($data2 = mysqli_fetch_array($query2)) {
								if($maCv==$data2["maCv"]) 											
									{  ?>
											<option value='<?php echo $data2["maCv"]; ?>' selected="selected"><?php echo $data2["tenCv"];  ?></option>
									 <?php }	else { ?>
											<option value='<?php echo $data2["maCv"]; ?>'><?php echo $data2["tenCv"]; ?></option>
									<?php   }	
							   }?>

							?>
						
						</select>		
						
						 </td>						
                      </tr>
                      
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                        <td colspan="3" height="55">		
							<input  type="submit" value="TÌM KIẾM" name="btn_tim"> 
							<input  type="submit" value="THÊM CHỨC VỤ CÁN BỘ" name="btn_them">     													
							<input  type="submit" value="CHỈNH SỬA" name="btn_sua">    
						</td>
                      </tr>                  
                    </table>
			</center>		
			
			
			
    	    <table class="table"  >
          		<h3 class="style1"> Danh sách CÁN BỘ CÓ CHỨC VỤ</h3>
	          	<thead>
					<tr >
					  <th width="20"> STT </th>
					  <th width="100"><center>Mã Cán bộ</center></th>
 					  <th width="320"><center>Tên Cán bộ</center></th>
				  	  <th width="130"><center>Tên chức vụ</center></th>
					  <th width="70">&nbsp;  </th>
					</tr>
				  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;		
					$sql_hienThi="select a.maCb,CONCAT(hoCb,' ',tenCb) as 'ten', tenCv, c.maCv from canbo a,chucvugiangvien b, chucvu c".
					" where a.maCb=b.MaCb and b.maCv=c.maCv";										 						 						 
					$query3 = mysqli_query($conn,$sql_hienThi);
					while ($row3 = mysqli_fetch_array($query3)) {						    
							$chuoi=$row3["maCb"]."+".$row3["maCv"];//Noi chuoi de lay ma can bo va ma chuc vu
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td><?php echo $row3["maCb"]; ?></td>	
						  <td><?php echo $row3["ten"]; ?></td>	
						  <td><?php echo $row3["tenCv"]; ?></td>	
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

							 <input type="image" name="btn_xoa" onclick=" return confirmAction()" value="<?php echo $chuoi;?>"src="img/delete.png" width="20" height="20">		
							 
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