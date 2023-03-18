<link rel="stylesheet" href="/atestat/components/navbar/navbar.css">
<script src="https://kit.fontawesome.com/1ee224159b.js" crossorigin="anonymous"></script>

<nav>
    <div class="mobile-navigation-buttons">
        <a class="logo" href="/atestat/index.php">
            <b>
                <span>GAME-</span><span style="color:rgb(123, 87, 255);"><i>STORE</i></span>
            </b>
        </a>
        <button class="fa fa-bars open-menu-button"></button>
    </div>
    <div class="navbar-links">
        <a href="/atestat/index.php">
            <span>Acasa</span>
        </a>
        <a href="/atestat/jocuri.php">
            <span>Jocuri</span>
        </a>
        <a href="/atestat/review.php">
            <span>Review</span>
        </a>
        <?php
        include(__DIR__ . "/../../utils/database.php");

        if (isset($_COOKIE["user_id"])) {
            $user_id = $_COOKIE["user_id"];
            $user = $database->query("SELECT username FROM atestat_user WHERE id = $user_id")->fetch();
            ?>
            <a class="username" href="/atestat/profil.php">
                <?php
                include(__DIR__ . "/../../utils/emoji.php");

                echo $user["username"];
                echo getRandomEmoji($emoji);
                ?>
            </a>
        <?php } else {
            ?>
            <a href="/atestat/login.php">
                <span>Login</span>
            </a>
        <?php } ?>
    </div>
</nav>

<script src="/atestat/components/navbar/navbar.js"></script>