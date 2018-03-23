<?php

function thongBao($noiDung){
   	echo '<script language="javascript">';
	echo 'alert("'.$noiDung.'")';
	echo '</script>';
}



// Hàm thiết lập đăng nhập
function set_logged($ms, $ten, $vaiTro){
   $_SESSION['ss_user_token']= array(
								'ms' => $ms,
								'ten' => $ten,
								'vaiTro' => $vaiTro		
							 );
}
function set_gv($maCb){
	return $maCb;
}
 
// Hàm thiết lập đăng xuất
function set_logout(){
     if (isset($_SESSION['ss_user_token'])){
        unset($_SESSION['ss_user_token']);
    }
}
 
// Hàm kiểm tra trạng thái người dùng đã đăng nhập chưa
function is_logged(){
  	return (isset($_SESSION['ss_user_token'])) ? $_SESSION['ss_user_token'] : false;
}
 
// Hàm kiểm tra có phải là admin hay không
function is_admin(){
    $user  = is_logged();
    if (!empty($user['vaiTro']) && $user['vaiTro'] == 'admin'){
        return true;
    }
    return false;
}

// Hàm kiểm tra có phải là cán bộ hay không
function is_GV(){
    $user  = is_logged();
    if (!empty($user['vaiTro']) && $user['vaiTro'] == 'canBo'){
        return true;
    }
    return false;
}

// Hàm kiểm tra có phải là sinh viên hay không
function is_QT(){
    $user  = is_logged();
    if (!empty($user['vaiTro']) && $user['vaiTro'] == 'app'){
        return true;
    }
    return false;
}
function doiMKSV($conn, $ms, $mk_old, $mk_new){
	// làm sạch tham số vào
		$ms = trim($ms);
		$ms = strip_tags($ms);
		$ms = addslashes($ms);
			
		$mk_old = trim($mk_old);
		$mk_old = strip_tags($mk_old);
		$mk_old = addslashes($mk_old);
		
		$mk_new  = trim($mk_new );
		$mk_new  = strip_tags($mk_new );
		$mk_new  = addslashes($mk_new );	


	//kiem tra tai khoan chinh xac khong
	$sql = "select maSv from sinhvien where maSv = '$ms' and matKhau = '$mk_old' ";
	$query = mysqli_query($conn,$sql);			
	$num_rows = mysqli_num_rows($query);	
	
	if($num_rows==0)
	{
		thongBao("Mật khẩu cũ không chính xác");
	}	
	else 	
	{
		//thuc hien cap nhat mat khau
		 $sql2 = "UPDATE sinhvien SET matKhau = '$mk_new' where maSv = '$ms'" ;		
		 mysqli_query($conn,$sql2);
		 thongBao("Mật khẩu đã được thay đổi");
		 //header('Location: index.php?f=info');			
	}
}

function doiMKGV($conn, $ms, $mk_old, $mk_new){
	// làm sạch tham số vào
		$ms = trim($ms);
		$ms = strip_tags($ms);
		$ms = addslashes($ms);
			
		$mk_old = trim($mk_old);
		$mk_old = strip_tags($mk_old);
		$mk_old = addslashes($mk_old);
		
		$mk_new  = trim($mk_new );
		$mk_new  = strip_tags($mk_new );
		$mk_new  = addslashes($mk_new );	


	//kiem tra tai khoan chinh xac khong
	$sql = "select maCb from canBo where maCb = '".$ms."' and matKhau = md5('".$mk_old."') ";
	$query = mysqli_query($conn,$sql);			
	$num_rows = mysqli_num_rows($query);	
	
	if($num_rows==0)
	{
		thongBao("Mật khẩu cũ không chính xác");
	}	
	else 	
	{
		//thuc hien cap nhat mat khau
		 $sql2 = "UPDATE canBo SET matKhau =md5( '".$mk_new."') where maCb = '$ms'" ;		
		 mysqli_query($conn,$sql2);
		 thongBao("Mật khẩu đã được thay đổi");
		 //header('Location: index.php?f=info');			
	}
}


?>