
<?php 
   session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Retail Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>        
        <div class="logo"> 
            <img src="logo.png" alt="Lorskie Store Logo" width="72" height="90">
        </div>
        <div class="store-name">
            <!-- <h2>Lorskie Store</h2> -->
        </div>
        <nav class="navigation">
            <h3>Lorskie Store</h3>
        </nav>
    </header>

    <div class="wrapper">
        
    <!--LOGIN-->
        <div class="form-box login">
            <?php

                include("config/connection.php");
                if(isset($_POST['submit'])) {
                    $email = mysqli_real_escape_string($conn,$_POST['email']);
                    $password = mysqli_real_escape_string($conn,$_POST['password']);

                    $result = mysqli_query($conn, "SELECT * FROM StaffRegister WHERE Email='$email' AND Password='$password' ") or die("select error");
                    $row = mysqli_fetch_assoc($result);

                    if(is_array($row) && !empty($row)) {
                        $_SESSION['valid'] = $row['Email'];
                        $_SESSION['FName'] = $row['FName'];
                        $_SESSION['LName'] = $row['LName'];
                        $_SESSION['Password'] = $row['Password'];
                        $_SESSION['StaffID'] = $row['StaffID'];
                        header("Location: dashboard.php");
                        exit;
                    } else {
                        echo "<div class='message'>
                              <p>Wrong Username or Password</p>
                          </div> <br>";
                        echo "<a href='index.php'><button class='btn'>Go Back</button>";
                    }
                }

            ?>
            <p>Login</p>
            <form action="dashboard.php" method="post">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon></ion-icon> 
                    </span>
                    <input type="email" name="email" id="email" required placeholder="Email">
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed">
                        </ion-icon></ion-icon> 
                    </span>
                    <input type="password" name="password" id="password" required placeholder="Password">
                </div>
                <div class="field input">
                    <button type="submit" name="submit" class="btn">Login</button>
                </div>
                <div class="login-register">
                    <p>Not yet registered?<a href="AdminRegister.php"> Register now!</a></p>
                </div>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
