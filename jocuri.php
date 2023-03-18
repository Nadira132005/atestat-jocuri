<!DOCTYPE html>
<html lang="ro">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Jocuri</title>
    <link rel="stylesheet" href="style/jocuri.css" media="screen">
    <link rel="stylesheet" href="style/global.css" media="screen">
    <script src="https://kit.fontawesome.com/1ee224159b.js" crossorigin="anonymous"></script>
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>

<body>
    <?php
    include("./components/navbar/index.php");
    ?>

    <section>
        <?php
        include("./utils/database.php");

        $games = $database->query("
          SELECT 
            atestat_joc.id, imagine, descriere, nume, 
            CAST(SUM(stele) / COUNT(atestat_review.id) AS int) AS rating 
          FROM atestat_joc 
          LEFT JOIN atestat_review 
          ON atestat_joc.id = atestat_review.joc_id 
          GROUP BY joc_id 
          ORDER BY rating DESC
        ")->fetchAll();
        ?>

        <?php foreach ($games as $game) { ?>
            <div class="game-card">
                <div class="game-image-container">
                    <img class="game-image" src=<?= "./images/" . $game["imagine"] ?> alt="">
                </div>
                <div class="game-info">
                    <a href=<?= 'joc.php?' . "joc-id=" . $game["id"] ?>>
                        <?= $game["nume"] ?>
                    </a>
                    <p class=" game-description">
                        <?= $game["descriere"] ?>
                    </p>
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
                </div>
            </div>
        <?php } ?>
    </section>


    <footer>
        <span class="review-question">
            Vrei sa lasi un
            <span class="review">
                <i>
                    #review
                </i>
            </span>
            ?
        </span>
        <br>
        <a class="link-to-review-page" href="review.php">
            Click aici!
        </a>
    </footer>
</body>

</html>