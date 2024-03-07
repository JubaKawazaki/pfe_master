<?php

require './views/includes/header.php';
require_once './autoload.php';
$home = new HomeController();
$pages = [
    'Login',
    'Dashboard',
    'listdoc',
    'Logout',
    'profil',
    'addemp',
    'addchef',
    'partagedoc',
    'archivedoc',
    'listemp',
    'listchef',
    'conge'
];

if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    if (isset($_GET['page'])) {
        if (in_array($_GET['page'], $pages)) {
            $page = $_GET['page'];
            $home->index($page);
        } else {
            include "views/includes/404.php";
        }
    } else {
        $home->index("Login");
    }

} else {
    $home->index("Login");
}

?>