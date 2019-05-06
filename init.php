<?php
require_once 'config\db.php';

$connect = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);
mysqli_set_charset($connect, 'utf8');

$projects = [];
$tasks = [];
$users = [];
$layout_content = '';
$page_content = '';