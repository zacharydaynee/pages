<!DOCTYPE html>
<html>
<?php 
require('session.php'); 
include ('../includes/connection.php');

if(logged_in()){ ?>
    <script type="text/javascript">
        // Start the animation before redirecting
        document.addEventListener('DOMContentLoaded', function() {
            const logo = document.getElementById('logo');
            const originalRect = logo.getBoundingClientRect(); // Get the original position

            // Calculate the center position
            const centerX = window.innerWidth / 2 - originalRect.width / 2; // Center x
            const centerY = window.innerHeight / 2 - originalRect.height / 2; // Center y

            // Move the logo to the center while growing
            logo.style.transform = `translate(${centerX - originalRect.left}px, ${centerY - originalRect.top}px) scale(3)`; // Translate to center and scale

            // Add dark background
            const darkBackground = document.createElement('div');
            darkBackground.className = 'dark-background';
            document.body.appendChild(darkBackground);

            // Trigger the fade-in effect by adding the active class
            setTimeout(() => {
                darkBackground.classList.add('active'); // Fade in the background
            }, 50); // Small delay to ensure the class is added after the element is in the DOM

            // Redirect to index.php after a delay
            setTimeout(() => {
                window.location.href = 'index.php'; // Redirect to index.php
            }, 2000); // Adjust time here if needed
        });
    </script>
<?php } ?>
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
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

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
        * {
            font-family: 'Inter', sans-serif; 
        }

        @media only screen and (max-width: 600px) {
            section {
                margin-top: -40px !important;
            }
        }

        body {
            background-image: url('images/login_background.jpeg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .dark-background {
            background-color: rgba(40, 55, 41, 1);
            opacity: 0;
            transition: opacity 2s ease;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 999;
        }

        .dark-background.active {
            opacity: 1;
        }

        .logo-animation {
            position: relative;
            transition: transform 1.5s ease, opacity 1s ease;
            opacity: 1;
            z-index: 1000;
        }
    </style>
    <script>
        function validateForm(event) {
            const username = document.getElementById("yourUsername").value;
            const password = document.getElementById("yourPassword").value;
            let valid = true;

            if (!username) {
                document.getElementById("username-feedback").style.display = "block";
                valid = false;
            } else {
                document.getElementById("username-feedback").style.display = "none";
            }

            if (!password) {
                document.getElementById("password-feedback").style.display = "block";
                valid = false;
            } else {
                document.getElementById("password-feedback").style.display = "none";
            }

            if (!valid) {
                event.preventDefault(); // Prevent form submission if invalid
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-2" style="background:#FEF5DA; border-radius:30px">
                            <div class="card-body" id="login-container">
                                <div class="pt-3 pb-2 pl-3 pr-3">
                                    <h5 class="card-title text-center pb-0 fs-4" style="color:black;">
                                        <img class="text-center logo-animation" id="logo" src="images/Logo.png" style="margin-bottom:20px;height:82px; width:87px; text-align:center !important"/><br>
                                        <?php echo $exe['site_title']; ?></h5>
                                    <p class="text-center small" style="color:black"><?php 
                                        if(isset($_GET['msg']) && $_GET['msg'] == 0) {
                                            echo "<br><span style='color:red; font-weight:bold'>Invalid Credentials...!</span>";
                                        }
                                    ?></p>
                                </div>
                                <form class="row g-3 needs-validation" novalidate action="processlogin.php" method="post" onsubmit="validateForm(event)">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary w-100" style="background:#5C4033; border:#5C4033; padding:10px; margin-bottom:20px; margin-top:-10px" type="submit" name="btnlogin"><b>Login</b></button>
                                    </div> 
                                    <div class="col-12">
                                        <div class="input-group has-validation">
                                            <input type="text" name="username" style="text-align:center; padding:10px" placeholder="Enter Username" class="form-control" id="yourUsername" required autofocus>
                                            <div id="username-feedback" class="invalid-feedback">Please enter your username.</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <input type="password" style="text-align:center; padding:10px;" name="password" class="form-control" id="yourPassword" placeholder="Enter Password" required>
                                        <div id="password-feedback" class="invalid-feedback">Please enter your password.</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
