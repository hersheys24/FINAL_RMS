<?php
$page_title = 'dashboard';
include('includes/header.html');
require_once 'config/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="dashboardstyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <title>Admin Dashboard</title>
</head>
<body>


  <header>        
    <div class="logo"> 
        <img src="logo.png" alt="Lorskie Store Logo" width="72" height="90">
    </div>

</header>

<style>

body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      padding-bottom: 10px;
      background-color: #ffffff;
      position: fixed;
    }

    .container {
      display: flex;
      justify-content: space-between;

    }

    .sidebar {
      flex: 0 0 200px;
      background-color: #313131;
     height: 47em;

      
    }

    .sidebar button {
      display: block;
      width: 70%;
      padding: 10px;
      padding-top: 10px;
      margin-bottom: 20px;
      margin-left: 29px;
      margin-top: 35px;
      border: none;
      background:#555;
      border-radius: 8px;
      color: #000000;
      font-size: 14px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .sidebar button:hover {
      background-color: #ffc400;
      size: 30px;
    }

    .content {
      flex: 1;
      background-color: #f0efef;
      padding: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      padding-left: 20px;
    }

    .content h2 {
      font-size: 24px;
      margin-bottom: 20px;
      padding-left: 20px;
    }

    .revenue-container {
      display: flex;
      gap: 20px;
      padding-right: 20px;
      padding-left: 15px;
      margin-bottom: 20px;
    }

    .revenue-card {
      flex: 1;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      
    }

    .orderList{
      flex: 1;
      background-color: #f9f9f9;
      padding: 20px;
      margin-left: 15px;
      margin-right: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .performanceTrack{
      flex: 1;
      background-color: #f9f9f9;
      padding: 15px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding-right: 20px;
      margin-right: 20px;
      margin-left: 15px;
    }

    .revenue-card h3 {
      margin-bottom: 10px;
      color: #333;
      padding-right: 20px;
    }

    .revenue-amount {
      font-size: 20px;
      font-weight: bold;
      color: #555;
    }

    .orders {
      font-size: 20px;
      font-weight: bold;
      color: #555;
    }

    .sales {
      font-size: 20px;
      font-weight: bold;
      color: #555;
    }

    ul#ordersList {
      list-style-type: none;
      padding: 0;
    }


    header {
      position:relative;
      top: 0;
      left: 0;
      width: 89em;
      height: 10%;
      padding: 0px 30px;
      background: #1d1d1d;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 99;
  }

  .logo {
    padding-left: 20px;
  }



/* CSS for Dropdown Menu */
.dropbtn {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 10px;
  margin-bottom: 20px;
  margin-left: 29px;
  margin-top: 55px;
  border: none;
  background: #555;
  border-radius: 8px;
  color: #ffffff;
  font-size: 14px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  position: relative;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}


  ion-icon {
    font-size: 40px;
    color: #fff;
  }



  .button .icon {
    color:#000000;
    font-size: 10px;
  }


    </style>



<div class="container">
   
<div class="sidebar">

        <button onclick="location.href= 'dashboard.php'">
        <span class="icon">
        <ion-icon name="home" width="20" height="20"></ion-icon>
        </span>    
    </button>

        <button onclick="location.href='DisplayMaterials.php'">
        <span class="icon"> 
        <ion-icon name="cube"></ion-icon>
        </span>
    </button>
        
        <button onclick="location.href= 'task.php'">
        <span class="icon"> 
        <ion-icon name="clipboard"></ion-icon>
        </span>
    </button>
        <button onclick="location.href= 'add_order.php'">
        <span class="icon"> 
        <ion-icon name="cart"></ion-icon>
        </span>
    
    </button>
        <button onclick="location.href= 'reports.php'">
        <span class="icon"> 
        <ion-icon name="newspaper"></ion-icon>
        </span>
    </button>

  
    <button class="dropbtn" onclick="toggleDropdown()">
            <span class="icon">
                <ion-icon name="person-circle-outline" width="90" height="90"></ion-icon>
            </span>
        </button>

<div class="dropdown-content" id="dropdownContent">
            <a href="StaffRegister.php">Register Staff</a>
            <a href="index.php">Logout</a>
        </div>
    </div>
    
    <div class="content">
        <!-- Admin Dashboard -->
        <h2>Dashboard</h2>
        <div class="revenue-container">
            <div class="revenue-card">
                <h3>Current Revenue</h3>
                <p id="current-revenue" class="revenue-amount">Loading..</p>
            </div>

            <div class="revenue-card">
                <h3>Pending Revenue</h3>
                <p id="pending-revenue" class="revenue-amount">Loading..</p>
            </div>
        </div>

        <!-- Pending Orders Page -->
        <h2>Ongoing Orders</h2>
        <ul id="ordersList"></ul>
        <div class="orderList">
            <h3>Details</h3>
            <p id="getOrder" class="orders">Loading..</p>
        </div>

        <!-- Sales   Page -->
        <h2>Sales Performance</h2>
        <ul id="salesPerformance"></ul>
        <div class="performanceTrack">
            <h3>Details</h3>
            <p id="getSales" class="sales">Loading..</p>
        </div>
    </div>
</div>

<?php include('includes/footer.html'); ?>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

   

</body>
</html>
