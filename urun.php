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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <?= $row['urun_adi'] ?>
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
</body>

</html>