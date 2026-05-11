<h1>
    i am read!!!
</h1>

<?php

include "../config/db.php";

session_start();

if(!isset($_SESSION["id"])){
    header("Location:login.php");
    exit;
}

if(isset($_GET["delete"])){
	$id = $_GET["delete"];

	// mysqli_query($conn,"DELETE FROM products WHERE id = $id");
    $stmts = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmts->bind_param("i", $id);
    $stmts->execute();
}
// $res = mysqli_query($conn,"SELECT * FROM products");
$stmts = $conn->prepare("SELECT * FROM products");
$stmts->execute();
$res = $stmts->get_result();
?>
<html>
<body>
<h1>List Of Products</h1>
<a href='create.php'>Create</a>
<a href='../dashboard.php'>Dashboard</a>

<br><br>

<table border="5px">
<tr>
<td>Name</td>
<td>Description</td>
<td>Price</td>
<td>Sale Price</td>
<td>Actions</td>
</tr>

<?php while ($product = mysqli_fetch_assoc($res)){?>
<tr>
<td><?php echo $product["name"];?></td>
<td><?php echo $product["description"];?></td>
<td>₹<?php echo $product["price"];?></td>
<td>₹<?php echo $product["sale_price"];?></td>
<td><a href="update.php?id=<?php echo $product["id"];?>">Edit</a>
    <a href="list.php?delete=<?php echo $product["id"];?>">Delete</a></td>
</tr>
<?php } ?>