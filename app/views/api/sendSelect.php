<?php
$query = "SELECT `" . $model->getUpdateDate() . "` from `" . $model->table() . "` where `" . $model->deleteData() . "`='" . $_POST["id"] . "'";
$model->request($query);
$data = $model->getData();
$toEcho = null;
foreach ($data as $datum) {
    $toEcho = $datum;
}

echo $toEcho;
