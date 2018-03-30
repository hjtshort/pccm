<?php 
require_once "db.php";
if(isset($_POST['action']) && trim($_POST['action'])=="gettable"){
	$maNganh= addslashes(strip_tags(trim($_POST['nganh'])));
	$he= addslashes(strip_tags(trim($_POST['he'])));
	$sttKhoa=addslashes(strip_tags(trim($_POST['sttKhoa'])));
	$hk=addslashes(strip_tags(trim($_POST['hocky'])));
	$namHoc=addslashes(strip_tags(trim($_POST['namhoc'])));
	echo hienthitable($maNganh,$he,$sttKhoa,$hk,$namHoc);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="delete"){
	 $data=explode("+",addslashes(strip_tags(trim($_POST['data']))));
	 deletecth($data[0],$data[1],$data[2],$data[3],$data[4],$data[5]);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="insertcth"){
	$maNganh= addslashes(strip_tags(trim($_POST['nganh'])));
	$he= addslashes(strip_tags(trim($_POST['he'])));
	$sttKhoa=addslashes(strip_tags(trim($_POST['sttKhoa'])));
	$hk=addslashes(strip_tags(trim($_POST['hocky'])));
	$namHoc=addslashes(strip_tags(trim($_POST['namhoc'])));
	$maMon=addslashes(strip_tags(trim($_POST['mamon'])));
	insertcth($maNganh,$maMon,$he,$sttKhoa,$hk,$namHoc);
}
else{

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
		$chuoi=$row["maNganh"]."+".$row["maMon"]."+".$row["he"]."+".$row["sttKhoa"]."+".$row["hocKi"]."+".$row["namHoc"];		
		$t.='<tr>
				<td scope="row">'. $stt++ .'</td>
				<td>'. $row["tenNganh"].' </td>	
				<td>'. $row["sttKhoa"].'</td>	
				<td>'. $row["hocKi"].'</td>	
				<td>'. $row["namHoc"].'</td>
				<td>'. $row["tenMon"].'</td>			
				<td>'. $row["soTc"].'</td>			
				<td>
				<button type="button" onclick="del(\''.$chuoi.'\')" style="border:none; background-color:transparent"> <img src="img/delete.png" width="20" height="20" ></button>							
		</td>
	  </tr>	';
	}
	return $t.'  <tr>
	<td colspan="6" align="center"> Tổng số</td>
	<td>'.$tong.' </td>
	</tr>';
}
//xóa môn học trong bảng chương trình học
function deletecth($maNganh,$maMon,$he,$sttKhoa,$hocKi,$namHoc){
	$db=new db();
	$query=$db->mysql->query("DELETE FROM `chuongtrinhhoc` WHERE maNganh=$maNganh and maMon='$maMon' and he=$he and sttKhoa=$sttKhoa and hocKi=$hocKi and namHoc=$namHoc");
	if($query)
		echo 'ok';
	else
		echo 'error';
}
function insertcth($maNganh,$maMon,$he,$sttKhoa,$hocKi,$namHoc)
{
	$db=new db();
	$query=$db->mysql->query("INSERT INTO `chuongtrinhhoc`(`maNganh`, `maMon`, `he`, `sttKhoa`, `hocKi`, `namHoc`) VALUES ($maNganh,N'$maMon',$he,$sttKhoa,$hocKi,$namHoc)");
	if($query)
		echo 'ok';
	else
		echo 'error';
}
function getvalue(){
	$db=new db();
	$value=array();
	$data=$db->mysql->query("select maMon from monhoc");
	while($row=$data->fetch_assoc()){
		array_push($value,$row['maMon']);
	}
	return $value;
}	
?>