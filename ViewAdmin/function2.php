<?php
    require_once('function.php');
    
    function get_table_thinh_giang($maBm)
    {
        $db=new db();
        $data=$db->mysql->query("select * from thinhgiang join lop on thinhgiang.maLop=lop.maLop 
        join monhoc on thinhgiang.maMon=monhoc.maMon where thinhgiang.maBm=$maBm");
        return $data;
    }
?>