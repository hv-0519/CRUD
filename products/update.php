<h1>
    i am Update!!!
</h1>

<?php
include "../config/db.php";
session_start();

if (!isset($_SESSION["id"])){
	header ("Location:login.php");
	exit;
}

$id = $_GET["id"];

$get_product = mysqli_query($conn,"SELECT * FROM products WHERE id = '$id'");
$product = mysqli_fetch_assoc($get_product);

$msg = "";

if (isset($_POST["update"])){
	$name = $_POST["name"];
	$description = $_POST["description"];
	$price = $_POST["price"];
	$sale_price = $_POST["sale_price"];

	if ($sale_price >= $price){
        $msg = "sale_price must be less than price";
	}
	else{
	mysqli_query($conn,
	"UPDATE products SET 
	name = '$name',
	description = '$description',
	price = '$price',
	sale_price = '$sale_price'
	where id = '$id'
	"
	);
	header("Location:list.php?msg=success");
}
}
?>

<html>
<body>
<h1>Updating Product</h1>
<p><?php echo $msg; ?></p>
<form method = "POST">
Product Name<input type = "text" name = "name" value="<?php echo $product["name"];?>"><br>
Product Description <textarea name = "description"><?php echo $product["description"];?></textarea><br>
Product Price<input type = "number" name = "price" value="<?php echo $product["price"];?>"><br>
Product Sale Price<input type = "number" name = "sale_price" value="<?php echo $product["sale_price"];?>"><br>

<button type = "submit" name = "update">Update</button>
<a href = 'list.php'>Back To Products</a>


