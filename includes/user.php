<?php
//User Class For account creation and login purpose

class User
{
	private $con;
	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
}

//User is already registered or not
	
	public function emailExists($table,$email){
		$email = mysqli_real_escape_string($this->con,$email);
		$pre_stmt = $this->con->prepare("SELECT id FROM $table WHERE email = ? ");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if($result->num_rows > 0){
			return 1;
		}else{
			return 0;
		}
		
	}
	public function mnoExists($table,$mno){
		$mno = mysqli_real_escape_string($this->con,$mno);
		$pre_stmt = $this->con->prepare("SELECT id FROM $table WHERE mobile = ? ");
		$pre_stmt->bind_param("s",$mno);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if($result->num_rows > 0){
			return 1;
		}else{
			return 0;
		}
		
	}



public function createUserAccount($table,$name,$email,$password,$mno,$act_code){
		//To protect your application from sql attack you can use prepares statement
		
		if($this->mnoExists($table,$mno)){
			return "Mobile_No_ALREADY_EXISTS";
		}
		else if($this->emailExists($table,$email)){
			return "EMAIL_ALREADY_EXISTS";
		}else{
			$email = mysqli_real_escape_string($this->con,$email);
			$name = mysqli_real_escape_string($this->con,$name);
			$password = mysqli_real_escape_string($this->con,$password);
			$mno = mysqli_real_escape_string($this->con,$mno);
			
			$date = date("Y-m-d H:i:s");
			$pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);
			$pre_stmt = $this->con->prepare("INSERT INTO $table (`u_nme`,`email`, `password`, `mobile`,`reg_date`,`last_login`,`act_code`,`act_status`) VALUES (?,?,?,?,?,?,?,'0')");
			$pre_stmt->bind_param("sssssss",$name,$email,$pass_hash,$mno,$date,$date,$act_code);
			$result = $pre_stmt->execute() or die($this->con->error);
			if($result){
				return $this->con->insert_id;
			}
			else{
				return "SOME_ERROR";
				}
		}
		
		
		
		
	}
	
	
	public function send_activation_code($email,$act_code,$uid)
	{
require '../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//activation_code
$to = $email;
		$subject = 'Activation Link from Dreamspark.in';
		$from = 'alexoscar940@gmail.com';//Its not valid email Address
		//To send HTML mail, the Content-type header must be set_error_handler
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		//Create email headers
		$headers .= 'From: '.$from."\r\n".'Reply-To: '.$from."\r\n".'X-Mailer: PHP/' .phpversion();
		
		//compose a simple HTML email message
		
		$message = "<html><body>";
		$message .= "<h1 style='color:#f40;'>Hi $email</h1>";
		$message .= "<p style='color:#333;font-size:14px;font-family:san-serif,Arial;'>Please Click on given link to Activate your account</p>";
		$message .= "<a href ='localhost/New%20WorkSpace/Ecommerce%20with%20bootstrap%203/activation_code.php?ACTIVATION_CODE=".$act_code."&uid=".$uid."&ue=".$email."'>Click here</a>";
		$message .= '</body></html>';		


//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'alexoscar940@gmail.com';                 // SMTP username
$mail->Password = '##+dik$h@+##';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom($headers, 's');
$mail->addAddress($to, 's');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->Body    = $message;
$mail->AltBody = '';

//Sending email

if(!$mail->send()) {
    return false;
} else {
    return true;
}

		
		
		
		
	}
	
	public function userLogin($table,$email,$password){
		$email = mysqli_real_escape_string($this->con,$email);
		$password = mysqli_real_escape_string($this->con,$password);
		$pre_stmt = $this->con->prepare("SELECT id,u_nme,password FROM $table WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		
		if($result->num_rows < 1){
			return "NOT_REGISTERED";
		}else{
			$row = $result->fetch_assoc();
			if(password_verify($password,$row["password"])){
			
    			
				$_SESSION["id"] = $row["id"];
				$_SESSION["name"] = $row["u_nme"];
				$_SESSION["email"] = $email;
				$_SESSION["password"] = $row["password"];
				//$_SESSION["last_login"] = $row["last_login"];
				
				setcookie("id",$row["id"],strtotime("+1 day"),"/","","",TRUE);
				setcookie("name",$row["u_nme"],strtotime("+1 day"),"/","","",TRUE);
				setcookie("email",$email,strtotime("+1 day"),"/","","",TRUE);
				setcookie("password",$row["password"],strtotime("+1 day"),"/","","",TRUE);
				//setcookie("last_login",$row["last_login"],strtotime("+1 day"),"/","","",TRUE);
				
				
				//Here We are updating user last login time when he is performing login
				$last_login = date("Y-m-d h:m:s");
				
				$pre_stmt = $this->con->prepare("UPDATE $table SET last_login = ? WHERE email = ?");
				$pre_stmt->bind_param("ss",$last_login,$email);
				$result = $pre_stmt->execute() or die($this->con->error);
				if($result){
					
					return 1;
				}else{
					return 0;
				}
			}else{
				return "PASSWORD_NOT_MATCHED";
			}
		}
		
	}
	

	
	
}

//$x = new User();
//echo $x->createUserAccount("cust_info","sumit sharma","alexoscar\x00940@gmail.com","123456789","8962117818","1223rfdfsdfadfsv");
//echo $x->userLogin("cust_info","alexoscar940@outlook.com","134567890");
?>