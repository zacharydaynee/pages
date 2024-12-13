<!DOCTYPE html>
<?php
include '../includes/connection.php';
include '../includes/sidebar.php'; 
?>
<main id="main" class="main">

    <section class="section">
    <?php 
          include 'backend.php';
          include 'alerts.php';
          //$settings = $db->query("SELECT * FROM configuration WHERE id='1'")->fetch_assoc();
    ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <!-- General Form Elements -->
              <form method="POST" action="backend.php">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label"><b>MAC Address:</b></label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" placeholder="Enter MAC Address" name="title" id="title" required autofocus>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label"><b>Name:</b></label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name" required autofocus>
                  </div>
                </div>

                <input type="hidden" name="mac_address" value="1" />
                <div class="row mb-3">
                
                <div class="row mb-3">
                
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-block btn-primary" style="border-color:black; background:#FEF5DA !important;color:black"><b>Update</b></button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>


</body>

</html>