<?php
include(dirname(__DIR__)."/sorteo/Sorteo.php");

$sorteo_object = new Sorteo();
$sorteo_create = $sorteo_object->createSorteo();
$status = $sorteo_create['success'];
$message = $sorteo_create['message'];
header("Location: ./create_view.php?status=$status&message=$message");

?>
