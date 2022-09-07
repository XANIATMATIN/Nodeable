<?php

namespace MatinUtils\Nodable;

trait Nodable
{
    public function getTable()
    {
        $prefix = app('nodable')->getPrefix();
        if (strpos($this->table, $prefix) === false) {
            $this->table = $prefix . $this->table;
        }
        return  $this->table;
    }
}