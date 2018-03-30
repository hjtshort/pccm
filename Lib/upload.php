<?php
require_once("xuly_khgd.php");
require_once("../ViewApp/function.php");
if(isset($_FILES['file']))
{
	$validextensions = array("xlsx","xls");
	$temporary = explode(".", $_FILES["file"]["name"]);
	$file_extension = end($temporary);

	if(in_array($file_extension, $validextensions))
	{
		move_uploaded_file($_FILES["file"]["tmp_name"], '../upload/'.$_FILES["file"]["name"]);
	
		
	}
	else
	{

	}
	if(file_exists('../upload/'.$_FILES["file"]["name"]))
	{
		$xuly=new xuly('../upload/'.$_FILES["file"]["name"]);
		$data=$xuly->mother_of_xl();
		$k=1;
		foreach($data['danhsach'] as $key=> $value){
			$k=1;
			for($i=$key+1;$i<count($data['danhsach']);$i++){
				if(strcmp($value['mamon'],$data['danhsach'][$i]['mamon'])==0){
					$data['danhsach'][$key]['mamon']=$k.".".$data['danhsach'][$key]['mamon'];
					$k++;

				}
			}
		}
		$search=getvalue();
		$str="";
	
		foreach($data['danhsach'] as $key=>$value){
			if(array_search($value['mamon'],$search)==null){
				$str.="('".str_replace(",",".",	$value['mamon'])."',N'".$value['tenhocphan']."'";
				$value['sotc']!=''? $str.=",".$value['sotc']:$str.=",0";
				$value['sotietlt']!=''? $str.=",".$value['sotietlt']:$str.=",0";
				$value['sotietbt']!=''? $str.=",".$value['sotietbt'].",".$value['sotietbt']."),":$str.=",0,0),";		
			}
		}
		 //echo "insert into monhoc values".substr($str,0,strlen($str)-1);
		 $db=new db();

		$query=$db->mysql->query("insert into monhocmoi values".substr($str,0,strlen($str)-1));
		if($query)
		{
			echo 'success';
		}
		else
			echo "error";		
	}
}
?>
