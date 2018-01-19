<?php
/**
 * Created by PhpStorm.
 * User: AliSalmani
 * Date: 1/19/2018
 * Time: 11:56 PM
 */

session_start();

$user = "test";
$pass = "test";
if(isset($_GET["user"]) && isset($_GET["pass"])) {
    $user = $_GET["user"];
    $pass = $_GET["pass"];

    $mysqli = mysqli_connect("localhost:3306", "root","", "mysql");
    $stmt = mysqli_prepare($mysqli, "SELECT id FROM register WHERE `user`=? and `pass`=?");
    mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $ids);
    if(mysqli_stmt_fetch($stmt)){
        $_SESSION['login_user']= $ids;
        header("location: user.php");
    }
    else
        echo "username or password is invalid\n";
}


if(isset($_SESSION['login_user'])){
    header("location: user.php");
}
else{
    echo   '<form method="GET" action="login.php" enctype="multipart/form-data">
                <input type="text" name="user" value="" placeholder="username"/>
                <input type="password" name="pass" value="" placeholder="password"/>
                <input type="submit" value="Submit" />
            </form>';
}
