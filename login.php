<?php
include "config/db.php";

session_start();

$msg = "";

if (isset($_POST["login"])) {

    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");


    if (empty($email) || empty($password)) {

        $msg = "Please enter email and password";

    } else {


        $sql = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($conn, $sql);

        if ($res && mysqli_num_rows($res) > 0) {

            $user = mysqli_fetch_assoc($res);


            if (password_verify($password, $user["password"])) {

                $_SESSION["id"] = $user["id"];
                $_SESSION["name"] = $user["name"];
                $_SESSION["email"] = $user["email"];

                header("Location: dashboard.php?msg=success");
                exit();

            } else {

                $msg = "Wrong email or password";
            }

        } else {

            $msg = "Wrong email or password";
        }
    }
}
?>


<html>

<head>
    <title>Login</title>
</head>

<body>

<h1>Log In</h1>

<p style="color:red;">
    <?php echo $msg; ?>
</p>

<form method="post">

<table>

<tr>
    <td>Email</td>
    <td>:</td>
    <td>
        <input type="email" name="email">
    </td>
</tr>

<tr>
    <td>Password</td>
    <td>:</td>
    <td>
        <input type="password" name="password">
    </td>
</tr>

<tr>
    <td colspan="3">
        <button type="submit" name="login">
            Login
        </button>
    </td>
</tr>

<tr>
    <td colspan="3">
        <button type="submit" name="login">
            Register
        </button>
    </td>
</tr>

</table>

</form>

</body>
</html>