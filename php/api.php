<?php require_once('db.php'); 

$query = 'select * from posts';
$row = mysqli_query($conn, $query);
header('Content-Type: application/json');


while($result = mysqli_fetch_assoc($row)){
    $arr[] = $result;
 
    echo json_encode($arr);
}