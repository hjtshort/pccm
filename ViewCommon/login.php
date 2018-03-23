<?php	
	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php')	;	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Trang đăng nhập </title>
	<meta charset="utf-8">
</head>
<body>
<?php
	require_once("lib/connection.php");
	require_once("lib/UserInfo.php");
	
	if (isset($_POST["btn_submit"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$vaitro = $_POST["vaitro"];
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if ($username == "" || $password =="") {
			thongBao("username hoặc password bạn không được để trống!");
		}else{		
			if ($vaitro=="cb")
				$sql = "select CONCAT(hoCb,' ',tenCb) as 'ten' from canbo where maCb = '$username' and matKhau = '$password' ";
			else	
				$sql = "select CONCAT(hoSv,' ',tenSv) as 'ten' from sinhvien where maSv = '$username' and matKhau = '$password' ";
			$query = mysqli_query($conn,$sql);			
			$num_rows = mysqli_num_rows($query);
			if ($num_rows==0) {			
				thongBao("tên đăng nhập hoặc mật khẩu không đúng !");
			}else{
					$data = mysqli_fetch_array($query);										
				if ($vaitro=="sv")
					set_logged($username , $data["ten"], "sinhVien");
				else	
				{
					//lay vai tro
					$sql2 = "select * from phanquyengv a, quyen b" .
							" where a.maQuyen = b.maQuyen and a.maCb= '$username' and b.tenQuyen = 'admin_ks' ";
					$query2 = mysqli_query($conn,$sql2);			
					$num_rows2 = mysqli_num_rows($query2);
					if ($num_rows2==0) {			
						set_logged($username , $data["ten"], "canBo");
					}
					else
						set_logged($username , $data["ten"], "admin");					
				}	
				header('Location: index.php?f=info');	
			}
		}
	}
?>


		
		<form method="POST" action="index.php">
		  <table  border="0" align="center" height="125">
            <tr>
              <td width="150">Tên tài khoản </td>
              <td width="200"> <input type="text" name="username" size="18" value="4600S428"> </td>
            </tr>
            <tr>
              <td>Mật khẩu </td>
              <td> <input  type="password" name="password" size="18" value="123"> </td>
            </tr>
            <tr>
              <td>Vai trò </td>
              <td>  
                <select  size="1"  name="vaitro">
                  <option value="sv"> Người học</option>
                  <option value="cb">Cán bộ</option>                 
                </select>  
			  </td>
            </tr>
		    <tr>
              <td colspan="2" align="center" > <p><img src="banner.png" alt="ko" width="1024" height="184">
                <p>
                  <input type="submit" value="Đăng nhập" name="btn_submit">	
              </td>
            </tr>
          </table>
		</form>

</body>
</html>