<?php
/**
 * Created by PhpStorm.
 * User: AliSalmani
 * Date: 1/19/2018
 * Time: 11:56 PM
 */

session_start();
if(isset($_SESSION['login_user'])){

    $user_id = $_SESSION['login_user'];

    $mysqli = mysqli_connect("localhost:3306", "root","", "mysql");
    $user = "test";
    $pass = "test";
    $name = "test";
    $email = "test";
    if(isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["name"]) &&isset($_POST["email"])) {
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $name = $_POST["name"];
        $email = $_POST["email"];

        $stmt = mysqli_prepare($mysqli, "UPDATE `register` SET `user`=?,`pass`=?,`name`=?,`email`=? WHERE `id`=?");
        mysqli_stmt_bind_param($stmt, "ssssi", $user, $pass, $name,$email, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_free_result($stmt);
        echo "profile updated\n";
    }

    $stmt = mysqli_prepare($mysqli, "SELECT `user`, `pass`, `name`, `email` FROM register WHERE `id`=?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user, $pass, $name, $email);
    if(mysqli_stmt_fetch($stmt)){

        echo   '<form method="POST" action="user.php" enctype="multipart/form-data">
                username:<input type="text" name="user" value='.$user.'>
                password:<input type="password" name="pass" value='.$pass.'>
                name:<input type="text" name="name" value='.$name.'>
                email:<input type="email" name="email" value='.$email.'>
                <input type="submit" value="Submit" >
            </form>';
        echo "\n\n";
        echo '<form method="POST" action="logout.php" enctype="multipart/form-data">
                <button type="submit" value="Submit">logout</button>
            </form>';
    }
}
else
    header("location: login.php");