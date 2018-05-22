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
	$malop=$_GET['malop'];
	$db=new db();
	$data=$db->mysql->query("select tenLop,he,sttKhoa from lop where maLop='$malop'")->fetch_assoc();
	if(isset($_POST['hocky']))
	{
		$chon=$_POST['hocky'];
		$data1= get_table_class($malop,$_POST['hocky']);
	}
	else
	{
		$chon=1;
		$data1= get_table_class($malop,1);
	}
?>		
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	    
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1">Phân công lớp: <?php echo $data['he']==1? "Cao đẳng":"Trung cấp"; echo " ".$data['tenLop']." Khóa: ".$data['sttKhoa']; ?><font color="#c70000"></font> &nbsp;&nbsp;	Năm học: 
							<input type="text" id="namhoc" name="namHoc" size="4"  onChange="this.form.submit()" value="<?php echo $namHoc; ?>"> - &nbsp;&nbsp;
							<input type="text" size="4" value="<?php echo ($namHoc+1); ?>" readonly="true">


			<a href="index.php?f=xuat&idMau=<?php $chuoi=$data["maBm"]." ".$namHoc; echo $chuoi; ?>"><img src="img/excel.jpg" title="Xuất file Excel" height="30" width="30" /></a>
			</h3>
			
			<Center>		
					<input type="hidden" id="lop" value="<?php echo $_GET['malop'] ?>">		 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >					  
                   </table>
				   <form action="" method="post" id="myform">
				   <label>Học kì</label>
					<select name="hocky" id="hocky">
						<option value="1" <?php if($chon==1) echo 'selected="selected"' ?>>1</option>
						<option value="2" <?php if($chon==2) echo 'selected="selected"' ?>>2</option>
						<option value="3" <?php if($chon==3) echo 'selected="selected"' ?>>3</option>
						<option value="4" <?php if($chon==4) echo 'selected="selected"' ?>>4</option>
						<option value="5" <?php if($chon==5) echo 'selected="selected"' ?>>5</option>
						<option value="6" <?php if($chon==6) echo 'selected="selected"' ?>>6</option>
					</select>
					</form>
					<label>Chọn giáo viên</label>
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
					  <th width="50"  ><center>
					    Bắt buộc
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
				
              
                  
                    $stt=0;
                    while($row=$data1->fetch_assoc()){	
                        $stt++;	
					?>
						<tr>
						  <th  width="29" scope="row"><?php echo $stt ?></th>
						  <td width="30" class='maMon'><?php echo $row["maMon"]; ?></td>	
						  <td width="100"><?php echo $row["tenMon"]; ?></td>	
						  <td width="51"><?php echo $row['soTc']; ?></td>	
						  <td width="51" class='soTietLt'><?php echo $row['soTietLt']; ?></td>	
						  <td width="51" class='soTietBT'><?php echo $row['soTietBT']; ?></td>	
						  <td width="51" class='soTietTh'><?php echo $row['soTietTh']; ?></td>	
						  <td width="51" class='soTietKt'><?php echo $row['soTietKt']; ?></td>	
						  <td width="51"><center><?php echo $row['batbuoc']=='x'? "Bắt buộc":"Tự chọn"; ?></center></td>	
 						  <td width="30"><center><input style="width:30px;" class='nhom' value="1"></center></td>	
						   <td width="30"><center><input style="width:30px;" class='heso' value="1"></center></td>	
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
	$('#hocky').on('change', function () {
		$('#myform').submit()
	});
	$('.cc').on('click',function()
{
	//console.log('phancong')
	var he=$(this).closest('tr').find('.heso').val()
	var nhom=$(this).closest('tr').find('.nhom').val() 
	var lythuyet=$(this).closest('tr').find('.soTietLt').text()
	var baitap=$(this).closest('tr').find('.soTietBT').text()
	var thuchanh=$(this).closest('tr').find('.soTietTh').text()
	var kiemtra=$(this).closest('tr').find('.soTietKt').text()
	var hocki=$('#hocky').val()
	var macb=$('#maCB').val()
	var namhoc=$('#namhoc').val()
	var malop=$('#lop').val()
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
	</script>
	
	


	
	
<?php 	require_once("footer.php");?>
</div><!--end wrapper--> 
</body>
</html>