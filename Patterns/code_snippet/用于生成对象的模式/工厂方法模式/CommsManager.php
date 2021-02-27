<?php
declare(strict_types = 1);

namespace popp\ch09\batch06;

/**
 *
 * Class CommsManager
 *
 * @package popp\ch09\batch06
 */
class CommsManager
{
    public function getApptEncoder(): ApptEncoder
    {
        return new BloggsApptEncoder();
    }
}
