<?php
$query=$model->createQuery($model->table(),"UPDATE", [$model->updateData(), $_POST["content"],$model->deleteData(),$_POST["id"]]);
$model->request($query);
echo $query;