<?php
require_once 'config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $materialID = $_GET['id'];
    
    // Fetch material details
    $sql = "SELECT * FROM Materials WHERE MaterialID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $materialID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $materialName = $row["MaterialName"];
        $stock = $row["Stock"];
        $description = $row["Description"];
        $cost = $row["Cost"];
        $supplierName = $row["SupplierName"];
    } else {
        echo "Material not found";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to update material details
    // Retrieve updated form data
    $materialID = $_POST['materialID'];
    $materialName = $_POST['materialName'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $supplierName = $_POST['supplierName'];

    // Update material in database
    $sql = "UPDATE Materials SET MaterialName=?, Stock=?, Description=?, Cost=?, SupplierName=? WHERE MaterialID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sisisi', $materialName, $stock, $description, $cost, $supplierName, $materialID);

    if ($stmt->execute()) {
        echo "<script>alert('Material updated successfully');</script>";
        echo "<script>setTimeout(function(){ window.location.href = 'DisplayMaterials.php'; }, 1000);</script>";
        // Redirect back to inventory table
        exit;
    } else {
        echo "Error updating material: " . $conn->error;
    }
}

// Close prepared statement
$stmt->close();
// Close database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Material</title>
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

    <h1>Edit Material</h1>


    <div class="wrapper">
        <div class="form-box register">

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <input type="hidden" name="materialID" value="<?php echo $materialID; ?>">


        <div class="input-box">            
            <input type="text" name="materialName" value="<?php echo $materialName ?? ''; ?>" required placeholder="Material Name"><br>
        </div>

        <div class="input-box">            
            <input type="number" name="stock" id="stock" value="<?php echo $stock ?? ''; ?>" required placeholder="Stock"><br>
        </div>

        <div class="input-box">
            <textarea textarea id="description" name="description" required placeholder="Description"> <?php echo $description ?? ''; ?> </textarea><br>
        </div>

        <div class="input-box">            
            <input type="text" name="supplierName" id="supplierName" value="<?php echo $supplierName ?? ''; ?>" required placeholder="Supplier Name"><br><br>
        </div>

        <div class="input-box">            
        <input type="number" id="cost" name="cost" step="0.01" value="<?php echo $cost ?? ''; ?>" required placeholder="Cost"><br><br>       
        </div>

            <button type="submit" name="submit" class="btn">Update Material</button>

        </form>

        </div>
    </div>

    </form>
</body>
</html>
