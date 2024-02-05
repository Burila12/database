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
    <title>Register</title>
</head>
<body>
    <header>
    <img src="book.png" alt="Logo">
    <a href="landing.html" style="color: grey;"><b>BOOK</b></a>
    </header>
    <br><br><br><br>
    <div id="box">
        <form method="post">
            <div style="font-size: 20px; margin: 10px; padding: 20px; color: white; text-align: center;"><b>CUSTOMER</b></div>
            <div style="font-size: 20px; margin: 10px; color: white;">Register</div>

            <input id="text" type="text" name="name" placeholder="Name" required><br><br>
            <input id="text" type="email" name="email" placeholder="Email" required><br><br>
            <input id="text" type="text" name="address" placeholder="Address" required><br><br>
            <input id="text" type="password" name="password" placeholder="Password" required><br><br>

            <input id="button" type="submit" value="Register"><br><br>

<?php
include("connection.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    if (!empty($name) && !empty($email) && !empty($address) && !empty($password)) {
        $checkQuery = "SELECT * FROM customers WHERE email = '$email'";
        $checkResult = mysqli_query($con, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $message = "Email already exists. Please use a different email.";
            $class = "error-message";
        } else {
            $insertQuery = "INSERT INTO customers (name, email, address, password) VALUES ('$name', '$email', '$address', '$password')";
            $insertResult = mysqli_query($con, $insertQuery);

            if ($insertResult) {
                $message = "Registration successful!";
                $class = "success-message";
            } else {
                $message = "Error in registration. Please try again.";
                $class = "error-message";
            }
        }
    } else {
        $message = "All fields are required!";
        $class = "error-message";
    }
}
?>
<?php
        if (isset($message)) {
            echo "<div class='form-message $class'><strong>$message</strong></div>";
        }
?>


</form>
    <p style="color: white; text-align: center;">Already have an account? <a href="clogin.php">Login here</a></p>
</div>
</body>
<footer>
        <p>&copy; 2023 </p>
</footer>
<style>
footer {
    background-color: transparent;
    color: #fff;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
}

 body {
     background-color: #f0f0f0; 
        
     background-image: url('bbook.png'); 
     background-repeat: no-repeat; 
     background-size: cover; 
     background-position: center; 
 }
 #box {
    background: rgba(0, 0, 0, 0.7);
    padding: 20px;
    margin: 50px auto;
    width: 300px;
    height: 520px;
    border-radius: 10px;
    box-sizing: border-box;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.form-message {
    text-align: center;
    width: 200px;
    padding: 10px;
    margin: 10px auto;
    border-radius: 5px;
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

.success-message {
    color: white;
    background: rgba(0, 255, 0, 0.3); /* Green with low alpha for transparency */
}

.error-message {
    color: red;
    background: rgba(255, 0, 0, 0.3); /* Red with low alpha for transparency */
}
header {
    background-color: black;
    color: #fff;
    display: flex;
    align-items: center;
    padding: 10px 20px;
}

</style>
</html>