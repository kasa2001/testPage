<?php
$query = $model->createQuery($model->table(), "insert", array_merge($model->insertData(), [$_POST["text"],date("y-m-d")]));
$model->request($query);
