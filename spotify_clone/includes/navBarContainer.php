<div id="navBarContainer">
  <nav class="navBar">

  <span onclick="openPage('index.php')" role="link" tabindex="0" class="logo"><img src="assets\images\icons\logo.png" alt="Media Port Logo"></span>


  <div class="group"><div class="navItem">
    <span onclick="openPage('search.php')" role="link" tabindex="0" class="navItemLink">Search
      <img src="assets\images\icons\search.png" alt="Search button" class="icon">
    </span>
  </div></div>
  <div class="group">
    <div class="navItem">

    </div>
    <div class="navItem">
    <span onclick="openPage('browse.php')" role="link" tabindex="0" class="navItemLink">Browse</span>
    </div>

    <div class="navItem">
    <span onclick="openPage('yourMusic.php')" role="link" tabindex="0" class="navItemLink">Your Music</span>
    </div>

    <div class="navItem">
    <span onclick="openPage('settings.php')" role="link" tabindex="0" class="navItemLink"><?php echo $userLoggedIn->getUsername(); ?></span>
    </div>
  </div>

  </nav>
</div>