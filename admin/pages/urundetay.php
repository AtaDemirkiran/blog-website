<?php
require_once 'inc-functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ürün Duzenle | Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <?php

    @$id = $_GET["id"];

    $cek = $db->prepare("SELECT * FROM `urundetay` WHERE `id` =:id ");
    $cek->bindValue(":id", $id, PDO::PARAM_INT);
    $cek->execute();

    $row = $cek->fetch(PDO::FETCH_ASSOC);


    // if (@$_POST["submit"]) {

    //     $urun_adi = htmlspecialchars($_POST["urun_adi"], ENT_QUOTES, 'UTF-8');
    //     $kategori_adi = htmlspecialchars($_POST["kategori_adi"], ENT_QUOTES, 'UTF-8');
    //     $urun_baslik = htmlspecialchars($_POST["urun_baslik"], ENT_QUOTES, 'UTF-8');
    //     $urun_detay = htmlspecialchars($_POST["urun_detay"], ENT_QUOTES, 'UTF-8');
    //     $aktif = htmlspecialchars($_POST["aktif"], ENT_QUOTES, 'UTF-8');

    //     $guncelle = $db->prepare("UPDATE `urunler` SET `urun_adi`= :urun_adi ,`kategori_adi`= :kategori_adi ,`urun_baslik`= :urun_baslik ,`urun_detay`= :urun_detay ,`aktif`= :aktif  WHERE `id` =:id ");

    //     $guncelle->bindValue(":urun_adi", $urun_adi, PDO::PARAM_STR);
    //     $guncelle->bindValue(":kategori_adi", $kategori_adi, PDO::PARAM_STR);
    //     $guncelle->bindValue(":urun_baslik", $urun_baslik, PDO::PARAM_STR);
    //     $guncelle->bindValue(":urun_detay", $urun_detay, PDO::PARAM_STR);
    //     $guncelle->bindValue(":aktif", $aktif, PDO::PARAM_INT);

    //     $guncelle->bindValue(":id", $id, PDO::PARAM_INT);

    //     if ($guncelle->execute()) {
    //         header("Location:urunler.php?i=ekle");
    //     } else {
    //         // print_r($ekle->errorInfo());
    //         header("Location:urunler.php?i=hata");
    //     }
    // }
    if (@$_GET["is"] == "sil") {
        $sil = $db->prepare("DELETE FROM  `urundetay` WHERE `id` = :i ");
        $sil->bindValue(":i", $id, PDO::PARAM_INT);

        if ($sil->execute()) {
            header("Location:urunler.php");
        } else {
            header("Location:urundetay.php?i=hata");
        }
    }

    ?>


    <div id="wrapper">

        <?php require_once 'inc-menu.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Ürün Detay Fotoğrafı</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="urundetay_ekle.php?id=<?= $id ?>" class="btn btn-primary" style="margin-right: 15px;">Ürün Detay Foto +</a>
                            <?php
                            if (@$_GET["i"] == "ekle") {
                                echo "<span class='text-success'>Ekleme İşlemi Başaralı</span>";
                            } elseif (@$_GET["i"] == "hata") {
                                echo "<span class='text-danger'>Ekleme İşlemi Başarısız</span>";
                            }
                            ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fotoğraf</th>
                                            <th>Aktif</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cek = $db->prepare("SELECT * FROM `urundetay` WHERE `urun_id`=$id ORDER BY `id` DESC");
                                        $cek->execute();

                                        while ($row = $cek->fetch(PDO::FETCH_ASSOC)) {

                                        ?>

                                            <tr class="odd gradeX">
                                                <td><?= $row["id"] ?></td>
                                                <td><img width="50px" height="50px" src="<?= $row["image"] ?>" />
                                                    <a href="urundetay_duzenle.php?id=<?= $row["id"] ?>" class="btn btn-info btn-xs" style="margin-right: 15px;">Değiştir</a>

                                                </td>
                                                <td class="center">
                                                    <?php if ($row["aktif"] == 1) { ?>
                                                        <a href="urundetay.php?is=aktif&id=<?= $row["id"] ?>&drm=<?= $row["aktif"] ?>" onclick="return confirm('Aktiflik Durumu Değişsin mi  ?')" class="btn btn-success btn-xs" style="margin-right: 15px;">Aktif</a>
                                                    <?php } else { ?>
                                                        <a href="urundetay.php?is=aktif&id=<?= $row["id"] ?>&drm=<?= $row["aktif"] ?>" onclick="return confirm('Aktiflik Durumu Değişsin mi  ?')" class="btn btn-danger btn-xs" style="margin-right: 15px;">Pasif</a>
                                                    <?php } ?>

                                                </td>
                                                <td>
                                                    <!-- <a href="urunler_duzenle.php?id=<?= $row["id"] ?>" class="btn btn-warning btn-xs" style="margin-right: 15px;">Düzenle</a> -->
                                                    <a href="urundetay.php?is=sil&id=<?= $row["id"] ?>" onclick="return confirm('Silmek İstediğinze Emin Misinz ?')" class="btn btn-danger btn-xs" style="margin-right: 15px;">Sil</a>
                                                </td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row buraya kadaar -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script src="../js/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
</body>

</html>