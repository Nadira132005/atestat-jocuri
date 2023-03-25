<?php
@include(__DIR__ . "/../../../../utils/database.php");

$error = null;
$success = null;

if (isset($_POST["game-id"])) {
    $game_id = $_POST["game-id"];
    try {
        $delete_game_query = $database->prepare("DELETE FROM atestat_joc WHERE id = :game_id");
        $delete_game_query->bindValue(":game_id", $game_id);
        $delete_game_query->execute();

        $affected_rows = $delete_game_query->rowCount();
        if ($affected_rows > 0)
            $success = "Jocul a fost șters cu success!";
        else
            $error = "UPS! Jocul nu a putut fi șters!";
    } catch (PDOException $error) {
        $error = "UPS! Jocul nu a putut fi șters!";
    }
}

?>


<link rel="stylesheet" href="/atestat/pages/dashboard/views/admin/admin.css">

<section>

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


    <div class="modal-delete-games">
        <div class="dialog">
            <span class="big-warning">
                Ești sigur că vrei să ștergi jocul?
            </span>
            <span class="warning-explanation">
                Această acțiune este permanentă și nu mai poate fi anulată!
            </span>

            <div class="dialog-actions">
                <button type="button" class="cancel" id="cancel">ANULEAZĂ</button>
                <form action="" method="post">
                    <button type="submit" class="delete" id="delete-game" name="game-id">
                        ȘTERGE
                    </button>
                </form>
            </div>
        </div>
    </div>



    <?php

    $games = $database->query("
        SELECT * FROM atestat_joc; 
    ")->fetchAll();
    ?>



    <div class="desktop-view">
        <a class="add-game-button" href="/atestat/pages/dashboard/views/admin/add-game.php">ADAUGĂ JOC</a>
        <div class=" desktop-game-info-container">
            <span class="table-column">ID</span>
            <span class="table-column">IMAGINE</span>
            <span class="table-column">NUME</span>
            <span class="table-column">DESCRIERE</span>
            <span></span>

            <?php
            foreach ($games as $game) {
                ?>
                <span>
                    <?= $game["id"] ?>
                </span>
                <img class="game-image" src=<?= "/atestat/images/" . $game["imagine"] ?> />
                <span>
                    <i>
                        <?= $game["nume"] ?>
                    </i>
                </span>
                <span class="descriere">
                    <?= $game["descriere"] ?>
                </span>
                <span>
                    <a class="edit" href=<?= "/atestat/pages/dashboard/views/admin/edit-game.php?joc-id=" . $game["id"] ?>>EDITEAZĂ</a>
                    <button class="delete open-dialog" value="<?= $game["id"] ?>">ȘTERGE</button>
                </span>
            <?php } ?>
        </div>
    </div>


    <div class="mobile-view">
        <a class="add-game-button" href="/atestat/pages/dashboard/views/admin/add-game.php">ADAUGĂ JOC</a>
        <div class="mobile-game-info-container">
            <?php
            foreach ($games as $game) {
                ?>
                <div class="game-info-container">
                    <div class="game-info">
                        <span class="column">
                            ID:
                        </span>
                        <span>
                            <?= $game["id"] ?>
                        </span>
                    </div>
                    <div class="game-info">
                        <span class="column">
                            IMAGINE:
                        </span>
                        <img class="game-image" src=<?= "/atestat/images/" . $game["imagine"] ?> />
                    </div>
                    <div class="game-info">
                        <span class="column">
                            NUME:
                        </span>
                        <span>
                            <i>
                                <?= $game["nume"] ?>
                            </i>
                        </span>
                    </div>
                    <div class="game-info">
                        <span class="column">
                            DESCRIERE:
                        </span>
                        <span>
                            <?= $game["descriere"] ?>
                        </span>
                    </div>
                    <div class="game-info" style="margin-top: 1rem;">
                        <span class="column">
                            ACȚIUNI:
                        </span>
                        <span>
                            <a class="edit" href=<?= "/atestat/pages/dashboard/views/admin/edit-game.php?joc-id=" . $game["id"] ?>>EDITEAZĂ</a>
                            <button class="delete open-dialog" value="<?= $game["id"] ?>">ȘTERGE</button>
                        </span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="/atestat/pages/dashboard/views/admin/admin.js"></script>
    <script>
        // prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</section>