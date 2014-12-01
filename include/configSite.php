<?PHP
class ConfigSite{
	var $admin_email;
	var $from_address;
	
	var $db_host;    /*host*/
	var $username;   /*From DB*/
	var $pwd;        /*From DB*/
	var $database;   /*EventAdvisors*/
	var $tablename1; /*admin*/
	var $tablename2; /*friends*/
	var $tablename3; /*friend_request*/
	var $tablename4; /*items*/
	var $tablename5; /*master*/
	var $tablename6; /*messages*/
	var $tablename7; /*students_master*/
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
        
        $_SESSION[$sessionvar]=NULL;
        
        unset($_SESSION[$sessionvar]);
    }
	
	function checkLoginInDB($username, $password){
		if(!$this->DBLogin()){
			$this->HandleError("Database login failed!");
			return false;
		}
		
		$username = $this->SanitizeForSQL($username);
		$pwdmd5 = md5($password);
		$qry = "SELECT first, last, email, username FROM $this->tablename5 WHERE username = '$username' AND password = '$pwdmd5'";

		$result = mysql_query($qry, $this->connection);

		if(!$result || mysql_num_rows($result) <= 0){
			$this->HandleError("Error logging in.\nYour username or password does not match");
			return false;
		}

		$row = mysql_fetch_assoc($result);

		$_SESSION['name_of_user']  = $row['first'] . " " . $row['last'];
		$_SESSION['user_name']     = $row['username'];
		$_SESSION['email_of_user'] = $row['email'];

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
         
         if(empty($_SESSION[$sessionvar]))
         {
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
}
?>