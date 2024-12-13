<!DOCTYPE html>
<html>
<?php 
require('session.php'); 
include ('../includes/connection.php');

if(logged_in()){ ?>
          <script type="text/javascript">
            window.location = "index.php";
          </script>
          <?php
}
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php 
          $exe = $db->query("SELECT * FROM configuration")->fetch_assoc();
          echo $exe['site_title'];

   ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="" rel="icon">
  <link href="" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
    <style type="text/css">
    @media only screen and (max-width: 600px) {
        section {
            margin-top:-40px !important;
        }
    }
    </style>
</head>

<body>

  
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-2">

                <div class="card-body">

                  <div class="pt-3 pb-2">
 
                    <h5 class="card-title text-center pb-0 fs-4" style="color:black">Sign Up</h5>
                    <p class="text-center small" style="color:black"><?php
                     include 'backend.php'; 
                     if(isset($_GET['msg'])){
                            if($_GET['msg']==0){
                                echo "<br><span style='color:red; font-weight:bold'>Invalid Credentials or Device ID Already Exist...!</span>";
                            }else if($_GET['msg']==2){
                                echo "<br><span style='color:red; font-weight:bold'>Invalid Device ID...!</span>";
                            }
                            else if($_GET['msg']==1){
                              ?>
                              <script type="text/javascript">                      
                                window.location = "login";
                              </script>
                <?php
                            } 
                    }?>
                    </p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate  action="signup.php" method="post">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label"><b>First Name:</b></label>
                      <div class="input-group has-validation">
                        <!--<span class="input-group-text" id="inputGroupPrepend">@</span>-->
                        <input type="text" name="first_name" placeholder="Enter First Name" class="form-control" id="first_name" required autofocus>
                        <div class="invalid-feedback">Please enter your first name.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="" class="form-label"><b>Last Name:</b></label>
                      <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter Last Name" required>
                      <div class="invalid-feedback">Please enter your last name!</div>
                    </div>
                    <div class="col-12">
                      <label for="" class="form-label"><b>Username:</b></label>
                      <input type="email" name="username" class="form-control" id="username" placeholder="Enter Username" required>
                      <div class="invalid-feedback">Please enter your username!</div>
                    </div>
                    <div class="col-12">
                      <label for="" class="form-label"><b>Password:</b></label>
                      <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                      <label for="" class="form-label"><b>Contact:</b></label>
                      <input type="text" name="contact" class="form-control" id="contact" placeholder="Enter Contact" required>
                      <div class="invalid-feedback">Please enter your contact!</div>
                    </div>
                    <div class="col-12">
                      <label for="" class="form-label"><b>Device ID:</b></label>
                      <input type="text" name="device_id" class="form-control" id="device_id" placeholder="Enter Device ID" required>
                      <div class="invalid-feedback">Please enter your device id!</div>
                    </div>
                    <div class="col-12">
                        <input type="hidden" name="user_registration_form" value="1" />
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" style="background:#397fbc" type="submit" name="btnlogin"><b>Create Account</b></button>
                      <a href="login" class="btn btn-primary w-100" style="background:#397fbc; margin-top: 10px" name="btnlogin"><b>Login Page</b></a>
                      
                    </div>
                    <div class="col-12">
                      <!--<p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>-->
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
             <!--    <span style="color:black">Designed By </span><a href="https://pms.net.pk/" target="_blank"><b>PMS (Pvt.) Ltd.</b></a> -->
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  <!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <!--<script src="assets/vendor/php-email-form/validate.js"></script>-->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>