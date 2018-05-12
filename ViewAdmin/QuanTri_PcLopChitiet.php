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
?>		
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	    
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1">Phân công chuyên môn bộ môn: <font color="#c70000"></font> &nbsp;&nbsp;	Năm học: 
							<input type="text" name="namHoc" size="4"  onChange="this.form.submit()" value="<?php echo $namHoc; ?>"> - &nbsp;&nbsp;
							<input type="text" size="4" value="<?php echo ($namHoc+1); ?>" readonly="true">


			<a href="index.php?f=xuat&idMau=<?php $chuoi=$data["maBm"]." ".$namHoc; echo $chuoi; ?>"><img src="img/excel.jpg" title="Xuất file Excel" height="30" width="30" /></a>
			</h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >					  
                   </table>
				   <input type="text" id="sonth" placeholder="số nhóm thực hành!">
					<input type="text" id="sotietlt" placeholder="số tiết lý thuyết!">
					<input type="text" id="sotietth" placeholder="số tiết thực hành!">
					<input type="text" id="sotietbt" placeholder="số tiết bài tập!">
					<input type="text" id="sotietkt" placeholder="số tiết kiếm tra!">
					<?php
					  $mabm = $_SESSION['ss_user_token']['Mabm'];
					$cb=get_can_bo($mabm) ;
					?>
					<select name="" id="maCB">
						<?php while($row=$cb->fetch_assoc()){
						?>
						<option value="<?php echo $row['maCb']; ?>"><?php echo $row['hoCb']." ".$row['tenCb']."(".$row['maCb'].")"; ?></option>
						<?php }?>
					</select>
			</center>		
			
			
    	    <table class="table table-hover" border="1"  >

	          	<thead>
					<tr >
					  <th width="29" ><center> STT</center> </th>
					  <th width="30" valign="middle">Mã Môn</th>
 					  <th width="100"  ><center>Tên Môn</center></th>
				  	  <th width="51"  ><center>
				  	    Học kì
				  	  </center></th>
					  <th width="40"  ><center>
					    Năm học 
					  </center></th>
					  <th width="40"  ><center>
					    Khoa 
					  </center></th>
					  <th width="40"  ><center>
					    Hệ 
					  </center></th>
					  <th width="40"  ><center>
					    Thao tác 
					  </center></th>
					  <th width="40"  ><center>
					 
					  </center></th>

					</tr>
											
			  </thead>
			  <tbody>
				  <?php		
				
                  	$malop=$_GET['malop'];
                    $data= get_table_class($malop);
                    $stt=0;
                    while($row=$data->fetch_assoc()){	
                        $stt++;	
					?>
						<tr>
						  <th  width="29" scope="row"><?php echo $stt ?></th>
						  <td width="30"><?php echo $row["maMon"]; ?></td>	
						  <td width="100"><?php echo $row["tenMon"]; ?></td>	
						  <td width="51"><center><?php echo $row['hocKi']; ?></center></td>	
						  <td width="51"><center><?php echo $row['namHoc']; ?></center></td>	
						  <td width="51"><center><?php echo $row['sttKhoa']; ?></center></td>	
 						  <td width="40"><center><?php echo $row['he']==1? "Cao Đẳng":"Trung Cấp";?></center></td>	
						  <?php echo  check_thinh_giang($malop,$row["maMon"],$row['hocKi'],$row['namHoc'])==1? "<td><label class='text-danger'>Thỉnh giảng</label></td>":check_phan_cong($malop,$row["maMon"],$row['hocKi'],$row['namHoc']); ?>
  						  
						</tr>	
                <?php }?>				
	
			  </tbody>
			</table>	
      	</div>
 
    	</div>
	
		
	</div>
	</div>
	<script>
	function ins(e)
	{
		var macb=$('#maCB').val()
		var sonth=$('#sonth').val()
		var sotietlt=$('#sotietlt').val()
		var sotietth=$('#sotietth').val()
		var sotietbt=$('#sotietbt').val()
		var sotietkt=$('#sotietkt').val()
		$.ajax({
			type: "post",
			url: "index.php?f=function",
			data: {"data":e,
			"action":"phan_cong",
			"macb":macb,
			'sonth':sonth,
			"sotietlt":sotietlt,
			"sotietth":sotietth,
			"sotietbt":sotietbt,
			"sotietkt":sotietkt
			},
			success: function (response) {
				if(response=="ok")
					location.reload();
			
			}
		});
	}
	function del(e)
	{
		$.ajax({
			type: "post",
			url: "index.php?f=function",
			data: {"data":e,
			"action":"xoa_phan_cong"
			},

			success: function (response) {
				if(response=="ok")
					location.reload();
			}
		});
	}
	</script>
	
	


	
	
<?php 	require_once("footer.php");?>
</div><!--end wrapper--> 
</body>
</html>