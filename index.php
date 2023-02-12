<?php
  $hostname = "info.tm.edu.ro:3366";
  $username = "nbodrogean";
  $password = "N@dir@%B0lT";
  $database = "nbodrogean";
  
  // Connection
  $database_connection = mysqli_connect(
      $hostname,
      $username,
      $password,
      $database
  );

?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Iti plac jocurile?Ai ajuns unde trebuie">
    <meta name="description" content="">
    <title>Acasa</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="Acasa.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery-1.9.1.min.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 5.5.0, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"url": "/",
		"logo": "images/game-store-logo-template-design-vector.jpg"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Acasa">
    <meta property="og:type" content="website">
    <link rel="canonical" href="/">
  <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
  <body data-home-page="https://website4063769.nicepage.io/Acasa.php?version=7d278615-a0ea-4f62-b133-464354ad218c" data-home-page-title="Acasa" class="u-body u-xl-mode" data-lang="en"><header class="u-clearfix u-custom-color-1 u-header u-header" id="sec-34e0"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="Acasa.php" class="u-image u-logo u-image-1" data-image-width="144" data-image-height="117" title="Acasa">
          <img src="images/game-store-logo-template-design-vector.jpg" class="u-logo-image u-logo-image-1">
        </a>
        <nav class="u-menu u-menu-one-level u-offcanvas u-menu-1">
          <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
            <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-active-color u-custom-text-color u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
              <svg class="u-svg-link" viewBox="0 0 24 24"><use xlink:href="#menu-hamburger"></use></svg>
              <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><g><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect>
</g></svg>
            </a>
          </div>
          <div class="u-custom-menu u-nav-container">
            <ul class="u-nav u-unstyled u-nav-1"><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-2-light-2 u-text-hover-palette-2-base u-text-white" href="Acasa.php" style="padding: 10px 20px;">Acasa</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-2-light-2 u-text-hover-palette-2-base u-text-white" href="Jocuri.php" style="padding: 10px 20px;">Jocuri</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-2-light-2 u-text-hover-palette-2-base u-text-white" href="Review.php" style="padding: 10px 20px;">Review</a>
</li></ul>
          </div>
          <div class="u-custom-menu u-nav-container-collapse">
            <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
              <div class="u-inner-container-layout u-sidenav-overflow">
                <div class="u-menu-close"></div>
                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Acasa.php">Acasa</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Jocuri.php">Jocuri</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Review.php">Review</a>
</li></ul>
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
        </nav>

        <?php
          if(isset($_COOKIE["user_id"])) {
            $user_id = $_COOKIE["user_id"];
            $result = $database_connection->query("SELECT username FROM atestat_user WHERE id = $user_id")->fetch_assoc();
            $username = $result["username"];
        ?>
          <span style="float:right;">
          🙂<?= $username ?>
          </span>    
          <?php }
        else {
          ?>
          <a href="Login.php" class="u-border-none u-btn u-btn-round u-button-style u-custom-color-3 u-radius-15 u-btn-1">Login</a>
        <?php } ?>
        </div></header>
    <section class="u-align-center u-clearfix u-image u-shading u-section-1" src="" data-image-width="736" data-image-height="396" id="sec-107e">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <h1 class="u-text u-text-default u-title u-text-1">Iți plac jocurile?<br>Ai ajuns unde trebuie!
        </h1>
        <p class="u-large-text u-text u-text-default u-text-variant u-text-2">Descoperă o varietate mare de jocuri chiar aici, dând click pe butonul de mai<br>&nbsp;jos
        </p>
        <a href="Jocuri.php" class="u-border-none u-btn u-btn-round u-button-style u-custom-color-2 u-radius-15 u-btn-1">Vezi Jocurile</a>
      </div>
    </section>
    
    
    <footer class="u-align-center u-clearfix u-footer u-gradient u-footer" id="sec-6b67"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="Review.php" class="u-active-none u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-2 u-bottom-left-radius-0 u-bottom-right-radius-0 u-btn u-btn-rectangle u-button-style u-hover-none u-none u-radius-0 u-top-left-radius-0 u-top-right-radius-0 u-btn-1">Vrei sa lasi un Review. Click aici!</a>
      </div></footer>
  
</body></html>