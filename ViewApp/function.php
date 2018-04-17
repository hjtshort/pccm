<?php 
require_once "db.php";
//var_dump(checkmontienquyet(1,1,'TU090',1));
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
	$stt=1;
	while($row=$data->fetch_assoc()){
		$tong+=intval($row["soTc"]);
		$chuoi=$row["maNganh"]."+".$row["maMon"]."+".$row["he"]."+".$row["sttKhoa"]."+".$row["hocKi"]."+".$row["namHoc"]."+".$stt;	
		$kk=checkmontienquyet($row["maNganh"],$row["he"],$row["maMon"],$row["hocKi"],$row["sttKhoa"])==false ? "<p><span style='color:red;'>Cần phải xóa vì môn tiên quyết chưa có trong chương trình</span></p>": "";
		$loai= $row['batbuoc']=="x"? "<select id='bb_tc' kai-value=".$chuoi." class='chon'><option selected='selected' value='bb'>Bắt buộc</option><option value='tt' >Tự chọn</option></select>":"<select class='chon' kai-value=".$chuoi."><option value='bb'>Bắt buộc</option><option selected='selected' value='tt'>Tự chọn</option></select>";	
		$t.='<tr>
				<td scope="row">'. $stt++ .'</td>
				<td>'. $row["tenNganh"].' </td>	
				<td>'. $row["sttKhoa"].'</td>	
				<td>'. $row["hocKi"].'</td>	
				<td>'. $row["namHoc"].'</td>
				<td>'. $row["tenMon"].$kk.'</td>			
				<td>'. $row["soTc"].'</td>
				<td>'.$loai.'</td>			
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
function delete_all($maNganh,$he,$sttKhoa){
	$db=new db();
	$query=$db->mysql->query("DELETE FROM `chuongtrinhhoc` WHERE maNganh=$maNganh  and he=$he and sttKhoa=$sttKhoa");
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
			$query=$db->mysql->query("insert into chuongtrinhhoc values (".$maNganh.",'".$maMon."',".$he.",".$sttKhoa.",".$hocKi.",".$namHoc.",' ','x')");
			if($query)
				echo 'ok';
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
	$value=$db->mysql->query("select maNganh,tenNganh from nganh");
	while($row=$value->fetch_assoc()){
		array_push($result,$row);
	}
	return $result;
}
function laymonhoc2($nganh){
	$db=new db();
	$maNganh=$db->mysql->escape_string($nganh);
	
	$data=$db->mysql->query("select * from monhoc inner join monhocnganh on monhoc.maMon=monhocnganh.maMon where maNganh=".$maNganh."");
	$t="";
	while($data4=$data->fetch_assoc()){
		$t.='<option value="'.$data4["maMon"].'" selected="selected">'.$data4["tenMon"].'('.$data4["maMon"].')-'.$data4["soTc"].' tín chỉ							
		</option>';
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
	while($row=$data->fetch_assoc()){
		if(checkmontienquyet($row['maNganh'],$row['he'],$row['maMon'],$row['hocKi'],$row['sttKhoa'])==false){
			$t.="<p style='color:#C70000;'>".$row['tenMon']."(Học kì ".$row['hocKi'].")</p>";
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
?>