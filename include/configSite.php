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
	function searchGrad(){
		if(!isset($_POST['submitted'])){
			return false;
		}

		$formvars = array();

		if(!$this->ValidateSearchSubmission()){
			return false;
		}
		
		$this->CollectSearchSubmission($formvars);
		
		if(!$this->searchGradHelper($formvars)){
			//$this->HandleError("Did not Find any Results by 2 " . $formvars['eventSearch']);
			return false;
		} else {
			$result = $this->searchGradHelper($formvars);
		}

		return $result;
	}
	
	function ValidateSearchSubmission(){
		//This is a hidden input field. Humans won't fill this field.
		if(!empty($_POST[$this->GetSpamTrapInputName()]) ){
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}

		$validator = new FormValidator();
		$validator->addValidation("eventSearch", "req", "Search Field is Empty!");

		if(!$validator->ValidateForm()){
			$error = '';
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				$error .= $inpname.':'.$inp_err."\n";
			}
			$this->HandleError($error);
			return false;
		}        
		return true;
	}
	
	function CollectSearchSubmission(&$formvars){
		$formvars['eventSearch'] = $this->Sanitize($_POST['eventSearch']);
	}
	
	function searchGradHelper(&$formvars){
		if(!$this->DBLogin()){
			$this->HandleError("Database login failed!");
			return false;
		}
		
		$formvars['eventSearch'] = strtolower($formvars['eventSearch']);
		
		$sql = "SELECT * FROM REGEXP '^f.*$';";
		
		$sql = "SELECT * FROM Events WHERE Ecity LIKE '" . $formvars['eventSearch'] . "' UNION ALL 
		SELECT * FROM Events WHERE Estate LIKE '" . $formvars['eventSearch'] . "' UNION ALL
		SELECT * FROM Events WHERE Evename LIKE '" . $formvars['eventSearch'] . "' UNION ALL
		SELECT * FROM Events WHERE Ezip LIKE '" . $formvars['eventSearch'] . "'UNION ALL
		SELECT * FROM Events WHERE EphoneNumber LIKE '" . $formvars['eventSearch'] . "'UNION ALL
		SELECT * FROM Events WHERE Edescription LIKE '" . $formvars['eventSearch'] . "' UNION ALL 
		SELECT * FROM Events WHERE Etype LIKE '" . $formvars['eventSearch'] . "' UNION ALL
		SELECT * FROM Events WHERE Ehashtag  LIKE '" . $formvars['eventSearch'] . "'ORDER BY EstartDate";
		
		$result = mysql_query($sql, $this->connection);
		
		if(!$result || mysql_num_rows($result) <= 0){
			$this->HandleError("Did Not Find Any Results For " . $formvars['eventSearch']);
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
	
	function GetSpamTrapInputName(){
		return 'sp'.md5('KHGdnbvsgst' . $this->rand_key);
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
	/*----------(End) Main Operations----------*/
}
?>