<?php

require_once ('init.php');
require_once ('templates\functions.php');
require_once ('helpers.php');
require_once ('templates\data.php');

// Если не удалось подключиться к БД, выводить ошибку

if (!$connect) {
    $error = mysqli_connect_error();
    $page_content = include_template('error.php', ['error' => $error]);
}
else {

// Если соеднились с БД, то показать список проектов и счетчик задач в проектах у id_user = 1

    $sql_projects_count = 'SELECT p.id, id_user, p.name, COUNT(*) tasks_count
            FROM projects p 
            JOIN tasks t
            ON p.id = t.id_project 
            WHERE id_user = 1  
            GROUP BY id';

    $result = mysqli_query($connect, $sql_projects_count);

// записать данные в массив $projects

    if ($result) {
        $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else {
        $error = mysqli_error($connect);
        $page_content = include_template('error.php', ['error' => $error]);
    }

// Далее показать список задач для текущего id_user.

    $sql_tasks_user = 'SELECT t.id, id_project, file, dt_add, t.name, dt_end, status, p.id  
            FROM tasks t 
            JOIN projects p 
            ON t.id_project = p.id
            WHERE id_user = 1
            ORDER BY dt_add ASC';

    // Получаем id задач для текущего user

    $sql_id_tasks = 'SELECT id_project, p.id_user  
                     FROM tasks t
                     JOIN projects p 
                     ON t.id_project = p.id
                     WHERE p.id_user = 1';

    $result = mysqli_query($connect, $sql_id_tasks);

    // Записываем выборку в массив $id_tasks

    if ($result) {
        $id_tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Создаем переменную, в которой будет значение запрашиваемого id в числовом выражении

    $show_category = intval($_GET['id']);

    // Проверяем на пустой запрос (если id не был передан) и на запрос id, которого нет в массиве $id_tasks

    if (!isset($_GET['id']) || !in_array($show_category, array_column($id_tasks, 'id_project'))) {

        http_response_code(404);
        header("Location: pages/404.html");
        exit();
    }

    $sql_tasks_user = "SELECT t.id, id_project, file, dt_add, t.name, dt_end, status, p.id  
                       FROM tasks t
                       JOIN projects p 
                       ON t.id_project = p.id 
                       WHERE t.id_project = '$show_category'";
    }
// Записываем ту или иную выборку в массив $tasks

    $result = mysqli_query($connect, $sql_tasks_user);
    if ($result) {

        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else {
        $error = mysqli_error($connect);
        $page_content = include_template('error.php', ['error' => $error]);
    }
}

// Вывод HTML

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

