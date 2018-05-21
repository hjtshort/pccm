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
	require_once("lib/QuanTri_Lop.php");	
	require_once("ViewAdmin/header.php");
	
	///Lấy khóa lớn nhất
	$sql="select max(sttKhoa) as khoa from chuongtrinhhoc";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
	$khoa_max=$data["khoa"];
	
	isset($_POST["maLop"])? $maLop=trim($_POST["maLop"]):	$maLop = '';	
	isset($_POST["siSo"]) ? $siSo=trim($_POST["siSo"])	:	$siSo= '';
	isset($_POST["tenLop"]) ? $tenLop=trim($_POST["tenLop"]):	$tenLop= '';	
	isset($_POST["maNganh"])? $maNganh=trim($_POST["maNganh"]):	$maNganh = '';	
	isset($_POST["sttKhoa"])? $sttKhoa=trim($_POST["sttKhoa"]):	$sttKhoa =$khoa_max;	
	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= '';	
	isset($_POST["he"])	? $he=trim($_POST["he"])	:	$he= '';	
	
	
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
			$address = "QuanTri_Lop";
			ThemLop($conn, $address,$maLop, $tenLop,$siSo, $maNganh, $sttKhoa,$he);		
			
	}	
	
	if (isset($_POST["btn_xoa"])) {		  								
			$maLop = $_POST["btn_xoa"];	
			$address = "QuanTri_Lop";
				XoaLop($conn, $address, $maLop);
	}	
	
	if (isset($_POST["btn_sua"])) {		  								
			if(!isset($_POST["chon"]))
			{
				thongBao("Bạn phải chọn lớp cần sửa thông tin trong bảng bên dưới trước khi ra lệnh chỉnh sửa!"); 
			
			}
			else
			{
				$ma_old = $_POST["chon"];
				$address = "QuanTri_Lop";							
				SuaLop($conn, $address, $maLop,$tenLop,$siSo, $maNganh, $sttKhoa,$he);	
			}	
	}	
	
	
	if (isset($_POST["chon"])) {					
		$chon = $_POST["chon"];		
		$sql_chon = "SELECT * ".
				 	" FROM lop ".
					" where maLop = '".$chon."'";
		$query_chon = mysqli_query($conn,$sql_chon);
		$data_chon = mysqli_fetch_array($query_chon);
		$maLop 	= $data_chon["maLop"];
		$tenLop	= $data_chon["tenLop"];
		$maNganh= $data_chon["maNganh"];
		$siSo= $data_chon["siSo"];
		$sttKhoa= $data_chon["sttKhoa"];	
		$he=$data_chon["he"];
	}	

?>
	
 <div class="wrapper" style="background-color:#FFFFFF"> 
 <div>
		
	    <form name="form1" method="POST" action="index.php?f=QuanTri_Lop" >
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1"> THÊM LỚP HỌC <?php echo $maLop; ?></h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >	
					<tr>
                        <td height="35" width="100"> Mã lớp: </td>
                        <td ><input type="text" name="maLop" size="30"  > 	</td>						
                      </tr>			
					 <tr>
                        <td height="35" width="100"> Tên lớp học: </td>
                        <td ><input type="text" name="tenLop" size="30"  value="<?php echo $tenLop; ?>"> 	</td>						
                      </tr>
					  <tr>
                        <td height="35"> Khóa: </td>
                        <td ><input type="text" name="sttKhoa" size="2"  value="<?php echo $sttKhoa; ?>"> 	</td>						
                      </tr>
					   <tr>
                        <td height="35"> Số lượng: </td>
                        <td ><input type="text" name="siSo" size="2"  value="<?php echo $siSo; ?>"> 	</td>						
                      </tr>
                      <tr>
                        <td height="35"> Ngành: </td>
						<td >
						<select name="maNganh" >							 	
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
					    <td height="35"> Hệ: </td>
                        <td>
						<select name="he">	
							<?php
							if (is_numeric($he)&&$he==1){	?>					 	
								<option value=<?php $he?> selected="selected">Cao đẳng</option>
								<option value='2' >Trung cấp</option>
							<?php
							}
							else if(is_numeric($he)&&$he==2){  ?>
								<option value=<?php $he?> selected="selected">Trung cấp</option>
								<option value='1' >Cao đẳng</option>
								<?php	
									}
									else { ?>
											<option value='1' selected="selected">Cao đẳng</option>
											<option value='2' >Trung cấp</option>
									<?php }?>											
						</select>			
						</td>
                      </tr>
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                        <td colspan="3" height="55">		
							<input class="btn btn-custom" type="submit" value="TÌM KIẾM" name="btn_tim"> 
							<input class="btn btn-custom" type="submit" value="THÊM LỚP" name="btn_them">     													
							<input class="btn btn-custom" type="submit" value="CHỈNH SỬA" name="btn_sua">     
						</td>
                      </tr>                
                    </table>
			</center>		
			
			
			
    	    <table class="table table-hover"  >

	          	<thead>
					<tr >
					  <th width="33"> STT </th>
					  <th width="80"><center>Mã Lớp</center></th>
					  <th width="330"><center>Tên Lớp</center></th>
   					  <th width="70"><center>Số lượng</center></th>
				  	  <th width="264"><center>Ngành</center></th>
					  <th width="86"><center>Hệ</center></th>
					  <th width="131">&nbsp;  </th>
					</tr>
				  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;
					$sql_hienThi = 	"SELECT * FROM lop a, nganh b ".
									" where a.maNganh = b.maNganh ".									
									" 	 and tenLop like '%".$tenLop."%'" .
									"   and a.maNganh like '%".$maNganh."%'".
									"   and sttKhoa like '%".$sttKhoa."%'".						
									" and b.maBm='".$maBm."'".
									" ORDER BY sttKhoa DESC ";
					$query = mysqli_query($conn,$sql_hienThi);
					while ($row = mysqli_fetch_array($query)) {						    
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
					      <td><?php echo $row["maLop"]; ?></td>
						  <td><?php echo $row["tenLop"]."-K".$row["sttKhoa"]; ?></td>	
  						  <td><center><?php echo $row["siSo"]; ?></center></td>							  
						  <td><?php echo $row["tenNganh"]; ?></td>	
  						  <td><?php 
						  			if ($row["he"]==1)	echo "Cao Đẳng";
									else echo "Trung cấp"	
									
								 ?></td>	
						  <td>		<center>
						  
						  <?php
						  if($chon== $row["maLop"])  
						  {?>  	
								<input type="radio" name="chon" value='<?php echo $row["maLop"]; ?>' onClick="this.form.submit();" checked="checked">
							<?php } 
						  else {	?>  	
								<input type="radio" name="chon" value='<?php echo $row["maLop"]; ?>' onClick="this.form.submit();">
						  <?php } ?>
						  				
								<input type="image" name="btn_xoa" onClick=" return confirmAction()"  value="<?php echo  $row["maLop"];?>"src="img/delete.png" width="20" height="20">		
						  </center></td>
						</tr>					
			  <?php		}		  ?>					
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