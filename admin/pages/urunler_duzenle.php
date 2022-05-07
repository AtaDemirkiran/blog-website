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

             @$id=$_GET["id"];
            
             $cek=$db->prepare("SELECT * FROM `urunler` WHERE `id` =:id ");
             $cek->bindValue(":id",$id,PDO::PARAM_INT);
             $cek->execute();

             $row=$cek->fetch(PDO::FETCH_ASSOC);
          

            if(@$_POST["submit"]){
                
                $urun_adi=htmlspecialchars($_POST["urun_adi"],ENT_QUOTES,'UTF-8');
                $kategori_adi=htmlspecialchars($_POST["kategori_adi"],ENT_QUOTES,'UTF-8');
                $urun_baslik=htmlspecialchars($_POST["urun_baslik"],ENT_QUOTES,'UTF-8');
                $urun_detay=htmlspecialchars($_POST["urun_detay"],ENT_QUOTES,'UTF-8');
                $aktif=htmlspecialchars($_POST["aktif"],ENT_QUOTES,'UTF-8');

                $guncelle=$db->prepare("UPDATE `urunler` SET `urun_adi`= :urun_adi ,`kategori_adi`= :kategori_adi ,`urun_baslik`= :urun_baslik ,`urun_detay`= :urun_detay ,`aktif`= :aktif  WHERE `id` =:id ");

                $guncelle->bindValue(":urun_adi",$urun_adi,PDO::PARAM_STR);
                $guncelle->bindValue(":kategori_adi",$kategori_adi,PDO::PARAM_STR);
                $guncelle->bindValue(":urun_baslik",$urun_baslik,PDO::PARAM_STR);
                $guncelle->bindValue(":urun_detay",$urun_detay,PDO::PARAM_STR);
                $guncelle->bindValue(":aktif",$aktif,PDO::PARAM_INT);

                $guncelle->bindValue(":id",$id,PDO::PARAM_INT);

                if($guncelle->execute()){
                    header("Location:urunler.php?i=ekle");
                }else{
                    // print_r($ekle->errorInfo());
                    header("Location:urunler.php?i=hata");
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
                                            <label>Ürün Adı </label>
                                            <input class="form-control" name="urun_adi" value="<?= $row["urun_adi"] ?>" placeholder="Kategori Giriniz" >
                                        </div>

                                        <div class="form-group">
                                            <label>Ürün Başlık </label>
                                            <input class="form-control" name="urun_baslik" value="<?= $row["urun_baslik"] ?>" placeholder="Kategori Giriniz" >
                                        </div>

                                        <div class="form-group">
                                            <label>Ürün Detay</label>
                                            <textarea class="form-control" name="urun_detay"   id="mytextarea" rows="3"><?= $row["urun_detay"] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Kategoriler</label><br>

                                            <select name="kategori_adi" id="">
                                            <option value="<?= $row["kategori_adi"] ?>"><?= $row["kategori_adi"] ?></option>
                                            <?php

                                                $kategoriCek=$db->prepare("SELECT * FROM `kategori` WHERE `aktif` = :aktif ORDER BY  `id` DESC");
                                                $kategoriCek->bindValue(":aktif",1,PDO::PARAM_INT);
                                                $kategoriCek->execute();

                                                while($kategoriler=$kategoriCek->fetch(PDO::FETCH_ASSOC)){
                                             ?>
                                                <option value="<?= $kategoriler["kategori_adi"] ?>"><?= $kategoriler["kategori_adi"] ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>

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