<?php
declare(strict_types = 1);

namespace popp\ch11\batch05;

interface Observer
{
    public function update(Observable $observable);
}
