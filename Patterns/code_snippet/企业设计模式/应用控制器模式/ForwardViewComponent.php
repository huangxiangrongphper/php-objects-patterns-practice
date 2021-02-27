<?php
declare(strict_types = 1);

namespace popp\ch12\batch06;

class ForwardViewComponent implements ViewComponent
{
    private $path = '';

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function render(Request $request)
    {
        $request->forward($this->path);
    }
}
