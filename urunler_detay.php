<!DOCTYPE html>
<html lang="en">
<?php //database baglantı
require_once 'admin/pages/inc-functions.php';

//detaylarda id ile cekme yapıyoruz.
//intval sadece sayı değeri alırken kullanılıyor.
@$id = intval($_GET["id"]);

$cek = $db->prepare("SELECT * FROM `urunler` WHERE `id` =:id LIMIT 1");
$cek->bindValue("id", $id, PDO::PARAM_INT);
$cek->execute();

$row = $cek->fetch(PDO::FETCH_ASSOC);

//aktif degilse direkt olarak url kısmından cekmesin diye
if (@$row["aktif"] == 0) {
    header("Location:index.php");
}

?>


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $row["urun_adi"] ?></title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <?php require 'includes/inc-menu.php' ?>
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/foto2.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading">
                        <h1><?= $row["urun_adi"] ?></h1>
                        <h2 class="subheading"><?= $row["kategori_adi"] ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <img src="<?= $row["image"]  ?>" width="450px" height="300px" alt="">
                    <?= htmlspecialchars_decode($row["urun_detay"]) ?>
                </div>
            </div>
            <div class="container">
                <?php
                $urundetayFoto_cek = $db->prepare("SELECT * FROM `urundetay` WHERE  `urun_id` = :urun_id ORDER BY  `id` DESC");
                $urundetayFoto_cek->bindValue(":urun_id", $id, PDO::PARAM_INT);
                $urundetayFoto_cek->execute();
                while ($urunFoto = $urundetayFoto_cek->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div>
                        <img src="<?= $urunFoto["image"]  ?>" width="450px" height="300px" alt="">
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </article>
    <!-- Footer-->
    <?php require 'includes/inc-footer.php' ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>