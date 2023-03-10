<?php
include("./utils/connection.php");

if (!isset($_COOKIE["user_id"])) {
  header("Location: login.php");
  die();
}

if (isset($_POST["submit"])) {
  $review = $_POST["review"];
  $game = $_POST["game"];
  $stars = $_POST["stars"];
  $user_id = $_COOKIE["user_id"];

  $template_query = $database->prepare("INSERT INTO atestat_review (user_id, nume_joc, stele, comentariu) VALUES (:user_id, :game, :stars, :review)");
  $template_query->bindValue(":user_id", $user_id);
  $template_query->bindValue(":game", $game);
  $template_query->bindValue(":stars", $stars);
  $template_query->bindValue(":review", $review);
  $template_query->execute();

  header("Location: jocuri.php");
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Review</title>
  <link rel="stylesheet" href="style/review.css">
  <link rel="stylesheet" href="style/global.css">
</head>

<body>
  <?php
  include("./components/navbar/index.php");
  ?>
  <section>
    <div class="form-container">
      <span class="form-title">Lasă <i>review-ul</i> tă​​u aici:</span>
      <form action="" method="post" name="form">
        <div class="form-2-column-group">
          <div style="margin-right:1.5rem;">
            <label>Numele jocului:</label>
            <input required name="game">
          </div>

          <div>
            <label>Stele acordate:</label>
            <input name="stars" type="number" required>
          </div>
        </div>
        <div class="form-1-column-group">
          <label>Adauga un comentariu:</label>
          <textarea name="review" rows="4" cols="50" required></textarea>
          <button type="submit" name="submit" value="submit">Postează</button>
        </div>
      </form>
    </div>
  </section>
</body>

</html>