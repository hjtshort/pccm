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

	<SCRIPT LANGUAGE="JavaScript">
      function confirmAction() {
        return confirm("Bạn có chắc xóa không?")
      }
 	</SCRIPT>

	<style type="text/css">
		.style1 {
			color: #0000CC;
		}
		
	</style>


</head>

<body>



 <div class="wrapper" style="background-color:#FFFFFF">

  <?php
	 require_once("lib/QuanTri_CanBo.php");
     require_once("ViewAdmin/header.php");
     require_once("function.php");
    
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                    <div class="form-group">
                            <label for="">Chọn lớp: </label>
                            <div class="chonmon">
                            <select class="form-control" name="" id="nganh">
                                <?php  $data=laynganh();
                                foreach($data as $key=>$value){
                                 ?>
                                    <option value="<?php echo $value['maNganh']; ?>"> <?php echo $value['tenNganh'];  ?></option>
                                <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                                <label for="">Hệ </label><br>
                                <div class="chonmontienquyet">
                                    <select class="form-control" name="he" title="chọn hệ" id="he">                             
                                            <option value="1" selected="selected">Cao đẳng</option>
                                            <option value="2">trung cấp</option>
                                        </select>
                                </div>
                    </div>
            </div> 
            <div class="col-md-6">
                    <label for="">Môn học </label><br>
                    <input class="form-control" type="text" id="inp-search1" placeholder="Tìm kiếm">
                    <div class="chonmontienquyet">
                    <select class="form-control" name="" id="monhoc" size="5"><option value="GQ010" selected="selected">Giáo dục quốc phòng - An ninh 2(GQ010)-2 tín chỉ							
		            </select>
                    </div>
            </div>        
        </div>
        <div style="float:right;margin-bottom: 30px"><button type="button" class="btn btn-custom" type="button" id="insert">Thêm</button></div>
    
        <div class="row">
             <table class="table table-hover"  >
          		<h3 class="style1"> Danh sách các môn học    </h3>

	          	<thead>
					<tr >
					  <th>STT</th>
				  	  <th>Mã môn</th>
					  <th>Tên môn</th>
                      <th>Số tính chỉ</th>
                      <th>Số tiết lý thuyết</th>
                      <th>Số tiết bài tập</th>
                      <th>Số tiết thực hành</th>
					  <th width="70">&nbsp;  </th>
					</tr>
				  </thead>
			  <tbody id="print">
					
			  </tbody>
              </table>
        </div>
    </div>
</div>



<?php include("footer.php");?>
</div><!--end wrapper-->
</body>

</html>
<script>
function NMT()
{
    $.ajax({
        type: "post",
        url: "index.php?f=function",
        data: 
        {"action":'NMT'
        },
        success: function (response) {
            $('#monhoc').html(response)
        }
    });
}
$('#inp-search1').keyup(function (e) { 
    var search=this.value
    $.ajax({
        type: "post",
        url: "index.php?f=function",
        data: 
        {"action":'NMTA',
        "search":search
        },
        success: function (response) {
            $('#monhoc').html(response)
        }
    });
});
$('#insert').click(function (e) { 
    var nganh=$('#nganh').val()
    var mamon=$('#monhoc').val()
    var he=$('#he').val()
    if(mamon!='')
    {
        $.ajax({
            type: "post",
            url: "index.php?f=function",
            data: {"action":"NMTAN",
            "maNganh":nganh,
            "maMon":mamon,
            "he":he
            },
            success: function (response) {
                if(response=="ok")
                    table()
                else 
                    alert('Môn học đã tồn tại trong ngành!')
            }   
        });
    }
    
});


$('#nganh').on('change', function () {
   table()

});
$('#he').on('change', function () {
   table()

});


function table(){
    var nganh=$('#nganh').val()
    var he=$('#he').val()
    $.ajax({
        type: "post",
        url: "index.php?f=function",
        data: {
            "action":"hocnganh",
            "nganh":nganh,
            "he":he
        },
        success: function (response) {
            $('#print').html(response)
        }
    });
}
function del(e)
{
    var nganh=$('#nganh').val()
    var he=$('#he').val()
    $.ajax({
        type: "POST",
        url: "index.php?f=function",
        data: {
            "action":"xoamonhocnganh",
            "maMon":e,
            "nganh":nganh,
            "he":he
        },
        success: function (response) {
            if(response=="ok")
            {
                table()
            }
            
        }
    });
}
$(document).ready(function () {
    table()
    NMT()
});
</script>


