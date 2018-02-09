<?php
$query = $model->createQuery($model->table(), "delete", [$model->deleteData(), $_POST["id"]]);
$model->request($query);
