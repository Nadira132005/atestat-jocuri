<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="style/login.css">
  <link rel="stylesheet" href="style/global.css">
</head>

<body>

  <?php
  include("./components/navbar/index.php");
  ?>

  <section>
    <?php
    include('./utils/database.php');
    include("./utils/cookies.php");

    if (isset($_POST["submit"])) {
      $username = $_POST["username"];
      $password = $_POST["password"];

      $get_user_query = $database->prepare("
        SELECT id FROM atestat_user 
        WHERE username = :username 
        AND password = :password
      ");

      $get_user_query->bindValue(":username", $username);
      $get_user_query->bindValue(":password", $password);
      $get_user_query->execute();
      $user = $get_user_query->fetch();

      if (isset($user["id"])) {
        $user_id = $user["id"];
        store_user_in_cookie($user_id);

        // redirect to home page
        header("Location: index.php");
      } else
        // show an error banner
        echo "<span class='error-message'>Username or password not correct!</span>";
    }
    ?>
    <div class="form-container">
      <span class="form-title">Login</span>
      <form action="" method="post">
        <div class="form-1-column-group">
          <label for="username">Username</label>
          <input type="text" placeholder="Introduceti numele" name="username" required>
          <label for="password">Parola</label>
          <input placeholder="Introduceti parola" name="password" required type="password">
          <button type="submit" value="submit" name="submit">POSTEAZĂ</button>
        </div>
      </form>

      <a class="link-to-create-account" href="creeaza-cont.php">Nu ai cont incă? Creaza-ti un cont</a>
    </div>
  </section>

</body>
<script>
  // prevent form resubmission on page refresh
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

</html>