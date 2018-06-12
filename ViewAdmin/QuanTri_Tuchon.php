<?php	
	if (!defined('IN_SITE')) 
 	 	header('Location: ../index.php')	;	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Website Trưởng bộ môn-Phân công chuyên môn </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="ViewAdmin/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/jquery.tabledit.js"></script>

   	<style type="text/css">
		.style1 {
			color: #333;
		}
		.table>thead>tr>th
{
vertical-align:middle !important;
}
	</style>
</head>
<body>
 <div class="wrapper" style="background-color:#FFFFFF"> 
<?php
    require_once("ViewAdmin/header.php");
	require_once("ViewAdmin/function.php");
	$he=isset($_POST['he'])? intval($_POST['he']):'';
	$maNganh=isset($_POST['nganh'])? $_POST['nganh']:'';
	$sttKhoa=isset($_POST['sttKhoa'])? $_POST['sttKhoa']:'';
	$bigdata='';
	if($he!='' && $maNganh!='' & $sttKhoa!='')
	{
		$bigdata=get_table_tuchon($maNganh,$sttKhoa,$he);
	}
?>		
	
<div class="wrapper" style="background-color:#FFFFFF"> 
<div>
	    
	 	<div class="container">
      		<div class="row">	
					<?php $mabm=$_SESSION['ss_user_token']['Mabm']; ?>
					<form action="" method="post" id="myform">
			Ngành: <select name="nganh" id='nganh'>
							<option value="">--Chọn ngành</option>
							<?php $data=get_nganh($mabm);
							while($row=$data->fetch_assoc()){ ?>
									<option <?php echo $maNganh==$row['maNganh']? 'selected':''; ?> value="<?php echo $row['maNganh'] ?>" ><?php echo $row['tenNganh'] ?></option>
								
							<?php }?>
					</select>  
							Khóa:<input type="number" name='sttKhoa' id='sttKhoa' >
							Hệ: <select name="he" id="">
									<option <?php echo $he==1? 'selected':''; ?>value="1">Cao Đẳng</option>
									<option <?php echo  $he==2? 'selected':''; ?> value="2">Trung Cấp</option>
							</select>
						<button class='btn btn-success'>Xem</button>
		

					</form>
					<td width="150">
					</tr>
					<tr>
					</table>
			</center>		
			
			
    	    <table class="table table-hover" border="1" id='example5'  >

	          	<thead>
					<tr >
					  <th width="29" ><center> STT</center> </th>
					  <th width="30" valign="middle">Học kì</th>
 					  <th width="50"  ><center>Số tín chỉ</center></th>
					
					</tr>
											
			  </thead>
			  <tbody>
				<?php 
					if(isset($bigdata)&& $bigdata!='')
					{
						
						$stt=0;
						while($row=$bigdata->fetch_assoc()){
							$stt++;

				?>
							<tr>
								
									<td><?php echo $stt; ?></td>
									<td hidden><?php echo $row['maNganh']; ?></td>
									<td hidden><?php echo $row['sttKhoa']; ?></td>
									<td hidden><?php echo $row['he']; ?></td>
									<td><?php echo $row['hocKi']; ?></td>
									<td><?php echo $row['soTc']; ?></td>
									<td hidden><?php echo $row['hocKi']; ?></td>
									
							</tr>
					<?php
						}
				 }?>		
			  </tbody>
			</table>	
      	</div>
 
    	</div>
	
		
	</div>
	</div>
<?php 	require_once("footer.php");?>
</div><!--end wrapper--> 
</body>
</html>
<script>
$(document).ready(function () {
	var manganh=$('#nganh').val()
	get_khoa(manganh)
});
	$('#nganh').change(function () { 
		var manganh=this.value;
		if(manganh!='')
		{
			get_khoa(manganh)
		}

		
	});
	function get_khoa(manganh)
	{
		$.ajax({
				type: "post",
				url: "index.php?f=function",
				data: {
					"action":"get_khoa",
					"maNganh":manganh
					},
				success: function (response) {
					if(response=='')
					{
						$('#sttKhoa').val(0)
					}else{
						$('#sttKhoa').val(response)
					}
				}
			});
	}
	$('#example5').Tabledit({
    url: 'index.php?f=QuanTri_edittuchon',
    deleteButton: false,
    saveButton: true,
    autoFocus: false,
    buttons: {
        edit: {
            class: 'btn btn-sm btn-primary',
            html: '<span class="glyphicon glyphicon-pencil"></span> &nbsp EDIT',
            action: 'edit'
		},
		save:{
                    class: 'btn btn-success',
                    html: '<span class="glyphicon glyphicon-pencil"></span> &nbsp SAVE',
                    action:'save'
                }
    },
    columns: {
        identifier: [0, 'id'],
        editable: [ [1, 'maNganh'],[2,'sttKhoa'],[3,'he'],[5,'sotc'],[6,'hocKi']]
	},
	 onSuccess: function(data, textStatus, jqXHR) {
					
               
                },
            onFail: function(jqXHR, textStatus, errorThrown) {
                console.log('onFail(jqXHR, textStatus, errorThrown)');
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                    }
             });
</script>