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

    <title>Blog Duzenle | Admin Panel</title>

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


    if (@$_POST["submit"]) {

        $filename = $_FILES['file']['name'];
        $target_dir = "upload/";
        if ($filename != '') {

            $target_file = $target_dir . basename($_FILES['file']['name']);
            $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extension_arr = array("jpg", "jpeg", "png", "gif");
            if (in_array($extension, $extension_arr)) {
                //convert to base 64

                $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']));

                $image = "data::image/" . $extension . ";base64," . $image_base64;

                $guncelle = $db->prepare("UPDATE `urundetay` SET `image`= :image  WHERE `id` =:id ");
                $guncelle->bindValue(":image", $image, PDO::PARAM_STR);
                $guncelle->bindValue(":id", $id, PDO::PARAM_INT);

                if ($guncelle->execute()) {
                    header("Location:urunler.php?i=ekle");
                } else {
                    // print_r($ekle->errorInfo());
                    header("Location:urunler.php?i=hata");
                }
            }
        }
    }

    ?>


    <div id="wrapper">

        <!-- Navigation -->
        <?php require_once 'inc-menu.php'; ?>
        <!-- Navigation -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Düzenle (<?= $id ?>)</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="urunler.php">Geri Dön</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="" method="POST" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label>Ürün Resim</label> <br>
                                            <img src="<?= $row["image"]  ?>" width="200px" height="200px" alt="">
                                            <input type='file' value="<?= $row["image"] ?>" name='file'> <br>
                                        </div>
                                        <input type="submit" class="btn btn-default" name="submit" value="Güncelle">
                                        <button type="reset" class="btn btn-default">Temizle</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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