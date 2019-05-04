<?php

require_once ('init.php');
require_once ('templates\functions.php');
require_once ('helpers.php');
require_once ('templates\data.php');

if (!$connect) {
    $error = mysqli_connect_error();
    $page_content = include_template('error.php', ['error' => $error]);
}
else {
    $sql = 'SELECT id, name FROM projects WHERE id_user = 1';
    $result = mysqli_query($connect, $sql);

    if ($result) {
        $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else {
        $error = mysqli_error($connect);
        $page_content = include_template('error.php', ['error' => $error]);
    }

    $sql = 'SELECT t.id, id_project, file, dt_end, t.name, dt_end, status, p.id 
            FROM tasks t
            JOIN projects p
            ON t.id_project = p.id';
    $result = mysqli_query($connect, $sql);
    if ($result) {
        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else {
        $error = mysqli_error($connect);
        $page_content = include_template('error.php', ['error' => $error]);
    }
}

$page_content = include_template('index.php', [
    'tasks' => $tasks,
    'show_complete_tasks' => $show_complete_tasks,
]);
$layout_content = include_template('layout.php', [
    'tasks' => $tasks,
    'content' => $page_content,
    'projects' => $projects,
    'users' => $users,
    'title' => 'Дела в порядке',
]);

print($layout_content);