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
    include('./utils/connection.php');
    include("./utils/cookies.php");

    if (isset($_POST["submit"])) {
      $username = $_POST["username"];
      $password = $_POST["password"];


      $template_select = $database->prepare("SELECT id FROM atestat_user WHERE username = :username AND password = :password");
      $template_select->execute(array(':username' => $username, ':password' => $password));
      $result = $template_select->fetch();

      if (isset($result["id"])) {
        $id = $result["id"];
        store_user_cookie($id);
        header("Location: index.php");
      } else
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
          <input placeholder="Introduceti parola" name="password" required>
          <button type="submit" value="submit" name="submit">Submit</button>
        </div>
      </form>

      <a class="link-to-create-account" href="creeaza-cont.php">Nu ai cont incă? Creaza-ti un cont</a>
    </div>
  </section>

</body>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

</html>