<?php
include('./utils/connection.php');
include('./utils/cookies.php');

if (isset($_POST["name"])) {
  $name = $_POST["name"];
  $forename = $_POST["forename"];
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  $template_insert = $database->prepare("INSERT INTO atestat_user (email, nume, prenume, username, password) VALUES (:email, :name, :forename, :username, :password)");
  $template_insert->bindValue(":email", $email);
  $template_insert->bindValue(":name", $name);
  $template_insert->bindValue(":forename", $forename);
  $template_insert->bindValue(":username", $username);
  $template_insert->bindValue(":password", $password);
  $template_insert->execute();

  $template_select = $database->prepare("SELECT id FROM atestat_user WHERE email = :email");
  $template_select->bindValue(":email", $email);
  $template_select->execute();
  $result = $template_select->fetch();

  if (isset($result["id"])) {
    $user_id = $result["id"];
    store_user_cookie($user_id);

  }
}
?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>Creaza cont</title>
  <link rel="stylesheet" href="style/nicepage.css" media="screen">
  <link rel="stylesheet" href="style/creeaza-cont.css" media="screen">
  <script class="u-script" type="text/javascript" src="javascript/nicepage.js" defer=""></script>
  <meta name="generator" content="Nicepage 5.5.0, nicepage.com">
  <meta name="referrer" content="origin">
  <link id="u-theme-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface:400">
  <script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": ""
}</script>
  <meta name="theme-color" content="#478ac9">
  <meta property="og:title" content="Creaza cont">
  <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>

<body class="u-body u-xl-mode" data-lang="en">
  <section class="u-clearfix u-image u-section-1" id="sec-04ff" data-image-width="1920" data-image-height="1080">
    <div class="u-clearfix u-sheet u-sheet-1">
      <a href="index.php"
        class="u-border-none u-btn u-button-style u-custom-color-2 u-hover-custom-color-8 u-btn-1"><span
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
      <h3 class="u-text u-text-custom-color-9 u-text-default u-text-1">Crează-ți contul:</h3>
      <div class="u-form u-form-1">
        <form action="" method="post" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form"
          style="padding: 10px;">
          <label for="name-6715" class="u-custom-font u-label u-text-palette-1-light-2 u-label-1">Nume:</label>
          <input type="text" placeholder="Introduceti numele" id="name-6715" name="name"
            class="u-border-1 u-border-grey-30 u-gradient u-input u-input-rectangle u-input-1">
          <label for="text-a7f0" class="u-custom-font u-label u-text-palette-1-light-2 u-label-2">Prenume:</label>
          <input type="text" placeholder="Introduceti prenumele" id="text-a7f0" name="forename"
            class="u-border-1 u-border-grey-30 u-gradient u-input u-input-rectangle u-input-2">
          <label for="email-6715" class="u-custom-font u-label u-text-palette-1-light-2 u-label-3">Email:</label>
          <input type="email" placeholder="Introduceti adresa de email" id="email-6715" name="email"
            class="u-border-1 u-border-grey-30 u-gradient u-input u-input-rectangle u-input-3" required="">
          <label for="text-7d77" class="u-custom-font u-label u-text-palette-1-light-2 u-label-4">Username:</label>
          <input type="text" placeholder="Introduceti username-ul" id="text-7d77" name="username" <label for="text-a3d3"
            class="u-custom-font u-label u-text-palette-1-light-2 u-label-5">Parola:</label>
          <input type="text" placeholder="Introduceti parola" id="text-a3d3" name="password"
            class="u-border-1 u-border-grey-30 u-gradient u-input u-input-rectangle u-input-5">
          <button type="submit" value="submit" name="submit">Creeaza cont</button>
        </form>
      </div>
    </div>
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