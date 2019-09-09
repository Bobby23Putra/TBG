<html>
<head>
<style>
body {
	font-family: Arial !important;
	background: url(bgana.png) repeat;
}
.modal-m1 
{
     position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -200px;
    margin-left: -200px;
    width: 400px;
    height: 400px;
}
.dialogbox
{
    margin: 0 auto;
    background-color: #F6F6F6;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
    border-radius: 20px;
    -webkit-box-shadow: #666 3px 3px 5px;
    -moz-box-shadow: #666 3px 3px 5px;
    box-shadow: #666 3px 3px 20px;
    padding: 20px;
    display:inline-block; /*change*/
}
.mydialogbox
{
    width: 400px;
    text-align:center;
}
fieldset {   
	-moz-border-radius:5px;  
	border-radius: 5px;  
	-webkit-border-radius: 5px; 
}
</style>
</head>
<body>
<div><center><!--<img src="header.png">--></div>

<div class="modal-m1">
	<div class="modal-m2">
		<div class="dialogbox ">
			<div class="mydialogbox">
				<div>
					<div id="titlex">Rebooting. Please Wait.<br>.. please update your LAN network profile <b>NOW</b> ..</div>
					<progress id="bar" value="0" max="100">
					</progress>
					<span id="fallback">0 %</span>
				</div>
			</div>
		</div>
	</div>
</div>
  
</body>
</html>
<script>

window.onload = function() {
	titlex = document.getElementById("titlex");
	var bar = document.getElementById("bar");
	fallback = document.getElementById("fallback");
	loaded = 0;
     
	var load = function() {
		loaded += 3;
		bar.value = loaded;
		fallback.innerHTML = loaded + "%";
		
		if(loaded >= 100) {
			clearInterval(dummyLoad);
			titlex.innerHTML = "Done. Redirecting ...";
			var param = location.search.split('dest=')[1]
			window.location = "http://"+param+":8080";
		}
	};
	
	dummyLoad = setInterval(function() {
		load();
	} ,1000);

}
</script>
