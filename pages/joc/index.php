<?php
@include(__DIR__ . "/../../utils/database.php");

$error = null;
$success = null;

if (isset($_POST["review-id"])) {
    $review_id = $_POST["review-id"];
    try {
        $delete_review_query = $database->prepare("DELETE FROM atestat_review WHERE id = :review_id");
        $delete_review_query->bindValue(":review_id", $review_id);
        $delete_review_query->execute();

        $affected_rows = $delete_review_query->rowCount();
        if ($affected_rows > 0)
            $success = "Review-ul a fost șters cu success!";
        else
            $error = "UPS! Review-ul nu a putut fi șters!";
    } catch (PDOException $error) {
        $error = "UPS! Review-ul nu a putut fi șters!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./joc.css">
    <link rel="stylesheet" href="/atestat/style/global.css">
    <script src="https://kit.fontawesome.com/1ee224159b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joc</title>
</head>

<body>
    <?php
    if (isset($error))
        echo "
        <span class='message error-message'>
            $error
            <button id='close-message' class='fa fa-close'></button>
        </span>";

    if (isset($success))
        echo "
        <span class='message success-message'>
            $success
            <button id='close-message' class='fa fa-close'></button>
        </span>
        ";
    ?>

    <?php
    include(__DIR__ . "/../../components/navbar/index.php");
    ?>

    <div class="modal-delete-reviews">
        <div class="dialog">
            <span class="big-warning">
                Ești sigur că vrei să ștergi review-ul?
            </span>
            <span class="warning-explanation">
                Această acțiune este permanentă și nu mai poate fi anulată!
            </span>

            <div class="dialog-actions">
                <button type="button" class="cancel" id="cancel">ANULEAZĂ</button>
                <form action="" method="post">
                    <button type="submit" class="delete" id="delete-review" name="review-id">
                        ȘTERGE
                    </button>
                </form>
            </div>
        </div>
    </div>

    <section>
        <?php
        @include(__DIR__ . "/../../utils/database.php");
        // given a valid url: "example.url.com/joc?joc-id=1"
        // we expect `$_GET['joc-id']` to return "1" 
        $game_id = $_GET["joc-id"];

        $game_info = $database->query("
            SELECT
                atestat_joc.*, 
                CAST(SUM(atestat_review.stele) / COUNT(atestat_review.id) AS int) AS rating
            FROM atestat_joc 
            LEFT JOIN atestat_review
            ON atestat_review.joc_id = atestat_joc.id
            WHERE atestat_joc.id = $game_id;
        ")->fetch();
        $game_reviews = $database->query("
            SELECT 
                atestat_review.id AS review_id,
                atestat_user.id AS user_id,
                atestat_review.*, 
                atestat_user.*
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
        <img class="game-image" src=<?= "/atestat/images/" . $game_info["imagine"] ?> alt="">
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
        foreach ($game_reviews as $review) {
            ?>
            <div class="review-card">
                <span class="reviewer">
                    <?= $review["username"] ?>
                </span>
                <div class="reviewer_email">
                    <?= $review["email"] ?>
                </div>
                <div class="review-from-user">
                    <?= $review["comentariu"] ?>
                </div>

                <div class="review-stats">
                    <span style="margin-right:1rem;">
                        ⭐
                        <?= $review["stele"] ?>
                    </span>
                    <span>
                        🕒
                        <?php
                        $date = date("d M Y", strtotime($review["updated_at"]));
                        echo $date;
                        ?>
                    </span>
                </div>
                <div class="review-actions">
                    <?php
                    if (isset($_COOKIE["user_id"]) && $_COOKIE["user_id"] == $review["user_id"]) {
                        ?>
                        <button class="edit">EDITEAZĂ</button>
                        <button class="delete" id="open-dialog" value=<?= $review["review_id"] ?>>ȘTERGE</button>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </section>
</body>

<script src="./joc.js"></script>
<script>
    // prevent form resubmission on page refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>