<?php
include(__DIR__ . "/../../utils/database.php");

if (!isset($_COOKIE["user_id"])) {
    header("Location: /atestat/login.php");
    return;
}
$user_id = $_COOKIE["user_id"];

?>

<?php

if (isset($_POST["submit"])) {
    $game_description = $_POST["description"];
    $game_name = $_POST["name"];
    $temporary_file = $_FILES['game-thumbnail']['tmp_name'];

    $mime_type = $_FILES["game-thumbnail"]["type"];
    $extension = ".jpg";
    if ($mime_type == "image/jpeg")
        $extension = ".jpeg";

    if ($mime_type == "image/png")
        $extension = ".png";

    if ($mime_type == "image/gif")
        $extension = ".gif";

    $prefix = bin2hex(random_bytes(10));

    $filename = "$prefix" . "$extension";
    $upload_to = "/../../images/" . $filename;

    $was_successful_upload = move_uploaded_file($temporary_file, $upload_to);

    if ($was_successful_upload) {
        echo "Fișierul a fost încărcat cu succes!";
    } else
        return;

    try {
        $insert_query = $database->prepare("
            INSERT INTO 
                atestat_joc_propuneri (
                    imagine, 
                    descriere, 
                    nume,
                    user_id
                ) 
                VALUES (
                    :filename, 
                    :description, 
                    :name,
                    :user_id
                )
        ");

        $insert_query->bindValue(":filename", $filename);
        $insert_query->bindValue(":description", $game_description);
        $insert_query->bindValue(":name", $game_name);
        $insert_query->bindValue(":user_id", $user_id);
        $insert_query->execute();
        header("Location: /atestat/jocuri.php");

    } catch (PDOException $error) {
        if ($error->getCode() == 23000) {
            // unique key constraint violation, i.e. duplicate game name
            echo "<span class='error-message'>Jocul: $game_name există deja! </span>";
        } else {
            echo "<span class='error-message'>Eroare necunoscută! Te rugăm încearcă mai târziu</span>";
            print_r($error);
        }
    }

}

?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="./new-game.css">
    <link rel="stylesheet" href="/atestat/style/global.css">
    <title>Propune Joc</title>
</head>

<body>
    <?php
    include(__DIR__ . "/../../components/navbar/index.php");
    ?>
    <section>
        <div class="form-container">
            <span class="form-title">Propune un joc nou: </span>
            <form enctype="multipart/form-data" action="" method="post" name="form">
                <div class="form-2-column-group">
                    <div style="margin-right:1.5rem;">
                        <label for="">Numele jocului: </label>
                        <input type="text" name="name">
                    </div>

                    <div>
                        <label>Poză: </label>
                        <input name="game-thumbnail" type="file" required>
                    </div>
                </div>
                <div class="form-1-column-group">
                    <label>Descriere: </label>
                    <textarea name="description" rows="4" cols="50" required></textarea>
                    <button type="submit" name="submit" value="submit">POSTEAZĂ</button>
                </div>
            </form>
        </div>
    </section>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>