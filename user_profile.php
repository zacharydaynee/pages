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
          $user_profile = $db->query("SELECT * FROM users WHERE id='".$_SESSION['MEMBER_ID']."'")->fetch_assoc();
    ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <!-- General Form Elements -->
              <form method="POST" action="backend.php">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label"><b>First Name:</b></label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" placeholder="Enter First Name" name="first_name" id="first_name" value="<?php echo $user_profile['first_name']; ?>" required autofocus>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label"><b>Last Name:</b></label>
                  <div class="col-sm-5">
                    <input type="text" placeholder="Enter Last Name" class="form-control" name="last_name" id="last_name" value="<?php echo $user_profile['last_name'];; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-3 col-form-label"><b>Cell No.:</b></label>
                  <div class="col-sm-5">
                    <input type="text" placeholder="Enter Cell No." class="form-control" name="cell_no" id="cell_no" value="<?php echo $user_profile['contact']; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-3 col-form-label"><b>Username:</b></label>
                  <div class="col-sm-5">
                    <input type="text" placeholder="Enter Username" class="form-control" name="email" id="email" value="<?php echo $user_profile['username'];; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-3 col-form-label"><b>Password:</b></label>
                  <div class="col-sm-5">
                    <input type="password" placeholder="Enter Password" class="form-control" name="password" id="password" value="<?php echo $user_profile['password']; ?>" required>
                  </div>
                </div>

                <input type="hidden" name="edit_user_profile_form" value="1" />
                <div class="row mb-3">
                <input type="hidden" name="edit_id" value="<?php echo $_SESSION['MEMBER_ID']; ?>" />
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