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
	var $rand_key;   /**/

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
	}
	
	function alreadyAdded($last, $first){
		
	}
	/*----------(End) Main Operations----------*/
	
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
}
?>