<?php
    function getCategoryNum($task_list, $category_name) {
    $index = 0;
    foreach ($task_list as $val) {
        if ($val['category'] == $category_name) {
        $index++;
        };
    };
    return $index;
};
    function getDateInterval($projectDate) {
    $projectDateTimestamp = strtotime($projectDate);
    $currentDate = time();
    $dateInterval = ($projectDateTimestamp - $currentDate);
    $secondInDay = 86400;

    if ($dateInterval <= $secondInDay) {
        if ($dateInterval > 0) {
            print('task--important');
        };
    };
};

