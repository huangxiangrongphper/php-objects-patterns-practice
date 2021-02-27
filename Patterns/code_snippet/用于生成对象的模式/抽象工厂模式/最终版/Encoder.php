<?php
declare(strict_types = 1);

namespace popp\ch09\batch10;

interface Encoder
{
    public function encode(): string;
}
