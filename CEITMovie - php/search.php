<?php
/**
 * Created by PhpStorm.
 * User: AliSalmani
 * Date: 1/19/2018
 * Time: 10:16 PM
 */


class sMovie{
    public $id;
    public $title;
    public $cover;
}


$txt = "%spider%";
if(isset($_GET["q"]))
    $txt = "%".$_GET["q"]."%";


$mysqli = mysqli_connect("localhost:3306", "root","", "mysql");
$stmt = mysqli_prepare($mysqli, "SELECT id, title FROM movie WHERE title like ? or description like ?");
mysqli_stmt_bind_param($stmt, "ss", $txt, $txt);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $ids, $title);

for ($i=0; mysqli_stmt_fetch($stmt); $i++) {
    $arr[$i] = new sMovie();
    $arr[$i]->id = $ids;
    $arr[$i]->title = $title;
    $arr[$i]->cover = $ids.'jpg';
}
if(isset($arr))
    echo json_encode($arr);
mysqli_stmt_free_result($stmt);