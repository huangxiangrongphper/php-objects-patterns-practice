<?php

namespace popp\ch04\batch23;

/**
 * Class Mailer
 *
 * @package \popp\ch04\batch23
 */
class Mailer
{
    public function doMail(Product $product)
    {
        print "  mailing ({$product->name})\n";
    }
}
