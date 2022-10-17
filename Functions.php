<?php


function nodeTable($tableName)
{
    return app('nodable')->getPrefix(). $tableName;
}

function createReferenceId()
{
    static $rand1;
    if (empty($rand1)) {
        $rand1 = base_convert(rand(), 10, 36);
        srand(getmygid());
    }
    $rand2 = base_convert(rand(), 10, 36) . $rand1;
    $time = explode(' ', microtime() . '');
    $time = base_convert($time[1] . substr($time[0], 2), 10, 36);
    return uniqid($time . $rand2);
}