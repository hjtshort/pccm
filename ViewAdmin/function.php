<?php 
require_once "db.php";

if(isset($_POST['action']) && trim($_POST['action'])=="gettable"){
	$maNganh= addslashes(strip_tags(trim($_POST['nganh'])));
	$he= addslashes(strip_tags(trim($_POST['he'])));
	$sttKhoa=addslashes(strip_tags(trim($_POST['sttKhoa'])));
	$hk=addslashes(strip_tags(trim($_POST['hocky'])));
	echo hienthitable($maNganh,$he,$sttKhoa,$hk);
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
	//var_dump($_POST);
	insertcth($maNganh,$maMon,$he,$sttKhoa,$hk,$namHoc);
}
else if(isset($_GET['action']) && trim($_GET['action'])=="xuat")
{
	require "xuat_kh.php";
	$maNganh= addslashes(strip_tags(trim($_GET['nganh'])));
	$sttKhoa=addslashes(strip_tags(trim($_GET['sttKhoa'])));
	$he= addslashes(strip_tags(trim($_GET['he'])));
	$xuat = new xuat_khoahoc($sttKhoa,$maNganh,$he);
	$xuat->xuly();

}
else if (isset($_POST['action']) && trim($_POST['action'])=="laymonhoc"){
	laymonhoc($_POST['nganh'],$_POST['he']);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="laymonhocnganh"){
	laymonhoc2($_POST['nganh']);	
}
else if(isset($_POST['action']) && trim($_POST['action'])=="themmontienquyet"){
	themmontienquyet($_POST['monhoc'],$_POST['monhoctq']);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="laybang"){
	laybang();
}
else if(isset($_POST['action']) && trim($_POST['action'])=="xoatienquyet"){
	$data=explode("+",$_POST['data']);
	xoatienquyet($data[0],$data[1]);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="laygido"){
	laygido($_POST['nganh'],$_POST['sttKhoa']);
}else if(isset($_POST['action']) && trim($_POST['action'])=="changeloai"){
	$data=explode("+",$_POST['data']);
	if($_POST['chon']=="tt"){
		$query="update chuongtrinhhoc set batbuoc=' ',tuchon='x' where maNganh='".$data[0]."' and maMon='".$data[1]."' and he=".$data[2]." and sttKhoa=".$data[3]." and hocKi=".$data[4]." and namHoc=".$data[5]." ";
	}
	else {
		$query="update chuongtrinhhoc set batbuoc='x',tuchon=' ' where maNganh='".$data[0]."' and maMon='".$data[1]."' and he=".$data[2]." and sttKhoa=".$data[3]." and hocKi=".$data[4]." and namHoc=".$data[5]." ";
	}
	doicaigido($query);
	
}
else if(isset($_POST['action']) && trim($_POST['action'])=="delete-all"){
	delete_all($_POST['maNganh'],$_POST['he'],$_POST['sttKhoa']);	
}
else if(isset($_POST['action']) && trim($_POST['action'])=="search"){
	search($_POST['nganh'],$_POST['he'],$_POST['search']);
}else if(isset($_POST['action']) && trim($_POST['action'])=="search2"){
	search2($_POST['nganh'],$_POST['search']);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="hocnganh")
{
	monhocnganh($_POST['nganh'],$_POST['he']);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="xoamonhocnganh")
{
	xoamonhocnganh($_POST['nganh'],$_POST['maMon'],$_POST['he']);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="NMT")
{
	getmonhoc('');
}
else if(isset($_POST['action']) && trim($_POST['action'])=="NMTA")
{
	getmonhoc($_POST['search']);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="NMTAN")
{
	insertmonhocnganh($_POST['maNganh'],$_POST['maMon'],$_POST['he']);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="NMTANE")
{
	create($_POST['nganh'],$_POST['he'],$_POST['khoa']);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="get_table")
{

	$data=explode('+',$_POST['nganh']);
	get_table($data[0],$_POST['he'],$data[2],$data[1],$_POST['hocki']);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="phan_cong")
{
	//$data=explode('+',$_POST['data']);
	//var_dump($_POST);
	$data=explode('+',$_POST['malop']);
	 phan_cong($_POST['macb'],$data[1],$_POST['mamon'],$_POST['hocki'],$_POST['namhoc'],$_POST['nhom'],
	 $_POST['lythuyet'],$_POST['thuchanh'],$_POST['baitap'],$_POST['kiemtra'],$_POST['he'],$_POST['hockicth']);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="phan_cong2")
{
	//$data=explode('+',$_POST['data']);
	//var_dump($_POST);
	 phan_cong($_POST['macb'],$_POST['malop'],$_POST['mamon'],$_POST['hocki'],$_POST['namhoc'],$_POST['nhom'],
	 $_POST['lythuyet'],$_POST['thuchanh'],$_POST['baitap'],$_POST['kiemtra'],$_POST['he'],$_POST['hockicth']);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="xoa_phan_cong")
{
	xoa_phan_cong($_POST['data']);
	 //echo $_POST['data'];
	
}
else if(isset($_POST['action']) && trim($_POST['action'])=="get_khoa")
{
	 get_max_khoa($_POST['maNganh']);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="thinh_giang")
{	
	 thinh_giang($_POST['malop'],$_POST['mamon'],$_POST['mabm'],$_POST['hocki'],$_POST['namhoc'],$_POST['hockicth']);


}
else if(isset($_POST['action']) && trim($_POST['action'])=="xoa_thinh_giang")
{	
	$data=explode('+',$_POST['data']);
	
	xoa_thinh_giang($data[0],$data[1],$data[2],$data[3]);
}
else if(isset($_POST['action']) && trim($_POST['action'])=="get_namhoc")
{	
	//var_dump($_POST);
	get_namhoc($_POST['nganh'],intval($_POST['hocki']),intval($_POST['he']),intval($_POST['sttKhoa']));
}
else if(isset($_POST['action']) && trim($_POST['action'])=="get_tc")
{
	get_tc($_POST['nganh'],$_POST['he'],$_POST['sttKhoa'],$_POST['hocki']);
	//var_dump($_POST);
	 
}


function get_tc($nganh,$he,$sttkhoa,$hocki)
{
	$db=new db();
	$data['tc']=$db->mysql->query("SELECT sum(soTc)  as tinchi FROM `chuongtrinhhoc` 
	join monhoc on chuongtrinhhoc.maMon=monhoc.maMon WHERE maNganh='$nganh' and he=$he and sttKhoa=$sttkhoa and batbuoc='x'")->fetch_assoc();
	$data['batbuoc']=$db->mysql->query("SELECT sum(soTc) as bb FROM `chuongtrinhhoc` 
	join monhoc on chuongtrinhhoc.maMon=monhoc.maMon WHERE maNganh='$nganh' and he=$he and sttKhoa=$sttkhoa and batbuoc='x'")->fetch_assoc();
	$data['tuchon']=$db->mysql->query("SELECT sum(soTc) as tc FROM `tuchon` WHERE maNganh='$nganh' and he=$he and sttKhoa=$sttkhoa")->fetch_assoc();
	$data['tuchon_bb']=$db->mysql->query("SELECT soTc FROM `tuchon`  WHERE maNganh='$nganh' and he=".intval($he)." and sttKhoa=".intval($sttkhoa)." and hocKi=".intval($hocki)."")->fetch_assoc();
	echo json_encode($data);
}


function get_max_khoa_lop($mabm)
{
	$db=new db();
	$key_max=$db->mysql->query("SELECT MAX(sttKhoa) as maxkhoa from lop join nganh on lop.maNganh=nganh.maNganh where maBm=$mabm")->fetch_assoc();//lấy khóa lớn nhất của lớp
	return $key_max['maxkhoa'];
}


function get_clas($mbm,$sttkhoa)
{
	$db=new db();
	$dslop = $db->mysql->query("select * from lop join nganh on lop.maNganh = nganh.maNganh where maBm=$mbm and sttKhoa=$sttkhoa");
	return $dslop;
}
function get_max_khoa($maNganh)
{
	$db=new db();
	$data=$db->mysql->query("SELECT MAX(sttKhoa) as maxkhoa from chuongtrinhhoc WHERE maNganh='$maNganh'")->fetch_assoc();
	echo $data['maxkhoa'];
}
function get_Bm_session($macb)
{
	$db = new db();
	$data=$db->mysql->query("select maBm from canbo where maCb='".$macb."'")->fetch_assoc();
	return $data['maBm'];
}
function ahihi($macb,$mamon,$hocki,$namhoc)//Gv dạy lớp thứ 3
{
	$db=new db();
	$data=$db->mysql->query("select * from pcday where maCb='$macb' and maMon='$mamon' and namHoc=$namhoc")->num_rows;
	if($data>=3)
	{
		return "<br><span style='color:red;'>Giáo án 3</span>";
	}
	else
		return "";
}
function xoa_phan_cong($e)
{
	$db=new db();
	$val=explode('+',$e);
	//var_dump($val);
	$namhoc=intval($val[4]);
	$hocki=intval($val[3]);
	$data=$db->mysql->query("delete from pcday where maCb='$val[0]' and maLop='$val[1]' and maMon='$val[2]' and hocKiCTH=$hocki and namHoc=$namhoc");
	if($data)
	{
		echo "ok";
	}
		
	else 
	{
		echo "error";
	}
	
	
}
function phan_cong($macb,$malop,$mamon,$hocki,$namhoc,$sonth,$sotietlt,$sotietth,$sotietbt,$sotietkt,$heso,$hockicth)
{
	$db=new db();
	$data=$db->mysql->query("insert into pcday values('".$macb."','".$malop."','".$mamon."',".$hocki.",".$hockicth.",".$namhoc.",
	".$sonth.",".$sotietlt.",".$sotietth.",".$sotietbt.",".$sotietkt.",".$heso.")");
	if($data)
	{
		echo "ok";
	}
	else
	{
		echo "error";
	}
}
function check_phan_cong($malop,$mamon,$hocki,$namhoc)
{
	$db=new db();
	$data1=$db->mysql->query("select * from pcday inner join canbo on pcday.maCb=canbo.maCb where maLop='".$malop."' and maMon='".$mamon."' and hocKiCTH=".$hocki."")->fetch_assoc();
	if($data1!=false)
	{
		$t=$data1['maCb']."+".$malop."+".$mamon."+".$hocki."+".$data1['namHoc'];
		return "<td>".$data1['hoCb'].$data1['tenCb']."(".$data1['maCb'].")".ahihi($data1['maCb'],$mamon,$hocki,$data1['namHoc']).
		"</td>"."<td><button class='btn btn-danger' onclick='del(\"".$t."\")'>Hủy</button></td>";
	}
	else 
	{
		return  '<td><button class="btn btn-success cc">Phân công</button></td>';	
	}
}
function check_phan_cong_2($malop,$mamon,$hocki,$namhoc){
	{
		$db=new db();
		$data1=$db->mysql->query("select * from pcday inner join canbo on pcday.maCb=canbo.maCb where maLop='".$malop."' and maMon='".$mamon."' and hocKiCTH=".$hocki."")->fetch_assoc();
		if($data1!=false)
		{
			$t=$data1['maCb']."+".$malop."+".$mamon."+".$hocki."+".$data1['namHoc'];
			return "<td>".$data1['hoCb'].$data1['tenCb']."(".$data1['maCb'].")".ahihi($data1['maCb'],$mamon,$hocki,$data1['namHoc']);
			// "</td>"."<td><button class='btn btn-danger' onclick='del(\"".$t."\")'>Hủy</button></td>";
		}
		else 
		{
			return 1;	
		}
	}
}
function get_table($maNganh,$he,$sttKhoa,$malop,$hocki)
{
	
	$db=new db();
	$sql = "SELECT * FROM chuongtrinhhoc cth, monhoc mh, nganh n ".
	" Where cth.maNganh = '".$maNganh."'" .
	 "	 and cth.he = '".$he."'" .
	 "	 and sttKhoa = '".$sttKhoa."'" .
	 "	 and hocKi = ".$hocki."" .						 					 
	 "	 and cth.maMon=mh.maMon".
	 "	 and cth.maNganh=n.maNganh".
	" ORDER BY cth.namHoc, cth.hocKi ASC ";
	$data=$db->mysql->query($sql);
	$stt=0;
	$t="";
	while($row=$data->fetch_assoc())
	{
		$check=$row['batbuoc']=='x'? "Bắt buộc":"<b style='color:red'>Tự chọn</b>";
		$stt++;
		$t.="<tr>
			<td>".$stt."</td>
			<td class='maMon'>".$row['maMon']."</td>
			<td >".$row['tenMon']."</td>
			<td>". $row['soTc']."</td>
			<td class='soTietLt' >". $row['soTietLt']."</td>
			<td class='soTietBT'>". $row['soTietBT']."</td>
			<td class='soTietTh'>". $row['soTietTh']."</td>
			<td class='soTietKt'>". $row['soTietKt']."</td>
			<td>". $check."</td>
			<td><input style='width:40px;' class='nhom' value='1'></td>
			<td><input style='width:40px;' class='heso' value='1'></td>
			"
		.check_phan_cong($malop,$row['maMon'],$row['hocKi'],$row['namHoc']).
		"</tr>";
	}
	echo $t;
}
function create($nganh,$he,$khoa)
{
	$db=new db();
	$maNganh=$db->mysql->escape_string($nganh);
	$He=$db->mysql->escape_string($he);
	$sttKhoa=$db->mysql->escape_string($khoa);
	$khoamoi=$sttKhoa+1;
	$check=$db->mysql->query("select * from chuongtrinhhoc where maNganh='".$maNganh."' and he=".$He." and sttKhoa=".$sttKhoa."");
	$insert="";
	while($row=$check->fetch_assoc())
	{
		$namhoc=$row['namHoc']+1;
		$tuchon= $row['tuchon']=="x"? "x":" ";
		$batbuoc=$row['batbuoc']=="x"? "x":" ";
		$insert.="('".$row['maNganh']."','".$row['maMon']."',".$He.",".$khoamoi.",".$row['hocKi'].",".$namhoc.",'".$tuchon."','".$batbuoc."'),";
	}
	$query=$db->mysql->query("insert into chuongtrinhhoc value".substr($insert,0,strlen($insert)-1));
	if($query)
	{
		echo "ok";
	}
	else
		echo "error";
}
function hienthitable($maNganh,$he,$sttKhoa,$hk)
{
	$db=new db();
    $sql_hienThi = 	"SELECT * FROM chuongtrinhhoc cth, monhoc mh, nganh n ".
									" Where cth.maNganh = '".$maNganh."'" .
									 "	 and cth.he = '".$he."'" .
									 "	 and sttKhoa = '".$sttKhoa."'" .						 
									 "	 and hocKi = '".$hk."'" .						 
									 "	 and cth.maMon=mh.maMon".
									 "	 and cth.maNganh=n.maNganh".
                                    " ORDER BY cth.namHoc, cth.hocKi ASC ";

	$data=$db->mysql->query($sql_hienThi);
	$t="";
	$tong=0;
	$tonglt=0;
	$tongbt=0;
	$tongth=0;
	$tongkt=0;
	$stt=1;
	$tongbatbuoc=0;
	$tongtuchon=0;
	while($row=$data->fetch_assoc()){
		if($row['batbuoc']=='x')
			$tongbatbuoc+=$row['soTc'];
		else
			$tongtuchon+=$row['soTc'];

		$tong+=intval($row["soTc"]);
		$tonglt+=intval($row['soTietLt']);
		$tongbt+=intval($row['soTietBT']);
		$tongth+=intval($row['soTietTh']);
		$tongkt+=intval($row['soTietKt']);
		$chuoi=$row["maNganh"]."+".$row["maMon"]."+".$row["he"]."+".$row["sttKhoa"]."+".$row["hocKi"]."+".$row["namHoc"]."+".$stt;	
		$kk=checkmontienquyet($row["maNganh"],$row["he"],$row["maMon"],$row["hocKi"],$row["sttKhoa"])==false ? "<p><span style='color:red;'>Cần phải xóa vì môn tiên quyết chưa có trong chương trình</span></p>": "";
		$loai= $row['batbuoc']=="x"? "<select id='bb_tc' kai-value=".$chuoi." class='chon'><option selected='selected' value='bb'>Bắt buộc</option><option value='tt' >Tự chọn</option></select>":"<select class='chon' kai-value=".$chuoi."><option value='bb'>Bắt buộc</option><option selected='selected' value='tt'>Tự chọn</option></select>";	
		$t.='<tr>
				<td scope="row">'. $stt++ .'</td>
				<td>'. $row["maMon"].'</td>
				<td>'. $row["tenMon"].$kk.'</td>			
				<td>'. $row["soTc"].'</td>
				<td>'. $row["soTietLt"].'</td>
				<td>'. $row["soTietBT"].'</td>
				<td>'. $row["soTietTh"].'</td>
				<td>'. $row["soTietKt"].'</td>

				<td>'.$loai.'</td>			
				<td>
				<button type="button" onclick="del(\''.$chuoi.'\')" style="border:none; background-color:transparent"> <img src="img/delete.png" width="20" height="20" ></button>							
		</td>
	  </tr>	';
	}
	return $t.'  <tr>
	<td colspan="3" align="center"> Tổng số</td>
	<td>'.$tong.' </td>
	<td>'.$tonglt.' </td>
	<td>'.$tongbt.' </td>
	<td>'.$tongth.' </td>
	<td>'.$tongkt.' </td>
	<td><b>Bắt buộc:'.$tongbatbuoc.'</b></td>
	<td><b>Tự chọn:'.$tongtuchon.'</b></td>
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
function delete_all($maNganh,$he,$sttKhoa){
	$db=new db();
	$query=$db->mysql->query("DELETE FROM `chuongtrinhhoc` WHERE maNganh=$maNganh  and he=$he and sttKhoa=$sttKhoa  ");
	if($query)
		echo 'ok';
	else
		echo 'error';

}
function insertcth($maNganh,$maMon,$he,$sttKhoa,$hocKi,$namHoc)
{
	$db=new db();
		$checked=checkmontienquyet($maNganh,$he,$maMon,$hocKi,$sttKhoa);
		if($checked==true){
			$query1=$db->mysql->query("select * from chuongtrinhhoc where maNganh='$maNganh' and maMon='$maMon' and sttKhoa=$sttKhoa ")->num_rows;
	
			if($query1==0)
			{
				$query=$db->mysql->query("insert into chuongtrinhhoc values ('$maNganh','$maMon',$he,$sttKhoa,$hocKi,$namHoc,' ','x')");
				if($query)
					echo 'ok';
				else
					echo 'error';
		
			
			}
			else
				echo 'error';
			
			
		}
		else
			echo "no";
		
	//}

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
function laymonhoc($malop,$he){
	$db=new db();
	$maNganh=$db->mysql->escape_string($malop);
	$He=$db->mysql->escape_string($he);
	$data=$db->mysql->query("select * from monhoc inner join monhocnganh on monhoc.maMon=monhocnganh.maMon where maNganh=".$maNganh." and he=".$He."");
	$t="";
	while($data4=$data->fetch_assoc()){
		$t.='<option value="'.$data4["maMon"].'" selected="selected">'.$data4["tenMon"].'('.$data4["maMon"].')-'.$data4["soTc"].' tín chỉ							
		</option>';
	}
	echo $t;
	
}	
function laynganh(){
	$db=new db();
	$result=array();
	$value=$db->mysql->query("select distinct maNganh,tenNganh from nganh inner join canbo on nganh.maBm=canbo.maBm where maCb='". $_SESSION['ss_user_token']['ms']."'");
	while($row=$value->fetch_assoc()){
		array_push($result,$row);
	}
	return $result;
}
function laymonhoc2($nganh){
	$db=new db();
	$maNganh=$db->mysql->escape_string($nganh);
	
	$data=$db->mysql->query("select monhocnganh.maMon,tenMon from monhocnganh inner join monhoc on monhocnganh.maMon=monhoc.maMon where maNganh=".$maNganh."");
	$t="";
	while($row=$data->fetch_assoc()){
		$t.= '<option value="'.$row['maMon'].'">'.$row['tenMon'].'</option>';
	}
	echo $t;
}
function themmontienquyet($monhoc,$monhoctq){
	$db=new db();
	$mh=$db->mysql->escape_string($monhoc);
	$mhtq=$db->mysql->escape_string($monhoctq);
	$query=$db->mysql->query("insert into montienquyet values('".$mh."','".$mhtq."')");
	if($query)
		echo "ok";
	else
		echo "error";
}
function laybang()
{
	$db=new db();
	$stt=1;
	$t="";
	$mang1=array();
	$mang2=array();
	$query=$db->mysql->query("select montienquyet.maMon,tenMon from montienquyet inner join monhoc on montienquyet.maMon=monhoc.maMon ");
	$query2=$db->mysql->query("select montienquyet.maMonTq,tenMon from montienquyet inner join monhoc on montienquyet.maMonTq=monhoc.maMon  ");
	while($row=$query->fetch_assoc()){
		array_push($mang1,$row);
	}
	while($row=$query2->fetch_assoc()){
		array_push($mang2,$row);
	}
	foreach($mang1 as $key=>$value)
	{
		$k=$mang1[$key]['maMon']."+".$mang2[$key]['maMonTq'];
		$t.="<tr>
			<td>".$stt."</td>
			<td>".$mang1[$key]['maMon']."</td>
			<td>".$mang1[$key]['tenMon']."</td>
			<td>".$mang2[$key]['maMonTq']."</td>
			<td>".$mang2[$key]['tenMon']."</td>
			<td><button type='button' onclick= 'del(\"".$k."\")' class='del'><img src='img/delete.png' width='20' height='20' ></button></td>
		</tr>";
		$stt++;
	}
	echo $t;
}
function xoatienquyet($ma1,$ma2)
{
	$db=new db();
	$mamon=$db->mysql->escape_string($ma1);
	$mamontq=$db->mysql->escape_string($ma2);
	$query=$db->mysql->query("delete from montienquyet where maMon='".$mamon."' and maMonTq='".$mamontq."'");
	if($query)
		echo "ok";
	else
		echo "error";
}
function checkmontienquyet($maNganh,$he,$maMon,$hocKi,$sttKhoa)
{
	$db=new db();
	$check=array();
	$montienquyet=$db->mysql->query("select maMonTq from montienquyet where maMon='".$maMon."'");
	$i=1;
	$in="";
	while($i<=$hocKi){
		$in.=$i.",";
		$i++;
		
	}
	while($row=$montienquyet->fetch_assoc())
	{
		array_push($check,$row['maMonTq']);
	}
	if(count($check)==0)
		return true;
	else{
		$checked=true;
		foreach($check as $value)
		{
			$qq=$db->mysql->query("select * from chuongtrinhhoc where maNganh=".$maNganh." and he=".$he." and maMon='".$value."' and sttKhoa=".$sttKhoa." and hocKi in (".substr($in,0,strlen($in)-1).")")->num_rows;
			if($qq==0)
				$check=false;
		}
		return $check==false? false:true;
	}

}
function laygido($a,$sttKhoa){
	$db=new db();
	$data=$db->mysql->query("select * from chuongtrinhhoc inner join monhoc on chuongtrinhhoc.maMon=monhoc.maMon where maNganh='".$a."' and sttKhoa=".$sttKhoa."");
	$t="";
	if($data)
	{
		while($row=$data->fetch_assoc()){
			if(checkmontienquyet($row['maNganh'],$row['he'],$row['maMon'],$row['hocKi'],$row['sttKhoa'])==false){
				$t.="<p style='color:#C70000;'>".$row['tenMon']."(Học kì ".$row['hocKi'].")</p>";
			}
		}
	}
	
	echo $t;	
}
function doicaigido($query)
{
	$db=new db();
	if($db->mysql->query($query))
		echo "ok";
	else 
		echo "error";
}
function search($malop,$he,$tim)
{
	$db=new db();
	$maNganh=$db->mysql->escape_string($malop);
	$He=$db->mysql->escape_string($he);
	$search=$db->mysql->escape_string($tim);
	$data=$db->mysql->query("select * from monhoc inner join monhocnganh on monhoc.maMon=monhocnganh.maMon where maNganh=".$maNganh." and he=".$He." and tenMon like '%".$search."%'");
	$t="";
	while($data4=$data->fetch_assoc()){
		$t.='<option value="'.$data4["maMon"].'" >'.$data4["tenMon"].'('.$data4["maMon"].')-'.$data4["soTc"].' tín chỉ							
		</option>';
	}
	echo $t;
}
function search2($malop,$tim)
{
	$db=new db();
	$maNganh=$db->mysql->escape_string($malop);
	$search=$db->mysql->escape_string($tim);
	$data=$db->mysql->query("select * from monhoc inner join monhocnganh on monhoc.maMon=monhocnganh.maMon where maNganh=".$maNganh." and tenMon like '%".$search."%'");
	$t="";
	while($data4=$data->fetch_assoc()){
		$t.='<option value="'.$data4["maMon"].'" >'.$data4["tenMon"].'('.$data4["maMon"].')-'.$data4["soTc"].' tín chỉ							
		</option>';
	}
	echo $t;
}
function monhocnganh($malop,$he)
{
	$db=new db();
	$maNganh=$db->mysql->escape_string($malop);
	$data=$db->mysql->query("select * from monhoc inner join monhocnganh on monhoc.maMon=monhocnganh.maMon where maNganh='".$maNganh."' and he=".$he."");
	$t="";
	$stt=1;
	while($mang=$data->fetch_assoc()){
		$t.="<tr>	
		<td>".$stt."</td>
		<td>".$mang['maMon']."</td>
		<td>".$mang['tenMon']."</td>
		<td>".$mang['soTc']."</td>
		<td>".$mang['soTietLt']."</td>
		<td>".$mang['soTietBT']."</td>
		<td>".$mang['soTietTh']."</td>	
		<td><button type='button' onclick= 'del(\"".$mang['maMon']."\")' class='del'><img src='img/delete.png' width='20' height='20' ></button></td>	
		</tr>";
		$stt++;
	}
	echo $t;
}
function xoamonhocnganh($nganh,$mon,$he)
{	
	$db=new db();
	$maNganh=$db->mysql->escape_string($nganh);
	$maMon=$db->mysql->escape_string($mon);
	$data=$db->mysql->query("delete from monhocnganh where maNganh='".$maNganh."' and maMon='".$maMon."' and he=".$he."");
	if($data)
	{
		echo "ok";
	}
	else 
		echo "error";
}
function getmonhoc($tim)
{
	$db= new db();
	$search=$db->mysql->escape_string($tim);
	$data=$db->mysql->query("select * from monhoc where tenMon like '%".$search."%'");
	$t="";
	while($data4 =$data->fetch_assoc())
	{
		$t.='<option value="'.$data4["maMon"].'" >'.$data4["tenMon"].'('.$data4["maMon"].')-'.$data4["soTc"].' tín chỉ							
		</option>';
	}
	echo $t;
}
function insertmonhocnganh($nganh,$mon,$he)
{
	$db=new db();
	$maNganh=$db->mysql->escape_string($nganh);
	$maMon=$db->mysql->escape_string($mon);
	$data=$db->mysql->query("insert into monhocnganh values('".$maNganh."','".$maMon."',".$he.")");
	if($data)
	 echo "ok";
	else
	 	echo "error";
}
function get_table_class($malop,$hocki)
{
	$db=new db();
	$data=$db->mysql->query("select * from lop where malop='$malop'")->fetch_assoc();
	$sttKhoa=$data['sttKhoa'];
	$he=$data['he'];
	$maNganh=$data['maNganh'];
	$value=$db->mysql->query("SELECT * FROM chuongtrinhhoc join monhoc on chuongtrinhhoc.maMon=monhoc.maMon where chuongtrinhhoc.maNganh='$maNganh' 
	and chuongtrinhhoc.sttKhoa=$sttKhoa and he=$he and hocKi=$hocki ");
	return $value;
}
function check_thinh_giang($malop,$mamon,$hocki,$namhoc)
{
	$db=new db();
	$data=$db->mysql->query("select * from thinhgiang where maLop='$malop' and maMon='$mamon' and hocKiCTH=$hocki ");
	if($data->fetch_assoc())
	{
		return 1;
	}
	else
	{
		return 0;
	}

}
function get_can_bo($mabm)
{
	$db=new db();
	$data=$db->mysql->query("select * from canbo where maBm=$mabm");
	return $data;
}
function check_phan_cong_thinh_giang($malop,$mamon,$hocki,$namhoc)
{
	$db=new db();
	$data1=$db->mysql->query("select * from thinhgiang join bomon on thinhgiang.maBm=bomon.maBm  where maLop='$malop' and maMon='$mamon' and hocKiCTH=$hocki")->fetch_assoc();
	if(!empty($data1))
	{
		$t=$malop."+".$mamon."+".$hocki."+".$namhoc;
		return "<td><label class='text-danger'>Thỉnh giảng(".$data1['tenBm'].")</label></td><td><button class='btn btn-danger' onclick='del(\"".$t."\")'>Hủy</button></td>";

		
	}
	else 
	{
		// $t=$malop."+".$mamon."+".$hocki."+".$namhoc;
		
		return "<td><button class='btn btn-success' >Thỉnh Giảng</button></td>";
	}
}
function get_bo_mon($maBm)
{
	$db=new db();
	$data=$db->mysql->query("select * from bomon where maBm !=$maBm");
	return $data;
}
function thinh_giang($malop,$mamon,$mabm,$hocki,$namhoc,$hockicth)
{
	$db=new db();
	$data=$db->mysql->query("insert into thinhgiang values('$malop','$mamon',$mabm,$hocki,$hockicth,$namhoc)");
	if($data)
		echo "ok";
	else
		echo "error";
}
function xoa_thinh_giang($malop,$mamon,$hocki,$namhoc)
{
	
	$db=new db();
	$data=$db->mysql->query("delete from thinhgiang where maLop='$malop' and maMon='$mamon' and hocKiCTH=$hocki");
	$data2=$db->mysql->query("delete from pcday where maLop='$malop' and maMon='$mamon' and hocKiCTH=$hocki");
	if($data)
		echo "ok";
	else
		echo "error";
}
function get_namhoc($nganh,$hocki,$he,$khoa)
{
	$db=new db();
	$data=$db->mysql->query("select distinct namHoc from chuongtrinhhoc where maNganh='$nganh' and hocKi=$hocki and he=$he and sttKhoa=$khoa ")->fetch_assoc();
	echo $data['namHoc'];
}
function get_name($malop,$mamon,$hocki,$namhoc)
{
	$db=new db();
	$data1=$db->mysql->query("select * from pcday inner join canbo on pcday.maCb=canbo.maCb 
	where maLop='".$malop."' and maMon='".$mamon."' and hocKiCTH=".$hocki."")->fetch_assoc();
	if($data1!=false)
	{
		$t=$data1['maCb']."+".$malop."+".$mamon."+".$hocki."+".$data1['namHoc'];
		return $data1['hoCb'].$data1['tenCb']."(".$data1['maCb'].")";
		
	}
	else 
	{
		return  '';
		
	}
}
?>