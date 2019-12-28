<?php
require_once "../class/DataBase.php";

print_r($_POST);
print_r($_GET);

$personsObject = new Persons();
echo $personsObject->createTiles();

?>