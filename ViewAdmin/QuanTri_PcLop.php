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
	require_once("lib/QuanTri_Pccm.php");	
    require_once("ViewAdmin/header.php");
    require_once("ViewAdmin/function.php");
?>		
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action='index.php?f=QuanTri_Pccm1&idMau=<?php echo $maCb; ?>'>
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1">Phân công chuyên môn bộ môn: <font color="#c70000"><?php echo $data1["tenBm"]  ?></font> &nbsp;&nbsp;	Năm học: 
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
					  <th width="30" valign="middle">Mã Cán bộ</th>
 					  <th width="100"  ><center>Tên cán bộ</center></th>
				  	  <th width="51"  ><center>
				  	    Tổng HK1
				  	  </center></th>
					  <th width="40"  ><center>
					    Tổng HK2 
					  </center></th>
					  <th width="63"  ><center>
					    Tổng tiết
					  </center></th>
					   <th width="63"  ><center>
					    Tiết nghĩa vụ
					  </center></th>
   					  <th width="47"   ><center>Ghi chú</center></th>				  
					  <th width="99"><center>Đối tượng giảm</center>  </th>
					</tr>
											
			  </thead>
			  <tbody>
				  <?php				
					?>
						<tr>
						  <th  width="29" scope="row"><?php echo $stt++ ?></th>
						  <td width="30"><?php echo $row["maCb"]; ?></td>	
						  <td width="100"><a href="index.php?f=QuanTri_Pccm&idMau=<?php $chuoi=$row["maCb"]." ".$namHoc." ".$data_lop["maLop"]; echo $chuoi; ?>" title="<?php if ($tong<$tc){ $st=$tc-$tong; echo "Thiếu ".$st." tiết"; } else if ($tong>=$tc) {$st=$tong-$tc; echo "Thừa ".$st." tiết";  }?>"><?php echo $row["ten"]; ?></td>	
						  <td width="51"><center><?php echo $tongHk1;; ?></center></td>	
 						  <td width="40"><center><?php echo $tongHk2;; ?></center></td>	
  						  <td width="63"><center><?php echo $tong; ?></center></td>	
						  <td width="63"><center><?php 
														echo $tc;
														?></center></td>
						    <td><center><?php if ($num_rows>0) echo "NCKH-";	
									  if ($num_rows2>0) echo "TBG"; ?></center></td>	
						<td><center><?php if ($num_DtGiam>0){
										
										 echo  $row_DtGiam["tenDt"]."-".$row_DtGiam["soTietGiam"];
					}?></center></td>
						</tr>					
	
			  <tr>
			  	<td colspan="5" align="center"><b> Tổng số</b></td>
				<td><b><?php echo --$stt. " giảng viên"; ?> </b></td>
				<td> </td>
				<td></td>
			  </tr>				
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