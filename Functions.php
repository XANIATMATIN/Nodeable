<?php


function nodeTable($tableName)
{
    return app('nodable')->getPrefix(). $tableName;
}