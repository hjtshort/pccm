<?php 
require_once "db.php";
if(trim($_POST['action']=="gettable")){
	echo hienthitable($_POST['nganh'],$_POST['he'],$_POST['sttKhoa'],$_POST['hocky'],$_POST['namhoc']);
	//<input type="image" name="btn_xoa"  value="<?php echo  $chuoi;"src="img/delete.png" width="20" height="20">
}
//Lấy dữ liệu table
function hienthitable($maNganh,$he,$sttKhoa,$hk,$namHoc)
{
    $db=new db();
    $sql_hienThi = 	"SELECT * FROM chuongtrinhhoc cth, monhoc mh, nganh n ".
									" Where cth.maNganh = '".$maNganh."'" .
									 "	 and cth.he = '".$he."'" .
									 "	 and sttKhoa = '".$sttKhoa."'" .						 
									 "	 and hocKi = '".$hk."'" .						 
									 "	 and namHoc = '".$namHoc."'".
									 "	 and cth.maMon=mh.maMon".
									 "	 and cth.maNganh=n.maNganh".
                                    " ORDER BY cth.namHoc, cth.hocKi ASC ";

	$data=$db->mysql->query($sql_hienThi);
	$t="";
	$tong=0;
	$stt=1;
	while($row=$data->fetch_assoc()){
		$tong+=intval($row["soTc"]);
		$t.='<tr>
				<td scope="row">'. $stt++ .'</td>
				<td>'. $row["tenNganh"].' </td>	
				<td>'. $row["sttKhoa"].'</td>	
				<td>'. $row["hocKi"].'</td>	
				<td>'. $row["namHoc"].'</td>
				<td>'. $row["tenMon"].'</td>			
				<td>'. $row["soTc"].'</td>			
				<td>						
			
				

		   <input type="image" name="btn_xoa" src="img/delete.png" width="20" height="20">		
		</td>
	  </tr>	';
	}
	return $t.'  <tr>
	<td colspan="6" align="center"> Tổng số</td>
	<td>'.$tong.' </td>
	</tr>';
}
//$chuoi=$row["maNganh"]."+".$row["maMon"]."+".$row["he"]."+".$row["sttKhoa"]."+".$row["hocKi"]."+".$row["namHoc"];
	
?>