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
	require_once("ViewAdmin/header.php");
	require "db.php";
	$mbm = $_SESSION['ss_user_token']['Mabm'];
	$db = new db();
	$dslop = $db->mysql->query("select * from lop join nganh on lop.maNganh = nganh.maNganh where maBm=$mbm");

	if(isset($_POST['btn_them'])){
		// var_dump($_POST);
		$data = $_POST;

		if($db->mysql->query("insert into capnhatsiso values('$data[lop]','$data[hocki]','$data[namhoc]','$data[siso]')"))
		{
			
		}
		else
		{
			echo '<script>alert("Bạn thêm thất bại");</script>';
		}
	}
	else if (isset($_POST['btn_xoa']))
	{
		$data = $_POST;

		if($db->mysql->query("delete from capnhatsiso where maLop = '$data[btn_xoa]'")){
			

		}
		else
		{
			echo '<script>alert("Bạn xóa thất bại");</script>';

		}
	}
	
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action="index.php?f=QuanTri_CapNhatSiSo">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1"> CẬP NHẬT SỈ SỐ </h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
                      <tr>
                        <td height="50" width="180"> Tên Lớp: </td>
                        <td width="150" ><select name="lop">
							<?php while($row = $dslop->fetch_assoc())
							{
								?>
								<option value="<?php echo $row['maLop'] ?>"><?php echo $row['tenLop'] ?></option>
							<?php  }
                        	?>
                        	
             					</select> </td>						
						<td width="260" height="35"> Chọn học kì: </td>
						<td width="100" ><select name="hocki" id="">
							<option value="1" selected>1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
						
						</select> </td>
						<td width="200" height="35"> Chọn năm học: </td> 
						<td width="100" height="35"><input type="text" name="namhoc"></td>   
						<td width="280" height="55"> Nhập sỉ số: </td> 
						<td width="80" height="35"><input type="number" name="siso"></td>                   
                      </tr>
                    
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                        <td colspan="6" height="70">		
							<input class="btn btn-custom" style="width: 150px"  type="submit" value="TÌM KIẾM" name="btn_tim"> 
							<input  class="btn btn-custom" style="width: 150px" type="submit" value="THÊM ĐỐI TƯỢNG" name="btn_them">     													
							<!-- <input  class="btn btn-custom" style="width: 150px" type="submit" value="CHỈNH SỬA" name="btn_sua">  -->   
				</td>
                      </tr>                  
                    </table>
			</center>		
					
			
			
    	    <table class="table table-hover"  >

	          	<thead>
					<tr >
					  <th width="20"> STT </th>
					  <th width="100"><center>Tên lớp</center></th>
 					  <th width="120"><center>Học kì</center></th>
				  	  <th width="130"><center>Năm học</center></th>
				  	   <th width="130"><center>Năm Sỉ số</center></th>
					  <th width="70">&nbsp;  </th>
					</tr>
				  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;												 						 						 
					$siso = $db->mysql->query("select * from capnhatsiso join lop on capnhatsiso.maLop = lop.maLop");
					
					while ($row = $siso->fetch_assoc()) {						    
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td><?php echo $row["tenLop"]; ?></td>	
						  <td><?php echo $row["hocKi"]; ?></td>	
						  <td><center><?php echo $row["namHoc"]; ?></center></td>
						  <td><center><?php echo $row["siSo"]; ?></center></td>		
						  <td>						
							  
							 
									<!-- <input type="radio" name="chon" value='' onClick="this.form.submit();" checked="checked">
								
							   	
									<input type="radio" name="chon" value='' onClick="this.form.submit();"> -->
							  

							 <input type="image" name="btn_xoa" onClick="return confirmAction()"  value="<?php echo $row['maLop'] ?>" src="img/delete.png" width="20" height="20">		
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