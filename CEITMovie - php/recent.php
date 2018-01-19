<?php
/**
 * Created by PhpStorm.
 * User: AliSalmani
 * Date: 1/19/2018
 * Time: 4:55 PM
 */


class rMovie{
    public $id;
    public $title;
    public $original_title;
    public $year;
}


$number = 10;
if(isset($_GET["number"]))
    $number = $_GET["number"];


$mysqli = mysqli_connect("localhost:3306", "root","", "mysql");
$stmt = mysqli_prepare($mysqli, "SELECT id, title, original_title, year FROM movie");
//mysqli_stmt_bind_param($stmt, "i", $year);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $title, $original_title, $year);

for ($i=0; mysqli_stmt_fetch($stmt) && $i<$number; $i++) {
    $arr[$i] = new rMovie();
    $arr[$i]->id = $id;
    $arr[$i]->title = $title;
    $arr[$i]->original_title = $original_title;
    $arr[$i]->year = $year;
}
if(isset($arr))
    echo json_encode($arr);
mysqli_stmt_free_result($stmt);

?>