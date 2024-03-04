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
    height: 520px;
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
