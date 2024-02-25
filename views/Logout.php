<?php
$us = new UserController();
$us->deco();
var_dump($us);
Redirect::to('Login');
?>