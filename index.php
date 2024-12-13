<!DOCTYPE html>
<?php
include '../includes/connection.php';
include '../includes/sidebar.php';


?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<head>
  <style>
    ::-webkit-scrollbar {
      width: 8px;

    }

    ::-webkit-scrollbar-track {
      box-shadow: inset 0 0 2px white;
      border-radius: 15px;
    }

    ::-webkit-scrollbar-thumb {
      background: #2c3728;

    }

    ::-webkit-scrollbar-thumb:hover {
      background: #2c3728;
    }

    .toggle-container {
      display: inline-block;
    }

    .toggle-checkbox {
      display: none;
    }

    .toggle-label {
      position: relative;
      width: 60px;
      height: 30px;
      background-color: #ccc;
      border-radius: 30px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .toggle-switch {
      position: absolute;
      top: 3px;
      left: 3px;
      width: 24px;
      height: 24px;
      background-color: white;
      border-radius: 50%;
      transition: transform 0.3s ease;
    }

    .toggle-checkbox:checked+.toggle-label {
      background-color: #283728;
    }

    .toggle-checkbox:checked+.toggle-label .toggle-switch {
      transform: translateX(30px);
    }

    .back-to-top svg {
      fill: white;
      /* Change this to your desired color */
      width: 18px;
      /* Width of the icon */
      height: 18px;
      /* Height of the icon */
    }

    .back-to-top {
      display: inline-block;
      /* Ensure it's inline-block for padding and background */
      background-color: #283728;
      /* Background color */
      border-radius: 3px;
      /* Optional: rounded corners if desired */
      width: 40px;
      /* Width of the square */
      height: 40px;
      /* Height of the square */
      text-align: center;
      /* Center align SVG */
      line-height: 50px;
      /* Center SVG vertically */
      transition: background-color 0.3s;
      /* Smooth transition for hover effect */
    }

    .back-to-top:hover {
      background-color: #4C6057;
      /* Darker shade for hover effect */
    }

    .vimeo-wrapper {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      width: 100%;
      height: 100vh;
      z-index: -1;
      pointer-events: none;
      overflow: hidden;
    }

    .vimeo-wrapper iframe {
      width: 100vw;
      height: 56.25vw;
      /* Given a 16:9 aspect ratio, 9/16*100 = 56.25 */
      height: 100vh;
      max-height: 100%;
      overflow: hidden;
      min-width: 177.77vh;
      /* Given a 16:9 aspect ratio, 16/9*100 = 177.77 */
      position: relative;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .vimeo-wrapper iframe {
      width: 100vw;
      height: 300vw;
      overflow: hidden;
      min-width: 300vh;
      position: relative;
      left: 50%;
      transform: translate(-50%, -50%);
    }



    /* Set the border radius for accordion items */
    .accordion-item {
      border: 1px solid #283728;
      /* Existing border style */
      border-radius: 10px;
      /* Change this value for desired roundness */
      margin-bottom: 10px;
      /* Optional: adds spacing between accordion items */
    }

    /* Set the border radius for accordion headers */
    .accordion-header {
      border-radius: 10px 10px 0 0;
      /* Round the top corners */
      background: #283728;
      /* Match with your background */
    }

    /* Set the border radius for accordion body */
    .accordion-collapse {
      border-radius: 0 0 10px 10px;
      /* Round the bottom corners */
      overflow: hidden;
      /* Optional: to ensure rounded corners are respected */
    }

    /* Add this in your CSS file */
    .search-bar {
      margin-bottom: 10px;
      padding: 12px;
      width: 20%;
      font-size: 14px;
      border: 2px solid #283728;
      border-radius: 5px;
      background-color: #f7f7f7;
      color: #333;
    }

    .highlight-red {
      font-weight: bold !important;
    }

    .bold-text {
      font-weight: bold !important;
    }



  </style>
  <main id="main" class="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-6" style="border:#283728;">

          <!-- LAST IMAGE Accordion -->
          <div class="accordion" id="accordionExample">
            <div class="accordion-item" style="border: #283728; height: 35vh;">
              <h2 class="accordion-header" id="headingOne">
                <div style="background: #283728; color: white; text-align: center; font-weight: bold; padding: 10px; font-size: 20px">
                  Last Image
                </div>
              </h2>
              <div id="collapseExample" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <h6 style="padding: 5px 20px; font-weight: bold; background: #BFBFBF; margin-top: 0px; display: inline-block; width: 100%;">TODAY</h6>
                  <div id="lastImageContainer" style="text-align: center;">
                    <!-- Initial image and file name will be inserted here by AJAX -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- LAST IMAGE Accordion -->

          <br>

          <!-- LIVE STREAM Accordion -->
          <div class="accordion" id="accordionLiveStream" style="margin-top: auto;">
            <div class="accordion-item" style="border:#283728; height: 53.5vh;">
              <h2 class="accordion-header" id="headingLiveStream">
                <div style="background:#283728; color:white; text-align:center; font-weight:bold; padding:10px; font-size:20px">Live Stream
                </div>
              </h2>
              <div id="collapseLiveStream" class="accordion-collapse collapse show" aria-labelledby="headingLiveStream" data-bs-parent="#accordionLiveStream">
                <div class="accordion-body">
                  <h6 style="padding: 5px 20px; font-weight: bold; background: #BFBFBF; margin-top: 0px; display: inline-block; width: 100%;">Live Stream
                  </h6>

                  <!-- Livestream Toggle Switch -->
                  <div class="toggle-container">
                    <input type="checkbox" id="livestream-toggle" class="toggle-checkbox" onclick="toggleLiveStream()">
                    <label for="livestream-toggle" class="toggle-label">
                      <span class="toggle-switch"></span>
                    </label>
                  </div>

                  <div id="live_stream_container" class="row">
                    <div id="live_stream" class="col-lg-6"></div>
                    <div id="live_stream1" class="col-lg-6" style="display:none"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- LIVE STREAM Accordion -->

          <br>

        </div>

        <div class="col-lg-6">
          <div class="col-lg-12">

            <!-- SNAPSHOTS Accordion -->
            <div class="accordion" id="accordionExample">
              <div class="accordion-item" style="border:#283728; height:35vh;">
                <h2 class="accordion-header" id="headingOne">
                  <!-- Use a div or h2 for the header text -->
                  <div style="background:#283728; border-color:#283728; color:white; cursor:pointer" data-bs-toggle="collapse" data-bs-target="#collapseOnes" aria-expanded="true" aria-controls="collapseOne">
                    <div style="background:#283728; color:white; text-align:center; font-weight:bold; padding:10px; font-size:20px">Snapshots
                    </div>
                </h2>
                <div id="collapseOne" style="height:29vh; overflow-y: scroll" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <?php
                    $query = $db->query("SELECT * FROM images order by id DESC");
                    if ($query->num_rows > 0) {
                      while ($row = $query->fetch_assoc()) {
                    ?>
                        <div style="background:#BFBFBF; padding:4px; margin-bottom:2px;">
                          <?php
                          echo '<a target="_blank" href="' . str_replace("pages/", "", $row['image_url']) . '" style="text-decoration:none; color:black">' . $row['date_time'] . '.jpeg</a>';
                          //echo '<span style="float: right; font-weight:bold; color: white"><a href="'.str_replace("pages/", "", $row['image_url']).'" download><i class="bi bi-download" style="color:black; font-weight:bold; margin-right:5px; font-weight:bold"></i></a></span>';
                          ?>
                        </div>
                    <?php
                      }
                    }
                    ?>
                  </div>
                </div>
              </div>
              <!-- SNAPSHOTS Accordion -->

            </div>
          </div>
          <br>

          <div class="col-lg-12">

            <!-- HISTORY OF ALERTS Accordion -->
            <div class="accordion" id="accordionExample">
              <div class="accordion-item" style="border:#283728; height:53.5vh;">
                <h2 class="accordion-header" id="headingOne">
                  <div style="background:#283728; color:white; text-align:center; font-weight:bold; padding:10px; font-size: 20px">History of Alerts</div>
                </h2>
                <div id="collapseOne" style="height:48vh; overflow-y:scroll;" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <table class="table text-center">
                      <thead>
                        <tr style="font-size:13px">
                          <th scope="col" style="background:#BFBFBF;">
                            <center>No</center>
                          </th>
                          <th scope="col" style="background:#BFBFBF;">
                            <center>Type</center>
                          </th>
                          <th scope="col" style="background:#BFBFBF;">
                            <center>Alert</center>
                          </th>
                          <th scope="col" style="background:#BFBFBF;">
                            <center>Recipient</center>
                          </th>
                          <th scope="col" style="background:#BFBFBF;">
                            <center>Timestamp</center>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="alertsTableBody">
                        <!-- Rows will be dynamically inserted here by AJAX -->
                        <tr style="font-size:13px">
                          <td colspan="5">Loading alert history...</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- HISTORY OF ALERTS Accordion -->

          </div>
        </div>

<!-- SUMMARY Accordion -->
<div class="accordion" id="accordionExample" style="margin-top:4px">
  <!-- Accordion Container -->
  <div class="accordion-item" style="border:#283728; height:90vh; width: 100%vh; margin: 0 auto;">
    <!-- Accordion Header -->
    <h2 class="accordion-header" id="headingOne" style="text-align: center;">
      <div style="background:#283728; border-color:#283728; color:white; width: 100%; text-align: center; padding: 10px; font-weight:bold; font-size: 20px;">
        Summary
      </div>
    </h2>
    <!-- Accordion Content (collapsible section) -->
    <div id="collapseOne" style="height:85vh; overflow-y: scroll;" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body" style="width: 100%; display: flex; justify-content: center; align-items: center;">
        
        <!-- Table for Summary Data -->
        <table id="summaryTable" class="table text-center" style="width: 100%;">
          <thead>
            <!-- Table Header -->
            <tr>
              <th scope="col" style="background:#BFBFBF; font-size:13px">
                <center>Timestamp</center>
              </th>
              <th scope="col" style="background:#BFBFBF; font-size:13px">
                <center>PIR Reading</center>
              </th>
              <th scope="col" style="background:#BFBFBF; font-size:13px">
                <center>Object Detected</center>
              </th>
              <th scope="col" style="background:#BFBFBF; font-size:13px">
                <center>MAC Address</center>
              </th>
              <th scope="col" style="background:#BFBFBF; font-size:13px">
                <center>Name</center>
              </th>
              <th scope="col" style="background:#BFBFBF; font-size:13px">
                <center>Status</center>
              </th>
              <th scope="col" style="background:#BFBFBF; font-size:13px">
                <center>Poacher Detected</center>
              </th>
              <th scope="col" style="background:#BFBFBF; font-size:13px">
                <center>Alert</center>
              </th>
            </tr>
          </thead>
          <tbody id="tableBody">
            <!-- Rows will be dynamically inserted here by AJAX -->
            <?php
            // Retain the original logic to populate the table on initial page load
            $query = $db->query("SELECT * FROM bluetooth ORDER BY id ASC");
            $query2 = $db->query("SELECT * FROM detection ORDER BY id ASC");

            $status = "-";
            $poacherDetected = "-";

            if ($query->num_rows > 0) {
              $count = 1;
              while ($row = $query->fetch_assoc()) {
                if ($count <= $query2->num_rows)
                  $row2 = $query2->fetch_assoc();
                else
                  $row2 = null;

                if ($row2) {
                  // Determine the status value based on the provided logic
                  $status = match (true) {
                    $row['nameb'] != "" && $row2['label'] == "person" && $row['bluetooth'] != "0" => "Authorized",
                    $row['nameb'] != "" && $row2['label'] != "person" && $row['bluetooth'] != "0" => "Authorized",
                    $row['nameb'] == "" && $row2['label'] == "person" && $row['bluetooth'] != "0" => "Unauthorized",
                    $row['nameb'] == "" && $row2['label'] != "person" && $row['bluetooth'] != "0" => "Unauthorized",
                    $row['nameb'] == "" && $row2['label'] != "person" && $row['bluetooth'] == "0" => "-",
                    $row['nameb'] == "" && $row2['label'] == "person" && $row['bluetooth'] == "0" => "Unauthorized",
                    default => ""
                  };

                  // Determine the poacherDetected value based on the provided logic
                  $poacherDetected = match (true) {
                    $row['nameb'] != "" && $row2['label'] == "person" && $row['bluetooth'] != "0" => "No",
                    $row['nameb'] != "" && $row2['label'] != "person" && $row['bluetooth'] != "0" => "No",
                    $row['nameb'] == "" && $row2['label'] == "person" && $row['bluetooth'] != "0" => "Yes",
                    $row['nameb'] == "" && $row2['label'] != "person" && $row['bluetooth'] != "0" => "Yes",
                    $row['nameb'] == "" && $row2['label'] != "person" && $row['bluetooth'] == "0" => "-",
                    $row['nameb'] == "" && $row2['label'] == "person" && $row['bluetooth'] == "0" => "Yes",
                    default => ""
                  };

                  // Update the database if poacherDetected is set to 'Yes', 'No', or '-'
                  if ($poacherDetected != "") {
                    $updateSql = "UPDATE bluetooth SET poacherDetected = ? WHERE id = ?";
                    $stmt = $db->prepare($updateSql);
                    $stmt->bind_param("si", $poacherDetected, $row2['id']); // Assuming 'id' is the identifier in detection table
                    $stmt->execute();
                  }


                
                }

                // Table Row
                echo '<tr style="font-size:13px">';
                echo '<th scope="row">' . $row['date_time'] . '</th>';
                echo '<td>' . ($row2 ? "Motion Detected" : "-") . '</td>';
                echo '<td>' . ($row2 && trim($row2['label']) == "person" ? "Human Detected" : ($row2 ? "Motion Detected" : "-")) . '</td>';
                echo '<td>' . $row['bluetooth'] . '</td>';
                echo '<td>' . ($row['nameb'] ? ucwords($row['nameb']) : "-") . '</td>';
                echo '<td>' . $status . '</td>';
                echo '<td class="' . ($poacherDetected == "Yes" ? 'highlight-red' : '') . '">' . $poacherDetected . '</td>';
                echo '<td class="' . ($poacherDetected == "Yes" ? 'highlight-red' : '') . '">' . ($poacherDetected == "Yes" ? "Email Sent" : "-") . '</td>';
                echo '</tr>';

                $count++;
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- SUMMARY Accordion -->


      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center" style="color: #283728;">
    <!-- Your custom SVG -->
    <svg fill="#000000" height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
      viewBox="0 0 330 330" xml:space="preserve">
      <path id="XMLID_224_" d="M325.606,229.393l-150.004-150C172.79,76.58,168.974,75,164.996,75c-3.979,0-7.794,1.581-10.607,4.394
            l-149.996,150c-5.858,5.858-5.858,15.355,0,21.213c5.857,5.857,15.355,5.858,21.213,0l139.39-139.393l139.397,139.393
            C307.322,253.536,311.161,255,315,255c3.839,0,7.678-1.464,10.607-4.394C331.464,244.748,331.464,235.251,325.606,229.393z" />
    </svg>
  </a>



  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  
  <script type="text/javascript">
    // live stream
    function toggleLiveStream() {
      const toggleCheckbox = document.getElementById("livestream-toggle");
      const liveStreamContainer = document.getElementById("live_stream1");

      // Check the toggle switch state
      if (toggleCheckbox.checked) {
        // If the switch is checked, show the live stream
        liveStreamContainer.style.display = "block";

        document.getElementById("live_stream").innerHTML = `
      <iframe style="width:100%; height:250px; transform: rotate(-90deg) scale(0.90) scaleY(-1); transform-origin: center; margin-top: 30px;" 
              
              src="http://192.168.197.152:81/stream" 
              frameborder="1" 
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
              allowfullscreen></iframe>`;

        document.getElementById("live_stream1").innerHTML = `
      <iframe style="width:600px; height:650px; transform: rotate(180deg) scale(0.45) scaleX(-1) scaleY(-1); transform-origin: center; margin-left: -130px; margin-top: -160px; padding: 5px;" 
              
              src="http://192.168.254.147"  
              frameborder="1" 
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
              allowfullscreen></iframe>`;
      } else {
        // If the switch is unchecked, hide the live stream
        liveStreamContainer.style.display = "none";

        document.getElementById("live_stream").innerHTML = '';
        document.getElementById("live_stream1").innerHTML = '';
      }
    }
    // live stream
    
    // Search Bar
    function searchTable() {
      // Get the search input value and convert it to lowercase
      const input = document.getElementById('searchInput');
      const filter = input.value.toLowerCase();

      // Get the table body and all rows
      const tableBody = document.getElementById('tableBody');
      const rows = tableBody.getElementsByTagName('tr');

      // Loop through all rows and hide those that don't match the search query
      for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('th'); // Change to 'th' to check the timestamp
        let rowVisible = false;

        // Check the timestamp cell only (first cell)
        if (cells.length > 0) {
          const timestampText = cells[0].textContent || cells[0].innerText; // Only check the first cell for the timestamp
          if (timestampText.toLowerCase().indexOf(filter) > -1) {
            rowVisible = true; // If a match is found
          }
        }

        // Show or hide the row based on the match
        rows[i].style.display = rowVisible ? "" : "none"; // Show the row if visible, hide if not
      }
    }
    // Search Bar
  </script>


<!-- Realtime Update for Summary -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
  // Function to fetch and update the table
  function updateTable() {
    $.ajax({
      url: 'fetch_data_summary.php', // The PHP file to fetch data
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        // Clear the existing table content to avoid duplicates
        $('#tableBody').empty();

        // Iterate through the returned data and populate the table
        data.forEach(function(item) {
          // Determine the highlight class based on the poacher detection
          var highlightClass = item.poacher_detected === "Yes" ? "highlight-red" : "";

          // Create the table row
          var row = $('<tr style="font-size:13px" class="' + highlightClass + '">');
          row.append('<th scope="row">' + item.timestamp + '</th>');
          row.append('<td>' + item.pir_reading + '</td>');
          row.append('<td>' + item.object_detected + '</td>');
          row.append('<td>' + item.mac_address + '</td>');
          row.append('<td>' + item.name + '</td>');
          row.append('<td>' + item.status + '</td>');
          row.append('<td>' + item.poacher_detected + '</td>');
          row.append('<td>' + item.alert + '</td>');

          // Append the new row to the table
          $('#tableBody').append(row);
        });
      },
      error: function(xhr, status, error) {
        console.log('Error fetching data:', error);
      }
    });
  }

  // Set an interval to fetch data every (n) seconds
  setInterval(updateTable, 1000);

  // Initial table load
  updateTable();
</script>

<!-- Realtime Update for Summary -->


  <!-- Realtime Update for Alerts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script type="text/javascript">
    // Function to fetch and update the History of Alerts table
    function updateAlertsTable() {
      $.ajax({
        url: 'fetch_data_alerts.php', // The PHP file to fetch the alert data
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          // Clear the current table data
          $('#alertsTableBody').empty();

          // Iterate through the returned data and populate the table
          data.forEach(function(item) {
            var row = '<tr style="font-size:13px">';
            row += '<td>' + item.no + '</td>';
            row += '<td>' + item.type + '</td>';
            row += '<td>' + item.alert + '</td>';
            row += '<td>' + item.recipient + '</td>';
            row += '<td>' + item.timestamp + '</td>';
            row += '</tr>';

            // Append the new row to the table
            $('#alertsTableBody').prepend(row); // Using prepend() to add new rows at the top
          });
        },
        error: function(xhr, status, error) {
          console.log('Error fetching data:', error);
        }
      });
    }

    // Set an interval to fetch data every 5 seconds (5000 milliseconds)
    setInterval(updateAlertsTable, 1000);

    // Initial table load
    updateAlertsTable();
  </script>
  <!-- Realtime Update for Alerts -->

  <!-- Realtime Update for Images -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script type="text/javascript">
    // Function to fetch the latest image data and update the image
    function updateLastImage() {
      $.ajax({
        url: 'fetch_data_image.php', // The PHP file to fetch the latest image data
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          // Check if data contains the image URL and file name
          if (data.image_url && data.file_name) {
            // Update the image source and file name in the accordion
            var imageHtml = `
              <div style="position: relative; display: inline-block;">
                <img src="${data.image_url}" style="width: 65%; height: 100%; transform: rotate(90deg) scaleX(-0.7) scaleY(-1); margin-top: -10px;" />
                <div style="position: absolute; bottom: -20px; left: 50%; transform: translateX(-50%); font-weight: bold; font-size: 12.5px; color: #283728; background: #BFBFBF; padding: 5px 4.5px;">
                  ${data.file_name}
                </div>
              </div>
            `;

            // Insert the new image and file name into the container
            $('#lastImageContainer').html(imageHtml);
          }
        },
        error: function(xhr, status, error) {
          console.log('Error fetching data:', error);
        }
      });
    }

    // Set an interval to fetch and update the image every 5 seconds (5000 milliseconds)
    setInterval(updateLastImage, 5000);

    // Initial image load
    updateLastImage();
  </script>
  <!-- Realtime Update for Images -->
<!-- Add this to your index.php before </body> tag or in an external JS file -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
        // Function to check for poacher detection
        function checkPoacher() {
            $.ajax({
                url: 'check_poacher.php', // PHP file that checks for poacher detection
                type: 'GET',
                success: function(response) {
                    // Handle the response from the PHP script
                    console.log("Response from server: " + response); // Log the server response

                    if (response === 'email_sent') {
                        console.log('Email has been sent successfully.');
                    } else if (response === 'error') {
                        console.log('There was an error sending the email.');
                    } else if (response === 'no_action') {
                        console.log('No action needed.');
                    }
                },
                error: function(xhr, status, error) {
                    // Log any AJAX request errors
                    console.log("AJAX request failed: " + status + ", " + error);
                }
            });
        }

        // Set an interval to check for poacher detection every 5 seconds (5000ms)
        setInterval(checkPoacher, 2000);  // Trigger every 5 seconds
    });
  </script>


 
  </body>

  </html>