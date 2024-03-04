<?php
// Ensure that form fields are set and not empty
if (isset($_POST['materialName']) && isset($_POST['stock']) && isset($_POST['description']) && isset($_POST['supplierName']) && isset($_POST['cost'])) {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "RMS_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to add material
    function addMaterial($conn, $materialName, $stock, $description, $supplierName, $cost) {
        $materialName = mysqli_real_escape_string($conn, $materialName);
        $description = mysqli_real_escape_string($conn, $description);
        $supplierName = mysqli_real_escape_string($conn, $supplierName);

        $sql = "INSERT INTO Materials (MaterialName, Stock, Description, SupplierName, Cost) VALUES ('$materialName', $stock, '$description', '$supplierName', $cost)";

        if ($conn->query($sql) === TRUE) {
            return "Material added successfully";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Call the addMaterial function
    $result = addMaterial($conn, $_POST['materialName'], $_POST['stock'], $_POST['description'], $_POST['supplierName'], $_POST['cost']);

    echo "<script>alert('$result');</script>"; // Display result

    // Close database connection
    $conn->close();
    header('Location: DisplayMaterials.php'); // Redirect back to inventory table
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Material</title>
    <link rel="stylesheet" href="addedit.css">
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

    <h1>Add Material</h1>
    <div class="wrapper">
        <div class="form-box register">

            <form method="post">

        <div class="input-box">            
            <input type="text" name="materialName" id="materialName" required placeholder="Material Name">
        </div>

        <div class="input-box">            
            <input type="number" name="stock" id="stock" required placeholder="Stock">
        </div>

        <div class="input-box">
            <textarea textarea id="description" name="description" required placeholder="Description"></textarea>
        </div>

        <div class="input-box">            
            <input type="text" name="supplierName" id="supplierName" required placeholder="Supplier Name">
        </div>

        <div class="input-box">            
            <input type="number" name="cost" id="cost" step="0.01" required placeholder="Cost"><br><br>
        </div>

            <button type="submit" name="submit" class="btn">Add Material</button>

        </form>

        </div>
    </div>
</body>
</html>
