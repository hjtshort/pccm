<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Môn học</title>
<style type="text/css">
<!--
.style1 {color: #993300;
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
<script language="javascript">
		function KTXOA(type){
			var str="Bạn có chắc chắn muốn xóa không ?.";								
			if(type=="x"){
				if(confirm(str)){					
					
				}else{
					return false;
				}
			}
		}
	</script>
	<script  type="text/javascript" language="javascript" src="./javascript/bang_mon.js">	</script>
	<link type="text/css" rel="stylesheet" href="../css/menu_left.css" />
</head>

<body>
<form onsubmit="return KIEM_TRA();" action="./include/bang_them_mon.php" method="post" enctype="multipart/form-data" name="mon_hoc" id="mon_hoc">
<table style="color:#003366; font-size:18px;" align="center" width="100%" border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td align="center" colspan="5"><span class="style1">CẬP NHẬT MÔN HỌC </span></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td>Mã môn học </td>
    <td><input onblur="MA_MON();" name="ma_mon_hoc" title= "Mã cán bộ 10 ký tự" type="text" id="ma_mon_hoc" />
	<i id="mot_mmon" class="hidden" style="color:#FF0000;">*</i><br /><i id="hai_mmon" class="hidden" style="color:#FF0000; font-size:14px;">Bạn chưa nhập mã môn</i>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Tên môn học </td>
    <td><input onblur="TEN_MON();"name="ten_mon_hoc" type="text" id="ten_mon_hoc" value="" />
	<i id="mot_tmon" class="hidden" style="color:#FF0000;">*</i><br /><i id="hai_tmon" class="hidden" style="color:#FF0000; font-size:14px;">Bạn chưa nhập tên môn</i>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4" align="center"><input name="ok" type="submit" id="ok" value="Lưu lại" />
      &nbsp;&nbsp;&nbsp;
      <input name="Cancel" type="reset" id="Cancel" value="Làm lại" /></td>
  </tr>
</table>
</form>
<table width="100%" border="1" cellpadding="0" cellspacing="0">  
  <tr><td colspan="5">
  	<div style="overflow:scroll; height:400px; width:750px;">
  	<?php
		include("./include/connect.php");
		$str="select * from mon_hoc";
		$sql=mysql_query($str,$conn) or die("Lỗi câu truy vấn.");
		if(mysql_num_rows($sql)==0)
			echo "Chưa có môn học.";
		else{
		?>
			<table style="color:#003366;" width="100%" border="1" cellpadding="3" cellspacing="0" >
				<tr align="center" style="color:#993300; background:#999966; font-size:22px;">
				  <td align="center" nowrap="nowrap">&nbsp;C N&nbsp;</td>
				  <td    align="center" nowrap="nowrap">STT</td>
				  <td nowrap="nowrap">Mã môn học </td>
				  <td nowrap="nowrap">Tên môn học </td>
				  </tr>
			<?php
				$i=0;
				while($hang=mysql_fetch_array($sql)){
					$i++;
					if($i%2==0){
				?>
						<tr  style="font-size:20px; background:#FFFFFF;"><td >
							<form  action="./index.php?lk=cap_nhat_mh" method="post" enctype="multipart/form-data" name="cap_nhat">
							<input name="ma_mh" id="ma_mh" type="hidden" value="<?php echo $hang[0]; ?>" />
							<input title="Xóa" style=" width:10px; height:15px; background:url(./image/Delete.png); border:0; cursor:pointer; color:#FFFFFF;" name="xoa2" type="submit" id="xoa2" value="x" onclick="return KTXOA(this.value);" />
							&nbsp;
							<input title="Sửa"  style=" width:10px; height:15px;background:url(./image/Edit.png); border:0;cursor:pointer; color:#FFFFFF;" name="xoa" type="submit" id="xoa" value="s" />
							</form>
							</td><td    align="center"><?php echo $i; ?></td><td ><?php echo $hang[0]; ?></td><td nowrap="nowrap"><?php echo $hang[1]; ?></td></tr>
				<?php
					}else{
					?>
						<tr  style="font-size:20px; background:#CCCCCC;"><td ><form  action="./index.php?lk=cap_nhat_mh" method="post" enctype="multipart/form-data" name="cap_nhat">
							<input name="ma_mh" id="ma_mh" type="hidden" value="<?php echo $hang[0]; ?>" />
							<input title="Xóa" style=" width:10px; height:15px; background:url(./image/Delete.png); border:0; cursor:pointer; color:#999999;" name="xoa" type="submit" id="xoa" value="x" onclick="return KTXOA(this.value);" /> &nbsp;
							<input title="Sửa"  style=" width:10px; height:15px;background:url(./image/Edit.png); border:0;cursor:pointer; color:#FFFFFF;" name="xoa" type="submit" id="xoa" value="s" />
							</form></td><td  align="center"><?php echo $i; ?></td><td ><?php echo $hang[0]; ?></td><td nowrap="nowrap"><?php echo $hang[1]; ?></td></tr>
					<?php
					}
				}
			?>				
			</table>
		<?php		
		}
	?>
	</div>
  </td></tr>
</table>
</body>
</html>
