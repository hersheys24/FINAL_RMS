  <?php
      require_once 'config/connection.php';

      
            if(isset($_POST['submit'])) {
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $pcont =$_POST['pcont'];
                $role = 'Admin' ;
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


                $_SESSION['email'] = $_POST['email']; //passes entered email to $_SESSION


                // Prepare and bind parameters
                $stmt = $conn->prepare("INSERT INTO PersonnelRegister (FName, LName, PContact, Role, Email, Password) VALUES (?, ?,?,?, ?, ?)");
                $stmt->bind_param("ssssss", $fname, $lname,$pcont,$role, $email, $password);
               
                    if ($stmt->execute()) {
                        session_start();
			            $_SESSION['PId'] = mysqli_insert_id($conn);
			            header('location:SetupEquipments.php');
			            exit();
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

            else {
            ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Retail Management System</title>
</head>
<body>
    <header>        
        <div class="logo"> 
            <img src="logo.png" alt="Lorskie Store Logo" width="72" height="90">
        </div>
        <h4 style="color: white;"> 
		Welcome to Lorskie Store's Retail's Management System! To begin setup, please log in as the administrator. </h4>
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


.wrapper {
    position: relative;
    margin-top: 100px;
    width: 400px;
    height: 520px;
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

.wrapper .form-box.login {
    display: none;
    
}



.wrapper p {
    color: #fff;
    text-align: center;
    font-family: 'Jaldi', sans-serif;
    
}

.input-box {
    position: relative;
    width: 100%;
    height: 50px;
    border-bottom: 2px solid #fff;
    margin: 30px 0;
    
}

/*for email and password label**/
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


/*for email and password box**/
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

/*for icons**/
.input-box .icon {
    position: absolute;
    right: 8px;
    font-size: 1.2em;
    color: rgb(141, 133, 133);
    line-height: 57px;
}


.remember-forgot {
    font-size: 1em;
    color: #fff;
    font-weight: 500;
    margin: -15px 0 15px;
    display: flex;
    justify-content: space-between;    
}

.remember-forgot label input {
    accent-color: #ffffff;
    margin-right: 3px;
}

.remember-forgot a {
    color: #fff;
    text-decoration: none;
}

.remember-forgot a:hover {
    text-decoration: underline;
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

.login-register {
    font-size: .9em;
    color: #fff;
    text-align: center;
    font-weight: 500;
    margin: 20px 0 10px;
}

.login-register p a {
    color: #fff;
    text-decoration: none;
    
}

.login-register p a:hover {
    text-decoration: underline;
}
        </style>
   	<div>
  
   	</div>
    <div class="wrapper">
        <div class="form-box register">
            
          
            
            <form action="" method="post">

                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" name="fname" id="fname" required placeholder="First Name">
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="lname" id="lname" required placeholder="Last Name">
                </div>

                  <div class="input-box">
                    <span class="icon"><ion-icon name="call"></ion-icon></span>
                    <input type="text" name="pcont" id="pcont" required placeholder="Contact">
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" id="email" required placeholder="Email">
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" id="password" required placeholder="Password">
                </div>

                <button type="submit" name="submit" class="btn">Register as Administrator</button>

                <div class="login-register">
                    <!-- <p>Already have an account?<a href="index.php"> Login </a></p> -->
                </div>
            </form>
        </div>

        <?php }?>
            
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>


