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
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
    if (!isset($_SERVER['HTTP_REFERER']))
        $this->redirect("home/index");
    else
        $this->redirect();
}