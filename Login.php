<?php
include('./utils/connection.php');
include("./utils/cookies.php");

if (isset($_POST["username"]) && isset($_POST["password"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $template_select = $database->prepare("SELECT id FROM atestat_user WHERE username = :username AND password = :password");
  $template_select->execute(array(':username' => $username, ':password' => $password));
  $result = $template_select->fetch();

  if (isset($result["id"])) {
    $id = $result["id"];
    store_user_cookie($id);
    header("Location: index.php");
  }
}
?>


<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="Login">
  <meta name="description" content="">
  <title>Login</title>
  <link rel="stylesheet" href="style/nicepage.css" media="screen">
  <link rel="stylesheet" href="style/Login.css" media="screen">
  <script class="u-script" type="text/javascript" src="javascript/nicepage.js" defer=""></script>
  <meta name="generator" content="Nicepage 5.5.0, nicepage.com">
  <meta name="referrer" content="origin">
  <link id="u-theme-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Lobster:400|Roboto+Condensed:300,300i,400,400i,700,700i">


  <script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": ""
}</script>
  <meta name="theme-color" content="#478ac9">
  <meta property="og:title" content="Login">
  <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>

<body class="u-body u-xl-mode" data-lang="en">
  <section class="u-clearfix u-image u-section-1" id="sec-7054" data-image-width="736" data-image-height="736">
    <div class="u-clearfix u-sheet u-sheet-1">
      <a href="index.php"
        class="u-border-none u-btn u-button-style u-custom-color-2 u-hover-custom-color-7 u-btn-1"><span
          class="u-icon u-text-white u-icon-1"><svg class="u-svg-content" viewBox="0 0 512 512" x="0px" y="0px"
            style="width: 1em; height: 1em;">
            <polygon
              points="256,152.96 79.894,288.469 79.894,470.018 221.401,470.018 221.401,336.973 296.576,336.973 296.576,470.018 432.107,470.018 432.107,288.469">
            </polygon>
            <polygon
              points="439.482,183.132 439.482,90.307 365.316,90.307 365.316,126.077 256,41.982 0,238.919 35.339,284.855 256,115.062 476.662,284.856 512,238.92">
            </polygon>
          </svg><img></span>
      </a>
      <h1 class="u-align-center u-custom-font u-font-lobster u-text u-text-palette-2-light-2 u-text-1">Login</h1>
      <div class="u-form u-form-1">
        <form action="" method="post" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form"
          style="padding: 10px;">
          <input type="text" placeholder="Introduceti numele" id="name-82e6" name="username"
            class="u-border-1 u-border-grey-30 u-gradient u-input u-input-rectangle u-palette-2-light-3 u-input-1"
            required="" control-id="ControlID-589">
          <input placeholder="Introduceti parola" name="password"
            class="u-border-1 u-border-grey-30 u-gradient u-input u-input-rectangle u-palette-2-light-3 u-input-2"
            required="" control-id="ControlID-590">
          <button type="submit" value="submit" name="submit">Submit</button>
        </form>

        <div style="color:white;">
        </div>
      </div>
      <a href="creeaza-cont.php"
        class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-2-light-1 u-border-no-left u-border-no-right u-border-no-top u-btn u-button-style u-none u-text-hover-custom-color-2 u-text-palette-1-light-3 u-btn-3">Nu
        ai cont incă? Creaza-ti un cont</a>
    </div>
  </section>


  <footer class="u-align-center u-clearfix u-footer u-gradient u-footer" id="sec-6b67">
    <div class="u-clearfix u-sheet u-sheet-1">
      <a href="Review.php"
        class="u-active-none u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-2 u-bottom-left-radius-0 u-bottom-right-radius-0 u-btn u-btn-rectangle u-button-style u-hover-none u-none u-radius-0 u-top-left-radius-0 u-top-right-radius-0 u-btn-1">Vrei
        sa lasi un Review. Click aici!</a>
    </div>
  </footer>

</body>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

</html>