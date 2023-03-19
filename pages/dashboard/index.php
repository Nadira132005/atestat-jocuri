<?php

include(__DIR__ . "/../../utils/database.php");

// check if the user exists and is an admin, otherwise redirect to home page
if (!isset($_COOKIE["user_id"])) {
    header("Location: index.php");
    die();
}

$user_id = $_COOKIE["user_id"];

$user = $database->query("
    SELECT * FROM atestat_user WHERE id=$user_id
")->fetch();

if (!isset($user["id"])) {
    header("Location: index.php");
    die();
}

$view = "profile";
if (isset($_GET["view"])) {
    $view = $_GET["view"];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/atestat/style/global.css">
    <link rel="stylesheet" href="./profil.css">
    <title>Dashboard</title>
</head>

<body>
    <?php
    include(__DIR__ . "/../../components/navbar/index.php");
    ?>

    <nav class="page">
        <a href="?" class="select-page" id=<?= $view == "profile" ? "active" : null ?>>PROFIL</a>
        <a href="?view=reviews" class="select-page" id=<?= $view == "reviews" ? "active" : null ?>>REVIEW-URI</a>

        <?php
        $is_admin = $user["role"] == "ADMIN" ? true : false;
        if ($is_admin) {
            ?>
            <a href="?view=admin" class="select-page" id=<?= $view == "admin" ? "active" : null ?>>ADMIN</a>
        <?php } ?>

    </nav>

    <?php

    if ($view == "profile")
        include(__DIR__ . "/views/profile/index.php");

    if ($view == "reviews")
        include(__DIR__ . "/views/reviews/index.php");

    if ($view == "admin")
        include(__DIR__ . "/views/admin/index.php");
    ?>

</body>

</html>