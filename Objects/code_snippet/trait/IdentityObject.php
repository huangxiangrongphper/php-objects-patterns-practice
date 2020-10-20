<?php
declare(strict_types=1);

namespace popp\ch04\batch06_3;

interface IdentityObject
{
    public function generateId(): string;
}
