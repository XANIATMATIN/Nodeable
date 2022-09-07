<?php


function nodeTable($tableName)
{
    return app('nodable')->prefix. $tableName;
}