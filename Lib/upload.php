<?php
require_once("xuly_khgd.php");
require_once("../ViewApp/function.php");
require_once("../ViewApp/db.php");
if(isset($_FILES['file']))
{
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
		$data['khoa']=mb_substr(str_replace(' ','',$data['khoahoc']),7,2,'utf8');

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// t in sert  hết r đâu insert đc nữau 	
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
			$value['sotietbt']!=''? $str.=",0,".$value['sotietbt'].",0)":$str.=",0,0,0)";
			$str2.="(".$data['ma_nghanh'].",'".str_replace(",",".",	$data['danhsach'][$key]['mamon'])."',".$data['he'].")";
			if($value['batbuot']=="x"){
				$str3="insert into chuongtrinhhoc values";
				$str3.="(".$data['ma_nghanh'].",'".str_replace(",",".",	$data['danhsach'][$key]['mamon'])."',".$data['he'].",".$data['khoa']."";
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
				$value['tuchon']=="x" ? $str3.=",'x',' ')":$str3.=",' ','x')";


			}
			// echo $str2;
			// echo $str3;
			//strcmp(mb_substr($value['hocki'],7,1,'utf8'),"I")==0? $str3.=",1,".(intval($data['namhoc'])+1).")" :'';				
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
		if($checked)
		{
			echo "<label class='label label-success'>Upload và xử lý thành công !</label>";
		}
		else{
			echo "<label class='label label-danger'>Upload và xử lý thất bại !</label>";
		}
		


		//Hàm trong function.php
		// $search=getvalue();
		// $str="";
		// foreach($data['danhsach'] as $key=>$value){
		// 	if(array_search(str_replace(",",".",	$value['mamon']),$search)==null){
		// 		$str.="('".str_replace(",",".",	$value['mamon'])."',N'".$value['tenhocphan']."'";
		// 		$value['sotc']!=''? $str.=",".$value['sotc']:$str.=",0";
		// 		$value['sotietlt']!=''? $str.=",".$value['sotietlt']:$str.=",0";
		// 		$value['sotietbt']!=''? $str.=",".$value['sotietbt'].",".$value['sotietbt']."),":$str.=",0,0),";	
		// 	}
			
		// }
		//  //echo "insert into monhoc values".substr($str,0,strlen($str)-1);
		 

		// $query=$db->mysql->query("insert into monhocmoi values".substr($str,0,strlen($str)-1));
		// if($query)
		// {
		// 	echo 'success';
		// }
		// else
		// 	echo "error";		
	}
}
?>
