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
	$sql="select max(sttKhoa) as khoa from chuongtrinhhoc";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);

	

	isset($_POST["chon"])	? $chon=trim($_POST["chon"])	:	$chon= '';	
	if (isset($_POST["maCb"])) 
		 $maCb	=trim($_POST["maCb"]);
	else if (isset($_SESSION['idMau']) && $_SESSION['idMau']!='') {
		$maCb	= $_SESSION['idMau'];
	}
	else {
			$sql2="select min(maCb) as maCb from canBo";
			$query2 = mysqli_query($conn,$sql2);
			$data2 = mysqli_fetch_array($query2);	
			$maCb=$data2["maCb"];
			}
		
	//////////////////////////////////
	if (isset($_POST["namHoc"])) {		
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
		
	
	//////////////////////////////////
//.	if (isset($_POST["btn_them"])) {					
	//	$address = "QuanTri_pccmGv";
		//header('Location: index.php?f='.$address);	

		//exit;
			//ThemKhGd($conn, $address,$maNganh, $maMon,$he, $sttKhoa, $hk, $namHoc);		
	//}	
	
	if (isset($_POST["btn_xoa"])) {	
			$chuoi=$_POST["btn_xoa"];	  								
			$ma =explode("+",$chuoi);//Tach các cot
			
			$address = "QuanTri_Pccm";
			$maCb=$ma[0];
			XoaPccm($conn, $address, $ma[0],$ma[1],$ma[2],$ma[3],$ma[4]);
			
			
	}	
	
	/*if (isset($_POST["btn_sua"])) {		  								
			if(!isset($_POST["chon"]))
			{
				thongBao("Bạn phải chọn lớp cần sửa thông tin trong bảng bên dưới trước khi ra lệnh chỉnh sửa!"); 
			
			}
			else
			{
				$ma_old = $_POST["chon"];
				$address = "QuanTri_Mon";							
				Sua($conn, $address, $ma_old, $maMon, $tenMon, $soTC, $LT, $TH);		
			}	
	}	
	
	if (isset($_POST["chon"])) {					
		$chon = $_POST["chon"];		
		$sql_chon = "SELECT * ".
				 	" FROM monhoc ".
					" where maMon = '".$chon."'";
		$query_chon = mysqli_query($conn,$sql_chon);
		$data_chon = mysqli_fetch_array($query_chon);	
		$maMon	= $data_chon["maMon"];
		$tenMon = $data_chon["tenMon"];	
		$soTC 	= $data_chon["soTc"];	
		$LT	 	= $data_chon["soTietLt"];	
		$TH 	= $data_chon["soTietTh"];							
	}*/
?>
		<?php 
								$sql="select maBm from canbo where maCb='".$user['ms']."'";
								$query = mysqli_query($conn,$sql);
								$data = mysqli_fetch_array($query);
								
								$sql1="select tenBm from bomon where maBm='".$data['maBm']."'";
								$query1 = mysqli_query($conn,$sql1);
								$data1 = mysqli_fetch_array($query1);
								

					?>			
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action='index.php?f=QuanTri_ThongKe&idMau=<?php echo $maCb; ?>'>
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1">Cán bộ còn thiếu tiết - Bộ môn <font color="#990000"><?php echo $data1["tenBm"]  ?></font> &nbsp;&nbsp;	Năm học: 
							<input type="text" name="namHoc" size="2"  onChange="this.form.submit()" value="<?php echo $namHoc; ?>"> - &nbsp;&nbsp;
							<input type="text" size="2" value="<?php echo ($namHoc+1); ?>" readonly="true">


			
			</h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			
			</center>		
			
			
    	    <table class="table" border="1"  >

	          	<thead>
					<tr >
					  <th width="5" ><center> STT</center> </th>
					  <th width="30" valign="middle">Mã Cán bộ</th>
 					  <th width="60"  ><center>Tên cán bộ</center></th>
					  <th width="20"  ><center>Tổng số tiết</center></th>
					  <th width="20"><center> Số tiết thiếu</center></th>
   					  <th width="20"   ><center>Ghi chú</center></th>				  
					  <th width="50"><center>Đối tượng giảm</center>  </th>
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
					
					
						//Lấy mã lớp đầu tiên
							
								$sql_nganh="select min(maNganh) as maNganh from nganh".
										" where maBm='".$data['maBm']."'";
								$query_nganh = mysqli_query($conn,$sql_nganh);
								$data_nganh = mysqli_fetch_array($query_nganh);
								
						
								$sql_lop="select max(maLop) as maLop from lop".
										" where maNganh='".$data_nganh['maNganh']."'";
								$query_lop = mysqli_query($conn,$sql_lop);
								$data_lop = mysqli_fetch_array($query_lop);

					
					
					
					
					$sql="select maBm from canbo where maCb='".$user['ms']."'";
					$query = mysqli_query($conn,$sql);
					$data = mysqli_fetch_array($query);
					$sql1="select maCb, CONCAT(hoCb,' ',tenCb) as 'ten' from canbo where maBm='".$data['maBm']."'";
					$query = mysqli_query($conn,$sql1);
					while ($row = mysqli_fetch_array($query)) {		
						$tong=0;
						$tongHk1=0;
						$tongHk2=0;											 						 						 
						////So tiết dạyh	
						$sql_hienThi= "SELECT * FROM canbo cb, pcday d, monhoc mh, lop l".
								" where cb.maCb='".$row["maCb"]."'".
								" and cb.maCb=d.maCb".
								" and d.namHoc='".$namHoc."'".
								" and mh.maMon=d.maMon".
								" and l.malop=d.malop";
						$query_hienThi = mysqli_query($conn,$sql_hienThi);		
						while ($row_hienThi=mysqli_fetch_array($query_hienThi)){
							if ($row_hienThi["he"]==2) $tong+=($row_hienThi["soTietLt"]+$row_hienThi["soTietTh"])*0.7;
							else {
									if ($row_hienThi["siSo"]<=50) $tong+=($row_hienThi["soTietLt"]+$row_hienThi["soTietTh"]);
									else if ($row_hienThi["siSo"]<=80) $tong+=($row_hienThi["soTietLt"]+$row_hienThi["soTietTh"])*1.1;
									else $tong+=($row_hienThi["soTietLt"]+$row_hienThi["soTietTh"])*1.2;
							}
							if ($row_hienThi["hocKi"]==1) $tongHk1+=$row_hienThi["soTietLt"]+$row_hienThi["soTietTh"];
							if ($row_hienThi["hocKi"]==2) $tongHk2+=$row_hienThi["soTietLt"]+$row_hienThi["soTietTh"];
							
								
						}//end while row hien thi
						
						$sql_Covan="SELECT * FROM cvht".
								" where maCb='".$row["maCb"]."'".
								"and namHoc='".$namHoc."'";							
						$query_Covan = mysqli_query($conn,$sql_Covan);				
						while ($row_Covan = mysqli_fetch_array($query_Covan)) {	///Cộng cvht
							$tong+=40.5;
						}	//end while co van
						
						///
						/////Chuc vu
						$sql_ChucVu="SELECT * FROM chucvugiangvien a, chucvu b".
								" where a.maCb='".$row["maCb"]."'".
								"and b.maCv=a.maCv";
								
						$query_ChucVu = mysqli_query($conn,$sql_ChucVu);				
						while ($row_ChucVu = mysqli_fetch_array($query_ChucVu)) {
							$tong+=$row_ChucVu["soTiet"];
						
						}//end while chuc vu
						
						///TBG
						/////Tap bai giang
						$sql_hienThi2="SELECT * FROM tapbaigiang tbg".
								" where tbg.maCb='".$row["maCb"]."'".
								"and tbg.namHoc='".$namHoc."'";			
								
						$query2 = mysqli_query($conn,$sql_hienThi2);
						$num_rows2 = mysqli_num_rows($query2);	
					///NCKH				
					$sql_hienThi1="SELECT * FROM nckh nc".
								" where nc.maCb='".$row["maCb"]."'".
								"and nc.namHoc='".$namHoc."'";			
								
					$query1 = mysqli_query($conn,$sql_hienThi1);
					$num_rows = mysqli_num_rows($query1);	
					$nc=0;				
					 $nc=1;//có nckh thì bật biến nc=1


					//Đối tượng giảm

			 		$sql_DtGiam="SELECT * FROM canbogiam a, doituonggiam b".
								" where a.maCb='".$row["maCb"]."'".
								"and a.namHoc='".$namHoc."'".
								"and a.maDt=b.maDt";			
								
					$query_DtGiam = mysqli_query($conn,$sql_DtGiam);
					$num_DtGiam = mysqli_num_rows($query_DtGiam);	
					
					if ($tong<390){
						$s_thieu=390-$tong;				
						
					?>
						<tr>
						  <th  width="5" scope="row"><?php echo $stt++ ?></th>
						  <td width="30"><?php echo $row["maCb"]; ?></td>	
						  <td width="100"><a href="index.php?f=QuanTri_Pccm&idMau=<?php $chuoi=$row["maCb"]." ".$namHoc." ".$data_lop["maLop"]; echo $chuoi; ?>" title="<?php if ($tong<270){ $st=$tong-270; echo "Thiếu ".$st." tiết"; } else if ($tong>=270) {$st=$tong-270; echo "Thừa ".$st." tiết";  }?>"><?php echo $row["ten"]; ?></td>	
  						  <td width="20"><center><?php echo $tong; ?></center></td>	
   						  <td width="20"><center><?php echo $s_thieu; ?></center></td>	
						    <td><center><?php if ($num_rows>0) echo "NCKH"."<br>";;	
									  if ($num_rows2>0) echo "TBG"; ?></center></td>	
						<td><center><?php if ($num_DtGiam>0){
										$row_DtGiam = mysqli_fetch_array($query_DtGiam);
										 echo  $row_DtGiam["tenDt"];
					}?></center></td>
						</tr>					
			  <?php } }//end của if ?>	
			  <tr>
			  	<td colspan="4" align="center"><b> Tổng số</b></td>
				<td><b><?php echo --$stt. " giảng viên"; ?> </b></td>
				<td> </td>
				<td> </td>
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