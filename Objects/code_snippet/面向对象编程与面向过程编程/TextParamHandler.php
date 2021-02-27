<?php
declare(strict_types=1);

namespace popp\ch06\batch03;

class TextParamHandler extends ParamHandler
{

    public function write(): bool
    {
        // write text
        // using $this->params
        $fh = $this->openSource('w');
        foreach ($this->params as $key => $val) {
            fputs($fh, "$key:$val\n");
        }
        fclose($fh);
        return true;
    }

    public function read(): bool
    {
        // read text
        // and populate $this->params
        $lines = file($this->source);
        foreach ($lines as $line) {
            $line = trim($line);
            list( $key, $val ) = explode(':', $line);
            $this->params[$key]=$val;
        }
        return true;
    }
}
