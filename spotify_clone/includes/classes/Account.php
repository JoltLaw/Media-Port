<?php
class Account {

  private $conn;
  private $error_array;

public function __construct($conn) {
  $this->error_array = array();
  $this->conn = $conn;
  }

public function login ($username, $password) {
    $password = md5($password);
    $query = mysqli_query($this->conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) == 1) {
      return true;
    } else {
      array_push($this->error_array, Constants::$loginFailed);
      return false;
    }
}


public function register($username, $first_name, $last_name, $email, $confirmEmail, $registerPassword, $confirmRegisterPassword) {
 $this->validateUsername($username);
 $this->validateFirstname($first_name);
 $this->validateLastname($last_name);
 $this->validateEmails($email, $confirmEmail);
 $this->validatePasswords($registerPassword, $confirmRegisterPassword);

 if(empty($this->error_array)) {
  return $this->insertUserDetials($username, $first_name, $last_name, $email, $registerPassword);
 } else {
  return false;
 }
}

public function getError ($error) {
  if(!in_array($error, $this->error_array)) {
    $error = "";
  }
  return "<span class='error_message'>{$error}</span>";
}

private function insertUserDetials($username, $first_name, $last_name, $email, $registerPassword) {
  $encryptedPW = md5($registerPassword);
  $profilePic = "assets\images\profile-pics\head_emerald.png";
  $date = date("Y-m-d"); 

  $result = mysqli_query($this->conn, "INSERT INTO users VALUES('', '$username', '$first_name', '$last_name', '$email', '$encryptedPW', '$date', '$profilePic')");

  return $result;
}


private function validateUsername($username) {
if(strlen($username) > 25 || strlen($username) < 5) {
  array_push($this->error_array, Constants::$usernameLength);
  return;
}

$checkUsernameQuery = mysqli_query($this->conn, "SELECT username FROM users WHERE username='$username'");
if(mysqli_num_rows($checkUsernameQuery) != 0) {
    array_push($this->error_array, Constants::$usernameTaken);
    return;
}
}

private function validateFirstname($first_name) {
  if(strlen($first_name) > 50 || strlen($first_name) < 2) {
    array_push($this->error_array, Constants::$firstNameLength);
    return;
  }
}
private function validateLastname($last_name) {
  if(strlen($last_name) > 50 || strlen($last_name) < 2) {
    array_push($this->error_array, Constants::$lastNameLength);
    return;
  }
  

}

private function validateEmails($email, $confirmEmail) {

    if($email != $confirmEmail) {
      array_push($this->error_array, Constants::$emailsDoNotMatch);
      return;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      array_push($this->error_array, Constants::$emailIsInvalid);
      return;
    }

    $checkEmailQuery = mysqli_query($this->conn, "SELECT email FROM users WHERE email='$email'");
if(mysqli_num_rows($checkEmailQuery) != 0) {
    array_push($this->error_array, Constants::$emailTaken);
    return;
}

}

private function validatePasswords($password, $confirmpassword) {
  
  if($password != $confirmpassword) {
      array_push($this->error_array, Constants::$passwordsDoNotMatch);
      return;
  }

  if(preg_match("/[^A-Za-z0-9]/", $password)) {
    array_push($this->error_array, Constants::$passwordsCanOnlyContain);
    return;
  }

  if(strlen($password) > 30 || strlen($password) < 5) {
    array_push($this->error_array, Constants::$passwordLength);
    return;
  }
}


}
?>