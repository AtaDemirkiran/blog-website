    <!-- Navigation-->
    <?php //database baglantı
    require_once 'admin/pages/inc-functions.php';
    ?>
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">Yazılım Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">Anasayfa</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="blog.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="hakkimizda.php">Hakkımda</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="urunler.php">Urunler</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="galeri.php">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="iletisim.php">İletişim</a></li>
                    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <?php
                                    $cek = $db->prepare("SELECT * FROM `kategori` WHERE  `aktif` = :aktif ORDER BY  `id` DESC");
                                    $cek->bindValue(":aktif", 1, PDO::PARAM_INT);
                                    $cek->execute();

                                    while ($row = $cek->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        -- <li><a class="dropdown-item" href="kategori.php?kategori_adi=<?= $row["kategori_adi"] ?>"><?= $row['kategori_adi'] ?> </a></li>--
                                        <?php
                                        $cek2 = $db->prepare("SELECT * FROM `urunler` WHERE  `kategori_adi` = :kategori_adi ORDER BY  `id` DESC");
                                        $cek2->bindValue(":kategori_adi", $row['kategori_adi']);
                                        $cek2->execute();

                                        while ($row2 = $cek2->fetch(PDO::FETCH_ASSOC)) {
                                        ?>


                                            ** <li><a class="dropdown-item" href="#"><?= $row2['urun_adi'] ?> </a></li> **



                                        <?php } ?>

                                    <?php } ?>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </ul>
            </div>
        </div>
    </nav>