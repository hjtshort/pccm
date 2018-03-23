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
	require_once("lib/QuanTri_Mon.php");	
	require_once("ViewAdmin/header.php");
	
	isset($_POST["maMon"])  ? $maMon	=trim($_POST["maMon"]) 	:	$maMon= '';	
	isset($_POST["tenMon"]) ? $tenMon	=trim($_POST["tenMon"]) :	$tenMon= '';	
	isset($_POST["soTC"]) 	? $soTC 	=$_POST["soTC"]  	:	$soTC = '';	
	isset($_POST["LT"]) 	? $LT	 	=$_POST["LT"] 		:	$LT= '';	
	isset($_POST["TH"]) 	? $TH	 	=$_POST["TH"] 		:	$TH= '';	
	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= '';	
	
	//////////////////////////////////
	if (isset($_POST["btn_them"])) {					
			$address = "QuanTri_Mon";
			ThemMon($conn, $address, $maMon, $tenMon, $soTC, $LT, $TH);		
	}	
	
	if (isset($_POST["btn_xoa"])) {		  								
			$maMon = $_POST["btn_xoa"];	
			$address = "QuanTri_Mon";
			XoaMon($conn, $address, $maMon);
	}	
	
	if (isset($_POST["btn_sua"])) {		  								
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
	}
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action="index.php?f=QuanTri_Mon">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1"> THÊM MÔN HỌC </h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
					  <tr>
                        <td height="35" width="140"> Mã môn học: </td>
                        <td ><input type="text" name="maMon" size="25"  value="<?php echo $maMon; ?>"> </td>						
                      </tr>
                      <tr>
                        <td height="35" width="140"> Tên môn học: </td>
                        <td ><input type="text" name="tenMon" size="25"  value="<?php echo $tenMon; ?>"> </td>						
                      </tr>
                      <tr>
                        <td height="35"> Số tín chỉ: </td>
						<td ><input  type="number" name="soTC" size="1" min="1" max="6"  value="<?php echo $soTC; ?>"> </td>                       
                      </tr>
                      <tr>
                        <td height="35"> Số tiết lý thuyết: </td>
						<td ><input type="text" name="LT" size="1"  value="<?php echo $LT; ?>"> </td>                       
                      </tr>
					   <tr>
                        <td height="35"> Số tiết thực hành: </td>
						<td ><input type="text" name="TH" size="1"  value="<?php echo $TH; ?>"> </td>                       
                      </tr>
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                        <td colspan="3" height="55">		
							<input  type="submit" value="TÌM KIẾM" name="btn_tim"> 
							<input  type="submit" value="THÊM MÔN HỌC" name="btn_them">     													
							<input  type="submit" value="CHỈNH SỬA" name="btn_sua">    
						</td>
                      </tr>                  
                    </table>
			</center>		
			
			
			
    	    <table class="table"  >

	          	<thead>
					<tr >
					  <th width="20"> STT </th>
					  <th width="100"><center>Mã Môn học</center></th>
 					  <th width="320"><center>Tên Môn học</center></th>
				  	  <th width="130"><center>Số tín chỉ</center></th>
					  <th width="130"><center>Số tiết Lý thuyết</center></th>
					  <th width="130"><center>Số tiết Thực hành</center></th>
					  <th width="70">&nbsp;  </th>
					</tr>
				  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;												 						 						 
					$sql_hienThi = 	"SELECT * FROM monhoc ".
									" Where maMon like '%".$maMon."%'" .
									 "	 and tenMon like '%".$tenMon."%'" .
									 "	 and soTc like '%".$soTC."%'" .						 
									 "	 and soTietLt like '%".$LT."%'" .						 
									 "	 and soTietTh like '%".$TH."%'".
									" ORDER BY maMon DESC ";
					$query = mysqli_query($conn,$sql_hienThi);
					while ($row = mysqli_fetch_array($query)) {						    
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td><?php echo $row["maMon"]; ?></td>	
						  <td><?php echo $row["tenMon"]; ?></td>	
							<td><center><?php echo $row["soTc"]; ?></center></td>	
						  <td><center><?php echo $row["soTietLt"]." tiết"; ?></center></td>
						  <td><center><?php echo $row["soTietTh"]." tiết"; ?></center></td>			
						  <td>						
							  
							  <?php
							  if($chon== $row["maMon"])  
							  {?>  	
									<input type="radio" name="chon" value='<?php echo $row["maMon"]; ?>' onClick="this.form.submit();" checked="checked">
								<?php } 
							  else {	?>  	
									<input type="radio" name="chon" value='<?php echo $row["maMon"]; ?>' onClick="this.form.submit();">
							  <?php } ?>

							 <input type="image" name="btn_xoa" onClick=" return confirmAction()"  value="<?php echo  $row["maMon"];?>"src="img/delete.png" width="20" height="20">		
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