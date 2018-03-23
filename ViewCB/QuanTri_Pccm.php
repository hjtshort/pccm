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
	require_once("ViewCb/header.php");
	$now=getdate();
	$nh1=$now["year"];
	
	///Lấy khóa lớn nhất
	$sql="select max(sttKhoa) as khoa from chuongtrinhhoc";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
	$khoa_max=$data["khoa"];
	$khoa_max1=$khoa_max-1;
	$khoa_max2=$khoa_max-2;
	

	
	$chuoi	= $_SESSION['idMau'];
	$ma =explode(" ",$chuoi);//Tach các cot
	$maCb=$ma[0]; 
	$namHoc=$ma[1];

			
	isset($_POST["tim_lop"])? $tim_lop=trim($_POST["tim_lop"]):	$tim_lop= '';		
	isset($_POST["maLop"]) 	? $maLop=trim($_POST["maLop"])	:	$maLop= $ma[2];	
	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= '';	
	

	
	$sql="select CONCAT(hoCb,' ',tenCb) as ten from canbo where maCb='".$maCb."'";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
	
	$sql1="select maBm from canbo where maCb='".$maCb."'";
	$query1 = mysqli_query($conn,$sql1);
	$data1 = mysqli_fetch_array($query1);
	$maBm=$data1["maBm"];
	

		
	
	
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action='index.php?f=QuanTri_Pccm&idMau=<?php echo $maCb." ".$namHoc." ".$maLop; ?>'>
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1">Chi tiết phân công cán bộ<font color="#990000">  <?php echo $data["ten"];	?></font> <font size="-1"></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
			<font color="#FF00FF">Năm học:<?php echo $namHoc."-"; echo $namHoc+1;?> </font></h3>

			
					
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
					
					  <table class="table" border="1"  vspace="true" >


	          	<thead>
					<tr >
					  <th width="33"  align="center"  rowspan="2" > STT </th>
					  <th width="208" rowspan="2"><center>Lớp</center></th>
 					  <th width="46" rowspan="2"  ><center>Số lượng</center></th>
				  	  <th width="210"  rowspan="2"><center>Môn học</center></th>
					  <th width="31" rowspan="2" ><center>Tín chỉ</center></th>
					  <th colspan="2"  ><center>Số tiết</center></th>
					  <th colspan="2"  ><center>
					    Thực dạy
					  </center></th>
					  <th width="50"   rowspan="2"><center>
					    <p>NC</p>
					    <p>KH</p>
					  </center></th>				  
  					  <th width="35" rowspan="2" ><center>
  					    <p>CV</p>
  					    <p>HT</p>
  					  </center></th>				  
					  <th width="53"  rowspan="2" ><center>
					    <p>Đoàn</p>
					    <p> thể</p>
					  </center></th>				  
  					  <th width="48"  rowspan="2"><center>
  					    <p>Chức</p>
  					    <p> vụ</p>
  					  </center></th>				  
 					  <th width="56"  rowspan="2" ><center>
 					    <p>Hoạt</p>
 					    <p> động </p>
 					    <p>khác</p>
 					  </center>  </th>				  
   					  <th width="106" rowspan="2" ><center>
   					    <p>Tổng</p>
   					    <p> qui</p>
   					    <p> đổi</p>
   					  </center></th>				  
   					  <th width="38"  rowspan="2" ><center>
   					    <p>Ghi </p>
   					    <p>chú</p>
   					  </center></th>				  

					</tr>
					<tr >						
						
					  <th width="30"><center>
					     HK1
					  </center></th>
					  <th width="35"><center>
					     HK2
					  </center></th>
					  <th width="47"><center> LT</center></th>
					  <th width="50"><center> TH</center></th>					
						
						
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
						  <th scope="row" width="33"><?php echo $stt++ ?></th>
						  <td width="208"><?php echo $he." ".$row["tenLop"]."-K".$row["sttKhoa"]; ?></td>	
						  <td width="46"><?php echo $row["siSo"]; ?></td>	
						  <td width="210"><?php echo $row["tenMon"]; ?></td>	
  						  <td width="31"><?php echo $row["soTc"]; ?></td>	
						  <td width="30"><?php if ($row["hocKi"]==1){ 
						  					$tongHk1+=$row["soTietLt"]+$row["soTietTh"];
											echo $row["soTietLt"]+$row["soTietTh"]; 
						  			}else echo " "; ?></td>	
						  <td width="35"><?php if ($row["hocKi"]==2){
						  						   echo $row["soTietLt"]+$row["soTietTh"]; 
	   						  					$tongHk2+=$row["soTietLt"]+$row["soTietTh"];
									}else echo " "; ?></td>	
					  	  <td width="47"><?php $tongLt+=$row["soTietLt"]; echo $row["soTietLt"]; ?></td>	
						  <td width="50"><?php  $tongTh+=$row["soTietTh"];echo $row["soTietTh"]; ?></td>	
						  <td width="50" ><?php  if ($nc==1){
						  							echo "NCKH"."<br>" ;
													$nc=0;//Để không in những dòng sau
						  						}
									if ($tbg==1){
						  							echo "TBG";
													$tbg=0;//Để không in những dòng sau
						  						}			
												
												 ?></td>	
						  <td width="35"><?php echo " " ?></td>
						  <td width="53"><?php  echo ""; ?></td>			
  						  <td width="48"><?php "" ?></td>			
   						  <td width="56"><?php "" ?></td>	
						  <td width="106"><center><?php //////Tổng qui đổi, nếu trung cấp hệ =2, cao đẳng hệ =1
						  		$tongtam=0;
						  		if ($row["he"]==2) echo $tongtam=($row["soTietLt"]+$row["soTietTh"])*0.7;
								else {
										if ($row["siSo"]<=50)echo $tongtam=($row["soTietLt"]+$row["soTietTh"]);
										else if ($row["siSo"]<=80)
											echo $tongtam=($row["soTietLt"]*1.1+$row["soTietTh"]);												
										else 	echo $tongtam=($row["soTietLt"]*1.2+$row["soTietTh"]);
									}	
								$tong+=$tongtam;	
						  
						  
						   ?></center></td>			
						    <td width="38"><?php "" //Cot ghi chu?></td>	
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
						  <th scope="row" width="33"><?php echo $stt++ ?></th>
						  <td width="208">&nbsp;</td>	
						  <td width="46">&nbsp; </td>	
						  <td width="210">&nbsp;</td>	
  						  <td width="31">&nbsp;</td>	
						  <td width="30">&nbsp;</td>	
						  <td width="35">&nbsp;</td>	
					  	  <td width="47">&nbsp;</td>	
						  <td width="50">&nbsp;</td>	
						  <td width="50">&nbsp;</td>	
						  <td colspan="4"><?php echo $row_Covan["tenLop"]; ?></td>
						  <td width="106"><center><?php //////Tổng qui đổi, nếu trung cấp hệ =2, cao đẳng hệ =1
						  		$tongtam=40.5;
									echo 40.5;
								$tong+=$tongtam;	
						    ?></center></td>			
						    <td width="38"><?php "" //Cot ghi chu?></td>	
						 
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
						  <th scope="row" width="33"><?php echo $stt++ ?></th>
						  <td width="208">&nbsp;</td>	
						  <td width="46">&nbsp;</td>	
						  <td width="210">&nbsp;</td>	
  						  <td width="31">&nbsp;</td>	
						  <td width="30">&nbsp;</td>	
						  <td width="35">&nbsp;</td>	
					  	  <td width="47">&nbsp;</td>	
						  <td width="50">&nbsp;</td>	
						  <td width="50">&nbsp;</td>	
						  <td width="35">&nbsp;</td>	
						  <td colspan="3"><?php echo $row_ChucVu["tenCv"]; ?></td>

						  <td width="106"><center><?php //////Tổng qui đổi, nếu trung cấp hệ =2, cao đẳng hệ =1
						  		$tongtam=$row_ChucVu["soTiet"];
									echo $row_ChucVu["soTiet"];
								$tong+=$tongtam;	
						    ?></center></td>			

						  <td width="38">						  </td>
						</tr>		
			  
						  
			  
			    <?php }?>
				
				
			  <tr>
			  	<td colspan="5" align="center"> <b>Tổng số</b></td>
				<td><b><center><?php echo $tongHk1 ?> </b></center></td>
				<td><b><center><?php echo $tongHk2?></b></center> </td>
				<td><b><center><?php echo $tongLt?> </b></center></td>
				<td><b><center><?php echo $tongTh?></b></center> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td><b><center><?php echo $tong?></b></center> </td>
				<td> </td>

			  </tr>				
			  </tbody>
			</table>	
    	  
      	</div>
 
    	</div>
		
		

		
	
	

	
	
<?php 	require_once("footer.php");?>
</div><!--end wrapper--> 
</body>
</html>