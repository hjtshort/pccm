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
	<link href="ViewAdmin/style1.css" rel="stylesheet" type="text/css" />
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
	require_once("lib/QuanTri_DoiTuongGiam.php");	
	require_once("ViewApp/header.php");
	
	isset($_POST["maDt"])  ? $maDt	=trim($_POST["maDt"]) 	:	$maDt= '';	
	isset($_POST["tenDt"]) ? $tenDt	=trim($_POST["tenDt"]) :	$tenDt= '';	
	isset($_POST["soTietGiam"]) 	? $soTietGiam 	=$_POST["soTietGiam"]  	:	$soTietGiam = '';	
	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= '';	
	
	//////////////////////////////////
	if (isset($_POST["btn_them"])) {					
			$address = "QuanTri_DoiTuongGiam";
			Them($conn, $address, $maDt, $tenDt, $soTietGiam);		
	}	
	
	if (isset($_POST["btn_xoa"])) {		  								
			$maDt = $_POST["btn_xoa"];	
			$address = "QuanTri_DoiTuongGiam";
			Xoa($conn, $address, $maDt);
	}	
	
	if (isset($_POST["btn_sua"])) {		  								
			if(!isset($_POST["chon"]))
			{
				thongBao("Bạn phải chọn lớp cần sửa thông tin trong bảng bên dưới trước khi ra lệnh chỉnh sửa!"); 
			
			}
			else
			{
				$ma_old = $_POST["chon"];
				$address = "QuanTri_DoiTuongGiam";							
				Sua($conn, $address, $ma_old, $tenDt, $soTietGiam);		
			}	
	}	
	
	if (isset($_POST["chon"])) {					
		$chon = $_POST["chon"];		
		$sql_chon = "SELECT * ".
				 	" FROM doituonggiam ".
					" where maDt = '".$chon."'";
		$query_chon = mysqli_query($conn,$sql_chon);
		$data_chon = mysqli_fetch_array($query_chon);	

		$tenDt = $data_chon["tenDt"];	
		$soTietGiam 	= $data_chon["soTietGiam"];	
	}
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action="index.php?f=QuanTri_DoiTuongGiam">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1"> THÊM ĐỐI TƯỢNG GIẢM </h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
                      <tr>
                        <td height="35" width="140"> Tên đối tượng: </td>
                        <td ><input type="text" name="tenDt" size="25"  value="<?php echo $tenDt; ?>"> </td>						
                      </tr>
                      <tr>
                        <td height="35"> Số tiết giảm: </td>
						<td ><input type="text" name="soTietGiam" size="1"  value="<?php echo $soTietGiam; ?>"> </td>                       
                      </tr>
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                        <td colspan="3" height="55">		
							<input class="btn btn-custom" style="width: 150px" type="submit" value="TÌM KIẾM" name="btn_tim"> 
							<input class="btn btn-custom" style="width: 150px" type="submit" value="THÊM ĐỐI TƯỢNG" name="btn_them">     													
							<input class="btn btn-custom" style="width: 150px" type="submit" value="CHỈNH SỬA" name="btn_sua">    
						</td>
                      </tr>                  
                    </table>
			</center>		
			
			
			
    	    <table class="table table-hover"  >
          		<h3 class="style1"> Danh sách các đối tượng</h3>
	          	<thead>
					<tr >
					  <th width="20"> STT </th>
					  <th width="100"><center>Mã đối tượng</center></th>
 					  <th width="320"><center>Tên đối tượng</center></th>
				  	  <th width="130"><center>Số tiết giảm</center></th>
					  <th width="70">&nbsp;  </th>
					</tr>
				  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;												 						 						 
					$sql_hienThi = 	"SELECT * FROM doituonggiam ".
									" Where maDt like '%".$maDt."%'" .
									 "	 and tenDt like '%".$tenDt."%'" .
									 "	 and soTietGiam like '%".$soTietGiam."%'" .						 
									" ORDER BY maDt DESC ";
					$query = mysqli_query($conn,$sql_hienThi);
					while ($row = mysqli_fetch_array($query)) {						    
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td><?php echo $row["maDt"]; ?></td>	
						  <td><?php echo $row["tenDt"]; ?></td>	
						  <td><?php echo $row["soTietGiam"]; ?></td>	
						  <td>						
							  
							  <?php
							  if($chon== $row["maDt"])  
							  {?>  	
									<input type="radio" name="chon" value='<?php echo $row["maDt"]; ?>' onClick="this.form.submit();" checked="checked">
								<?php } 
							  else {	?>  	
									<input type="radio" name="chon" value='<?php echo $row["maDt"]; ?>' onClick="this.form.submit();">
							  <?php } ?>

							 <input type="image" name="btn_xoa" onclick=" return confirmAction()" value="<?php echo  $row["maDt"];?>"src="img/delete.png" width="20" height="20">		
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