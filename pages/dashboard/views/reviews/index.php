<?php
@include(__DIR__ . "/../../../../utils/database.php");

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


<link rel="stylesheet" href="/atestat/pages/dashboard/views/reviews/reviews.css">
<link rel="stylesheet" href="/atestat/style/global.css">
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

    $reviews_query = $database->prepare("
        SELECT
            atestat_review.id as review_id,
            atestat_review.*,
            atestat_user.*
        FROM atestat_user
        LEFT JOIN atestat_review 
        ON atestat_review.user_id = atestat_user.id 
        WHERE atestat_user.id = :user_id
    ");

    $reviews_query->bindValue(":user_id", $user["id"]);
    $reviews_query->execute();
    $reviews = $reviews_query->fetchAll();
    ?>

    <?php
    // only display the list of reviews if it's not empty 
    if (isset($reviews[0]["id"])) {
        ?>
        <?php
        foreach ($reviews as $review) {
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
                        <a class="edit" href=<?= "/atestat/pages/editeaza/index.php" . "?" . "review-id=" . $review["review_id"] ?>>EDITEAZĂ</a>
                        <button class="delete" id="open-dialog" value=<?= $review["review_id"] ?>>ȘTERGE</button>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</section>

<script src="/atestat/pages/dashboard/views/reviews/reviews.js"></script>
<script>
    // prevent form resubmission on page refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>