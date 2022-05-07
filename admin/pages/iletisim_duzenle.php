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

    <title>İletişim Bilgileri Duzenle | Admin Panel</title>

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

             @$id=$_GET["id"];
            
             $cek=$db->prepare("SELECT * FROM `iletisimbilgileri` WHERE `id` =:id ");
             $cek->bindValue(":id",$id,PDO::PARAM_INT);
             $cek->execute();

             $row=$cek->fetch(PDO::FETCH_ASSOC);


            if(@$_POST["submit"]){
                

                $tel1=htmlspecialchars($_POST["tel1"],ENT_QUOTES,'UTF-8');
                $tel2=htmlspecialchars($_POST["tel2"],ENT_QUOTES,'UTF-8');
                $mail=htmlspecialchars($_POST["mail"],ENT_QUOTES,'UTF-8');
                $adres=htmlspecialchars($_POST["adres"],ENT_QUOTES,'UTF-8');
                $aktif=htmlspecialchars($_POST["aktif"],ENT_QUOTES,'UTF-8');

                $guncelle=$db->prepare("UPDATE `iletisimbilgileri` SET `tel1`= :tel1, `tel2`= :tel2 ,`mail`= :mail , `adres` = :adres,`aktif`= :aktif  WHERE `id` =:id ");

                $guncelle->bindValue(":tel1",$tel1,PDO::PARAM_STR);
                $guncelle->bindValue(":tel2",$tel2,PDO::PARAM_STR);
                $guncelle->bindValue(":mail",$mail,PDO::PARAM_STR);
                $guncelle->bindValue(":adres",$adres,PDO::PARAM_STR);
                $guncelle->bindValue(":aktif",$aktif,PDO::PARAM_INT);
                $guncelle->bindValue(":id",$id,PDO::PARAM_INT);

                if($guncelle->execute()){
                    header("Location:iletisim.php?i=ekle");
                }else{
                    // print_r($ekle->errorInfo());
                    header("Location:iletisim.php?i=hata");
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
                            <a href="iletisim.php">Geri Dön</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="" method="POST" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label>Telefon 1</label>
                                            <input class="form-control" name="tel1" value="<?= $row["tel1"] ?>" placeholder="Başlık Giriniz" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Telefon 2</label>
                                            <input class="form-control" name="tel2"  value="<?= $row["tel2"] ?>" placeholder="Alt Başlık Giriniz" >
                                        </div>
                                        <div class="form-group">
                                            <label>E-Mail</label>
                                            <input class="form-control" type="email" name="mail"  value="<?= $row["mail"] ?>" placeholder="E-mail Giriniz" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Adres</label>
                                            <textarea class="form-control" name="adres"   id="mytextarea" rows="3"><?= $row["adres"] ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Durum</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktif" value="1"
                                                    <?php echo ($row["aktif"]==1) ? 'checked' : '' ;?>
                                                    >Aktif
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktif" value="0"
                                                    <?php
                                                        echo ($row["aktif"]==0) ? 'checked' : '' ;
                                                    ?> 
                                                    >Pasif
                                                </label>
                                            </div>
                                        </div>

                                        <input type="submit"  class="btn btn-default" name="submit" value="Güncelle">
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