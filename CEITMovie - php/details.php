<?php
/**
 * Created by PhpStorm.
 * User: AliSalmani
 * Date: 1/19/2018
 * Time: 8:28 PM
 */



class Movie{
    public $id;
    public $created_at;
    public $title;
    public $original_title;
    public $rate;
    public $year;
    public $length;
    public $language;
    public $country;
    public $description;
    public $director;
    public $rate_avg;
}


$id = 10;
if(isset($_GET["id"]))
    $id = $_GET["id"];


$mysqli = mysqli_connect("localhost:3306", "root","", "mysql");
$stmt = mysqli_prepare($mysqli, "SELECT * FROM movie WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $ids, $created_at, $title, $original_title, $rate,
    $year, $length, $language, $country, $description, $director);

$m = new Movie();
if(mysqli_stmt_fetch($stmt)){
    $m->id = $ids;
    $m->created_at = $created_at;
    $m->title = $title;
    $m->original_title = $original_title;
    $m->rate = $rate;
    $m->year = $year;
    $m->length = $length;
    $m->language = $language;
    $m->country = $country;
    $m->description= $description;
    $m->director= $director;
}
mysqli_stmt_free_result($stmt);

$stmt = mysqli_prepare($mysqli, "SELECT AVG(comment.rate) FROM movie, comment  WHERE movie.id=? and movie.id = comment.movie_id");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $rate_avg);
if(mysqli_stmt_fetch($stmt)){
    $m->rate_avg=$rate_avg;
}
mysqli_stmt_free_result($stmt);

echo json_encode($m);


?>