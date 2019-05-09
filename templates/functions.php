<?php
function getCategoryNum($task_list, $id_project) {
    $index = 0;
    foreach ($task_list as $key => $val) {
      if ($val['id_project'] == $id_project) {
      $index++;
      };
    };
return $index;
};

function isDeadlineClose($projectDate) {
    $projectDateTimestamp = strtotime($projectDate);
    $dateInterval = ($projectDateTimestamp - time());
    $secondsInDay = 3600 * 24;

    return $dateInterval <= $secondsInDay && $dateInterval > 0;
};

/**
     * Создает массив с данными на основе готового SQL запроса и переданных данных
     *
     * @param $connect mysqli Ресурс соединения
     * @param $sql string SQL запрос с плейсхолдерами вместо значений
     * @param array $data Данные для вставки на место плейсхолдеров
     *
     * @return $result Массив с данными
     */

function db_fetch_data($connect, $sql, $data = []) {
  $result = [];
  $stmt = db_get_prepare_stmt($connect, $sql, $data);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);

  if ($res) {
      $resut = mysqli_fetch_all($res, MYSQLI_ASSOC);
  }

  return $result;
}

// добавление записей

function db_insert_data($connect, $sql, $data = []) {
    $stmt = db_get_prepare_stmt($connect, $sql, $data);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
      $result = mysqli_insert_id($connect);
    }   

    return $result;
}
