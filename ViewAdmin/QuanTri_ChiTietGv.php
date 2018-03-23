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
	$now=getdate();
	$nh1=$now["year"];
	
	///Lấy khóa lớn nhất
	$sql="select max(sttKhoa) as khoa from chuongtrinhhoc";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
	$khoa_max=$data["khoa"];
	$khoa_max1=$khoa_max-1;
	$khoa_max2=$khoa_max-2;
	

/*	if (isset($_POST["maLop"]))	 $maLop=trim($_POST["maLop"]);
	 else{	$sql2="select min(malop) as maLop from lop";
			$query2 = mysqli_query($conn,$sql2);
			$data2 = mysqli_fetch_array($query2);	
			$maLop=$data2["maLop"];
	}*/		
	
	$chuoi	= $_SESSION['idMau'];
	$ma =explode(" ",$chuoi);//Tach các cot
	$maCb=$ma[0]; 
	$namHoc=$ma[1];

			
	isset($_POST["tim_lop"])? $tim_lop=trim($_POST["tim_lop"]):	$tim_lop= '';		
	isset($_POST["maLop"]) 	? $maLop=trim($_POST["maLop"])	:	$maLop= $ma[2];	
	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= '';	
	
	/*if (isset($_POST["maCb"])) 
		 $maCb	=trim($_POST["maCb"]);
	else if (isset($_SESSION['idMau']) && $_SESSION['idMau']!='') {
		$maCb	= $_SESSION['idMau'];
	}
	else {
			$sql2="select min(maCb) as maCb from canBo";
			$query2 = mysqli_query($conn,$sql2);
			$data2 = mysqli_fetch_array($query2);	
			$maCb=$data2["maCb"];
			}*/
			
	

	
	$sql="select CONCAT(hoCb,' ',tenCb) as ten from canbo where maCb='".$maCb."'";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
	
	$sql1="select maBm from canbo where maCb='".$maCb."'";
	$query1 = mysqli_query($conn,$sql1);
	$data1 = mysqli_fetch_array($query1);
	$maBm=$data1["maBm"];
	

		
	//////////////////////////////////
	/*if (isset($_POST["namHoc"])) {		
		if( $_POST["namHoc"]=='')
		{		
			$now = getdate();
			$namHoc =  $now["year"]-1; 	
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
			$namHoc =  $now["year"]-1; 	
		}	
		
	*/
	//////////////////////////////////
	if (isset($_POST["btn_them"])) {					
		$chuoi=$_POST["btn_them"];	  								
		$ma =explode("+",$chuoi);//Tach các cot
		$address = "QuanTri_pccm";	
		ThemPccm($conn, $address, $ma[0],$ma[1],$ma[2],$ma[3],$ma[4]);		
	}	
	
	if (isset($_POST["btn_xoa"])) {	
			$chuoi=$_POST["btn_xoa"];	  								
			$ma =explode("+",$chuoi);//Tach các cot
			
			$address = "QuanTri_ChiTietGv";
			XoaPccm($conn, $address, $ma[0],$ma[1],$ma[2],$ma[3],$ma[4]);
			
			
	}	
	
	
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action='index.php?f=QuanTri_ChiTietGv&idMau=<?php echo $maCb." ".$namHoc." ".$maLop; ?>'>
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1">Chi tiết phân công cán bộ<font color="#990000">  <?php echo $data["ten"];	?></font> <font size="-1"></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<font color="#FF00FF">Năm học:<?php echo $namHoc."-"; echo $namHoc+1;?> </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="index.php?f=QuanTri_Pccm&idMau=<?php $chuoi=$maCb." ".$namHoc." ".$maLop; echo $chuoi; ?>"> <img src="img/Re.jpg" width="20" height="20" title="Trở về" /></a></h3>

			
					
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
					
					  <table class="table" border="1"  >
<!--          		<h3 class="style1"> Danh sách các môn học đã phân công   </h3>-->

	          	<thead>
					<tr >
					  <th width="33"  align="center"  rowspan="2" > STT </th>
					  <th width="177"rowspan="2"><center>Lớp</center></th>
 					  <th width="46" rowspan="2"  ><center>Số lượng</center></th>
				  	  <th width="192"  rowspan="2"><center>Môn học</center></th>
					  <th width="38" rowspan="2" ><center>
					    <p>Tín</p>
					    <p> chỉ</p>
					  </center></th>
					  <th colspan="2"  ><center>Số tiết</center></th>
					  <th colspan="2"  ><center>
					    Thực dạy
					  </center></th>
					  <th width="30"   rowspan="2"><center>
					    <p>NC</p>
					    <p>KH</p>
					  </center></th>				  
  					  <th width="22" rowspan="2" ><center>
  					    <p>CV</p>
  					    <p>HT</p>
  					  </center></th>				  
					  <th width="40"  rowspan="2" ><center>
					    <p>Đoàn </p>
					    <p>thể</p>
					  </center></th>				  
  					  <th width="36"  rowspan="2"><center>
  					    <p>Chức</p>
  					    <p> vụ</p>
  					  </center></th>				  
 					  <th width="38"  rowspan="2" ><center>Hoạt động khác</center>  </th>				  
   					  <th width="106" rowspan="2" ><center>
   					    <p>Tổng </p>
   					    <p>qui đổi</p>
   					  </center></th>				  
   					 
					  <th width="41" rowspan="2">&nbsp;  </th>
					</tr>
					<tr >						
						
					  <th width="56"><center> HK 1</center></th>
					  <th width="55"><center> HK 2</center></th>
					  <th width="48"><center> LT</center></th>
					  <th width="37"><center> TH</center></th>					
						
						
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
					while ($row = mysqli_fetch_array($query)) {		
						
						if ($row["he"]==1) $he="CĐ";else $he="TC";						

					?>
						<tr>
						  <th scope="row"><?php echo $stt++ ?></th>
						  <td width="177"><?php echo $he." ".$row["tenLop"]."-K".$row["sttKhoa"]; ?></td>	
						  <td><?php echo $row["siSo"]; ?></td>	
						  <td width="192"><?php echo $row["tenMon"]; ?></td>	
  						  <td><?php echo $row["soTc"]; ?></td>	
						  <td><center><?php if ($row["hocKi"]==1){ 
						  					$tongHk1+=$row["soTietLt"]+$row["soTietTh"];
											echo $row["soTietLt"]+$row["soTietTh"]; 
						  			}else echo " "; ?></center></td>	
						  <td><?php if ($row["hocKi"]==2){
						  						   echo $row["soTietLt"]+$row["soTietTh"]; 
	   						  					$tongHk2+=$row["soTietLt"]+$row["soTietTh"];
									}else echo " "; ?></td>	
					  	  <td><?php $tongLt+=$row["soTietLt"]; echo $row["soTietLt"]; ?></td>	
						  <td><?php  $tongTh+=$row["soTietTh"];echo $row["soTietTh"]; ?></td>	
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
						  		if ($row["he"]==2) echo $tongtam=($row["soTietLt"]+$row["soTietTh"])*0.7;
								else {
										if ($row["siSo"]<=50)echo $tongtam=($row["soTietLt"]+$row["soTietTh"]);
										else if ($row["siSo"]<=80)
											echo $tongtam=($row["soTietLt"]*1.1+$row["soTietTh"]);												
										else 	echo $tongtam=($row["soTietLt"]*1.2+$row["soTietTh"]);
									}	
								$tong+=$tongtam;	
						  
						  
						   ?></td>			

						  <td>						
							  
							  <?php
							  	$chuoi=$row["maCb"]."+".$row["maLop"]."+".$row["maMon"]."+".$row["hocKi"]."+".$row["namHoc"];
							 ?>

							 <input type="image" name="btn_xoa" onClick=" return confirmAction()" value="<?php echo  $chuoi;?>"src="img/delete.png" width="20" height="20">		
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
						  <td width="177">&nbsp;</td>	
						  <td>&nbsp;</td>	
						  <td width="192">&nbsp;</td>	
  						  <td>&nbsp;</td>	
						  <td>&nbsp;</td>	
						  <td>&nbsp;</td>	
					  	  <td>&nbsp;</td>	
						  <td>&nbsp;</td>	
						  <td >&nbsp;</td>	
						  <td colspan="4"><?php echo $row_Covan["tenLop"]."-K".$row_Covan["sttKhoa"];; ?></td>
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
						  <td width="177">&nbsp;</td>	
						  <td>&nbsp;</td>	
						  <td width="192">&nbsp;</td>	
  						  <td>&nbsp;</td>	
						  <td>&nbsp;</td>	
						  <td>&nbsp;</td>	
					  	  <td>&nbsp;</td>	
						  <td>&nbsp;</td>	
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
			  	<td colspan="5" align="center"> <b>Tổng số</b></td>
				<td><b><?php echo $tongHk1 ?> </b></td>
				<td><b><?php echo $tongHk2?></b> </td>
				<td><b><?php echo $tongLt?> </b></td>
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
    	  
      	</div>
 
    	</div>
		
		

		
	
	

	
	
<?php 	require_once("footer.php");?>
</div><!--end wrapper--> 
</body>
</html>