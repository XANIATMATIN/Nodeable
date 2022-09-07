<?php

namespace MatinUtils\Nodable;

class Singleton
{
    protected $prefix;
    public function __construct()
    {
        $configs = config('nodable');
        preg_match_all('/\[(\w+)\]/', $configs['prefix'], $items);
        $prefix = $configs['prefix'];
        foreach ($items[1] as $item) {
            $prefix = str_replace("[$item]", is_callable($configs[$item]) ? $configs[$item]() : $configs[$item], $prefix);
        }

        $this->prefix = $prefix;
        return $prefix;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }
}
