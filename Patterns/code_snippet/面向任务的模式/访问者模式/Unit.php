<?php
declare(strict_types = 1);

namespace popp\ch11\batch07;

abstract class Unit
{
    // ...

    public function getComposite(): Unit
    {
        return null;
    }

    abstract public function bombardStrength(): int;

    public function textDump($num = 0): string
    {
        $txtout = "";
        $pad = 4 * $num;
        $txtout .= sprintf("%{$pad}s", "");
        $txtout .= get_class($this).": ";
        $txtout .= "bombard: ".$this->bombardStrength()."\n";

        return $txtout;
    }
    // ...


    public function unitCount(): int
    {
        return 1;
    }

}

