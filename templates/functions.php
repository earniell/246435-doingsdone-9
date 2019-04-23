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
