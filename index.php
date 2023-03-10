<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Acasa</title>
  <link rel="stylesheet" href="style/global.css">
  <link rel="stylesheet" href="style/acasa.css">
</head>

<body>
  <?php
  include("./components/navbar/index.php");
  ?>

  <section>
    <div class="promo">
      <h1>
        Iți plac jocurile?
        <br>
        Ai ajuns unde trebuie!
      </h1>
      <p class="description">
        Vizitează galeria și găsește jocul cel mai
        <b>
          popular
        </b>
        sau
        încearcă ceva complet <b>nou!</b>
        <br>
        <i style="
          display: block;
          margin-top: 0.5rem;
        ">
          Distracția te așteaptă!
        </i>
      </p>
      <a class="visit-game-gallery" href="jocuri.php">Vezi Jocurile</a>
    </div>
    <img src="./images/computer-game.png" alt="computer-start-game">
  </section>

</body>

</html>