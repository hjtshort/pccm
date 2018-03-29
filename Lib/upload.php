<?php


if(isset($_FILES['file']))
{
	$validextensions = array("xlsx","xls");
	$temporary = explode(".", $_FILES["file"]["name"]);
	$file_extension = end($temporary);

	if(in_array($file_extension, $validextensions))
	{
		move_uploaded_file($_FILES["file"]["tmp_name"], '../upload/'.$_FILES["file"]["name"]);
		echo 'success';
	}
}
else
{
	echo 'error !';
}



?>
