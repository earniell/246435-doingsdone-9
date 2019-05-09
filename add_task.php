<?php
require_once ('init.php');
require_once ('functions.php');

$sql_projects_count = 'SELECT p.id, id_user, p.name, COUNT(*) tasks_count 
                       FROM projects p 
                       JOIN tasks t
                       ON p.id = t.id_project 
                       WHERE id_user = 1  
                       GROUP BY id';

$result = mysqli_query($connect, $sql_projects_count);

if ($result) {
    $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
else {
    $error = mysqli_error($connect);
    show_error($content, $error);
}

$page_content = include_template('add_task_form.php', ['projects' => $projects]);

// Если есть данные в массиве $_POST

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $add_task = $_POST;

// Проверка на заполненность полей "Название" и "Проект"

    $required = ['name', 'project'];
    $required_fields = ['name' => 'Название', 'project' => 'Проект'];
    $errors = [];

    foreach ($required as $key) {
        if (empty($_POST[$key])) {
            $errors[$key] = 'Вам нужно заполнить это поле';
        }
    }

// Проверка на соответствие поля "Проект"

    $project_error = true;

    foreach ($projects as $key => $val) {
        if ($val['id'] == $_POST['project']) {
            $project_error = false;
        }
    }

    if ($project_error) {
        $errors["project"] = "Пожалуйста, укажите тип проекта";
    }

// Проверка корректности даты

    if ($_POST['date'] !== '') {
        $current_time = strtotime('now');
        $dt_end = $_POST['date'];

        if (strtotime($dt_end) <= $current_time) {
            $errors['date'] = 'Дата выполнения должна быть больше или равна текущей дате';
        }

        if (!is_date_valid($dt_end)) {
            $errors['date'] = 'Неправильный формат даты';
        }
    }
    else {

        $_POST['date'] = null;
    }

// Если был загружен файл, то переместить его в папку uploads

    $file = null;

    if (isset($_FILES['task_file']['name'])) {
        $tmp_name = $_FILES['task_file']['tmp_name'];
        $path = $_FILES['task_file']['name'];

        move_uploaded_file($tmp_name, 'uploads/'. $path);
        $file = 'uploads/' . $path;
    }

    // Если были ошибки, вывести на страницу

    if (count($errors)) {
        $page_content = include_template('add_task_form.php', ['projects' => $projects, 'errors' => $errors, 'required_fields' => $required_fields]);
    }
    else {

// формирование запроса в БД

        $id_project = $_POST['project'];
        $name = $_POST['name'];
        $dt_end = $_POST['date'];

        $sql = 'INSERT INTO tasks (id_project, name, dt_end, file)
            VALUES (?, ?, ?, ?)';

        db_insert_data($connect, $sql, [$id_project, $name, $dt_end, $file]);
        header("Location: /index.php");

// вывод содержимого страницы
    }
}

$layout_content = include_template('layout.php', [
    'tasks' => $tasks,
    'content' => $page_content,
    'projects' => $projects,
    'users' => $users,
    'title' => 'Дела в порядке'
]);

print($layout_content);
