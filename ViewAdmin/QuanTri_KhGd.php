<?php	
	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php')	;	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Website Trưởngng bộ môn </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="ViewAdmin/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery.js"></script>

    <script type="text/javascript" src="js/main.js"></script>



   	<style type="text/css">
		.style1 {
			color: #0000CC;
		}
	</style>
</head>
<body>
 <div class="wrapper" style="background-color:#FFFFFF"> 
<?php
	require_once("lib/QuanTri_KhGd.php");	
	require_once("ViewAdmin/header.php");
	require_once("ViewAdmin/function.php");
	$now=getdate();
	$nh1=$now["year"];
	$sql="select max(sttKhoa) as khoa from chuongtrinhhoc";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
?>
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	     <form name="form1" method="POST" action="index.php?f=QuanTri_KhGd">
	 	<div class="container">
      		<div class="row">	
			<h3 class="style1"> THÊM KẾ HOẠCH GIẢNG DẠY </h3>
			
			<Center>				 		  
					<input type="image" name="test"  value=""  width="3" height="3">
			        <table width="800" border="1" >
					  <tr>
                        <td height="35" width="140">Ngành: </td>
                        <td ><select name="maNganh" title="chọn mã ngành" id="nganh">							 	
							<?php								
								$data4=laynganh();
								foreach ($data4 as $key=>$value) {
									?>
								
										<option value='<?php echo $value["maNganh"]; ?>' selected="selected"><?php echo $value["tenNganh"]; ?></option>
								<?php } ?>
									
								
						  </select>	
						 </td>						
                      </tr>
					  <tr>
					  	<td height="35" width="140"> Hệ: </td>
                        <td ><select name="he" title="chọn hệ" id="he">							 	
									<option value=1 selected="selected" >Cao đẳng</option>
									<option value=2 >trung cấp</option>
							 </select>						
					  </tr>					  
                      <tr>
                        <td height="35" width="140"> Học kỳ: </td>
                        <td ><select name="hk"  id="hocky">
								<option value=1 selected="selected" >1</option>
								<option value=2 >2</option>
								<option value=3 >3</option>
								<option value=4 >4</option>
								<option value=5 >5</option>
								<option value=6 >6</option>
							 </select>	
						 </td>						
                      </tr>
                      <tr>
                        <td height="35"> Năm học: </td>
						<td ><input type="text" name="namHoc" size="2" id="namhoc" value="<?php echo $now["year"]; ?>"> - &nbsp;&nbsp;
							<input type="text" size="2" value="<?php echo $now["year"]+1; ?>"><br> 
							<div style="color:red;" id="validationnamhoc">
							</div>              
						</td>                       
                      </tr>
                      <tr>
                        <td height="35"> Khóa: </td>
						<td ><input type="text" name="sttKhoa" size="1" id="sttKhoa"  value="<?php echo $data['khoa']; ?>"><br> 
						<div style="color:red;" id="validationkhoa">
							
						</div>  
						</td>
						 <td height="35"><button type="button" class="btn btn-success create">Tạo</button> </td>              
                      </tr>
					   <tr>
							<td>&nbsp</td>
							<td><input  type="text" value="" id="inp-search" placeholder="Tìm kiếm"></td>
						</tr>
						<tr>			
							<td height="35"> Môn học: </td>
							<td ><select name="maMon"  id="mamon" size="5">							 							
									
								</select>	
							</td>                       
                      </tr>
					  <tr>
                        <td colspan="5" height="10"></td>
                      </tr>
                      <tr>
                        <td colspan="3" height="55">		
							<!-- <input  type="submit" value="TÌM KIẾM" name="btn_tim">  -->
							<input  type="button" value="THÊM MÔN HỌC" class="btn btn-custom" style="width: 150px" name="btn_them" id="btn-them">
							<input  type="button" value="XUẤT CHƯƠNG TRÌNH" class="btn btn-custom" style="width: 200px" name="btn_them" id="btn-xuat">     													
							<!--<input  type="submit" value="CHỈNH SỬA" name="btn_sua">    -->
						</td>
                      </tr>  
					  <tr>
					     <td>
							 Danh sách các môn cần xóa
							 <div class="error" style="width:300px; height:100px; border:solid 1px; overflow:auto;">
									
							 </div>
						 </td>
					  </tr>                
                    </table>
			</center>		
			
			
			
    	    <table class="table"  >
          		<h3 class="style1"> Danh sách các môn học    </h3>

	          	<thead>
					<tr >
					  <th width="20"> STT </th>
					  <th width="100"><center>Tên ngành</center></th>
 					  <th width="20"><center>Khóa</center></th>
				  	  <th width="10"><center>Học kì</center></th>
					  <th width="20"><center>Năm học</center></th>
					  <th width="130"><center>Tên môn</center></th>
					  <th width="30"><center>Tín chỉ</center></th>
					  <th width="30"><center>loại</center></th>
					  <th width="50"><button type="button" class="btn btn-xoa"><i class="fa fa-trash"></i> Xóa hết</button>  </th>
					</tr>
				  </thead>
			  <tbody id="print">
					
			  </tbody>
			</table>	
			

		</form>	
	</div>
	</div>
<?php 	require_once("footer.php");?>
</div><!--end wrapper--> 
</body>
</html>
<script>
	$('.create').click(function (e) { 
		var r = confirm("Are you sure!");
		if (r == true){
			var nganh=$('#nganh').val()
			var he= $('#he').val()
			var sttKhoa=$('#sttKhoa').val()
			$.ajax({
				url: 'index.php?f=function',
				type: 'post',
				data: {'action': 'NMTANE',
				'nganh':nganh,
				'he':he,
				'khoa':sttKhoa
				},
				success:function(response)
				{
					console.log(response)
				}
			})
		}
			
	});
	$('#inp-search').keyup(function (e) { 
		var search =this.value
		var nganh=$('#nganh').val()
		var he= $('#he').val()
		$.ajax({
			type: "post",
			url: "index.php?f=function",
			data:{ 
				"nganh":nganh,
				"he":he,
				"action":"search",
				"search":search
			},
			success: function (response) {
				$('#mamon').html(response)
			}
		});
	});
	$('.btn-xoa').click(function (e) { 

		var r = confirm("Bạn chắc xóa không?!");
		if (r == true) {
			var nganh = $('#nganh').val()
			var sttKhoa=$('#sttKhoa').val()
			var he =$('#he').val()
			$.ajax({
				type: "post",
				url: "index.php?f=function",
				data: {"action":"delete-all",
					"maNganh":nganh,
					"sttKhoa":sttKhoa,
					"he":he
				},
				success: function (response) {
					if(response=="ok"){
						gettable()
						NMT()
					}
					else{
						alert("Không thể xóa!")		
					}
					
				}
			});
			
		} 
		else {
			
		}
		
	});

	function NMT(){
		var nganh = $('#nganh').val()
		var sttKhoa=$('#sttKhoa').val()
		$.ajax({
			type: "post",
			url: "index.php?f=function",
			data: {
				"action":"laygido",
				"nganh":nganh,
				"sttKhoa":sttKhoa
			},
			success: function (response) {
				$('.error').html(response)
			}
		});
	}
	function laymonhoc(){
		var nganh = $('#nganh').val()
		var he =$('#he').val()
		$.ajax({
			type: "post",
			url: "index.php?f=function",
			data: {
				"nganh":nganh,
				"he":he,
				"action":"laymonhoc"
			},
			success: function (response) {
				$('#mamon').html(response)
			}
		});
	}
	function gettable(){
		
			var nganh = $('#nganh').val()
			var he =$('#he').val()
			var sttKhoa=$('#sttKhoa').val()
			var hocky =$('#hocky').val()
			var namHoc=$('#namhoc').val()
			$.ajax({
				type: "post",
				url: "index.php?f=function",
				data: {"nganh":nganh,
						"he":he,
						"sttKhoa":sttKhoa,
						"hocky":hocky,
						"action":"gettable"
					},
				success: function (response) {
					$('#print').html(response)
				}
			});
			//console.log(sttKhoa)
			
	}
	$(document).ready(function () {
		get_khoa()
	
		gettable()
		laymonhoc()
		NMT()

	
	});

	$('#print').on("change",function(e){
	 var chon =$(e.target).val()
	 var data =	$(e.target).attr('kai-value')
		$.ajax({
			type: "post",
			url: "index.php?f=function",
			data: {
				"action":"changeloai",
				"data":data,
				"chon":chon
			},
			success: function (response) {
				if(response=="ok")
					gettable()
			}
		});
		//console.log($($(e.target).parent('td').parent('tr')[0]).find("td").eq(2).html()); // cai này là lấy cái select 
	 //lấy cái dong cái nào thay đổi thằng target mới lấy đc hả
		
	});
	$('#nganh').change(function (e) {
		
		gettable()
		get_khoa()
	
		laymonhoc()
		NMT()
		$('#inp-search').val('')
	});
		//lấy lại dữ liệu bảng nếu hệ thay đổi
	$('#he').change(function (e) { 
		gettable()
		laymonhoc()	
		$('#inp-search').val('')
		

	});
		//lấy lại dữ liệu bảng nếu khóa thay đổi
	 $('#sttKhoa').change(function (e) { 
	 	gettable()
		 NMT()		
	 });
	 	//lấy lại dữ liệu bảng nếu học kỳ thay đổi
	 $('#hocky').change(function (e) { 
	 	gettable()		
	 });
	 	//lấy lại dữ liệu bảng nếu năm học thay đổi
	 //xóa môn học ra khỏi kế hoạch giản dạy của 1 lớp
	 function del(a){
		 $.ajax({
			 type: "post",
			 url: "index.php?f=function",
			 data: {"data":a,
					"action":"delete"
			 },
			 success: function (response) {
				 if(response.trim()=="ok"){
					 //lấy lại dữ liệu bảng
					gettable()
					NMT()
				 }
				 else
				 	alert("Không thể xóa!")
			 }
		 });
	 }
	 function TryParseInt(str,defaultValue) {
     var retValue = defaultValue;
     if(str !== null) {
         if(str.length > 0) {
             if (!isNaN(str)) {
                 retValue = parseInt(str);
             }
         }
     }
     return retValue;
	}
	$('#btn-xuat').click(function(event) {
		var nganh = $('#nganh').val();
		var he = $('#he').val();
		var sttKhoa=$('#sttKhoa').val();
		window.location = 'index.php?f=function&action=xuat&he='+he+'&sttKhoa='+sttKhoa+'&nganh='+nganh+'';

			 });
	 $('#btn-them').click(function (e) { 
			var nganh = $('#nganh').val()
			var he =$('#he').val()
			var sttKhoa=$('#sttKhoa').val()
			var hocky =$('#hocky').val()
			var namHoc=$('#namhoc').val()
			var mamon=$('#mamon').val()
			var check=1;
			if(namHoc.toString().length==0){
				$('#validationnamhoc').html('<span>Năm học không được để trống</span><br>');
				check=0
			}
			else if(TryParseInt(namHoc.toString(),0)==0){
				$('#validationnamhoc').html('<span>Năm học phải là số</span><br>');
				check=0
			}
			else if(parseInt(namHoc.toString())>2050 || parseInt(namHoc.toString())<2010 ){
				$('#validationnamhoc').html('<span>Năm học không hợp lệ</span><br>');
				check=0
			}
			if(sttKhoa.toString().length==0){
				$('#validationkhoa').html('<span>Năm học không được để trống</span><br>');
				check=0
			}
			else if(TryParseInt(sttKhoa.toString(),0)==0){
				$('#validationkhoa').html('<span>Năm học phải là số</span><br>');
				check=0
			}
			if(parseInt(check)==1){
				$('#validationkhoa').html('');
				$('#validationnamhoc').html('');
				$.ajax({
					type: "post",
					url: "index.php?f=function",
					data: {"nganh":nganh,
							"he":he,
							"sttKhoa":sttKhoa,
							"hocky":hocky,
							"namhoc":namHoc,
							"mamon":mamon,
							"action":"insertcth"
							},
					success: function (response) {
						//alert(response)
						if(response.trim()=="ok"){
							gettable()
							NMT()
						}
						else if(response.trim()=="no")
							alert('Không thể thêm do môn tiên quyết chưa có trong chương trình học!')
						else 
							alert('Môn học đã có trong chương trình học!')
					}
				});

			}  
	 });
function get_khoa()
{
    var e= $('#nganh').val()
	$.ajax({
		type: "post",
		url: "index.php?f=function",
		data: {
			"action":"get_khoa",
			"maNganh":e
		},
		success: function (response) {
			if(response!='')
				$('#sttKhoa').val(response)
		}
	});
}

</script>