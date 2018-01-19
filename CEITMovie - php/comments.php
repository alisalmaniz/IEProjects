<?php
/**
 * Created by PhpStorm.
 * User: AliSalmani
 * Date: 1/19/2018
 * Time: 8:59 PM
 */

class Comments{

    public $id;
    public $movie_id;
    public $created_at;
    public $author;
    public $comment;
    public $rate;
}


$id = 10;
if(isset($_GET["id"]))
    $id = $_GET["id"];

if(isset($_POST["comment"]) && isset($_POST["author"]) && isset($_POST["rate"])){
    $comment = $_POST["comment"];
    $author = $_POST["author"];
    $rate = $_POST["rate"];

    $date = date('Y-m-d H:i:s');
    $mysqli = mysqli_connect("localhost:3306", "root","", "mysql");
    $stmt = mysqli_prepare($mysqli, "INSERT INTO `comment`(`movie_id`, `created_at`, `author`, `comment`, `rate`) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "isssi",$id, $date,$author,$comment,$rate);
    mysqli_stmt_execute($stmt);
}
else{
    $mysqli = mysqli_connect("localhost:3306", "root","", "mysql");
    $stmt = mysqli_prepare($mysqli, "SELECT * FROM comment WHERE movie_id=? ORDER BY created_at");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $ids, $movie_id, $created_at, $author, $comment, $rate);

    for ($i=0; mysqli_stmt_fetch($stmt); $i++) {
        $arr[$i]= new Comments();
        $arr[$i]->id = $ids;
        $arr[$i]->movie_id = $movie_id;
        $arr[$i]->created_at = $created_at;
        $arr[$i]->author = $author;
        $arr[$i]->comment = $comment;
        $arr[$i]->rate = $rate;
    }
    if(isset($arr))
        echo json_encode($arr);
}


?>