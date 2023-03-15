<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" href="./style/creeaza-cont.css">
  <link rel="stylesheet" href="./style/global.css">
  <title>Creaza cont</title>
</head>

<body>
  <?php
  include("./components/navbar/index.php");
  ?>

  <section>
    <?php
    include('./utils/connection.php');
    include("./utils/cookies.php");

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

      try {
        $template_insert->execute();
        $template_select = $database->prepare("SELECT id FROM atestat_user WHERE email = :email");
        $template_select->bindValue(":email", $email);
        $template_select->execute();
        $result = $template_select->fetch();

        if (isset($result["id"])) {
          $user_id = $result["id"];
          store_user_in_cookie($user_id);
          header("Location: index.php");
        }
      } catch (PDOException $error) {
        if ($error->getCode() == 23000) {
          // unique key constraint violation, i.e. duplicate name
          echo "<span class='error-message'>Email: '$email' or username: '$username' is already being used!</span>";
        } else {
          throw $error;
        }
      }
    }
    ?>
    <div class="form-container">
      <span class="form-title">Crează-ți contul:</span>
      <form action="" method="post">
        <div class="form-2-column-group">
          <div style="margin-right:1.5rem;">
            <label>Nume:</label>
            <input name="name" required>
          </div>
          <div>
            <label>Prenume:</label>
            <input name="forename">
          </div>
        </div>
        <div class="form-1-column-group">
          <label>Email:</label>
          <input required name="email">
          <div class="form-2-column-group">
            <div>
              <label>Username:</label>
              <input required name="username">
            </div>
            <div>
              <label>Parola:</label>
              <input required name="password">
            </div>
          </div>
          <button type="submit" value="submit" name="submit">Creeaza cont</button>
        </div>
      </form>
    </div>
  </section>
</body>

<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

</html>