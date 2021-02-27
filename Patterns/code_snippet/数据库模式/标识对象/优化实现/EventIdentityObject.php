<?php
declare(strict_types = 1);

namespace popp\ch13\batch07;

/**
 * 当然，移除一些硬编码的方法后，代码的健壮性也下降了。
 * 这就是需要$enforce数组的原因。
 * 子类可以在调用基类的构造方法时限定比较的字段。
 *
 * Class EventIdentityObject
 *
 * @package popp\ch13\batch07
 */
class EventIdentityObject extends IdentityObject
{
    public function __construct(string $field = null)
    {
        parent::__construct(
            $field,
            ['name', 'id', 'start', 'duration', 'space']
        );
    }
}
