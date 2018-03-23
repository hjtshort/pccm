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
			
			$address = "QuanTri_Pccm";
			XoaPccm($conn, $address, $ma[0],$ma[1],$ma[2],$ma[3],$ma[4]);
			
			
	}	
	
	
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action='index.php?f=QuanTri_Pccm&idMau=<?php echo $maCb." ".$namHoc." ".$maLop; ?>'>
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1">Phân công cán bộ<font color="#990000" >  <?php echo $data["ten"];	?></font> <font size="-1"><a href="index.php?f=QuanTri_ChiTietGv&idMau=<?php $chuoi=$maCb." ".$namHoc." ".$maLop; echo $chuoi; ?>"> <img src="img/Edit.png" width="20" height="20" title="Chi tiết phân công" /></a></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
			<font color="#FF00FF">Năm học:<?php echo $namHoc."-"; echo $namHoc+1;?> </font></h3>

			
					
			        <table width="800" border="1" >
					
					 <tr>
                         <td width="200"> Lớp thuộc bộ môn: </td>									
                         <td>        
							<select name="maLop" onChange="this.form.submit()">
                            <?php														
									if($maLop!= '' && $tim_lop=='')
									{								
										$sql7 = "SELECT * FROM lop ".
												" WHERE maLop= '".$maLop."'";												
										$query7 = mysqli_query($conn,$sql7);
										$data7 = mysqli_fetch_array($query7);									
										
										$sql_dem="select count(*) as sl from chuongtrinhhoc cth".
										   " where cth.maNganh='".$data7['maNganh']."'".
										   " and  cth.he='".$data7['he']."'".
						   					" and cth.sttKhoa='".$data7['sttKhoa']."'".
										   " and cth.namHoc='".$namHoc."'".
									   " and cth.maMon not in (select maMon from pcday".
									   " where maLop='".$data7['maLop']."')";
									
						   
										$query_dem = mysqli_query($conn,$sql_dem);
										$row_sl = mysqli_fetch_array($query_dem);
										
									 ?>
									 
									 
                            <option value='<?php echo $data7["maLop"]; ?>'><?php echo $data7["tenLop"]." - K".$data7["sttKhoa"]." (". $row_sl["sl"]." môn)"; ?></option>
                            <?php } 	
										$sql8 = "SELECT * FROM lop ".
												" WHERE maLop!= '".$maLop."'".
												" and (sttKhoa= '".$khoa_max."'".
												" or sttKhoa= '".$khoa_max1."'".
												" or sttKhoa= '".$khoa_max2."')".
												" and maNganh in (select maNganh from nganh n".
												" where n.maBm='".$maBm."')".
												" order by sttKhoa desc";
																		
										$query8 = mysqli_query($conn,$sql8);
									
										while ($data8 = mysqli_fetch_array($query8)) {
											
										$sql_dem_8="select count(*) as sl from chuongtrinhhoc cth".
										   " where cth.maNganh='".$data8['maNganh']."'".
										   " and  cth.he='".$data8['he']."'".
						   					" and cth.sttKhoa='".$data8['sttKhoa']."'".
										   " and cth.namHoc='".$namHoc."'".
									   " and cth.maMon not in (select maMon from pcday".
									   " where maLop='".$data8['maLop']."')";
									
						   
										$query_dem_8 = mysqli_query($conn,$sql_dem_8);
										$row_sl_8 = mysqli_fetch_array($query_dem_8);
									

									  ?>
                            <option value='<?php echo $data8["maLop"]; ?>'><?php echo $data8["tenLop"]." - K".$data8["sttKhoa"]." (".$row_sl_8["sl"]." môn)"; ?></option>
                            <?php } ?>
                          </select>
<!--                        <span class="tim"> (Tìm <input type="text" name="tim_lop" size="15"  onChange="this.form.submit()" value="<?php echo $tim_lop; ?>"> ) </span>-->
						
						<a href="index.php?f=QuanTri_Lop1&idMau=<?php $chuoi=$maCb." ".$namHoc; echo $chuoi; ?>" title="Chọn lớp theo khoa"> Tất cả các lớp </a>
						</td>   
                      </tr>
					 
					 
                     
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      
                      
                    </table>
			</center>		
			<?php
				$sql="select * from lop".
						" where maLop='".$maLop."'";
				$query = mysqli_query($conn,$sql);
				$data = mysqli_fetch_array($query);
					
			?>
			 <table class="table" border="1"  >
          		<h3 class="style1"> Danh sách môn học chưa phân công thuộc Lop <?php echo $data["tenLop"]."-K".$data["sttKhoa"];?>   </h3>
	          	<thead>
					<tr >
					  <th width="29" ><center> STT</center> </th>
					  <th width="59" ><center>
					    Mã MH 
					  </center></th>
 					  <th width="325"  ><center>Tên Môn</center></th>
   					  <th width="77"  ><center>Học kì</center></th>
   					  <th width="71"  ><center>Năm học</center></th>
					  <th width="45" >&nbsp; </th>
					  <th width="250">Các môn đã phân công</th>
					</tr>
											
			  </thead>
			  <tbody>
				  <?php
				  	//B2: HIỂN THỊ
					$stt = 1 ;	
					$tong=0;
/*					$sql_hienThi = 	"SELECT * FROM chuongtrinhhoc cth, monhoc mh, nganh n ".
									" Where cth.maNganh like '%".$maNganh."%'" .
									 "	 and cth.he = '".$he."'" .
									 "	 and sttKhoa like '%".$sttKhoa."%'" .						 
									 "	 and hocKi = '".$hk."'" .						 
									 "	 and namHoc like '%".$namHoc."%'".
									 "	 and cth.maMon=mh.maMon".
									 "	 and cth.maNganh=n.maNganh".
									" ORDER BY cth.namHoc, cth.hocKi ASC ";
									
					$sql_hienThi= "SELECT * FROM pcday d, lop l, monhoc mh".
								" where d.maLop=l.malop".
								" and d.maCb='".$maCb."'".
								" and d.namHoc='".$namHoc."'".
								" and d.maMon=mh.maMon";*/
					


					
					
					
					
					
						
					$sql1="select * from chuongtrinhhoc cth, monhoc mh".
						   " where cth.maNganh='".$data['maNganh']."'".
						   " and  cth.he='".$data['he']."'".
						   " and cth.sttKhoa='".$data['sttKhoa']."'".
						   " and cth.namHoc='".$namHoc."'".
						   " and cth.maMon=mh.maMon".
						   " and cth.maMon not in (select maMon from pcday".
						   " where maLop='".$maLop."')".
						   " order by cth.hocKi";
					$j=1;	   
					$query = mysqli_query($conn,$sql1);
					$rowcount=mysqli_num_rows($query);
					while ($row = mysqli_fetch_array($query)) {		

					?>
						<tr>
						  <th scope="row"  width="29"><?php echo $stt++ ?></th>
						  <td width="59"><?php echo $row["maMon"]; ?></td>	
						  <td width="325"><?php echo $row["tenMon"]; ?></td>	
						  <td width="77"><center><?php echo $row["hocKi"]; ?></center></td>	
 						  <td width="71"><center><?php echo $row["namHoc"]; ?></center></td>	
				    
						  <td width="45"><center>						
							  
							  <?php
							  	$chuoi=$maCb."+".$maLop."+".$row["maMon"]."+".$row["hocKi"]."+".$row["namHoc"];
							 ?>

							 <input type="image" name="btn_them" title="Thêm phân công"  value="<?php echo  $chuoi;?>"src="img/add_2.png" width="20" height="20">		</center>
						  </td>
						  	<?php 
								$sql_mon= "SELECT * FROM pcday d, lop l, monhoc mh".
											" where d.maLop=l.malop".
											" and d.maCb='".$maCb."'".
											" and d.namHoc='".$namHoc."'".
											" and d.maMon=mh.maMon";
								$query_mon = mysqli_query($conn,$sql_mon);
			
									
							if ($j==1){?>
							<td rowspan="<?php echo $rowcount+1?>" width="250"> <?php 
																		$tt=1;
																		while ($row_mon = mysqli_fetch_array($query_mon)){ ?>
																			<input type="text" size="30" value="<?php  echo $tt." ".$row_mon["tenMon"];?>" title="<?php  echo "Lớp ".$row_mon["tenLop"]."-K ".$row_mon["sttKhoa"];?>" />
																			
						  <?php																
																				echo "<br>"; 
																				$tt++;} 			?></td>
							<?php $j++; }?>
						</tr>		
									
			  <?php }  ?>	
			  
			  <tr>
			  	<td colspan="4" align="center"> Tổng số</td>
				<td colspan="2"  ><?php echo --$stt. "  môn học"; ?> </td>
				
				
			  </tr>				
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
					  <th colspan="2"  ><center>
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
						  <td width="143"><?php echo $he." ".$row["tenLop"]."-K".$row["sttKhoa"]; ?></td>	
						  <td><?php echo $row["siSo"]; ?></td>	
						  <td width="184"><?php echo $row["tenMon"]; ?></td>	
  						  <td><?php echo $row["soTc"]; ?></td>	
						  <td><?php if ($row["hocKi"]==1){ 
						  					$tongHk1+=$row["soTietLt"]+$row["soTietTh"];
											echo $row["soTietLt"]+$row["soTietTh"]; 
						  			}else echo " "; ?></td>	
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

							 <input type="image" name="btn_xoa" onClick="return confirmAction()" value="<?php echo  $chuoi;?>"src="img/delete.png" width="20" height="20">		
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