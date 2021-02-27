<?php
declare(strict_types = 1);

namespace popp\ch10\batch05;

// 接口应当专注于自己特有的功能
abstract class Unit
{
    public function getComposite()
    {
        return null;
    }

    abstract public function bombardStrength(): int;
}

