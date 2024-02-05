<?php
session_start();
if(isset($_SESSION['log_in'])){
    header("location:index.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
	<title>HOME</title>
</head>
<body>
<header>
        <img src="book.png" alt="Logo">	
        <a href="login.php">BOOK</a>
    </header>
    <br><br>
    <br><br>    
<div id="box">
		
		<form method="post">
            <div style="font-size: 20px;margin: 10px; padding: 20px;color: white;text-align: center;"><b>ADMIN</b></div>
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="user_name"><br><br>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>            
<?php 
	include("connect.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from user where username = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $id;
						$_SESSION["log_in"] = true;
						header("Location: index.php");
						die;
					}
				}
			}
            echo"<strong>";
            echo '<div id="box" style="color: red; text-align: center; width:200px; padding: 2px;"><strong>Wrong username or password!</strong></div>';
            echo"<strong>";
		}else
		{

            echo"<strong>"; 
			echo '<div  id="box" style="color: red; text-align: center;width:200px; padding: 2px;"><strong>Enter username or password!</strong></div>';
            echo"<strong>"; 
		}
	}
?>
		</form>
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
}</style>
</html>