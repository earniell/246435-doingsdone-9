<?php
// показывать или нет выполненные задачи

require_once ('templates\functions.php');
require_once ('helpers.php');
require_once ('templates\data.php');

$page_content = include_template('index.php', [
    'show_complete_tasks' => $show_complete_tasks,
    'tasks' => $tasks,
]);

$layout_content = include_template('layout.php', [
    'tasks' => $tasks,
    'content' => $page_content,
    'projects' => $projects,
    'title' => 'Дела в порядке',
    '$projectDate' => $projectDate,
    'currentDate' => $currentDate,
    'dateInterval' => $dateInterval,
]);

print($layout_content);
