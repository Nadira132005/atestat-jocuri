<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./style/joc.css">
    <link rel="stylesheet" href="./style/global.css">
    <script src="https://kit.fontawesome.com/1ee224159b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include("./components/navbar/index.php");
    ?>
    <section>
        <?php

        @include("./utils/connection.php");
        $params = array();
        parse_str($_SERVER['QUERY_STRING'], $params);
        $game_id = $params["joc-id"];


        $game = $database->query("SELECT *, CAST(SUM(stele) / COUNT(atestat_review.id) AS int) AS rating FROM atestat_joc LEFT JOIN atestat_review ON atestat_joc.id = atestat_review.joc_id WHERE atestat_joc.id = $game_id")->fetch();
        $game_reviews = $database->query("SELECT atestat_review.*, atestat_joc.*, atestat_user.* FROM atestat_joc LEFT JOIN atestat_review ON atestat_joc.id = atestat_review.joc_id LEFT JOIN atestat_user ON atestat_review.user_id = atestat_user.id WHERE atestat_joc.id = $game_id")->fetchAll();
        ?>
        <h1>
            <?= $game["nume"] ?>
        </h1>
        <img class="game-image" src=<?= "./images/" . $game["imagine"] ?> alt="">
        <div class="stars-container">
            <?php for ($i = 1; $i <= 10; $i++) { ?>
                <?php if ($i <= $game["rating"]) {
                    echo "<i class='fa fa-star gold'></i>";
                } else
                    echo "<i class='fa fa-star'></i>";
                ?>
            <?php } ?>
            <b class="star-rating">
                <?= $game["rating"] ? $game["rating"] : 0 ?>
            </b>
        </div>

        <h2>Review-uri: </h2>
        <?php
        foreach ($game_reviews as $review) {
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

            </div>
        <?php } ?>
    </section>
</body>

</html>