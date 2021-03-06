<?PHP
class ConfigSite{
	var $admin_email;
	var $from_address;
	
	var $db_host;    /*host*/
	var $username;   /*From DB*/
	var $pwd;        /*From DB*/
	var $database;   /*EventAdvisors*/
	var $tablename1; /*admin*/
	var $tablename2; /*friend_request*/
	var $tablename3; /*items*/
	var $tablename4; /*master*/
	var $tablename5; /*messages*/
	var $tablename6; /*privacy*/
	var $tablename7; /*users_posts*/
	var $tablename8; /*users*/
	var $connection; /**/
	var $rand_key = '5qts9W3JvI';   /**/

	var $error_message; /**/
    
    /*----(Start) Initialization----*/
    function ConfigSite(){ }
    
    function InitDB($host, $uname, $pwd, $database, $tablename1, $tablename2, $tablename3, $tablename4, $tablename5, $tablename6, $tablename7, $tablename8){
        $this->db_host    = $host;
        $this->username   = $uname;
        $this->pwd        = $pwd;
        $this->database   = $database;
        $this->tablename1 = $tablename1;   
        $this->tablename2 = $tablename2;   
        $this->tablename3 = $tablename3;   
        $this->tablename4 = $tablename4;   
        $this->tablename5 = $tablename5;   
        $this->tablename6 = $tablename6;   
        $this->tablename7 = $tablename7;
        $this->tablename8 = $tablename8;
    }
    /*----(End) Initialization----*/
	
    /*----------(Start) Main Operations----------*/
	/*----------Search Graduates----------*/
	function searchGrad($searchGrad){
		echo $searchGrad . " inside the method &nbsp;";
		
		if(!$this->DBLogin()){
			$this->HandleError("Database login failed!");
			return false;
		}
		
		if(!isset($searchGrad)){
			echo "Please Fill Out The...";
			return false;
		}
		
		$searchGrad = $this->Sanitize($searchGrad);
		
		
		echo "before query";
		$sql = "SELECT * FROM master WHERE * LIKE '%" . $searchGrad . "%'";
		echo "after query";
		
		
		$result = mysql_query($sql, $this->connection);
		
		if(!$result || mysql_num_rows($result) <= 0){
			$this->HandleError("Did Not Find Any Results For " . $searchGrad);
			return false;
		}

		return $result;
	}
	
	function HandleError($err){
        $this->error_message .= $err."\r\n";
    }
	
	function HandleDBError($err){
		$this->HandleError($err . "\r\n mysqlerror: " . mysql_error());
	}
	
	function Sanitize($str, $remove_nl = true){
		$str = $this->StripSlashes($str);

		if($remove_nl){
			$injections = array('/(\n+)/i', '/(\r+)/i', '/(\t+)/i', '/(%0A+)/i', '/(%0D+)/i', '/(%08+)/i', '/(%09+)/i', '/(%+)/i');
			$str = preg_replace($injections, '', $str);
		}
		return $str;
	}
	
	function StripSlashes($str){
        if(get_magic_quotes_gpc()){
            $str = stripslashes($str);
        }
        return $str;
    }
	
	function userName(){
        return isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ' ';
    }
	
	function addUser(){
		//should add user based on the ID
		
		$this->RedirectToURL();
	}
	
	function alreadyAdded($last, $first){
		if(!$this->DBLogin()){
			$this->HandleError("Database login failed!");
			return false;
		}
		
		
		
		
	}
	
	function RedirectToURL($url){
		header("Location: $url");
		exit;
	}
	/*----------(End) Main Operations----------*/
	
	/*----------(Start) Login----------*/
	function login(){
        if(empty($_POST['Username'])){
            $this->HandleError("Username is empty!");
            return false;
        }
        
        if(empty($_POST['password'])){
            $this->HandleError("Password is empty!");
            return false;
        }
        
        $username = trim($_POST['Username']);
        $password = trim($_POST['password']);
        
        if(!isset($_SESSION)){ session_start(); }
        if(!$this->checkLoginInDB($username, $password)){
            return false;
        }
        
        $_SESSION[$this->getLoginSessionVar()] = $username;
        
        return true;
    }
	
	function LogOut(){
        session_start();
        
        $sessionvar = $this->getLoginSessionVar();
        
        $_SESSION[$sessionvar] = NULL;
        
        unset($_SESSION[$sessionvar]);
    }
	
	function checkLoginInDB($username, $password){
		if(!$this->DBLogin()){
			$this->HandleError("Database login failed!");
			return false;
		}
		
		$username = $this->SanitizeForSQL($username);
		$pwdmd5 = md5($password);
		$qry = "SELECT first, last, email, username FROM $this->tablename8 WHERE username = '$username' AND password = '$pwdmd5'";

		$result = mysql_query($qry, $this->connection);

		if(!$result || mysql_num_rows($result) <= 0){
			$this->HandleError("Error logging in.\nYour username or password does not match");
			return false;
		}

		$row = mysql_fetch_assoc($result);

		$_SESSION['name_of_user']  = $row['first'] . " " . $row['last'];
		$_SESSION['user_name']     = $row['username'];
		$_SESSION['email_of_user'] = $row['email'];
		$_SESSION['login_status'] = true;
		

		return true;
	}
	
	function DBLogin(){
        $this->connection = mysql_connect($this->db_host, $this->username, $this->pwd);

        if(!$this->connection){   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
		
        if(!mysql_select_db($this->database, $this->connection)){
            $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
            return false;
        }
		
        if(!mysql_query("SET NAMES 'UTF8'", $this->connection)){
            $this->HandleDBError('Error setting utf8 encoding');
            return false;
        }
        return true;
    }
	
	function CheckLogin(){
		if(!isset($_SESSION)){ session_start(); }

		$sessionvar = $this->GetLoginSessionVar();

		if(empty($_SESSION[$sessionvar])){
			return false;
		}
		return true;
	}
	
	function getLoginSessionVar(){
        $retvar = md5($this->rand_key);
        $retvar = 'usr_' . substr($retvar, 0, 10);
        return $retvar;
    }
	
	function SanitizeForSQL($str){
		if( function_exists( "mysql_real_escape_string" ) ){
			$ret_str = mysql_real_escape_string( $str );
		} else {
			$ret_str = addslashes( $str );
		}
		return $ret_str;
	}
	/*----------(End) Login----------*/
	
	function GetSelfScript(){
		return htmlentities($_SERVER['PHP_SELF']);
	}
	
	function GetErrorMessage(){
		if(empty($this->error_message)){
			return '';
		}
		$errormsg = nl2br(htmlentities($this->error_message));
		return $errormsg;
	}
	
	function SafeDisplay($value_name){
		if(empty($_POST[$value_name])){
			return'';
		}
		return htmlentities($_POST[$value_name]);
	}
	
	/*Hima's method to check login*/
	function validateLogin(){
		session_start();
		include('include/db.php');
		$uname = (isset($_POST['username']) ? $_POST['username'] : null);
		$pwd = (isset($_POST['password']) ? $_POST['password'] : null);
		$username = sanitizeString($uname);
		$password = sanitizeString($pwd);
		$_SESSION['login_user'] = $username;

		// case for login                 
		if(isset($_POST['login_submit']))
		{
			if(ctype_alnum($username))
			{
				//check user exist

				$query = "SELECT username, first FROM users WHERE username='$username'and password='$password'";

				$result = mysqli_query($con, $query);
				$count = mysqli_num_rows($result);

				if($count==1)
				{
					$get = mysqli_fetch_assoc($result);
					//$username=$get['username'];
					$firstname=$get['first_name'];
					//echo "user exist";
					$_SESSION['login_user_fname']=$firstname;
					$_SESSION['login_status']=true;
					header("Location: loginprofile.php");
				} else {
					//user not exist invalud login credentials
					//echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/alumni/index.html\">";
					header("Location: index.php");
					exit();
				}
			}
		}
	}
	
	//Hima's set of functions
	function send_Post(){
		if(!isset($_POST['submitted'])){
			return false;
		}
		
		$post = $this->Sanitize($_POST['post']);
		
		if($post != ""){
			$date_added = date("y-m-d");
			$added_by = $this->userName();
			$user_posted_to = $_SESSION['profile_user'];
			
			$postquery= "INSERT INTO user_posts values('', '$post', '$added_by', '$user_posted_to', '$date_added')";
			//$queryselect="SELECT * FROM users WHERE email='$email'";

			$result = mysqli_query($con, $postquery);
		} else {
			echo "You must enter something in the post field before you can send it...";
		}
	}
	
	// function to sanitize the user input
	function sanitizeString($var){
		$var=  stripcslashes($var);
		$var=  strip_tags($var);
		$var=  htmlentities($var);
		return $var;
	}
}
?>