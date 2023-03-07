<?php
include("./utils/connection.php");

if (!isset($_COOKIE["user_id"])) {
  header("Location: Login.php");
  die();
}

if (isset($_POST["submit"])) {
  $review = $_POST["review"];
  $game = $_POST["game"];
  $stars = $_POST["stars"];
  $user_id = $_COOKIE["user_id"];

  $template_insert = $database->prepare("INSERT INTO atestat_review (user_id, nume_joc, stele, comentariu) VALUES (:user_id, :game, :stars, :review)");
  $template_insert->bindValue(":user_id", $user_id);
  $template_insert->bindValue(":game", $game);
  $template_insert->bindValue(":stars", $stars);
  $template_insert->bindValue(":review", $review);
  $template_insert->execute();
}
?>


<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="Lasa Riview-ul tau chiar aici:">
  <meta name="description" content="">
  <title>Review</title>
  <link rel="stylesheet" href="style/nicepage.css" media="screen">
  <link rel="stylesheet" href="style/Review.css" media="screen">
  <script class="u-script" type="text/javascript" src="javascript/nicepage.js" defer=""></script>
  <meta name="generator" content="Nicepage 5.5.0, nicepage.com">
  <meta name="referrer" content="origin">
  <link id="u-theme-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">


  <script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "",
    "logo": "images/game-store-logo-template-design-vector.jpg"
}</script>
  <meta name="theme-color" content="#478ac9">
  <meta property="og:title" content="Review">
  <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>

<body class="u-body u-xl-mode" data-lang="en">
  <header class="u-clearfix u-custom-color-1 u-header u-header" id="sec-34e0">
    <div class="u-clearfix u-sheet u-sheet-1">
      <a href="index.php" class="u-image u-logo u-image-1" data-image-width="144" data-image-height="117" title="Acasa">
        <img src="images/game-store-logo-template-design-vector.jpg" class="u-logo-image u-logo-image-1">
      </a>
      <nav class="u-menu u-menu-one-level u-offcanvas u-menu-1">
        <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
          <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-active-color u-custom-text-color u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base"
            href="#">
            <svg class="u-svg-link" viewBox="0 0 24 24">
              <use xlink:href="#menu-hamburger"></use>
            </svg>
            <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px"
              xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
              <g>
                <rect y="1" width="16" height="2"></rect>
                <rect y="7" width="16" height="2"></rect>
                <rect y="13" width="16" height="2"></rect>
              </g>
            </svg>
          </a>
        </div>
        <div class="u-custom-menu u-nav-container">
          <ul class="u-nav u-unstyled u-nav-1">
            <li class="u-nav-item"><a
                class="u-button-style u-nav-link u-text-active-palette-2-light-2 u-text-hover-palette-2-base u-text-white"
                href="index.php" style="padding: 10px 20px;">Acasa</a>
            </li>
            <li class="u-nav-item"><a
                class="u-button-style u-nav-link u-text-active-palette-2-light-2 u-text-hover-palette-2-base u-text-white"
                href="Jocuri.php" style="padding: 10px 20px;">Jocuri</a>
            </li>
            <li class="u-nav-item"><a
                class="u-button-style u-nav-link u-text-active-palette-2-light-2 u-text-hover-palette-2-base u-text-white"
                href="Review.php" style="padding: 10px 20px;">Review</a>
            </li>
          </ul>
        </div>
        <div class="u-custom-menu u-nav-container-collapse">
          <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
            <div class="u-inner-container-layout u-sidenav-overflow">
              <div class="u-menu-close"></div>
              <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="index.php">Acasa</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="Jocuri.php">Jocuri</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="Review.php">Review</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
        </div>
      </nav>
      <a href="Login.php"
        class="u-border-none u-btn u-btn-round u-button-style u-custom-color-3 u-radius-15 u-btn-1">Login</a>
    </div>
  </header>
  <section class="u-clearfix u-image u-section-1" id="sec-818d" data-image-width="2560" data-image-height="1600">
    <div class="u-clearfix u-sheet u-sheet-1">
      <h1 class="u-text u-text-palette-2-light-2 u-text-1">Lasă Review-ul tă​​u chiar aici:</h1>
      <div class="u-form u-form-1">
        <form action="" method="post" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" name="form"
          style="padding: 10px;">
          <div class="u-form-group u-form-name">
            <label for="name-7272" class="u-label u-text-palette-2-light-2 u-label-1">Numele jocului:</label>
            <input name="game" type="text" placeholder="Jocul ales de tine" id="name-7272"
              class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-1" required=""
              control-id="ControlID-17339">
          </div>
          <div class="u-form-group u-form-rating u-form-group-2">
            <label for="form-rating-9d00" class="u-label u-text-palette-2-light-2 u-label-2">Stele acordate:</label>
            <input id="form-rating-9d00" name="stars" type="number">
          </div>
      </div>
      <div class="u-form-group u-form-message">
        <label for="message-7272" class="u-label u-text-palette-2-light-2 u-label-3">Adauga un comentariu:</label>
        <textarea name="review" placeholder="Adauga un comentariu" rows="4" cols="50" id="message-7272"
          class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-2" required=""
          control-id="ControlID-17341"></textarea>
      </div>
      <div class="u-align-left u-form-group u-form-submit">
        <button type="submit" name="submit" value="submit">Submit</button>
      </div>
      </form>
    </div>
    </div>
  </section>


</body>

</html>