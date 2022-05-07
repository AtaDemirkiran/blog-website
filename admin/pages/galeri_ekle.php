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

    <title>Galeri Ekle | Admin Panel</title>

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
            if(@$_POST["submit"]){
                    $filename=$_FILES['file']['name'];
                    $target_dir="upload/";
                    if($filename!=''){
                        
                        $target_file=$target_dir.basename($_FILES['file']['name']);
                        $extension=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        $extension_arr=array("jpg","jpeg","png","gif");

                        if(in_array($extension,$extension_arr)){

                            $image_base64=base64_encode(file_get_contents($_FILES['file']['tmp_name']));

                            $image="data::image/".$extension.";base64,".$image_base64;

                                // $baslik=htmlspecialchars($_POST["baslik"],ENT_QUOTES,'UTF-8');
                                // $alt_baslik=htmlspecialchars($_POST["alt_baslik"],ENT_QUOTES,'UTF-8');
                                // $aciklama=htmlspecialchars($_POST["aciklama"],ENT_QUOTES,'UTF-8');
                                $aktif=htmlspecialchars($_POST["aktif"],ENT_QUOTES,'UTF-8');
            
                                $ekle=$db->prepare('INSERT INTO `galeri` (`image`,`aktif`) VALUES
                                (:image,:aktif) ');
                            
                                // $ekle->bindValue(":baslik",$baslik,PDO::PARAM_STR);
                                // $ekle->bindValue(":alt_baslik",$alt_baslik,PDO::PARAM_STR);
                                // $ekle->bindValue(":aciklama",$aciklama,PDO::PARAM_STR);
                                $ekle->bindValue(":aktif",$aktif,PDO::PARAM_INT);
                                $ekle->bindValue(":image",$image,PDO::PARAM_STR);
            
                                if($ekle->execute()){
                                    header("Location:galeri.php?i=ekle");
                                }else{
                                    // print_r($ekle->errorInfo());
                                    header("Location:galeri.php?i=hata");
                                }
                        }
                    }else{
                        // eger fotograf eklenmediyse buraya girecek.
                        header("Location:galeri.php?i=hata");
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
                    <h1 class="page-header">Yeni Ekle</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="galeri.php">Geri Dön</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="" method="POST" enctype="multipart/form-data">

                                        <div class="form-group">
                                             <label>Blog Resim</label>
                                            <input type='file' name='file'> <br>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label>Başlık</label>
                                            <input class="form-control" name="baslik" placeholder="Başlık Giriniz" >
                                        </div> -->

                                        <!-- <div class="form-group">
                                            <label>Alt Başlık</label>
                                            <input class="form-control" name="alt_baslik" placeholder="Alt Başlık Giriniz" >
                                        </div> -->

                                        <!-- <div class="form-group">
                                            <label>Açıklama</label>
                                            <textarea class="form-control" name="aciklama" id="mytextarea" rows="3"></textarea>
                                        </div> -->

                                        <div class="form-group">
                                            <label>Durum</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktif" value="1" checked>Aktif
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktif" value="0">Pasif
                                                </label>
                                            </div>
                                        </div>

                                        <input type="submit"  class="btn btn-default" name="submit" value="Kaydet">
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