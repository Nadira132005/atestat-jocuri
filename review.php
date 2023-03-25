<?php
include("./utils/database.php");

if (!isset($_COOKIE["user_id"])) {
  header("Location: login.php");
  return;
}

if (isset($_POST["submit"])) {
  $review = $_POST["review"];
  $game_id = $_POST["game_id"];
  $user_id = $_COOKIE["user_id"];

  $stars = $_POST["stars"];
  if ($stars > 10)
    $stars = 10;
  if ($stars < 0)
    $stars = 0;

  $insert_review_query = $database->prepare("
    INSERT INTO 
      atestat_review (
        user_id, 
        joc_id, 
        stele, 
        comentariu
      ) 
      VALUES (
        :user_id, 
        :game_id, 
        :stars, 
        :review
      )
  ");


  $insert_review_query->bindValue(":user_id", $user_id);
  $insert_review_query->bindValue(":game_id", $game_id);
  $insert_review_query->bindValue(":stars", $stars);
  $insert_review_query->bindValue(":review", $review);
  $insert_review_query->execute();

  header("Location: pages/joc/index.php?joc-id=" . $game_id);
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
            <?php
            $games_to_review = $database->query("
              SELECT id, nume FROM atestat_joc
            ")->fetchAll();
            ?>
            <label>Alege jocul: </label>
            <select required name="game_id">
              <?php
              // show the user a list of all games that are available for review
              foreach ($games_to_review as $game) {
                ?>
                <option value=<?= $game["id"] ?>>
                  <?= $game["nume"] ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div>
            <label>Stele acordate:</label>
            <input name="stars" type="number" required>
          </div>
        </div>
        <div class="form-1-column-group">
          <label>Adauga un comentariu:</label>
          <textarea name="review" rows="4" cols="50" required></textarea>
          <button type="submit" name="submit" value="submit">POSTEAZĂ</button>
          <br>
          <span class="hint">Nu găsești jocul tău preferat?</span>
          <a class="propose-game-redirect" href="/atestat/pages/new-game/index.php">PROPUNE UN JOC</a>
        </div>
      </form>
    </div>
  </section>
</body>

</html>