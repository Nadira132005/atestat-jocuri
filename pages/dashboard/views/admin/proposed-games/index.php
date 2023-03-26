<?php
@include(__DIR__ . "/../../../../../utils/database.php");

$error = null;
$success = null;

if (isset($_POST["delete-game"])) {
    $game_id = $_POST["delete-game"];
    try {
        $delete_game_query = $database->prepare("DELETE FROM atestat_joc_propuneri WHERE id = :game_id");
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

if (isset($_POST["approve-game"])) {
    $game_id = $_POST["approve-game"];
    try {
        $get_game_query = $database->prepare("
            SELECT nume, descriere, imagine 
            FROM atestat_joc_propuneri 
            WHERE id = :game_id
        ");
        $get_game_query->bindValue(":game_id", $game_id);
        $get_game_query->execute();
        $game = $get_game_query->fetch();

        $insert_official_game = $database->prepare("
        INSERT INTO 
            atestat_joc (
                imagine, 
                descriere, 
                nume
            ) 
            VALUES (
                :filename, 
                :description, 
                :name
            )
        ");
        $insert_official_game->bindValue(":filename", $game["imagine"]);
        $insert_official_game->bindValue(":description", $game["descriere"]);
        $insert_official_game->bindValue(":name", $game["nume"]);
        $insert_official_game->execute();

        $inserted_game = $insert_official_game->rowCount();
        if ($inserted_game == 1)
            $success = "Jocul a fost oficializat cu succes!";

    } catch (PDOException $error) {
        if ($error->getCode() == 23000)
            $error = "UPS! Jocul nu a putut fi oficializat! Jocul există deja!";
        else
            $error = "UPS! Jocul nu a putut fi oficializat!";
    }

    try {
        $delete_proposed_game = $database->prepare("
            DELETE FROM atestat_joc_propuneri 
            WHERE id = :game_id
        ");

        $delete_proposed_game->bindValue(":game_id", $game_id);
        $delete_proposed_game->execute();
    } catch (PDOException $error) {
        $error = "Jocul a fost oficializat, dar nu a putut fi șters!";
    }
}

?>


<link rel="stylesheet" href="/atestat/pages/dashboard/views/admin/official-games/official-games.css">
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
                    <button type="submit" class="delete" id="delete-game" name="delete-game">
                        ȘTERGE
                    </button>
                </form>
            </div>
        </div>
    </div>



    <?php

    $games = $database->query("
        SELECT * FROM atestat_joc_propuneri; 
    ")->fetchAll();
    ?>



    <div class="desktop-view">
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
                    <form action="" method="post" style="display:inline-block;">
                        <button class="edit" name="approve-game" value="<?= $game["id"] ?>">APROBĂ</button>
                    </form>
                    <button class="delete open-dialog" value="<?= $game["id"] ?>">ȘTERGE</button>
                </span>
            <?php } ?>
        </div>
    </div>


    <div class="mobile-view">
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
                            <form action="" method="post" style="display:inline-block;">
                                <button class="edit" name="approve-game" value="<?= $game["id"] ?>">APROBĂ</button>
                            </form>
                            <button class="delete open-dialog" value="<?= $game["id"] ?>">ȘTERGE</button>
                        </span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="/atestat/pages/dashboard/views/admin/official-games/official-games.js"></script>
    <script>
        // prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</section>