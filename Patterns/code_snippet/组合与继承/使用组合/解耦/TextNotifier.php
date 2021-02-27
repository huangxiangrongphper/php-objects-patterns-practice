<?php
declare(strict_types=1);
namespace popp\ch08\batch02;

class TextNotifier extends Notifier
{
    public function inform($message)
    {
        print "TEXT notification: {$message}\n";
    }
}
