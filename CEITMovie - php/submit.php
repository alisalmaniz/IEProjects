<?php
/**
 * Created by PhpStorm.
 * User: AliSalmani
 * Date: 1/19/2018
 * Time: 10:26 PM
 */




if(isset($_POST["id"])){
    $id = $_POST["id"];
    $title = $_POST["title"];
    $length = $_POST["length"];
    $year = $_POST["year"];
    $country = $_POST["country"];
    $description = $_POST["description"];
    $director = $_POST["director"];
    $authors = $_POST["authors"];
    $stars = $_POST["stars"];
    $category = $_POST["category"];


    //store to db
    $date = date('Y-m-d H:i:s');
    $mysqli = mysqli_connect("localhost:3306", "root","", "mysql");
    $stmt = mysqli_prepare($mysqli, "INSERT INTO `movie`(`id`, `created_at`, `title`, `original_title`, `rate`, `year`, `length`, `language`, `country`, `description`, `director`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $rate = 3;
    $language = "en";
    mysqli_stmt_bind_param($stmt, "isssiiissss",$id, $date, $title,$title,$rate,$year,$length,$language,$country,$description,$director);
    mysqli_stmt_execute($stmt);


    //upload cover
    if(isset($_FILES["cover"])){
        if($_FILES["cover"]["error"] > 0)
            echo "cover not uploaded";
        else{
            if (file_exists("poster/" . $id.'.jpg'))
                echo "cover already exists.";
            else{
                move_uploaded_file($_FILES["cover"]["tmp_name"],"poster/" . $id.'.jpg');
                echo "cover Stored";
            }
        }
    }
    else
        echo "cover not uploaded";
    echo "\n";

    //upload trailer
    if(isset($_FILES["trailer"])){
        if($_FILES["trailer"]["error"] > 0)
            echo "trailer not uploaded";
        else{
            if (file_exists("trailer/" . $id.'.mp4'))
                echo "trailer already exists.";
            else{
                move_uploaded_file($_FILES["trailer"]["tmp_name"],"trailer/" . $id.'.mp4');
                echo "trailer Stored";
            }
        }
    }
    else
        echo "trailer not uploaded";



}
else{
    echo   '<form method="POST" action="submit.php" enctype="multipart/form-data">
                <input type="text" name="id" value="" placeholder="id">
                <input type="text" name="title" value="" placeholder="title">
                <input type="text" name="length" value="" placeholder="length">
                <input type="text" name="year" value="" placeholder="year">
                <input type="text" name="country" value="" placeholder="country">
                <input type="text" name="description" value="" placeholder="description">
                <input type="text" name="director" value="" placeholder="director">
                <input type="text" name="authors" value="" placeholder="authors">
                <input type="text" name="stars" value="" placeholder="stars">
                <input type="text" name="category" value="" placeholder="category">
                cover:<input type="file" accept="image/jpeg" name="cover">
                trailer:<input type="file" accept="video/mp4" name="trailer">
                <input type="submit" value="Submit" >
            </form>';
}
