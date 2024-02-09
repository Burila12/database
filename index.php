<?php
session_start();
if(! isset($_SESSION['log_in'])){
    header("location:login.php");
}
?>

<?php   
 include 'connection.php';  
 $query = "select * from customers";  
 $run = mysqli_query($con,$query);  
 ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
	<title>Login</title>
</head>
<body>
<header>
        <img src="book.png" alt="Logo">
        <a href="logout.php">logout</a>
</header>
<br>
<br>         
<div style="text-align: center;">
    <form method="post" action="" style="display: inline-block;">
        <input type="text" name="search" placeholder="Search by Name or Email" style="padding: 2px; border: 2px solid #ccc; border-radius: 5px;">
        <input type="submit" name="submit" value="Search" style="background-color: #3498db; color: #fff; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer;">
    </form>
</div>   

<?php
//seach
    include 'connection.php';
    if (isset($_POST['submit'])) {
        $search = mysqli_real_escape_string($con, $_POST['search']);
        $query = "SELECT * FROM customers WHERE name LIKE '%$search%' OR email LIKE '%$search%'";            
    } else {
        $query = "SELECT * FROM customers";
    }
        $run = mysqli_query($con, $query);
        if (mysqli_num_rows($run) > 0){}
        else{echo '<div style="color: red; text-align: center;">No data found.</div>';}
    ?> 

    <br><br>
    <br><br>


    <a href="insert.php" class="insert-button">Add Customer</a>
    <a href="item.php"class="insert-button">item</a>
    <br><br>
    <br><br>
   <script>
    //VALIDATION YES OR NO
    function confirmAction(customerId, action) {
    var actionText = action === "delete" ? "delete this item" : "update this item";
    if (confirm("Are you sure you want to " + actionText + "?")) {
        if (action === "delete") {
            window.location = "delete.php?id=" + customerId + "&table=customers";
        } else if (action === "update") {
            window.location = "update.php?id=" + customerId;
        }
    } else {
       
    }
}
</script> 

 <table border="1" cellspacing="0" cellpadding="0">  
      <tr class="heading">  
           <th>ID</th>  
           <th>Name</th>  
           <th>Email</th>  
           <th>Address</th>  
           <th>Operation</th>  
      </tr>  
<?php   
           if ($num = mysqli_num_rows($run)>0) {  
                while ($result = mysqli_fetch_assoc($run)) {  
                     echo "  
                          <tr class='data'>   
                               <td>".$result['id']."</td>  
                               <td>".$result['name']."</td>  
                               <td>".$result['email']."</td>  
                               <td>".$result['address']."</td>  
                               <td>
                               <a href='#" . $result['id'] . "' onclick='confirmAction(" . $result['id'] . ", \"delete\")' id='btn'>Detele</a>
                               <a href='#" . $result['id'] . "' onclick='confirmAction(" . $result['id'] . ", \"update\")' id='btn'>Update</a></td>  
                          </tr>  
                     ";  
                }  
           }  
      ?>  
 </table>  
     
<br><br>
<br><br>
</body>
</html>
<style>
* body {
    width: 100%;
    height: 100vh;
    background-color: wheat;
    font-family: 'verdana', sans-serif;
    margin: 0; 
}

header {
    width: 100%;
    height: 80px;
    background-color: #8a817c;
}

table {

    width: 80%;
    max-height: 70vh;
    overflow-y: auto;
    margin: 0 auto; 
    position: relative;
    top: 0; 
    left: 0; 
    transform: none; 
}

.heading {
    background-color: #6c757d;
}

.heading th {
    padding: 10px 0;
}

.data {
    text-align: center;
    color: black;
}

.data td {
    padding: 10px 0;
}

#btn {
    text-decoration: none;
    color: #FFF;
    background-color: #e74c3c;
    padding: 5px 5px;
    border-radius: 3px;
}

#btn:hover {
    background-color: #c0392b;
}

.insert-button {
    display: inline-block;
    background-color: #3498db;
    color: #fff;
    padding: 10px 10px;
    border: 1px solid #3498db;
    border-radius: 5px;
    text-decoration: none;
    margin: 5px;
    float: right; 
}

</style>     