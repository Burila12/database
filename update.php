<?php
session_start();
if(! isset($_SESSION['log_in'])){
    header("location:login.php");
}
?>
<?php
include 'connection.php';


if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM customers WHERE id = $id";
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "item not found or missing data.";
    }
} else {
    echo "No ID provided for update.";
}

if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    if (empty($name) || empty($email) || empty($address)) {
        echo "Please fill in all required fields.";
    } else {
        $query = "UPDATE customers SET name = '$name', email = '$email', address = '$address' WHERE id = $id";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "Update was successful.";
        } else {
            echo "Please fill in all required fields." . mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Update Customer</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #0d1b2a;
        }

        .update-form {
            background-color: #003049;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .update-form label, .update-form input {
            display: block;
            margin-bottom: 10px;
        }

        .update-form button {
            background-color: #0d1b2a;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .update-form button:hover {
            background-color: #005f89;
        }
        .error-message {
            color: red;
            text-align: center;
            width: 200px;
            padding: 2px;

        }
    </style>
</head>
<body>
    <div class="update-form">
        <form method="post" action="update.php">
        <?php if (isset($row)) { ?>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>"required>
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>"required>
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>"required>
                <label for="address">Address:</label>
                <input type="text" name="address" value="<?php echo $row['address']; ?>"required>
                <button type="submit" name="submit">Update</button>
                <?php } else { 
                header("Location: index.php");
            } ?>
        </form>
    </div>
</body>
</html>