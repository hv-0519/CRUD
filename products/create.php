<h1>
    i am creat!!!
</h1>

<?php

require_once "../config/db.php";

session_start();

if(!isset($_SESSION["id"])){
    header("Location:login.php");
    exit;
}

$msg = "";

if (isset($_POST["save"])) {

    $name = $_POST["name"] ?? "";
    $description = $_POST["description"] ?? "";
    $price = $_POST["price"] ?? 0;
    $sale_price = $_POST["sale_price"] ?? 0;

    

    if ($sale_price >= $price){

        $msg = "sale price must be less than price";

    } else {

        
        // $sql = "INSERT INTO products
        // (name,description,price,sale_price)
        // VALUES
        // ('$name','$description','$price','$sale_price')";

        // mysqli_query($conn,$sql);

        // header("Location:list.php?msg=success");
        // exit;
        $stmts =$conn->prepare(
            "INSERT INTO products(name,description,price,sale_price)
             VALUES(?,?,?,?)"
        );
        $stmts->bind_param("ssii", $name, $description, $price, $sale_price);
        $stmts->execute();
        header("Location:list.php?msg=success");
        exit;
    }
}
?>

<html>
<body>
<p><?php echo $msg; ?></p>

<form method="post" enctype="multipart/form-data">

<table>

<tr>
<td>Name</td>
<td>:</td>
<td><input type="text" name="name"></td>
</tr>

<tr>
<td>Description</td>
<td>:</td>
<td><textarea name="description"></textarea></td>
</tr>

<tr>
<td>Price</td>
<td>:</td>
<td><input type="number" name="price"></td>
</tr>

<tr>
<td>Sale Price</td>
<td>:</td>
<td><input type="number" name="sale_price"></td>
</tr>

<tr>
<td>
<button type="submit" name="save">
Add Product
</button>
</td>
</tr>

<tr>
<td><a href="../dashboard.php">Dashboard</a></td>
</tr>

</table>

</form>
</body>
</html>