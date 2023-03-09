<!DOCTYPE html>
<html lang="ro">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Jocuri</title>
  <link rel="stylesheet" href="style/jocuri.css" media="screen">
  <link rel="stylesheet" href="style/global.css" media="screen">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>

<body>
  <?php
  include("./components/navbar/index.php");
  ?>

  <section>
    <?php
    include("./utils/connection.php");
    $review_rows = $database->query("SELECT atestat_review.*, atestat_user.* FROM atestat_review LEFT JOIN atestat_user ON atestat_review.user_id = atestat_user.id");
    $reviews = $review_rows->fetchAll();

    $column_1_reviews = array_filter($reviews, function ($index) {
      return $index % 3 == 0;
    }, ARRAY_FILTER_USE_KEY);

    $column_2_reviews = array_filter($reviews, function ($index) {
      return $index % 3 == 1;
    }, ARRAY_FILTER_USE_KEY);

    $column_3_reviews = array_filter($reviews, function ($index) {
      return $index % 3 == 2;
    }, ARRAY_FILTER_USE_KEY);
    ?>

    <div class="column-1">
      <?php foreach ($column_1_reviews as $review) {
        ?>
        <div class="review-card">
          <div class='reviewer-details'>
            <span class="reviewer">
              <?= $review["username"] ?>
            </span>
            -
            <div class="reviewer_email">
              <?= $review["email"] ?>
            </div>
          </div>
          <div class="review-from-user">
            <?= $review["COMENTARIU"] ?>
          </div>
          <div class="stars">
            ⭐
            <?= $review["stele"] ?>
          </div>
          <div class="game">
            🎮
            <?= $review["nume_joc"] ?>
          </div>
        </div>
      <?php } ?>
    </div>

    <div class="column-2">
      <?php foreach ($column_2_reviews as $review) {
        ?>
        <div class="review-card">
          <div class='reviewer-details'>
            <span class="reviewer">
              <?= $review["username"] ?>
            </span>
            -
            <div class="reviewer_email">
              <?= $review["email"] ?>
            </div>
          </div>
          <div class="review-from-user">
            <?= $review["COMENTARIU"] ?>
          </div>
          <div class="stars">
            ⭐
            <?= $review["stele"] ?>
          </div>
          <div class="game">
            🎮
            <?= $review["nume_joc"] ?>
          </div>
        </div>
      <?php } ?>
    </div>

    <div class="column-3">
      <?php foreach ($column_3_reviews as $review) {
        ?>
        <div class="review-card">
          <div class='reviewer-details'>
            <span class="reviewer">
              <?= $review["username"] ?>
            </span>
            -
            <div class="reviewer_email">
              <?= $review["email"] ?>
            </div>
          </div>
          <div class="review-from-user">
            <?= $review["COMENTARIU"] ?>
          </div>
          <div class="stars">
            ⭐
            <?= $review["stele"] ?>
          </div>
          <div class="game">
            🎮
            <?= $review["nume_joc"] ?>
          </div>
        </div>
      <?php } ?>
    </div>


  </section>


  <?php
  include("./components/review/index.php");
  ?>
</body>

</html>