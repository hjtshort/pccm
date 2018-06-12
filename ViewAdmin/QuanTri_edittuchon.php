<?php 
    require_once "function.php";

        $db=new db();
        // $data=explode('/',$_POST['id']);
        $sotc=$_POST['sotc'];
        $he=$_POST['he'];
        $maNganh=$_POST['maNganh'];
        $sttKhoa=$_POST['sttKhoa'];
        $hocKi=$_POST['hocKi'];

        $query=$db->mysql->query("update tuchon set soTc=$sotc where maNganh=$maNganh and sttKhoa=$sttKhoa and he=$he and hocKi=$hocKi");
        if($query){
            echo '1';
        }
        else
            echo '0';
      
    
?>