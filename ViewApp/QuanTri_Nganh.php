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
	require_once("lib/QuanTri_Nganh.php");	
	require_once("ViewApp/header.php");
	
	isset($_POST["maNganh"])? $maNganh=trim($_POST["maNganh"]) 	:	$maNganh = '';	
	isset($_POST["tenNganh"])? $tenNganh=trim($_POST["tenNganh"]) 	:	$tenNganh = '';	
	isset($_POST["maBm"]) 	 ? $maBm	=trim($_POST["maBm"])		:	$maBm= '';		
	isset($_POST["chon"])	 ? $chon=trim($_POST["chon"])			:	$chon= '';	

	//////////////////////////////////
	if (isset($_POST["btn_them"])) {					
			$address = "QuanTri_Nganh";
			ThemNganh($conn, $address, $maNganh,$tenNganh, $maBm);		
	}	
	
	if (isset($_POST["btn_xoa"])) {		  								
			$maNganh = $_POST["btn_xoa"];	
			$address = "QuanTri_Nganh";
			XoaNganh($conn, $address, $maNganh);
	}	
	
	if (isset($_POST["btn_sua"])) {		  								
			if(!isset($_POST["chon"]))
			{
				thongBao("Bạn phải chọn Ngành cần sửa thông tin trong bảng bên dưới trước khi ra lệnh chỉnh sửa!"); 
			
			}
			else
			{
				$ma_old = $_POST["chon"];
				$address = "QuanTri_Nganh";							
				SuaNganh($conn, $address, $ma_old, $maNganh, $tenNganh, $maBm);	
			}	
	}	
	
	
	if (isset($_POST["chon"])) {					
		$chon = $_POST["chon"];		
		$sql_chon = "SELECT * ".
				 	" FROM nganh ".
					" where maNganh = '".$chon."'";
		$query_chon = mysqli_query($conn,$sql_chon);
		$data_chon = mysqli_fetch_array($query_chon);		
		$maNganh= $data_chon["maNganh"];
		$tenNganh= $data_chon["tenNganh"];
		$maBm	 = $data_chon["maBm"];	
	}	

?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	    <form name="form1" method="POST" action="index.php?f=QuanTri_Nganh">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1"> THÊM NGÀNH</h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
					  <tr>
                        <td height="35" width="100"> Mã ngành: </td>
                        <td ><input type="text" name="maNganh" size="40"  value="<?php echo $maNganh; ?>"> 	</td>						
                      </tr>
					  <tr>
                        <td height="35" width="100"> Tên ngành: </td>
                        <td ><input type="text" name="tenNganh" size="40"  value="<?php echo $tenNganh; ?>"> 	</td>						
                      </tr>
                      <tr>
                        <td height="35"> Bộ môn: </td>
						<td >
						<select name="maBm" >															
							<?php								
									$sql4 ="SELECT maBm, tenBm FROM bomon b, khoa c".
						 				   " WHERE b.maKhoa=c.maKhoa  ";																										
									$query4 = mysqli_query($conn,$sql4);
									while ($data4 = mysqli_fetch_array($query4)) {
									if($maBm==$data4["maBm"]) 											
									{  ?>
											<option value='<?php echo $data4["maBm"]; ?>' selected="selected"><?php echo $data4["tenBm"]; ?></option>
									 <?php }	else { ?>
											<option value='<?php echo $data4["maBm"]; ?>'><?php echo $data4["tenBm"]; ?></option>
									<?php   }	
									   }?>
						  </select>		
						</td>                       
                      </tr>                     
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                        <td colspan="3" height="55">		
							<input class="btn btn-custom"  type="submit" value="TÌM KIẾM" name="btn_tim"> 
							<input class="btn btn-custom"  type="submit" value="THÊM NGÀNH" name="btn_them">     													
							<input  class="btn btn-custom" type="submit" value="CHỈNH SỬA" name="btn_sua">     
						</td>
                      </tr>                  
                    </table>
			</center>		
			
			
			
    	    <table class="table table-hover"  >
          		<h3 class="style1"> Danh sách các ngành</h3>
	          	<thead>
					<tr >
					  <th width="20"> STT </th>					
         			  <th width="400"><center>Mã ngành</center></th>
 					  <th width="400"><center>Tên ngành</center></th>
				  	  <th width="400"><center>Bộ Môn</center></th>
					  <th width="70">&nbsp;  </th>
					</tr>
				  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;
					$sql_hienThi = 	"SELECT * FROM nganh a, bomon b ".
									" where a.maBm = b.maBm ".
									"	 and tenNganh like '%".$tenNganh."%'".
									"	 and a.maBm like '%".$maBm."%' ".
									" ORDER BY maNganh DESC ";
					$query = mysqli_query($conn,$sql_hienThi);
					while ($row = mysqli_fetch_array($query)) {						    
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>	
						  <td><?php echo $row["maNganh"]; ?></td>						
						  <td><?php echo $row["tenNganh"]; ?></td>	
						  <td><?php echo $row["tenBm"]; ?></td>	
						  <td>	
						  <?php
						  if($chon== $row["maNganh"])  
						  {?>  	
								<input type="radio" name="chon" value='<?php echo $row["maNganh"]; ?>' onClick="this.form.submit();" checked="checked">
							<?php } 
						  else {	?>  	
								<input type="radio" name="chon" value='<?php echo $row["maNganh"]; ?>' onClick="this.form.submit();">
						  <?php } ?>					
						  
						  <input type="image" name="btn_xoa" onClick=" return confirmAction()" value="<?php echo  $row["maNganh"];?>"src="img/delete.png" width="20" height="20">
									
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