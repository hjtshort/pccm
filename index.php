<?php
session_start();	
require_once("lib/UserInfo.php");
require_once("lib/connection.php");	

// Định nghĩa một hằng số bảo vệ project
define("IN_SITE", true);
 
//Lấy vaitro người dùng
$user  = is_logged();
$vaiTro = isset($user) ? $user['vaiTro'] : '';

//Lấy file cần chuyển đến
$file = isset($_GET['f']) ? $_GET['f'] : '';

$_SESSION['idMau'] = isset($_GET['idMau']) ? $_GET['idMau'] : '';
$_SESSION['namHoc'] = isset($_GET['namHoc']) ? $_GET['namHoc'] : '';
 
// Tạo đường dẫn và lưu vào biến $path
if (empty($vaiTro))		// Trường hợp người dùng chưa đăng nhập
    $path = 'ViewCommon/dangnhap.php';
elseif ($file=="logout")
	$path = 'ViewCommon/logout.php';
elseif($vaiTro=="admin")
		$path = 'ViewAdmin/' . $file.'.php';
		
elseif ($vaiTro	=="canBo")
	$path = 'ViewCB/' . $file . '.php';
elseif ($vaiTro	=="app")
	$path = 'ViewApp/' . $file . '.php';

// Trường hợp URL chạy đúng
if (file_exists($path)) {
    include_once ($path);
} 
else { 
	
    // Trường hợp URL không tồn tại thì thông báo lỗi
    include_once ('ViewCommon/ThongBao.php');
}

?>