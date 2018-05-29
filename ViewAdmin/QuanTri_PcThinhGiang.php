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
	require_once("ViewAdmin/function2.php");
	
?>		
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	    
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1">Phân công chuyên môn bộ môn: <font color="#c70000"></font> &nbsp;&nbsp;	Năm học: 
							<input style="width:100px;" type="number" id="namhoc" name="namHoc"    value="<?php echo date('Y'); ?>"> - &nbsp;&nbsp;
							<input style="width:100px;" type="number" id="namhoc2"  value="<?php echo date("Y")+1; ?>" readonly="true">


			<a href="index.php?f=xuat&idMau=<?php $chuoi=$data["maBm"]." ".$namHoc; echo $chuoi; ?>"><img src="img/excel.jpg" title="Xuất file Excel" height="30" width="30" /></a>
			</h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >					  
                   </table>
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
					  <th>Mã lớp</th>
					  <th>Tên lớp</th>
					  <th width="30" valign="middle">Mã Môn</th>
 					  <th width="100"  ><center>Tên Môn</center></th>
					   <th>Học kì</th>
				  	  <th width="51"  ><center>
				  	    Số Tc
				  	  </center></th>
					  <th width="40"  ><center>
					    LT 
					  </center></th>
					  <th width="40"  ><center>
					    BT
					  </center></th>
					  <th width="40"  ><center>
					    TH
					  </center></th>
					  <th width="40"  ><center>
					    KT 
					  </center></th>
					  <th width="20"  ><center>
							số nhóm
					  </center></th>
					  <th width="20"  ><center>
							Hệ số
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
				
                    $data=get_table_thinh_giang($mabm);
                    $stt=0;
                    while($row=$data->fetch_assoc()){	
                        $stt++;	
					?>
						<tr>
						<th  width="29" scope="row"><?php echo $stt ?></th>
						<td width="30" class='maLop'><?php echo $row["maLop"]; ?></td>	
						<td width="30"><?php echo $row["tenLop"]."-K".$row["sttKhoa"]; ?></td>	
							<td width="30" class='maMon'><?php echo $row["maMon"]; ?></td>	
						  <td width="100"><?php echo $row["tenMon"]; ?></td>
						  <td width="30" class='hocKi'><?php echo $row["hocKi"]; ?></td>		
						  <td width="51"><?php echo $row['soTc']; ?></td>	
						  <td width="51" class='soTietLt'><?php echo $row['soTietLt']; ?></td>	
						  <td width="51" class='soTietBT'><?php echo $row['soTietBT']; ?></td>	
						  <td width="51" class='soTietTh'><?php echo $row['soTietTh']; ?></td>	
						  <td width="51" class='soTietKt'><?php echo $row['soTietKt']; ?></td>		
 						  <td width="30"><center><input style="width:30px;" class='nhom' value="1"></center></td>	
						   <td width="30"><center><input style="width:30px;" class='heso' value="1"></center></td>
						 <?php echo  check_phan_cong($row['maLop'],$row["maMon"],$row['hocKi'],$row['namHoc']); ?>
 						 
  						  
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
$('.cc').on('click',function()
{
	var he=$(this).closest('tr').find('.heso').val()
	var nhom=$(this).closest('tr').find('.nhom').val() 
	var lythuyet=$(this).closest('tr').find('.soTietLt').text()
	var baitap=$(this).closest('tr').find('.soTietBT').text()
	var thuchanh=$(this).closest('tr').find('.soTietTh').text()
	var kiemtra=$(this).closest('tr').find('.soTietKt').text()
	var hocki=$(this).closest('tr').find('.hocKi').text()
	var macb=$('#maCB').val()
	var namhoc=$('#namhoc').val()
	var malop=$(this).closest('tr').find('.maLop').text()
	var mamon=$(this).closest('tr').find('.maMon').text()

	$.ajax({
		type: "post",
		url: "index.php?f=function",
		data: {"action":"phan_cong2",
		'he':he,
		'nhom':nhom,
		'lythuyet':lythuyet,
		'baitap':baitap,
		'thuchanh':thuchanh,
		'kiemtra':kiemtra,
		'hocki':hocki,
		'macb':macb,
		'namhoc':namhoc,
		'malop':malop,
		'mamon':mamon
		},
		success: function (response) {
			if(response=='ok')
			{
				location.reload()
			}
		}
	});



})
$('#namhoc').keyup(function () { 
	$('#namhoc2').val(parseInt(this.value)+1)
});
	</script>
	
	


	
	
<?php 	require_once("footer.php");?>
</div><!--end wrapper--> 
</body>
</html>