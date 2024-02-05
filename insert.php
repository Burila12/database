<?php
session_start();
if(! isset($_SESSION['log_in'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<header>
        
        <img src="book.png" alt="Logo">	
        <a href="index.php">GO_BACK</a>
</header>   
    <title>Add Customer</title>
    <style>
        a {
         color: white;
         align-items: left;
        text-decoration: none;
         margin: 0 20px;
        }
        header {
            background-color: #0d1b2a;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 10px 20px;

        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #0d1b2a;
        }

        .insert-form {
            background-color: #0d1b2a;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .insert-form label, .insert-form input {
            display: block;
            margin-bottom: 10px;
            color: skyblue;
        }

        .insert-form button {
            background-color: skyblue;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="insert-form">
        <form method="post" action="insert.php">
            <label for="name">Name:</label>
            <input type="text" name="name"required>
            <label for="email">Email:</label>
            <input type="email" name="email"required>
            <label for="address">Address:</label>
            <input type="text" name="address"required>
            <button type="submit" name="submit">Insert</button>
        </form>
    </div>
</body>
</html>
<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    $query = "INSERT INTO customers (name, email , address) VALUES ('$name', '$email', '$address')";
    $result = mysqli_query($con, $query);
    if ($result) {
        header('location:index.php');  
    } else {
        echo "Insert failed: " . mysqli_error($con);
    }
}
?>