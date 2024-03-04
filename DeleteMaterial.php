<?php
session_start();
require_once 'config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $materialID = $_GET['id'];
    
    if (isset($_GET['confirm'])) {
        // Delete material from the database
        $sql = "DELETE FROM Materials WHERE MaterialID = $materialID";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Material deleted successfully');</script>";
            echo "<script>window.location.href = 'DisplayMaterials.php';</script>";
            exit();
        } else {
            echo "Error deleting material: " . $conn->error;
        }
    } else {
        // Show confirmation message using JavaScript
        echo "<script>
                if (confirm('Are you sure you want to delete this material?')) {
                    window.location.href = 'DeleteMaterial.php?id=$materialID&confirm=yes';
                } else {
                    window.location.href = 'DisplayMaterials.php';
                }
              </script>";
    }
}

// Close database connection
$conn->close();
?>






