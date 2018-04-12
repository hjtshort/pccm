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
	<link href="ViewAdmin/style.css" rel="stylesheet" type="text/css" />\
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Website Truong bo mon</title>
    <link href="ViewAdmin/style.css" rel="stylesheet" type="text/css" />
    <link href="ViewAdmin/style1.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css" />
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
     require_once("ViewCB/header.php");
     require_once("function.php");
    
    ?>
    <div class="container">
    
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


