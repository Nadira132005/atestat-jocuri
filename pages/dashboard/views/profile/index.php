<link rel="stylesheet" href="/atestat/pages/dashboard/views/profile/profile.css">

<?php
include(__DIR__ . "/../../../../utils/database.php");
session_start();

if (isset($_POST["edit"])) {
    $name = $_POST["name"];
    $forname = $_POST["forname"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $username = $_POST["username"];

    $update_user_info_query = $database->prepare("
        UPDATE atestat_user 
        SET 
          email = :email,
          nume = :name,
          prenume = :forname,
          username = :username,
          password = :password
        WHERE id = :user_id
    ");

    $update_user_info_query->bindValue(":email", $email);
    $update_user_info_query->bindValue(":name", $name);
    $update_user_info_query->bindValue(":forname", $forname);
    $update_user_info_query->bindValue(":username", $username);
    $update_user_info_query->bindValue(":password", $password);
    $update_user_info_query->bindValue(":user_id", $user["id"]);

    try {
        $update_user_info_query->execute();
        $affected_rows = $update_user_info_query->rowCount();
        if ($affected_rows == 0)
            $_SESSION["error"] = "UPS! Nu am putut actualiza datele dumneavostra!";
        else
            $_SESSION["success"] = "Datele au fost actualizate cu succes!";
    } catch (PDOException $error) {
        if ($error->getCode() == 23000)
            // unique key constraint violation, i.e. duplicate name
            $_SESSION["error"] = "Username-ul sau emailul sunt deja utilizate!";
    }

    header("Location: ?");
    return;
}

?>


<?php
$is_edit_mode = isset($_GET["action"]) && $_GET["action"] == "edit" ? true : false;

if (!$is_edit_mode) {

    ?>
    <section>
        <?php
        if (isset($_SESSION["error"])) {
            $error = $_SESSION["error"];
            unset($_SESSION["error"]);
            ?>

            <span class='message-container error-message'>
                <span class="message">
                    <?= $error ?>
                </span>
                <button id='close-message' class='fa fa-close'></button>
            </span>

        <?php } ?>

        <?php
        if (isset($_SESSION["success"])) {
            $success = $_SESSION["success"];
            unset($_SESSION["success"]);
            ?>
            <span class='message-container success-message'>
                <span class="message">
                    <?= $success ?>
                </span>
                <button id='close-message' class='fa fa-close'></button>
            </span>
        <?php } ?>
        <div class="user-info-container">
            <div class="profile-picture">
                <?= substr($user["nume"], 0, 1) . substr($user["prenume"], 0, 1) ?>
            </div>
            <div class="user-info">
                <span class="info-tag">
                    <b>Nume:</b>
                    <?= $user["nume"] ?>
                </span>
                <a href="?action=edit" class="edit-user-field fa fa-edit"></a>
            </div>

            <div class="user-info">
                <span class="info-tag">
                    <b>
                        Prenume:
                    </b>
                    <?= $user["prenume"] ?>
                </span>
                <a href="?action=edit" class="edit-user-field fa fa-edit"></a>
            </div>

            <div class="user-info">
                <span class="info-tag">
                    <b>
                        Email:
                    </b>
                    <?= $user["email"] ?>
                </span>
                <a href="?action=edit" class="edit-user-field fa fa-edit"></a>
            </div>

            <div class="user-info">
                <span class="info-tag">
                    <b>Parola:</b>
                    <?= $user["password"] ?>
                </span>
                <a href="?action=edit" class="edit-user-field fa fa-edit"></a>
            </div>

            <div class="user-info">
                <span class="info-tag">
                    <b>Username:</b>
                    <?= $user["username"] ?>
                </span>
                <a href="?action=edit" class="edit-user-field fa fa-edit"></a>
            </div>

            <form action="" method="post">
                <?php
                if (isset($_POST["log-out"])) {
                    setcookie("user_id", null, 0, "/");
                    header("Location: /atestat");
                }
                ?>

                <button name="log-out" value="log-out" class="log-out">
                    LOG OUT
                    <i class="fa fa-sign-out"></i>
                </button>
            </form>
        </div>
    <?php } ?>


    <?php
    if ($is_edit_mode) {
        ?>
        <section>
            <div class="user-info-container">
                <form action="" method="post">
                    <div class="profile-picture">
                        <?= substr($user["nume"], 0, 1) . substr($user["prenume"], 0, 1) ?>
                    </div>
                    <div class="user-info">
                        <span>Nume:</span>
                        <input name="name" class="edit-info" type="text" value="<?= $user["nume"] ?>">
                    </div>

                    <div class="user-info">
                        <span>Prenume:</span>
                        <input name="forname" class="edit-info" type="text" value="<?= $user["prenume"] ?>">
                    </div class="user-info">

                    <div class="user-info">
                        <span>Email:</span>
                        <input name="email" class="edit-info" type="text" value="<?= $user["email"] ?>">
                    </div>

                    <div class="user-info">
                        <span>Parola:</span>
                        <input name="password" class="edit-info" type="text" value="<?= $user["password"] ?>">
                    </div>

                    <div class="user-info">
                        <span>Username:</span>
                        <input name="username" class="edit-info" type="text" value="<?= $user["username"] ?>">
                    </div>
                    <button type="submit" value="edit" name="edit">
                        MODIFICA
                        <i class="fa fa-edit"></i>
                    </button>
                </form>
            </div>
        </section>
    <?php } ?>

    <script src="/atestat/pages/dashboard/views/profile/profile.js"></script>