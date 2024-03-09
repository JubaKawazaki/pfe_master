<?php
if (isset($_POST['details'])) {
    $date = new EmployesController();
    $employe = $date->getOneEmploye();
}
$sx = $_POST['sx'];

include "profil.php";

?>