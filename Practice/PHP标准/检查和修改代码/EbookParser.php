<?php

namespace popp\ch15\batch01;

// 为方法加上访问修饰符并修改类名。
// 现在代码完全符合规范了。
class EbookParser
{
    public function __construct(string $path, $format = 0)
    {
        if ($format > 1) {
            $this->setFormat(1);
        }
    }

    private function setformat(int $format)
    {
        // do something with $format
    }
}
