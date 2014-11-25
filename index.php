
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Alumni Website</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/main.js" ></script>



    </head>
    <body>
    <div id="navigation_container">
         <div class="rectangle">


        <ul id="navigation">
            <li><a href="index.html"><span id="highlight">Home</span></a></li>
            <li><a href="Store.html">Store</a></li>
            <li><a href="Donate.html">Donate</a></li>
            <li><a href="Find.php">Find Graduate</a></li>
            <li><a href="AboutUs.html">About</a></li>
            <li><a href="">Contact Us</a></li>
        </ul>
    </div>

<span id="login_input">
    <form name="Login_Form" action="validate.php" onsubmit="return validateForm()" method="post">
        Username:<input type="text" name="username"><br>
       Password: <input type="password" name="password"><br>
        <input type="submit" value="Login" name="login_submit">
        <p id="Message">
    </form>
</span>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
