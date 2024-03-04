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

<style>
    
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&family=Jaldi&display=swap" rel="stylesheet');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Jaldi', sans-serif;
}


body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #ededee;

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


h1 {
    position: absolute;
    margin-bottom: 10em;
}


.wrapper {
    position: relative;
    margin-top: 100px;
    width: 400px;
    height: 500px;
    padding-bottom: 20px;
    background: transparent;
    background-color:#1d1d1d;
    border: 2px solid 191818;
    border-radius: 20px;
    backdrop-filter: blur(20px);
    box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    /* overflow: ; */
    transition: height .2s ease;
}

.wrapper .form-box {
    width: 100%;
    padding: 40px;
    
}


.input-box {
    position: relative;
    width: 100%;
    height: 50px;
    border-bottom: 2px solid #fff;
    margin: 30px 0;
    
}


.input-box label {
    position: absolute;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    font-size: 1em;
    color: rgb(90, 90, 90); 
    font-weight: 500;
    pointer-events: none;   
}

.input-box textarea {
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1em;
    font-weight: 600;
    padding: 0 35px 0 5px;
    color: #fff;
    resize: none; 
}



.input-box input {
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1em;
    font-weight: 600;
    padding: 0 35px 0 5px;
    color: #fff;
}


.btn {
    width: 100%;
    height: 45px;
    background: hsl(49, 100%, 49%);
    border: none;
    border-radius: 20px;
    cursor: pointer;
    font-size: 1em;
    font-weight: 500;
}



.input-box input[type="number"]::-webkit-inner-spin-button,
.input-box input[type="number"]::-webkit-outer-spin-button {
    width: 20em; /* Adjust the height as needed */
}


.input-box input[type="number"] {
    width: 350px; /* Set the desired width */
}

    </style>


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
