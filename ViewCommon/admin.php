<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="ViewCommon/css/w3.css">
</head>
<body>

<header class="w3-container w3-teal">
<img style="margin:0px" src="ViewCommon/image/banner.png" alt="Ko thay" width="1030" height="184">
</header>

<div class="w3-bar w3-blue">
  <button class="w3-bar-item w3-button" onclick="openCity('London')">Phân công chuyên môn</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Paris')">NCKH</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Tokyo')">Tập bài giảng</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Tokyo')">Hoạt động khác</button>
</div>

<div id="London" class="w3-container city" style="display:none">
  <h2>London</h2>
  <p>London is the capital city of England.</p>
</div>

<div id="Paris" class="w3-container city" style="display:none">
  <h2>Paris</h2>
  <p>Paris is the capital of France.</p> 
</div>

<div id="Tokyo" class="w3-container city" style="display:none">
  <h2>Tokyo</h2>
  <p>Tokyo is the capital of Japan.</p>
</div>

<div class="w3-container" style=" height:500px">
  <h2>Side Navigation Example</h2>
  <p>Note that you control the size of the sidenav with style="width:value". To change the color, change the w3-color class.</p>

  <p>Make sure to add the margin-left property to the page content, with a value that is equal to the width of the sidenav. If you omit this, the navigation pane will overlay/sit on top of the page content.</p>
</div>
<script>
function openCity(cityName) {
    var i;
    var x = document.getElementsByClassName("city");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(cityName).style.display = "block";  
}
</script><footer class="w3-container w3-teal">
  <h5>Bộ môn tin học</h5>
  <p>Footer information goes here</p>
</footer>

</div>
      
</body>
</html>
