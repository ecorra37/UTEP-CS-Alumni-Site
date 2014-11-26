function validateForm() {
    var Username = document.forms["Login_Form"]["Username"].value;
    var Password = document.forms["Login_Form"]["Password"].value;
    $.post('test.php',{user:Username}, function (output) {
            alert(output);
    });
}

function send_post() {
	 if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    hr=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    hr=new ActiveXObject("Microsoft.XMLHTTP");
  }
      
      
       var hr = new XMLHttpRequest();

	var fn = document.getElementById("post").value;
	var vars = "post="+fn;
	var url ="send_post.php";
	hr.open("POST",url,true);
 hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
        		 	
	document.getElementById("status").innerHTML = hr.responseText;
		
        }
    }
    hr.send(vars);
	document.getElementById("status").innerHTML = "Processing...";
	
}﻿

