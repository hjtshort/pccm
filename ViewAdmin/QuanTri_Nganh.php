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
	require_once("lib/QuanTri_Nganh.php");	
	require_once("ViewAdmin/header.php");
	

	isset($_POST["tenNganh"])? $tenNganh=trim($_POST["tenNganh"]) 	:	$tenNganh = '';	
	isset($_POST["chon"])	 ? $chon=trim($_POST["chon"])			:	$chon= '';	
	//Lấy bộ môn
	$sql="select maBm from canbo where maCb='".$user['ms']."'";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
	
	$sql_Bm="select * from bomon where maBm='".$data['maBm']."'";
	$query_Bm = mysqli_query($conn,$sql_Bm);
	$data_Bm = mysqli_fetch_array($query_Bm);
	$maBm=$data['maBm'];

	//////////////////////////////////
	if (isset($_POST["btn_them"])) {					
			$address = "QuanTri_Nganh";

			ThemNganh($conn, $address, $tenNganh, $maBm);		
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
				SuaNganh($conn, $address, $ma_old,  $tenNganh, $maBm);	
			}	
	}	
	
	
	if (isset($_POST["chon"])) {					
		$chon = $_POST["chon"];		
		$sql_chon = "SELECT * ".
				 	" FROM nganh ".
					" where maNganh = '".$chon."'";
		$query_chon = mysqli_query($conn,$sql_chon);
		$data_chon = mysqli_fetch_array($query_chon);		
		$tenNganh= $data_chon["tenNganh"];
		isset($_POST["maBm"])? $maBm=trim($_POST["maBm"]) 	:	$maBm = $data_chon["maBm"];;	

	}	
	
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	    <form name="form1" method="POST" action="index.php?f=QuanTri_Nganh">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1"> THÊM NGÀNH CHO BỘ MÔN <font color="#FF0000"><?php echo $data_Bm['tenBm'];?></font></h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
					  <tr>
                        <td height="35" width="100"> Tên ngành: </td>
                        <td ><input type="text" name="tenNganh" size="40"  value="<?php echo $tenNganh; ?>"> 	</td>						
						<td colspan="3" height="55">		
							<input class="btn btn-custom" type="submit" value="TÌM KIẾM" name="btn_tim"> 
							<input class="btn btn-custom" type="submit" value="THÊM NGÀNH" name="btn_them">     													
							<input class="btn btn-custom" type="submit" value="CHỈNH SỬA" name="btn_sua">     
						</td>
                      </tr>
                    
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                        
                      </tr>                  
                    </table>
			</center>		
			
			
			
    	    <table class="table table-hover"  >

	          	<thead>
					<tr >
					  <th width="20"> STT </th>					
 					  <th width="400"><center>Tên ngành</center></th>
				  	  <th width="400"><center>Bộ Môn</center></th>
					  <th width="70">&nbsp </th>
					</tr>
				  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;
					$sql_hienThi = 	"SELECT * FROM nganh a".
									" where a.maBm = '".$data['maBm']."'".
									"	 and tenNganh like '%".$tenNganh."%'".
									" ORDER BY maNganh DESC ";
					$query = mysqli_query($conn,$sql_hienThi);
					while ($row = mysqli_fetch_array($query)) {						    
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>						
						  <td><?php echo $row["tenNganh"]; ?></td>	
						  <td><?php echo $data_Bm["tenBm"]; ?></td>	
						  <td>	
						  <?php
						  if($chon== $row["maNganh"])  
						  {?>  	
								<input type="radio" name="chon" value='<?php echo $row["maNganh"]; ?>' onClick="this.form.submit();" checked="checked">
							<?php } 
						  else {	?>  	
								<input type="radio" name="chon" value='<?php echo $row["maNganh"]; ?>' onClick="this.form.submit();">
						  <?php } ?>					
						  
						  <input type="image" name="btn_xoa" onclick=" return confirmAction()"  value="<?php echo  $row["maNganh"];?>"src="img/delete.png" width="20" height="20">
									
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