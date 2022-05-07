<?php //database baglantı
    require_once 'admin/pages/inc-functions.php';
?>
<footer class="text-center text-lg-start bg-light text-muted">
  <!-- Section: Social media -->
  <section
    class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>Yazılım Blog
          </h6>
          <p>
            Here you can use rows and columns to organize your footer content. Lorem ipsum
            dolor sit amet, consectetur adipisicing elit.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Hızlı Menu
          </h6>
          <p>
            <a href="index.php" class="text-reset">Anasayfa</a>
          </p>
          <p>
            <a href="blog.php" class="text-reset">Blog</a>
          </p>
          <p>
            <a href="hakkimizda.php" class="text-reset">Hakkımda</a>
          </p>
          <p>
            <a href="galeri.php" class="text-reset">Galeri</a>
          </p>
          <p>
            <a href="iletisim.php" class="text-reset">İletişim</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Contact
          </h6>

          <?php

                $cek=$db->prepare("SELECT * FROM `iletisimBilgileri` WHERE  `aktif` = :aktif ORDER BY  `id` DESC");
                $cek->bindValue(":aktif",1,PDO::PARAM_INT);
                $cek->execute();
                $row=$cek->fetch(PDO::FETCH_ASSOC)
            ?>

          <p><i class="fas fa-home me-3"></i><?= html_entity_decode($row["adres"]) ?></p>
          <p><i class="fas fa-envelope me-3"></i><?= $row["mail"] ?></p>
          <p><i class="fas fa-phone me-3"></i> <?= $row["tel1"] ?></p>
          <p><i class="fas fa-print me-3"></i> <?= $row["tel2"] ?></p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2022 Copyright:
    <a class="text-reset fw-bold" href="index.php">Yazılım Blog</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
