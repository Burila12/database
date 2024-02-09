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

    $query = "SELECT * FROM items WHERE id = $id";
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
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $author = mysqli_real_escape_string($con, $_POST['author']);
    $genre = mysqli_real_escape_string($con, $_POST['genre']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $qty = mysqli_real_escape_string($con, $_POST['qty']);

    $query = "UPDATE items SET title = '$title', author = '$author', genre = '$genre', price = '$price', type = '$type' , qty = '$qty ' WHERE id = $id";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Update was successful
    } else {
        echo "Update failed: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Update item</title>
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
    </style>
</head>
<body>
    <div class="update-form">
        <form method="post" action="update1.php">
            <?php if (isset($row)) { ?>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                
                <label for="title">Title:</label>
                <input type="text" name="title" value="<?php echo $row['title']; ?>"required>

                <label for="author">Author:</label>
                <input type="text" name="author" value="<?php echo $row['author']; ?>"required>

                <label for="genre">Genre:</label>
                <input type="text" name="genre" value="<?php echo $row['genre']; ?>"required>

                <label for="price">Price:</label>
                <input type="number" name="price" value="<?php echo $row['price']; ?>"required>

                <label for="type">Type:</label>
                <input type="text" name="type" value="<?php echo $row['type']; ?>"required>
                
                <label for="qty">Qty:</label>
                <input type="number" name="qty" value="<?php echo $row['qty']; ?>"required>

                <button type="submit" name="submit">Update</button>
            <?php } else { 
                header("Location: item.php");
            } ?>
        </form>
    </div>
</body>
</html>