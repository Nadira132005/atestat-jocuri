<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./style/joc.css">
    <link rel="stylesheet" href="./style/global.css">
    <script src="https://kit.fontawesome.com/1ee224159b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joc</title>
</head>

<body>
    <?php
    include("./components/navbar/index.php");
    ?>
    <section>
        <?php
        @include("./utils/connection.php");
        $params = array();
        // given a valid url: "example.url.com/joc?joc-id=1"
        // we expect `$_SERVER['QUERY_STRING']` to retrieve: "joc-id=1"
        // the `parse_str` method will insert a [key => value] pair in the `$params` array, as such: ["joc-id" => 1]
        parse_str($_SERVER['QUERY_STRING'], $params);
        $game_id = $params["joc-id"];

        $game_info = $database->query("--sql
            SELECT 
                atestat_review.*, 
                atestat_user.*,
                atestat_joc.*,
                CAST(SUM(stele) / COUNT(atestat_review.id) AS int) AS rating 
            FROM atestat_joc 
            LEFT JOIN atestat_review 
            ON atestat_joc.id = atestat_review.joc_id 
            LEFT JOIN atestat_user 
            ON atestat_review.user_id = atestat_user.id 
            WHERE atestat_joc.id = $game_id
        ")->fetchAll();

        ?>
        <h1>
            <?= $game_info["nume"] ?>
        </h1>
        <img class="game-image" src=<?= "./images/" . $game_info["imagine"] ?> alt="">
        <div class="stars-container">
            <?php for ($i = 1; $i <= 10; $i++) { ?>
                <?php if ($i <= $game_info["rating"]) {
                    echo "<i class='fa fa-star gold'></i>";
                } else
                    echo "<i class='fa fa-star'></i>";
                ?>
            <?php } ?>
            <b class="star-rating">
                <?= $game_info["rating"] ? $game_info["rating"] : 0 ?>
            </b>
        </div>

        <h2>Review-uri: </h2>
        <?php
        foreach ($game_info as $review) {
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