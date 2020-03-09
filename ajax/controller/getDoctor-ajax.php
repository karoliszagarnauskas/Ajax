<?php
// print_r($_POST);
include_once('../models/doctors.php');
$numeris = $_POST['sk'];
$gydytojas = getDoctor($numeris);
// print_r($gydytojas);
echo json_encode($gydytojas);

 ?>
