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
	<link href="ViewAdmin/style1.css" rel="stylesheet" type="text/css" />
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
     require_once("ViewApp/header.php");
     require_once("function.php");
    
    ?>
    <div class="container">
        <div class="row">
            <div style="padding-left: 15px; margin-top: 60px">
                    <label for="">Chọn lớp: </label>
                    <div class="chonmon">
                        <select name="" id="nganh">
                              <?php  $data=laynganh();
                              foreach($data as $key=>$value){
                               ?>
                                  <option value="<?php echo $value['maNganh']; ?>"> <?php echo $value['tenNganh'];  ?></option>
                              <?php } ?>
                        </select>
                    </div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-6">
                    <label for="">Chọn môn: </label><br>
                    <input type="text" id="inp-search1" placeholder="Tìm kiếm">
                    <div class="chonmon">
                        <select name="" id="monhoc" size="5">
                           
                        </select>
                    </div>
                </div>
                  <div class="col-md-6">
                          <label for="">Chọn môn tiên quyết: </label><br>
                          <input type="text" id="inp-search2" placeholder="Tìm kiếm">
                          <div class="chonmontienquyet">
                          <select name="" id="monhoctienquyet" size="5">
                                    
                                  </select>
                          </div>
                  </div>
            
              </div>
        <div style="margin-bottom: 30px"><button type="button" class="btn btn-custom" type="button" id="insert">Thêm</button></div>
    
        <div class="row">
             <table class="table table-hover"  >
          		<h3 class="style1"> Danh sách các môn học    </h3>

	          	<thead>
					<tr >
					  <th width="20"> STT </th>
				  	  <th width="10">Mã môn</th>
					  <th width="130">Tên môn</th>
                      <th width="10">Mã môn tiên quyết</th>
					  <th width="130">Tên môn tiên quyết</th>
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
$('#inp-search1').keyup(function (e) { 
    var nganh=$('#nganh').val()
    var search=this.value
    $.ajax({
        type: "post",
        url: "index.php?f=function",
        data: {
            "action":"search2",
            "nganh":nganh,
            "search":search
            },
        success: function (response) {
            $('#monhoc').html(response)
        }
    });
});
$('#inp-search2').keyup(function (e) { 
    var nganh=$('#nganh').val()
    var search=this.value
    $.ajax({
        type: "post",
        url: "index.php?f=function",
        data: {
            "action":"search2",
            "nganh":nganh,
            "search":search
            },
        success: function (response) {
            $('#monhoctienquyet').html(response)
        }
    });
});
function laymonhoc(){
    var nganh=$('#nganh').val()
    $.ajax({
        type: "post",
        url: "index.php?f=function",
        data: {"action":"laymonhocnganh",
            "nganh":nganh
        },
        success: function (response) {
             $('#monhoc').html(response)
             $('#monhoctienquyet').html(response)
        }
    });
}
$('#nganh').on('change', function () {
   laymonhoc()
   $('#inp-search1').val('')
   $('#inp-search2').val('')

});
$('#insert').on('click', function () {
    var  monhoc=$('#monhoc').val()
    var monhoctienquyet=$('#monhoctienquyet').val()
    if(monhoc!=null&& monhoctienquyet!=null){
        $.ajax({
            type: "post",
            url: "index.php?f=function",
            data: {"action":"themmontienquyet",
            "monhoc":monhoc,
            "monhoctq":monhoctienquyet
            },
            success: function (response) {
                table()
            }
        });
    }
});
function table(){
    $.ajax({
        type: "post",
        url: "index.php?f=function",
        data: {"action":"laybang"
        },
        success: function (response) {
            $('#print').html(response)
        }
    });
}
function del(e)
{
    $.ajax({
        type: "POST",
        url: "index.php?f=function",
        data: {
            "action":"xoatienquyet",
            "data":e
        },
        success: function (response) {
            table()
        }
    });
}
$(document).ready(function () {
    laymonhoc()
    table()
});
</script>


