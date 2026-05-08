<?php
include "config/db.php";

$msg = "";

if(isset($_POST["register"])){

    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $phone = $_POST["phone"] ?? "";
    $password =($_POST["password"] ?? "");
    $confirm_password =($_POST["confirm_password"] ?? "");

    if($password != $confirm_password){
        $msg = "Password doesn't match";
    }else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmts = $conn->prepare(
            "INSERT INTO users(name,email,phone,password)
             VALUES(?,?,?,?)"
        );

        $stmts->bind_param("ssss", $name, $email, $phone, $hashed_password);

        if($stmts->execute()){

            header("Location: login.php?msg=success");
            exit;

        } else {

            $msg = "Registration failed";
        }
}
}
?>


<html>
<body>
<h1>Registration</h1>
<p><?php echo $msg ?></p>
<form method="post">
<table>
<tr>
<td>Name</td>
<td>:</td>
<td><input type = "text" name = "name"></td>
</tr>
<tr>
<td>Email</td>
<td>:</td>
<td><input type = "email" name = "email"></td>
</tr>
<tr>
<td>Phone</td>
<td>:</td>
<td><input type = "tel" name = "phone"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input type="password" name="password"></td>
</tr>

<tr>
<td>Confirm Password</td>
<td>:</td>
<td><input type="password" name="confirm_password"></td>
</tr>
<tr>
<td><button type = "submit" name = "register">Register</button></td>
</tr>
</table>
</form>
</body>
</html>