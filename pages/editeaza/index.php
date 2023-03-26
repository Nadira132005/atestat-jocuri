<?php
include(__DIR__ . "/../../utils/database.php");

// do not allow unauthenticated users to edit reviews
if (!isset($_COOKIE["user_id"])) {
    header("Location: login.php");
}

$review_id = $_GET["review-id"];
$user_id = $_COOKIE["user_id"];

$user_query = $database->prepare("
    SELECT * FROM atestat_user WHERE id = :user_id
");
$user_query->bindValue(":user_id", $user_id);
$user_query->execute();
$user = $user_query->fetch();

// only allow an admin or the owner to edit the review 
$review_query = $database->prepare("
    SELECT atestat_review.*, atestat_user.id AS user_id FROM atestat_review 
    LEFT JOIN atestat_user
    ON atestat_review.user_id = atestat_user.id
    WHERE 
        atestat_review.id = :review_id 
    ");

$review_query->bindValue(":review_id", $review_id);
$review_query->execute();
$review = $review_query->fetch();

if ($review["user_id"] != $user["id"] && $user["role"] != "ADMIN") {
    header("Location: /atestat/index.php");
}

if (isset($_POST["submit"])) {
    $comment = $_POST["comment"];
    $game_id = $_POST["game_id"];
    $user_id = $_COOKIE["user_id"];

    $stars = $_POST["stars"];
    if ($stars > 10)
        $stars = 10;
    if ($stars < 0)
        $stars = 0;

    $insert_review_query = $database->prepare("
        UPDATE atestat_review
        SET 
            stele = :stars,
            comentariu = :comment,
            joc_id = :game_id
        WHERE id = :review_id
    ");
    $insert_review_query->bindValue(":stars", $stars);
    $insert_review_query->bindValue(":comment", $comment);
    $insert_review_query->bindValue(":game_id", $game_id);
    $insert_review_query->bindValue(":review_id", $review["id"]);
    $insert_review_query->execute();

    header("Location: /atestat/pages/joc/index.php?" . "joc-id=" . $game_id);
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Review</title>
    <link rel="stylesheet" href="/atestat/style/review.css">
    <link rel="stylesheet" href="/atestat/style/global.css">
    <title>Editează review-ul</title>
</head>

<body>
    <?php
    include(__DIR__ . "/../../components/navbar/index.php");
    ?>
    <section>
        <div class="form-container">
            <span class="form-title">Editează <i>review-ul</i> tă​​u aici:</span>
            <form action="" method="post" name="form">
                <div class="form-2-column-group">
                    <div style="margin-right:1.5rem;">
                        <?php
                        // show the user a list of all games that are available for review
                        $games_to_review = $database->query("SELECT id, nume FROM atestat_joc")->fetchAll();
                        ?>
                        <label>Alege jocul: </label>
                        <select required name="game_id">
                            <?php
                            foreach ($games_to_review as $game) {
                                ?>
                                <option value=<?= $game["id"] ?>     <?= $game["id"] == $review["joc_id"] ? "selected" : null ?>>
                                    <?= $game["nume"] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div>
                        <label>Stele acordate:</label>
                        <input name="stars" type="number" required value=<?= $review["stele"] ?>>
                    </div>
                </div>
                <div class="form-1-column-group">
                    <label>Adauga un comentariu:</label>
                    <textarea name="comment" rows="4" cols="50" required><?= $review["comentariu"] ?></textarea>
                    <button type="submit" name="submit" value="submit">Modifică</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>