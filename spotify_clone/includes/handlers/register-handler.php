
<?php 

function sanitizeFormUsername($inputText) {
  $inputText = strip_tags($inputText);
  return $inputText;
}

function sanitizeFormPassword($inputText) {
  $inputText = strip_tags($inputText);
  $inputText = str_replace(" ", "", $inputText);
  return $inputText;
}

function sanitizeFormString($inputText) {
  $inputText = strip_tags($inputText);
  $inputText = str_replace(" ", "", $inputText);
  $inputText = ucfirst(strtolower($inputText));
  return $inputText;
}




if(isset($_POST["registerBtn"])) {
  $username = sanitizeFormUsername($_POST["registerUsername"]);
  $first_name = sanitizeFormString($_POST["firstName"]);
  $last_name = sanitizeFormString($_POST["lastName"]);
  $email = sanitizeFormString($_POST["email"]);
  $confirmEmail = sanitizeFormString($_POST["confirmEmail"]);
  $registerPassword = sanitizeFormPassword($_POST["registerPassword"]);
  $confirmRegisterPassword = sanitizeFormPassword($_POST["confirmRegisterPassword"]);


 $wasSuccessful = $account->register($username, $first_name, $last_name, $email, $confirmEmail, $registerPassword, $confirmRegisterPassword);

  if($wasSuccessful) {
    $_SESSION['userLoggedIn'] = $username;
    header("Location: index.php" );
  }
}
?>