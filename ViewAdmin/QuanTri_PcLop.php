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
			color: #333;
		}
		.table>thead>tr>th
{
vertical-align:middle !important;
}
	</style>
</head>

<body>
 <div class="wrapper" style="background-color:#FFFFFF"> 
<?php
    require_once("ViewAdmin/header.php");
	require_once("ViewAdmin/function.php");
	$mbm = $_SESSION['ss_user_token']['Mabm'];
	$maxkhoa=get_max_khoa_lop($mbm);
	$sttKhoa=42;
		
?>		


	

<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
<?php
	$now=getdate();
	$nh1=$now["year"];
//////////////////////////////////
	if (isset($_POST["namHoc"])) {		
		if( $_POST["namHoc"]=='')
		{		
			$now = getdate();
			$namHoc = $now["year"]; 	
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
			$namHoc = $now["year"]; 	
			$nh= $now["year"]; 	
		}	
		
	
?>
	     <form name="form1" method="POST" action=''>
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1">Phân công Theo lớp: <font color="#c70000"></font> &nbsp;&nbsp;	Năm học: 
							<input type="text" name="namHoc" size="4"  onChange="this.form.submit()" value="<?php echo $namHoc; ?>"> - &nbsp;&nbsp;
							<input type="text" size="4" value="<?php echo ($namHoc+1); ?>" readonly="true">


			<a href="index.php?f=xuat&idMau=<?php $chuoi=$data["maBm"]." ".$namHoc; echo $chuoi; ?>"><img src="img/excel.jpg" title="Xuất file Excel" height="30" width="30" /></a>
			</h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >					  
                   </table>
			</center>		
			
			
    	    <table class="table table-hover" border="1"  >

	          	<thead>
					<tr >
					  <th width="29" ><center> STT</center> </th>
					  <th width="30" valign="middle">Mã lớp</th>
 					  <th width="100"  ><center>Tên lớp</center></th>
				  	  <th width="51"  ><center>
				  	    Khóa
				  	  </center></th>
					  <th width="40"  ><center>
					    hệ 
					  </center></th>
					  <th width="40"  ><center>
						Thỉnh giảng 
					  </center></th>

					</tr>
											
			  </thead>
			  <tbody>
                  <?php		
                  $mbm = $_SESSION['ss_user_token']['Mabm'];
                    $data=get_clas($mbm,$sttKhoa);
                    $stt=0;
                    while($row=$data->fetch_assoc()){	
                        $stt++;	
					?>
						<tr>
						  <th  width="29" scope="row"><?php echo $stt ?></th>
						  <td width="30"><?php echo $row["maLop"]; ?></td>	
						  <td width="100"><a href="index.php?f=QuanTri_PcLopChitiet&malop=<?php  echo $row["maLop"]." ".$namHoc; ?>"><?php echo $row['tenLop'];?></a></td>	
						  <td width="51"><center><?php echo $row['sttKhoa']; ?></center></td>	
 						  <td width="40"><center><?php echo $row['he']==1? "Cao Đẳng":"Trung Cấp";?></center></td>	
							<td width="40"><center><a href="index.php?f=QuanTri_ThinhGiang&malop=<?php  echo $row["maLop"]; ?>">Thỉnh giảng</a></center></td>	
  						  
						</tr>	
                <?php }?>				
	
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