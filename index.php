<?php
session_start();
//We include the database connections and functions
include 'db.php';
$pdo = connect_pdo();
//By default we get into login.php
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'login';
// We include the page and .php
include $page . '.php';