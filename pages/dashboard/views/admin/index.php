<link rel="stylesheet" href="/atestat/pages/dashboard/views/admin/admin.css">
<?php
$category = "official-games";
if (isset($_GET["category"]))
    $category = $_GET["category"];
?>

<nav class="page">
    <a href="?view=admin&category=official-games" class="select-page" id=<?= $category == "official-games" ? "active" : null ?>>JOCURI OFICIALE</a>
    <a href="?view=admin&category=proposed-games" class="select-page" id=<?= $category == "proposed-games" ? "active" : null ?>>JOCURI PROPUSE</a>
</nav>

<?php
if ($category == "official-games")
    include(__DIR__ . "/official-games/index.php");

if ($category == "proposed-games")
    include(__DIR__ . "/proposed-games/index.php");
?>