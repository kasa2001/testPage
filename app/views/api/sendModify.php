<?php
$query = "UPDATE `testdata` set `data` = '" . $_POST["data"] . "', `alias` = '" . $_POST["alias"] . "', `title` = '" . $_POST["title"] . "' where `id` = " . $_POST["id"];
$model->execute($query);

echo $query;