<link rel="stylesheet" href="./components/navbar/navbar.css">
<nav>
    <a class="logo" href="index.php">
        <b>
            <span>GAME-</span><span style="color:rgb(123, 87, 255);"><i>STORE</i></span>
        </b>
    </a>
    <div>
        <a href="index.php">
            <span>Acasa</span>
        </a>
        <?php
        include("./utils/connection.php");

        if (isset($_COOKIE["user_id"])) {
            $user_id = $_COOKIE["user_id"];
            $result = $database->query("SELECT username FROM atestat_user WHERE id = $user_id")->fetch();
            $username = $result["username"];
            ?>
            <a class="username" href="#">
                <?= $username ?>
                <?php
                include("./utils/emoji.php");
                echo getRandomEmoji($emoji);
                ?>
            </a>
        <?php } else {
            ?>
            <a href="login.php">
                <span>Login</span>
            </a>
        <?php } ?>
    </div>
</nav>