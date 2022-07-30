<!DOCTYPE html>
<?php //database baglantı
require_once 'admin/pages/inc-functions.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    @$kategori_adi = $_GET["kategori_adi"];

    $cek = $db->prepare("SELECT * FROM `urunler` WHERE `kategori_adi` =:kategori_adi ");
    $cek->bindValue(":kategori_adi", $kategori_adi, PDO::PARAM_STR);
    $cek->execute();
    while ($row = $cek->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div class="post-preview">
            <img src="<?= $row["image"]  ?>" width="450px" height="300px" alt="">
            <a href="urun.php?id=<?= $row["id"] ?>">
                <h2 class="post-title"><?= $row["urun_adi"] ?></h2>
                <h3 class="post-subtitle"><?= htmlspecialchars_decode($row["urun_detay"]) ?> </h3>

            </a>
        </div>
    <?php } ?>
</body>

</html>