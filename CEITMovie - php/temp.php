<?php
/**
 * Created by PhpStorm.
 * User: AliSalmani
 * Date: 1/19/2018
 * Time: 8:06 PM
 */

//has sql injection
$mysqli = mysqli_connect("localhost:3306", "root","", "mysql");
$result = mysqli_query($mysqli,"SELECT * FROM `movie`");
while($row = mysqli_fetch_assoc($result)){
    echo $row['id']."->".$row['title']."\n";
}
mysqli_free_result($result);
mysqli_close($mysqli);