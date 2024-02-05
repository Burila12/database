<?php
session_start();
if(isset($_SESSION['login'])){
    header("location:customer.php");
	exit;
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>HOME</title>
    <style>
        body {
            background-color: #f0f0f0;
            background-image: url('bbook.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            margin: 0;
        }

        header {
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        #box {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            margin: 50px auto;
            width: 300px;
            height: 450px;
            border-radius: 10px;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .form-header {
            font-size: 20px;
            margin: 10px;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .form-subheader {
            font-size: 20px;
            margin: 10px;
            color: white;
        }

        #text {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        #button {
            background-color: #0d1b2a;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #button:hover {
            background-color: #005f89;
        }

        .error-box {
            color: red;
            text-align: center;
            width: 200px;
            padding: 2px;
        }

        .form-message {
            text-align: center;
            width: 200px;
            padding: 10px;
            margin: 10px auto;
            border-radius: 5px;
        }

        .success-message {
            color: white;
            background: rgba(0, 255, 0, 0.3);
        }

        .error-message {
            color: red;
            background: rgba(255, 0, 0, 0.3);
        }

        footer {
            background-color: transparent;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .container {
      display: flex;
      align-items: center;
      margin-left: 20px; 
    }
    
    </style>
</head>
<body>
    <header>
        <img src="book.png" alt="Logo">
        <a href="landing.php" style="color: grey;"><b>BOOK</b></a>
    </header>
    <br><br><br><br>
    <div id="box">   
        <form method="post">
            <div class="form-header"><b>CUSTOMER</b></div>
            <div class="form-subheader">Login</div>
            <input id="text" type="email" name="user_name" placeholder="Email" ><br><br>
         
            <input id="text" type="password" name="password" placeholder="Password"><br><br>

            <input id="button" type="submit" value="Login"><br><br>          
            <?php 
                include("connection.php");

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $email = $_POST['user_name'];
                    $password = $_POST['password'];

                    if (!empty($email) && !empty($password)) {
                        $query = "SELECT * FROM customers WHERE email = '$email' LIMIT 1";
                        $result = mysqli_query($con, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $user_data = mysqli_fetch_assoc($result);
                            if ($user_data['password'] === $password) {
                                $_SESSION['user_id'] = $user_data['id'];
                                $_SESSION["login"] = true;
                                header("Location: customer.php");
                                die;
                            }
                        }
                        echo '<div class="error-box">Wrong username or password!</div>';
                    } else {
                        echo '<div class="error-box">Enter username or password!</div>';
                    }
                }
            ?>
        </form>
        <p style="color: white; text-align: center;">Don't have an account? <a href="create.php">Register here</a></p>
    </div>
    
    <footer>
        <p>&copy; 2023 </p>
    </footer>
</body>
</html>
