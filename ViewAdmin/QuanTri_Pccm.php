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
	
	<SCRIPT LANGUAGE="JavaScript">
      function confirmAction() {
        return confirm("Bạn có chắc xóa không?")
      }
 	</SCRIPT>

   	<style type="text/css">
		.style1 {
			color: #0000CC;
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
	$db=new db();
	$now=getdate();
	$nh1=$now["year"];
	
	///Lấy khóa lớn nhất
	$sql="select max(sttKhoa) as khoa from lop";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
	$khoa_max=$data["khoa"];

	$khoa_max1=$khoa_max-1;
	$khoa_max2=$khoa_max-2;
	$ma =explode(" ",$_GET['idMau']);
	$maCb=$ma[0]; 
	$namHoc=$ma[1];	
	$sql="select CONCAT(hoCb,' ',tenCb) as ten from canbo where maCb='".$maCb."'";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
	
	$sql1="select maBm from canbo where maCb='".$maCb."'";
	$query1 = mysqli_query($conn,$sql1);
	$data1 = mysqli_fetch_array($query1);
	$maBm=$data1["maBm"];

	if (isset($_POST["btn_xoa"])) {		  				
			$chuoi=$_POST["btn_xoa"];	  	
			$ma =explode("+",$chuoi);//Tach các cot

			$address = "QuanTri_Pccm";
			$maCb=$ma[0];
			
			XoaPccm($conn, $address, $ma[0],$ma[1],$ma[2],$ma[3],$ma[4]);
			
	}
	
?>

<input type="text" hidden  id="maCB" value="<?php echo $maCb; ?>">

<input type="text" hidden  id="namhoc" value="<?php echo $namHoc; ?>">
<input type="text" hidden  id="maBM" value="<?php echo $maBm; ?>"> 		

<div class="wrapper" style="background-color:#FFFFFF"> 
<div>

	 	<div class="container">
      		<div class="row">	
			<h3 class="style1">Phân công cán bộ<font color="#990000" >  <?php echo $data["ten"];	?></font> <font size="-1"><a href="index.php?f=QuanTri_ChiTietGv&idMau=<?php $chuoi=$maCb." ".$namHoc; echo $chuoi; ?>"> <img src="img/Edit.png" width="20" height="20" title="Chi tiết phân công" /></a></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<font color="#FF00FF"> Học kỳ: <select name="hocky" id="hockiphancong">
									<option value="1" >1</option>
									<option value="2" >2</option>
								</select>   Năm học:<?php echo $namHoc."-"; echo $namHoc+1;?> </font></h3>


					
			        <table width="800" border="1" >
					
						<tr>
							<td width="200"> Lớp thuộc bộ môn: </td>									
							<td>        
								<select name="maLop" id="lop">
								<?php														
																
								$sql7 = "SELECT * FROM lop 
											WHERE (sttKhoa=$khoa_max or sttKhoa=$khoa_max1 or sttKhoa=$khoa_max2) and maNganh in (select maNganh from nganh where maBm=".$maBm.")";												
								$query7 = $db->mysql->query($sql7);
								while($row=$query7->fetch_assoc()){																	
								?>									 
									<option value='<?php echo $row["maNganh"]."+".$row['maLop']."+".$row['sttKhoa']; ?>'><?php echo ($row["he"]==1?  "CĐ": "TC")." ". $row["tenLop"]." - K".$row["sttKhoa"].""; ?></option>
								<?php }
									?>
			
							</td>   
							<td>Hệ:</td>
							<td>
								<select name="" id="he">
									<option value="1">Cao đẳng</option> 
									<option value="2">Trung cấp</option> 	
								</select>
							</td>	
						</tr>
											
						<tr>
							<td >Học kỳ</td>
							<td><select name="hocky" id="hocky">
									<option value="1" >1</option>
									<option value="2" >2</option>
									<option value="3" >3</option>
									<option value="4">4</option>
									<option value="5" >5</option>
									<option value="6">6</option>
								</select>
							</td>
						</tr>
						
                      
                      
                    </table>
			</center>		
			<?php
					
			?>
			 <table class="table" border="1"  >
          		<h3 class="style1" id="title"></h3>
	          	<thead>
					<tr >
					  <th width="29" ><center> STT</center> </th>
					  <th width="59" ><center>
					    Mã MH 
					  </center></th>
 					  <th width="200"  ><center>Tên Môn</center></th>
					   <th width="30"><center>TC</center></th>
					  <th width="30">LT</th>
					  <th width="30">BT</th>
					  <th width="30">Th</th>
					  <th width="30">KT</th>
					  <th width="30">Loại</th>
					  <th width="30">Nhóm thực hành</th>
					  <th width="30">Hệ số</th>

					  <th width="100">Các môn đã phân công</th>
					  <th width="30">&nbsp</th>
					</tr>
											
			  </thead>
			  <tbody id="print">
			
			  </tbody>
			</table>	
			<?php 
			 		$sql_DtGiam="SELECT * FROM canbogiam a, doituonggiam b".
								" where a.maCb='".$maCb."'".
								"and a.namHoc='".$namHoc."'".
								"and a.maDt=b.maDt";			
								
					$query_DtGiam = mysqli_query($conn,$sql_DtGiam);
					$num_DtGiam = mysqli_num_rows($query_DtGiam);	
					if ($num_DtGiam>0){
										$row_DtGiam = mysqli_fetch_array($query_DtGiam);
										 echo " ( ".$row_DtGiam["tenDt"]." ) Giảm: ".$row_DtGiam["soTietGiam"]." tiết ";
					}
			
			?>
			<Center>				 		  
						   <form name="form1" method="POST" action="index.php?f=QuanTri_Pccm">
					  <table class="table" border="1"  >
          		<h3 class="style1"> Chi tiết phân công   </h3>

	          	<thead>
					<tr >
					  <th width="33"  align="center"  rowspan="2" > STT </th>
					  <th width="143"rowspan="2"><center>Lớp</center></th>
 					  <th width="45" rowspan="2"  ><center>Số lượng</center></th>
				  	  <th width="184"  rowspan="2"><center>Môn học</center></th>
					  <th width="31" rowspan="2" ><center>
					    <p>Tín </p>
					    <p>chỉ</p>
					  </center></th>
					  <th colspan="2"  ><center>Số tiết</center></th>
					  <th colspan="3"  ><center>
					    <p>Thực dạy</p>
					    </center></th>
					  <th width="28"   rowspan="2"><center>
					    <p>NC</p>
					    <p>KH</p>
					  </center></th>				  
  					  <th width="22" rowspan="2" ><center>
  					    <p>CV</p>
  					    <p>HT</p>
  					  </center></th>				  
					  <th width="39"  rowspan="2" ><center>
					    <p>Đoàn</p>
					    <p> thể</p>
					  </center></th>				  
  					  <th width="36"  rowspan="2"><center>
  					    <p>Chức</p>
  					    <p> vụ</p>
  					  </center></th>				  
 					  <th width="39"  rowspan="2" ><center>Hoạt động khác</center>  </th>				  
   					  <th width="54" rowspan="2" ><center>Tổng qui đổi</center></th>				     					  
					  <th width="50" rowspan="2">&nbsp;  </th>
					</tr>
					<tr >						
						
					  <th width="39"><center>
					     HK1
					  </center></th>
					  <th width="36"><center>
					     HK2
					  </center></th>
					  <th width="49"><center> LT</center></th>
					  <th width="41"><center> BT</center></th>
					  <th width="41"><center> TH</center></th>
					  		
						
						
					</tr>
			  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;	
					$tong=0;
					$tongHk1=0;											 						 						 
					$tongHk2=0;											 						 						 
					$tongLt=0;		
					$tongBt=0;											 						 						 
					$tongTh=0;											 						 						 
/*					$sql_hienThi = 	"SELECT * FROM chuongtrinhhoc cth, monhoc mh, nganh n ".
									" Where cth.maNganh like '%".$maNganh."%'" .
									 "	 and cth.he = '".$he."'" .
									 "	 and sttKhoa like '%".$sttKhoa."%'" .						 
									 "	 and hocKi = '".$hk."'" .						 
									 "	 and namHoc like '%".$namHoc."%'".
									 "	 and cth.maMon=mh.maMon".
									 "	 and cth.maNganh=n.maNganh".
									" ORDER BY cth.namHoc, cth.hocKi ASC ";*/
									
					$sql_hienThi= "SELECT * FROM pcday d, lop l, monhoc mh".
								" where d.maLop=l.malop".
								" and d.maCb='".$maCb."'".
								" and d.namHoc='".$namHoc."'".
								" and d.maMon=mh.maMon";
									
					$sql_hienThi1="SELECT * FROM nckh nc".
								" where nc.maCb='".$maCb."'".
								"and nc.namHoc='".$namHoc."'";			
								
					$query1 = mysqli_query($conn,$sql_hienThi1);
					$num_rows = mysqli_num_rows($query1);	
					$nc=0;				
					if ($num_rows>0) $nc=1;//có nckh thì bật biến nc=1
					
					
					/////Tap bai giang
					$sql_hienThi2="SELECT * FROM tapbaigiang tbg".
								" where tbg.maCb='".$maCb."'".
								"and tbg.namHoc='".$namHoc."'";			
								
					$query2 = mysqli_query($conn,$sql_hienThi2);
					$num_rows2 = mysqli_num_rows($query2);	
					$tbg=0;				
					if ($num_rows2>0) $tbg=1;//có nckh thì bật biến nc=1
					$query = mysqli_query($conn,$sql_hienThi);
					$i=0;

					while ($row = mysqli_fetch_array($query)) {		
						$so=giao_an($row["maCb"],$row["maMon"],$row["namHoc"]);
						if($so>=3) $i=$i+1;;
						if ($row["he"]==1) $he="CĐ";else $he="TC";						
					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td width="143"><?php echo $he." ".$row["tenLop"]."-K".$row["sttKhoa"]; ?></td>	
						  <td><?php echo $row["siSo"]; ?></td>	
						  <td width="184"><?php echo $row["tenMon"]; ?></td>	
  						  <td><?php echo $row["soTc"]; ?></td>	
						  <td><?php if ($row["hocKi"]==1){ 
						  					$tongHk1+=$row["soTietLt"]+$row["soTietTh"]+$row["soTietBt"]+$row["soTietKt"];
											echo $row["soTietLt"]+$row["soTietTh"]+$row["soTietBt"]+$row["soTietKt"]; 
						  			}else echo " "; ?></td>	
						  <td><?php if ($row["hocKi"]==2){
						  						   echo $row["soTietLt"]+$row["soTietTh"]+$row["soTietBt"]+$row["soTietKt"]; 
	   						  					$tongHk2+=$row["soTietLt"]+$row["soTietTh"]+$row["soTietBt"]+$row["soTietKt"];
									}else echo " "; ?></td>	
					  	  <td><?php $tongLt+=$row["soTietLt"]; echo $row["soTietLt"]; ?></td>	
  					  	  <td><?php $tongBt+=$row["soTietBt"]; echo $row["soTietBt"]; ?></td>	
						  <td><?php  $tongTh+=$row["soTietTh"]+$row["soTietKt"];echo $row["soTietTh"]+$row["soTietKt"]; ?></td>	
						  <td ><?php  if ($nc==1){
						  							echo "NCKH"."<br>" ;
													$nc=0;//Để không in những dòng sau
						  						}
									if ($tbg==1){
						  							echo "TBG";
													$tbg=0;//Để không in những dòng sau
						  						}			
												
												 ?></td>	
						  <td><?php echo " " ?></td>
						  <td><?php  echo ""; ?></td>			
  						  <td><?php "" ?></td>			
   						  <td><?php "" ?></td>	
						  <td><?php //////Tổng qui đổi, nếu trung cấp hệ =2, cao đẳng hệ =1
						  		$tongtam=0;
								$lt=$row["soTietLt"];
								if ($i>=3) $lt=	$row["soTietLt"]*0.7;
									if ($row["siSo"]<=50)echo $tongtam=($lt+$row["soTietTh"]+$row["soTietBt"]+$row["soTietKt"]);
										else if ($row["siSo"]<=70)
											echo $tongtam=($lt+$row["soTietTh"]+$row["soTietBt"]+$row["soTietKt"])*1.1;												
										else if ($row["siSo"]<=90)
											echo $tongtam=($lt+$row["soTietTh"]+$row["soTietBt"]+$row["soTietKt"])*1.2;
										else if ($row["siSo"]<=110)
											echo $tongtam=($lt+$row["soTietTh"]+$row["soTietBt"]+$row["soTietKt"])*1.3;																								
										else if ($row["siSo"]<=130)
											echo $tongtam=($lt+$row["soTietTh"]+$row["soTietBt"]+$row["soTietKt"])*1.4;												
										else
											echo $tongtam=($lt+$row["soTietTh"]+$row["soTietBt"]+$row["soTietKt"])*1.5;												

								$tong+=$tongtam;	
						  
						  
						   ?></td>			
						    
						  <td>						
							  
							  <?php
							  	$chuoi=$row["maCb"]."+".$row["maLop"]."+".$row["maMon"]."+".$row["hocKi"]."+".$row["namHoc"];

								
							 ?>

							 <input type="image" name="btn_xoa" onClick="return confirmAction()" value="<?php echo  $chuoi;?>"src="img/delete.png" width="20" height="20">	
							 <a><?php if ($i>=3) echo "Giáo án 3"; ?></a>	
						  </td>
						</tr>					
			  <?php }  ?>	
			  <?php 
			  /////CVHT
					$sql_Covan="SELECT * FROM cvht, lop".
								" where maCb='".$maCb."'".
								"and namHoc='".$namHoc."'".
								"and cvht.maLop=lop.maLop";
								
					$query_Covan = mysqli_query($conn,$sql_Covan);				
					while ($row_Covan = mysqli_fetch_array($query_Covan)) {		?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td width="143">&nbsp;</td>	
						  <td>&nbsp;</td>	
						  <td width="184">&nbsp;</td>	
  						  <td>&nbsp;</td>	
						  <td>&nbsp;</td>	
						  <td>&nbsp;</td>	
					  	  <td>&nbsp;</td>	
						  <td>&nbsp;</td>	
						  <td >&nbsp;</td>
  						  <td >&nbsp;</td>	
						  <td colspan="4"><?php echo $row_Covan["tenLop"]."-K".$row_Covan["sttKhoa"]; ?></td>
						  <td><?php //////Tổng qui đổi, nếu trung cấp hệ =2, cao đẳng hệ =1
						  		$tongtam=62.4;
									echo 62.4;
								$tong+=$tongtam;	
						    ?></td>			

						  <td>						
							  
							

							
						  </td>
						</tr>		
			  
						  
			  
			    <?php }?>
				
				 <?php 
			  /////Chuc vu
					$sql_ChucVu="SELECT * FROM chucvugiangvien a, chucvu b".
								" where a.maCb='".$maCb."'".
								"and b.maCv=a.maCv";
								
					$query_ChucVu = mysqli_query($conn,$sql_ChucVu);				
					while ($row_ChucVu = mysqli_fetch_array($query_ChucVu)) {		?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td width="143">&nbsp;</td>	
						  <td>&nbsp;</td>	
						  <td width="184">&nbsp;</td>	
  						  <td>&nbsp;</td>	
						  <td>&nbsp;</td>	
						  <td>&nbsp;</td>	
					  	  <td>&nbsp;</td>	
						  <td>&nbsp;</td>	
						  <td >&nbsp;</td>	
						  <td >&nbsp;</td>	
  						  <td >&nbsp;</td>	
						  <td colspan="3"><?php echo $row_ChucVu["tenCv"]; ?></td>
						  <td><?php //////Tổng qui đổi, nếu trung cấp hệ =2, cao đẳng hệ =1
						  		$tongtam=$row_ChucVu["soTiet"];
									echo $row_ChucVu["soTiet"];
								$tong+=$tongtam;	
						    ?></td>			

						  <td>						
							  
							

							
						  </td>
						</tr>		
			  
						  
			  
			    <?php }?>
				
				
			  <tr>
			  	<td colspan="4" align="center"> <b>Tổng số</b></td>
				<td></td>
				<td><b><?php echo $tongHk1?></b> </td>
				<td><b><?php echo $tongHk2?></b> </td>
				<td><b><?php echo $tongLt?> </b></td>
				<td><b><?php echo $tongBt?> </b></td>
				<td><b><?php echo $tongTh?></b> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td><b><?php echo $tong?></b> </td>

				<td></td>
			  </tr>				
			  </tbody>
			</table>	
</form>
      	</div>

    	</div>	
<?php 	require_once("footer.php");?>
</div><!--end wrapper--> 
</body>
</html>
<script>
	$(document).ready(function () {
		//title()
		get_table()
	// 	$('.cc').on('click', function () {
	// 	// var heso = $(this).closest('tr').find('.heso').val();
	// 	// console.log(heso)
	// 	console.log('123')
	// });
		
		
	});
	$('#lop').on('change', function () {
		//title()
		get_table()
	});
	$('#hocky').on('change', function () {
		get_table()
	});
	$('#he').on('change',function (){
		get_table()
	})

	// function title()
	// {
	// 	$('#title').html('Chương trình học của lớp '+$('#lop').text())
	// }
	function get_table()
	{
		var nganh=$('#lop').val()
		var he=$('#he').val()
		var hocki=$('#hocky').val()

		$.ajax({
			type: "post",
			url: "index.php?f=function",
			data: {
				"action":"get_table",
				"nganh":nganh,
				"he":he,
				"hocki":hocki
			},
			success: function (response) {
				$('#print').html(response)
			}
		});
	}


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
					get_table()
			
			}
		});
	}
	function del(e)
	{
		console.log(e)
		$.ajax({
			type: "post",
			url: "index.php?f=function",
			data: {"data":e,
			"action":"xoa_phan_cong"
			},

			success: function (response) {
				if(response=="ok")
				{
					get_table()
					//location.reload()
				}
					
				// console.log(response)
			}
		});
	}

$("#print").on('click','.cc',function()
{
	//console.log('phancong')
	var he=$(this).closest('tr').find('.heso').val()
	var nhom=$(this).closest('tr').find('.nhom').val() 
	var lythuyet=$(this).closest('tr').find('.soTietLt').text()
	var baitap=$(this).closest('tr').find('.soTietBT').text()
	var thuchanh=$(this).closest('tr').find('.soTietTh').text()
	var kiemtra=$(this).closest('tr').find('.soTietKt').text()
	var hocki=$('#hockiphancong').val()
	var macb=$('#maCB').val()
	var namhoc=$('#namhoc').val()
	var malop=$('#lop').val()
	var mamon=$(this).closest('tr').find('.maMon').text()
	var hockicth=$('#hocky').val()
	$.ajax({
		type: "post",
		url: "index.php?f=function",
		data: {"action":"phan_cong",
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
		'mamon':mamon,
		'hockicth':hockicth
		},
		success: function (response) {
			if(response=='ok')
			{
				//location.reload()
			get_table()
			}
		
		}
	});



})

</script>