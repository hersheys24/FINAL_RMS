<?php
session_start(); // Start the session

$page_title = 'dashboard';
require_once 'config/connection.php';

$display_all = "SELECT * FROM equipments";
$query = mysqli_query($conn, $display_all);

$errors = array();

if (isset($_POST['submitButton'])){
    $name = $_POST['name'];
    $model = $_POST['model'];
    $serialNumber = $_POST['serialNumber'];
    $lastMaintenance = $_POST['last_maintenance_date'];
    $issues = $_POST['issues_encountered'];
    $checkf = $_POST['check_frequency'];

    // Validation if empty
    if (empty ($name)){
        $errors['name'] = "This is a required field.";
    }

    if(count($errors) == 0) {
        $insertQuery = "INSERT INTO Equipments(EName, Model, SerialNumber, LastMaintenance, Issues, DesiredCheck)
                        VALUES (?, ?, ?, ?, ?, ?)";

        // Prepare the query
        $stmt = $conn->prepare($insertQuery); 
        // Check if the query was prepared successfully
        if ($stmt) {
            $stmt->bind_param('ssssss', $name, $model, $serialNumber, $lastMaintenance,
            $issues, $checkf );
            
            if ($stmt->execute()) {
                // Set session variable
                $_SESSION['form_submitted'] = true;
                // Redirect to the same page after successful submission to prevent resubmission on page refresh
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            } else {
                $errors['db_error'] = "Failed to execute the query.";
            }
        } else {
            $errors['db_error'] = "Failed to prepare the query.";
        }
    } else {
        // Handle other form validation errors
    }
}
?>
<!-- Modal -->
<?php if (isset($_SESSION['form_submitted']) && $_SESSION['form_submitted']): ?>
<div id="myModal" class="modal" style="display: block;">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Equipment recorded successfully. Do you want to record another equipment?</p>
    <button onclick="location.href='SetupEquipments.php';">Yes</button>
    <button onclick="location.href='dashboard.php';">No</button>
  </div>
</div>
<?php 
// Reset session variable
$_SESSION['form_submitted'] = false;
endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Record Equipment</title>
</head>
<body>
<header>        
    <div class="logo"> 
        <img src="logo.png" alt="Lorskie Store Logo" width="72" height="90">
    </div>

    <div class="navigation">

            <h3>Lorskie Store</h3>
        </div>
        
</header>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&family=Jaldi&display=swap" rel="stylesheet');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Jaldi', sans-serif;
}

/* Set body background color to black */
body {
  background-color: #c9c9c9;
  color: #ffffff; /* Set text color to white */
  margin: 0;
  padding: 0;
}

/* Container styling */
.container {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
}

/* Form styling */
form {
  padding: 20px;                
  background-color: #1e1e1e;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  margin-top: 100px;
}

/* Form label styling */
label {
  display: block;
  margin-bottom: 5px;
  color: #ffffff;
}

/* Form input styling */
input[type="text"],
input[type="date"],
textarea {
  width: calc(100% - 16px);
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ffffff; /* White border */
  background-color: transparent; /* Transparent background */
  color: #ffffff; /* White text color */
}

select {
  width: calc(100% - 16px);
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ffffff;
  background-color: transparent;
  color: #ffffff;
}

/* Form input focus styling */
input[type="text"]:focus,
textarea:focus {
  outline: none;
  border-color: #FFA500; /* Orange border color on focus */
}

/* Form submit button styling */
input[type="submit"] {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #FFA500; /* Set button background color to orange */
  color: #000; /* Set button text color to black */
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-top: 10px;
  
}

/* Form submit button hover effect */
input[type="submit"]:hover {
  background-color: #FF8C00; /* Darken button background color on hover */
}

/* Setup Equipments radio buttons */
.radio-columns {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}

.radio-columns label {
  flex-basis: 50%;
  color: #ffffff;
}

/* Dark mode for radio buttons */
input[type="radio"] {
  display: none;
}

input[type="radio"] + label {
  display: inline-block;
  padding: 5px;
  padding-left: 10px;
  margin-bottom: 15px;
  margin-right: 15px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

input[type="radio"]:checked + label {
  background-color: #FFA500;
  color: #000;
}

/* Error message styling */
.error-message {
  color: #ff0000;
  margin-top: 5px;
}

/* Change the color of the calendar icon */
input[type="date"]::-webkit-calendar-picker-indicator {
  filter: invert(100%);
}

/* Modal */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(0, 0, 0, 0.5); /* Black with opacity */
}

/* Modal content */
.modal-content {
  background-color: #333; /* Dark background color */
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  color: #fff; /* Text color */
}

/* Close button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #fff; /* Hover color */
  text-decoration: none;
  cursor: pointer;
}


header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 10%;
  padding: 10px 50px;
  background: #1d1d1d;
  display: flex;
  justify-content: space-between;
  align-items: center;
  z-index: 99;
}

.navigation h3 {
  color: #fff;
}

  </style>

  <div class="container">
    <form action="SetupEquipments.php" method="POST">
      <h2>Record Equipments</h2><br>
      <p>Now, let's proceed by adding your equipment details</p><br>

      <!-- Display error messages if any -->
      <?php if (count($errors) > 0): ?>
      <div class="error-message">
        <?php foreach ($errors as $error): ?>
        <p><?php echo $error; ?></p>
        <?php endforeach; ?>    
      </div>
      <?php endif; ?>

      <!-- Equipment details inputs -->
      <label for="name">Name</label>
      <input type="text" id="type" name="name" required>

      <label for="model">Model</label>
      <input type="text" id="model" name="model" required>

      <label for="serial_number">Serial Number <h6>(if any, skip if there's none)</label>
      <input type="text" id="serial_number" name="serial_number" >

      <h2>Maintenance History</h2>
      <label for="last_maintenance_date">Date of last maintenance:</label>
      <input type="date" id="last_maintenance_date" name="last_maintenance_date">

      <label for="issues_encountered">Issues encountered <h6>(if any, skip if there's none)</h6></label>
      <textarea id="issues_encountered" name="issues_encountered" rows="4" cols="50"></textarea>

      <!-- Desired Check Frequency -->
      <h2>Desired Check Frequency</h2>
      <fieldset>
        <div class="radio-columns">
          <input type="radio" id="daily" name="check_frequency" value="daily">
          <label for="daily">Daily</label>

          <input type="radio" id="weekly" name="check_frequency" value="weekly">
          <label for="weekly">Weekly</label>

          <input type="radio" id="monthly" name="check_frequency" value="monthly">
          <label for="monthly">Monthly</label>

          <input type="radio" id="quarterly" name="check_frequency" value="quarterly">
          <label for="quarterly">Quarterly</label>

          <input type="radio" id="annually" name="check_frequency" value="annually">
          <label for="annually">Annually</label>
        </div>
      </fieldset>

      <!-- Submit button -->
      <input type="submit" name="submitButton" value="Submit">
    </form>
  </div>

  <!-- Modal -->
  <?php if (isset($_SESSION['form_submitted']) && $_SESSION['form_submitted']): ?>
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>Equipment recorded successfully. Do you want to record another equipment?</p>
      <button onclick="location.href='SetupEquipments.php';">Yes</button>
      <button onclick="document.getElementById('myModal').style.display = 'none';">No</button>
    </div>
  </div>
  <?php 
  // Reset session variable
  $_SESSION['form_submitted'] = false;
  endif; ?>

  <script>
   var modal = document.getElementById('myModal');

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
}
  </script>
</body>
</html>
