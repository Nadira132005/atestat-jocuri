<?php
if (isset($_COOKIE["user_id"])) {
    $user_id = $_COOKIE["user_id"];
    $result = $database->query("SELECT username FROM atestat_user WHERE id = $user_id")->fetch();
    $username = $result["username"];
    ?>
    <span style="float:right;">
        🙂
        <?= $username ?>
    </span>
<?php } else {
    ?>
    <a href="Login.php"
        class="u-border-none u-btn u-btn-round u-button-style u-custom-color-3 u-radius-15 u-btn-1">Login</a>
<?php } ?>