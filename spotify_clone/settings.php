<?php 
include("includes\includedFiles.php");
?>

<div class="entityInfo">
  <div class="centerSection">
    <div class="userInfo">
      <h1><?php echo $userLoggedIn->getFirstAndLastName(); ?></h1>
    </div>
    <div class="btnItems">
      <button class="btn" onclick="openPage('updateDetails.php')">USER DETAILS</button>
      <button class="btn" onclick="logout()">LOGOUT</button>

    </div>
  </div>
</div>