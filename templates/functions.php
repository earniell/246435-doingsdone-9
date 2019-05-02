<?php
function getCategoryNum($task_list, $category_name) {
    $index = 0;
    foreach ($task_list as $key => $val) {
        if ($val['id'] == $category_name) {
            $index++;
        };
    };
    return $index;
};

function isDeadlineClose($projectDate) {
    $projectDateTimestamp = strtotime($projectDate);
    $dateInterval = ($projectDateTimestamp - time());
    $secondsInDay = 86400;

    return $dateInterval <= $secondsInDay && $dateInterval > 0;
};





