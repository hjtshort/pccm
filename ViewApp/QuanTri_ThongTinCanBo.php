<?php	
	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php')	;	
		
?>

 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Website Trưởngng bộ môn</title>
<link href="ViewAdmin/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="ViewAdmin/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
	
<style type="text/css">
	.ten{color: #0000ff; font-style:italic}
	.heThong {color: #FF6600; font-weight:bold; }

	input[type="text"]{
	border-top-color: rgba(255, 255, 255, 0);
		border-top-style: solid;
		border-top-width: 1px;
		border-right-color: rgba(255, 255, 255, 0);
		border-right-style: solid;
		border-right-width: 1px;
		border-bottom-color: rgba(64, 62, 62, 0.5);
		border-bottom-style: dotted;
		border-bottom-width: 1px;
		border-left-color: rgba(255, 255, 255, 0);
		border-left-style: solid;
		border-left-width: 1px;
		border-image-source: initial;
		border-image-slice: initial;
		border-image-width: initial;
		border-image-outset: initial;
		border-image-repeat: initial;
	}
	.tieuDe {
		color: #0000FF;
		font-style: bold;
		size: 16;
		font-weight: bold;
		font-size: 18px;
	}
</style>

</head>

<body>



 <div class="wrapper" style="background-color:#FFFFFF"> 

  <?php
	require_once("lib/QuanTri_CanBo.php");	
	require_once("ViewApp/header.php");	
	
	
		$user  = is_logged();
        $ten   = isset($user) ?   $user['ten'] : '';
		$ms  = isset($user) ?   $user['ms'] : '';
		
		if (isset($_POST["btn_submit"])) {			
			$username = $_POST["user"];
			$pass_old = $_POST["pass_old"];
			$pass_new = $_POST["pass_new"];		
			
			if(	$pass_old=='')
				thongBao("Vui lòng nhập mật khẩu cũ của bạn");
			else if(strlen($pass_new)<8)
				thongBao("Mật khẩu mới phải có ít nhất 8 ký tự. Vui lòng nhập lại mật khẩu mới");
			else
				doiMKGV($conn, $username, $pass_old, $pass_new);
		}
	//include("header.php");
	
	$sql ="SELECT * FROM canbo cb, bomon bm".
	" WHERE maCb='".$ms."'".
	"and cb.maBm=bm.maBm";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);


	
	//////////////////////////////////
	

?>

<div class="wrapper" style="background-color:#FFFFFF"> 
 		<div>
			  <form name="form1" method="POST" action="index.php?f=QuanTri_ThongTinCanBo">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1" style="color: #0000CC">THÔNG TIN CÁN BỘ </h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
					  <tr>
                        <td height="35" width="100"> Mã cán bộ: </td>
                        <td ><input type="text" name="user" size="15" readonly="true"  value="<?php echo $ms; ?>"> </td>						
                      </tr>
                      <tr>
                        <td height="35"> Họ và tên: </td>
                        <td ><input type="text" name="hoCb" size="15" readonly="true" value="<?php echo $ten; ?>"> 	</td>						
                      </tr>
                      <tr>
                        <td height="35"> Bộ môn: </td>
						 <td ><input type="text" name="hoCb" size="15" readonly="true"  value="<?php echo $data["tenBm"]; ?>"> 	</td>						
                      </tr>
                      <tr>
                        <td height="35"> Mật khẩu cũ: </td>
						<td > <input  type="password" name="pass_old"> </td>                       
                      </tr>
					  <tr>
                        <td height="35"> Mật khẩu mới: </td>
						<td > <input  type="password" name="pass_new"> </td>                       
                      </tr>
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                        <td colspan="3" height="55">		
							<input  type="submit" value="Đổi mật khẩu" name="btn_submit"> 
						</td>
                      </tr>                  
                    </table>
			</center>		
			
			
			
    	    
	
      	</div>
 
    	</div>
		</form>	
		</div>
		</div>
 
<?php include("footer.php");?>
</div><!--end wrapper--> 
</body>
</html>


