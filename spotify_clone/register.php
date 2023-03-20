<?php 
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");
  $account = new Account($conn);
 include("includes/handlers/register-handler.php"); 
 include("includes/handlers/login-handler.php"); 
 
 function getInputValue ($name) {

  if(isset($_POST[$name]))
 {
  echo $_POST[$name];
 }
 }
 ?>


<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets\css\register.css">
  <title>Welcome to Media Port</title>
</head>
<body>

  <div id="background">
    <div id="loginContainer">
  <div id="inputContainer">
    <form action="register.php" method="POST" id="loginForm">
      <h2>Login to your account</h2>
      <div>
        <?php echo $account->getError(Constants::$loginFailed); ?>

        <label for="loginUsername">Username</label>
        <input type="text" value="<?php getInputValue("loginUsername"); ?>" id="loginUsername" name="loginUsername" placeholder="e.g. Bart_Simpson" required="true">
      </div>
      <div>
        <label for="loginPassword">Password</label>
        <input type="password" id="loginPassword" name="loginPassword"  required="true">
      </div>
        <button type="submit" name="loginBtn">Login</button>
        <div class="hasAccountText">
          <span id="hideLogin">Don't have an account yet? Signup here.</span>
        </div>
    </form>

    <form action="register.php" method="POST" id="registerForm">
      <h2>Create an account</h2>
      <div>
        <?php echo $account->getError(Constants::$usernameLength); ?>
        <?php echo $account->getError(Constants::$usernameTaken); ?>
        <label for="registerUsername">Username</label>
        <input value="<?php getInputValue("registerUsername") ?>" type="text" id="registerUsername" name="registerUsername" placeholder="e.g. Bart_Simpson" required="true">
      </div>
      <div>
        <?php echo $account->getError(Constants::$firstNameLength); ?>
        <label for="firstName">First name</label>
        <input value="<?php getInputValue("firstName") ?>" type="text" id="firstName" name="firstName" placeholder="e.g. Bart" required="true">
      </div>
      <div>
        <?php echo $account->getError(Constants::$lastNameLength); ?>
        <label for="lastName">Last name</label>
        <input value="<?php getInputValue("lastName") ?>" type="text" id="lastName" name="lastName" placeholder="e.g. Simpson" required="true">
      </div>
      <div>
        <?php echo $account->getError(Constants::$emailIsInvalid); ?>
        <?php echo $account->getError(Constants::$emailTaken); ?>
        <label for="email">Email</label>
        <input value="<?php getInputValue("email") ?>" type="email" id="email" name="email" placeholder="e.g. John_Doe@example.com" required="true">
      </div>
      <div>
        <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
        <label for="confirmEmail">Confirm email</label>
        <input value="<?php getInputValue("confirmEmail") ?>" type="email" id="confirmEmail" name="confirmEmail" placeholder="e.g. John_Doe@example.com" required="true">
      </div>
      <div>
        <?php echo $account->getError(Constants::$passwordsCanOnlyContain);?>
        <?php echo $account->getError(Constants::$passwordLength); ?>
        <label for="registerPassword">Password</label>
        <input type="password" id="registerPassword" name="registerPassword"  required="true">
      </div>
      <div>
        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
        <label for="confirmRegisterPassword">Confirm password</label>
        <input type="password" id="confirmRegisterPassword" name="confirmRegisterPassword"  required="true">
      </div>
        <button type="submit" name="registerBtn">SIGN UP!</button>
        <div class="hasAccountText">
        <span id="hideRegister">Have an account? Login here.</span>
        </div>
    </form>
  </div>
  <div id="loginText">
    <h1>Get great music, right now</h1>
    <h2>Listen to loads of songs for free</h2>
    <ul>
      <li>
        Discover music you'll fall in love with
      </li>
      <li>
        Create your own play list
      </li>
      <li>
        Follow artists to keep up to date
      </li>
    </ul>
  </div>
  </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="assets/js/register.js"></script>
  <script>$(document).ready(function() { 
    $("#loginForm").show();
    $("#registerForm").hide();
  })
  </script>
  
  <?php if(isset($_POST["registerBtn"])) {
      echo '<script>$(document).ready(function() { 
          $("#loginForm").hide();
          $("#registerForm").show();
        })
        </script>';
  }
   else {
      echo '<script>$(document).ready(function() { 
        $("#loginForm").show();
        $("#registerForm").hide();
      })
      </script>';
  }; ?>


</body>
</html>