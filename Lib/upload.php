<?php
require_once("xuly_khgd.php");
require_once("../ViewApp/function.php");
require_once("../ViewApp/db.php");
if(isset($_FILES['file']))
{
	// echo $_POST['mabm'];
	// die();
	$validextensions = array("xlsx","xls");
	$temporary = explode(".", $_FILES["file"]["name"]);
	$file_extension = end($temporary);
	$checked = false;
	if(in_array($file_extension, $validextensions))
	{
		move_uploaded_file($_FILES["file"]["tmp_name"], '../upload/'.$_FILES["file"]["name"]);
		
	}
	else
	{
		echo "<label class='label label-danger'>Tap tin khong hop le !</label>";
	}
	if(file_exists('../upload/'.$_FILES["file"]["name"]))
	{
		
		$xuly=new xuly('../upload/'.$_FILES["file"]["name"]);
		$data=$xuly->mother_of_xl();
		$db=new db();
		$data['namhoc']=mb_substr(str_replace(' ','',$data['khoahoc']),10,4,'utf8');
		$data['khoa']=explode(' ',$data['khoahoc']);
		$val=$db->mysql->query('select maNganh from nganh');
		$hetbietgi=true;
		while($row=$val->fetch_assoc())
		{
			if($row['maNganh']==$data['ma_nghanh'])
			{
				$hetbietgi=false;
			}
		}
		if($hetbietgi==true)
		{
			$dccc=$db->mysql->query("insert into nganh values('".$data['ma_nghanh']."','".$data['tennghanh']."',".$_POST['mabm'].")");
			if($dccc)
			{
				echo "<label class='label label-success'>Thêm ngành mới thành công !</label>";
			}
			else
			{
				echo "<label class='label label-danger'>Thêm ngành mới thất bại !</label>";
			}
		}
		echo "<pre>";
		echo $data['khoa'][2];
		var_dump($data);
	
		echo "</pre>";
		die();

		foreach($data['danhsach'] as $key=> $value){
			$str="insert into monhoc values";
			$str2="insert into monhocnganh values";
			$k=1;
			for($i=$key+1;$i<count($data['danhsach']);$i++){
				if(strcmp($value['mamon'],$data['danhsach'][$i]['mamon'])==0){
					$data['danhsach'][$key]['mamon']=$k.".".$data['danhsach'][$key]['mamon'];
					$k++;

				}
			}
			$str.="('".str_replace(",",".",	$data['danhsach'][$key]['mamon'])."',N'".$value['tenhocphan']."'";
			$value['sotc']!=''? $str.=",".$value['sotc']:$str.=",0";
			$value['sotietlt']!=''? $str.=",".$value['sotietlt']:$str.=",0";
			$value['sotietbt']!=''? $str.=",0,".$value['sotietbt'].",".$value['kiemtra'].")":$str.=",0,0,".$value['kiemtra'].")";
			$str2.="('".$data['ma_nghanh']."','".str_replace(",",".",	$data['danhsach'][$key]['mamon'])."',".$data['he'].")";
			$str3="insert into chuongtrinhhoc values";
			$str3.="('".$data['ma_nghanh']."','".str_replace(",",".",	$data['danhsach'][$key]['mamon'])."',".$data['he'].",".$data['khoa'][2]."";

			
		
		
			$hocki=explode(" ",$value['hocki']);
			switch (trim($hocki[2])){
				case "I":
					$str3.=",1,".intval($data['namhoc'])."";
					break;
				case "II":
					$str3.=",2,".(intval($data['namhoc'])+1)."";
					break;
				case "III";
					$str3.=",3,".(intval($data['namhoc'])+1)."";
					break;
				case "IV";
					$str3.=",4,".(intval($data['namhoc'])+2)."";
					break;
				case "V";
					$str3.=",5,".(intval($data['namhoc'])+2)."";
					break;
				case "VI";
					$str3.=",6,".(intval($data['namhoc'])+3)."";
					break;
				default:
			}
			$value['batbuot']=="x" ? $str3.=",' ','x')":$str3.=",'x',' ')";
			// echo $str;
			// echo $str2;
			//  echo $str3;
			//  die();
		 	try{
		 		$db->mysql->query($str);
				$db->mysql->query($str2);
		 		$db->mysql->query($str3);
				$checked = true;
		 	}
		 	catch(Exception $e){
		 		$checked = false;
		 	}
		}
		
		foreach($data['tuchon'] as $key=>$value){
			$str4='insert into tuchon values';
			$hocki=$key+1;
			$str4.="('".$data['ma_nghanh']."',".$data['khoa'][2].",".$data['he'].",".$hocki.",".$value.")";
			try{

				$db->mysql->query($str4);
			}
			catch(Exception $e)
			{

			}
		}							
		if($checked)
		{
			echo "<label class='label label-success'>Upload và xử lý thành công !</label>";
		}
		else{
			echo "<label class='label label-danger'>Upload và xử lý thất bại !</label>";
		}
			
	}
}
?>
