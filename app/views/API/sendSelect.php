<?php
$mysqli= new mysqli("localhost","root","","projekt");
$result=$mysqli->query("Select * from `users`");
$data=null;
$i=0;
while ($row=$result->fetch_assoc()){
    $data[$i]=$row;
    $i++;
}
echo json_encode($data);