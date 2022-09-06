<?php

namespace MatinUtils\Nodable;

trait Nodable
{
    public function getTable()
    {
        $perfix = 'n' . node()->id . '_';
        if (strpos($this->table, $perfix) === false) {
            $this->table = $perfix . $this->table;
        }
        return  $this->table;
    }
}
