<?php
$page_title = 'Edit Orders';
require_once 'config/connection.php';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&family=Jaldi&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Jaldi', sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: #ededee;
            padding-top: 80px; /* Adjusted padding */
            position: relative; /* Added relative positioning */
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


        header .navigation h3 {
            color: #fff;
        }

        .heading-container {
            text-align: center;
            margin: 20px 0; /* Adjusted shorthand */
        }

        table {
    width: 100%; /* Adjusted width */
    margin: 0 auto; /* Centered the table horizontally */
    table-layout: fixed; /* Fixed layout */
    border-collapse: collapse; /* Collapse the borders */
}

th, td {
    padding: 10px 15px; /* Adjusted padding */
    text-align: left;
    color: white;
    background-color: #1d1d1d;
    overflow: hidden; /* Hidden overflow */
    white-space: nowrap; /* Prevents wrapping */
    text-overflow: ellipsis; /* Ellipsis for overflow */
    border: none; /* Removed border */
}


        th {
            background: hsl(49, 100%, 49%);
            font-weight: bold;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        a {
            color: rgb(255, 255, 255); /* Default color */
        }

        a:hover {
            color: rgb(255, 166, 0); /* Color when hovered over */
        }

        button {
            padding: 10px 30px; /* Adjusted padding */
            background-color: #1d1d1d; /* Background color */
            color: rgb(255, 255, 255); /* Text color */
            border: none; /* Removed border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Cursor style on hover */
            display: block; /* Change display to block */
            margin: 20px auto; /* Center the button horizontally */
        }

        button:hover {
            background: hsl(49, 100%, 49%);
        }

        h2 {
            text-align: center;
            margin: 28px 0; /* Adjusted shorthand */
        }

        /* Add a scrollbar for the table */
        table {
            overflow-y: auto;
            max-height: calc(100vh - 160px); /* Adjusted height */
        }
    </style>
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

    <table border="1">
        <h2>Manage Inventory</h2>
        <button onclick="window.location.href='AddMaterial.php'">Add Material</button>
        <tr>
            <th>#</th>
            <th>Material Name</th>
            <th>Stock</th>
            <th>Description</th>
            <th>Supplier</th>
            <th>Cost</th>
            <th>Actions</th>
        </tr>
        <?php
        // Fetch inventory data
        $sql = "SELECT * FROM Materials"; // Adjust table name accordingly
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["MaterialID"] . "</td>";
                echo "<td>" . $row["MaterialName"] . "</td>";
                echo "<td>" . $row["Stock"] . "</td>";
                echo "<td>" . $row["Description"] . "</td>";
                echo "<td>" . $row["SupplierName"] . "</td>";
                echo "<td>" . $row["Cost"] . "</td>";
                echo "<td><a href='EditMaterial.php?id=" . $row["MaterialID"] . "'>Edit</a> | <a href='DeleteMaterial.php?id=" .
                    $row["MaterialID"] . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No materials found</td></tr>";
        }
        ?>
    </table>

    <?php
    // Close database connection
    $conn->close();
    ?>
</body>
</html>