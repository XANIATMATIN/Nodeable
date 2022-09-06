<?php


function nodeTable($tableName)
{
    return 'n' . node()->id . '_' . $tableName;
}