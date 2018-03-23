
<?php	
	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php')	;	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>trang dang nhap</title>
<link type="text/css" rel="stylesheet" href="ViewCommon/css/menu_left.css" />
<link href="ViewCommon/css/menu_left.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

<SCRIPT>
var today = new Date();
var weekdayNames = ['Chủ nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];
var monthNamesR = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
var thisDay = today.getDay();
var thisDate = today.getDate();
var currMonth = today.getMonth();
var currYear = today.getFullYear();
function datetime() {
document.write(weekdayNames[thisDay] + ", " + thisDate + " / " + monthNamesR[currMonth] + " / " + currYear )
}
	var divs = new Array();
	var da = document.all;
	var start;
	var speed = 50;
	function initVars(){
		if (!document.all)
		return
		addDiv(hi,"#9999CC",2,11);
		addDiv(msg2,"orange",15,17);
		startGlow();
	}
	
	function addDiv(id,color,min,max){
		var j = divs.length;
		divs[j] = new Array(5);
		divs[j][0] = id;
		divs[j][1] = color;
		divs[j][2] = min;
		divs[j][3] = max;
		divs[j][4] = true;
	}
	
	function startGlow(){
		if (!document.all)
			return 0;
		for(var i=0;i<divs.length;i++)	{
			divs[i][0].style.filter = "Glow(Color=" + divs[i][1] + ", Strength=" + divs[i][2] + ")";
			divs[i][0].style.width = "100%";
		}
		start = setInterval('update()',speed);
	}
	
	function update(){
		for (var i=0;i<divs.length;i++)	{
			if (divs[i][4]){
				divs[i][0].filters.Glow.Strength++;
				if (divs[i][0].filters.Glow.Strength == divs[i][3])
					divs[i][4] = false;
			}	
			if (!divs[i][4]){
				divs[i][0].filters.Glow.Strength--;
				if (divs[i][0].filters.Glow.Strength == divs[i][2])
					divs[i][4] = true;
			}
		}
	}
	-->
		
	</SCRIPT>
</head>



<?php
	require_once("lib/connection.php");
	require_once("lib/UserInfo.php");
	
	if (isset($_POST["btn_submit"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$vaitro = "cb";
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if ($username == "" || $password =="") {
			thongBao("username hoặc password bạn không được để trống!");
		}
		else if ($username == "admin"){///Đây là người quản trị
				$sql = "select * from admin where maAdmin = 'admin' and matKhau = md5('".$password."')";
				$query = mysqli_query($conn,$sql);			
				$num_rows = mysqli_num_rows($query);
				if ($num_rows==0) {			
						thongBao("Mật khẩu không đúng !");}
				else{			
						set_logged($username , $data["ten"], "app");
						header('Location: index.php?f=QuanTri_CanBo');	
					}	
		
		}
		else{		
			//if ($vaitro=="cb")
				$sql = "select CONCAT(hoCb,' ',tenCb) as 'ten' from canbo where maCb = '".$username."' and matKhau= md5('".$password."')";
			//else	
				//$sql = "select CONCAT(hoSv,' ',tenSv) as 'ten' from sinhvien where maSv = '$username' and matKhau = '$password' ";
			$query = mysqli_query($conn,$sql);			
			$num_rows = mysqli_num_rows($query);
			if ($num_rows==0) {			
				thongBao("tên đăng nhập hoặc mật khẩu không đúng !");
			}else{
					$data = mysqli_fetch_array($query);										
				//Xem có phải trưởng bộ môn?
					$sql2="select * from chucvugiangvien where maCb='$username' and maCv=1";				
					$query2= mysqli_query($conn,$sql2);			
					$num_rows2 = mysqli_num_rows($query2);
					
//				if ($vaitro=="sv")
//Nếu khong phải chuyển sang trang giảng viên
				if ($num_rows2==0){
					set_logged($username , $data["ten"], "canBo");
					header('Location: index.php?f=Quantri_Pccm1');	
				}	
				else	//Nếu là trưởng bộ môn chuyển sang trang cập nhật
				{
					//lay vai tro
					/*$sql2 = "select * from phanquyengv a, quyen b" .
							" where a.maQuyen = b.maQuyen and a.maCb= '$username' and b.tenQuyen = 'admin_ks' ";
					$query2 = mysqli_query($conn,$sql2);			
					$num_rows2 = mysqli_num_rows($query2);
					if ($num_rows2==0) {			
						set_logged($username , $data["ten"], "canBo");
					}
					else*/
						set_logged($username , $data["ten"], "admin");					
						header('Location: index.php?f=Quantri_Pccm1');	
				}	
				
			}
		}
	}
?>


<body topmargin = " 0" bottommargin = "0 " leftmargin = "0 " rightmargin = "0 ">
	<table align="center" width="950" border="1" cellspacing="0" cellpadding="0">
	<tr><td valign="top" colspan = "2" height = "100" background="">	
	<!--<object align="left" height="25" width="209">
        <embed  align="left" src="./image/ball.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" ; type="application/x-shockwave-flash" menu="false" wmode="transparent" height="100" width="600"></object>-->
<div align="right" style="color:#996600; font-size:14px; padding:1px; margin:2px;" ></div>
  <img src="ViewCommon/image/bn copy.jpg" alt="Không có hình" width="1024" height="184" />
	<tr>
    <td colspan="2" align="left" style="color:#990000; font-size:18px; font-weight:bold;" background="ViewCommon/image/bg03.gif" width="205"><script language="javascript">
		
  datetime();
      </script></td>
    
  </tr>
  <tr height=100%>
        <td height="400" colspan="2" valign="top" background="ViewCommon/image/bg12322.gif">

		<table align="center" border="1" cellpadding="0" cellspacing="0">
	<tr><td bordercolor="#006699">
		<form action="index.php" method="post" enctype="multipart/form-data" name="dang_nhap" id="dang_nhap" >
		<table border="0" cellpadding="5" cellspacing="0" style="color:#003366;">

			
			<tr align="center" ><td colspan="2" style=" background:url(ViewCommon/image/bg03.gif)"><span class="style2">ĐĂNG NHẬP</span></td>
			</tr>
			<tr><td>Username</td><td><input name="username" type="text" id="username" /></td></tr>
			<tr><td>Password</td><td><input name="password" type="password" id="password" /></td></tr>
			<tr><td align="center" colspan="2"><input name="btn_submit" type="submit" id="ok" value="  OK  " />&nbsp;&nbsp;<input name="cancel" type="reset" id="cancel" value="Cancel" /></td></tr>
			
		</table>
	  </form>
	</td></tr>
</table>
	&nbsp;
	
	</td>
  </tr>
  <tr>
  	  
  <tr>
    <td colspan="2" height="20px" background="ViewCommon/image/bg03.gif" nowrap="nowrap" align="center">
	
			 TRƯỜNG CAO ĐẲNG CẦN THƠ 
			 Số 413 - Đường 30/4 - Phường Hưng Lợi - Quận Ninh Kiều - TP.Cần Thơ 			</td>

  </tr>
</table>

</body>
</html>
