<!DOCTYPE html>
<html>
	<head>
		<script>
			function hyperlink(){
				var b;
				if(window.XMLHttpRequest){
					b = new XMLHttpRequest();
				}
				else {
					b = new ActiveXObject("Microsoft.HMLHTTP");
				}
				b.onreadystatechange = function(){
					if (b.readyState==4 && b.status==200){
						document.getElementById('link').innerHTML = b.responseText;
					}
				}
				b.open('GET', 'upload_file_to_tmp.php', true);
				b.send();
			}
		</script>
	</head>
	<body>
		<h3>Click picture to edit!</h3>
		<a id='link'><img  onclick='hyperlink()' src='pictures/welcome.png' width='60' height='50' ></a>
		<span id='change'></span>
	</body>
</html>
