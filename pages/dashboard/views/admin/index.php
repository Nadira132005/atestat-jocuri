<link rel="stylesheet" href="/atestat/pages/dashboard/views/admin/admin.css">

<section>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/atestat/utils/database.php');
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
                    <a class="edit" href=<?= "/atestat/pages/editeaza/index.php" ?>>EDITEAZĂ</a>
                    <button class="delete" id="open-dialog">ȘTERGE</button>
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
                            <a class="edit" href=<?= "/atestat/pages/editeaza/index.php" ?>>EDITEAZĂ</a>
                            <button class="delete" id="open-dialog">ȘTERGE</button>
                        </span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>