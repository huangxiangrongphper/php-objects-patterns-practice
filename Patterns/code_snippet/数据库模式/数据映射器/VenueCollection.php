<?php
declare(strict_types = 1);

namespace popp\ch13\batch01;

/**
 *
 * 每个领域类的集合
 *
 * 这个类只能用于VenueMapper
 *
 * 实际上，这是一个相当类型安全的集合，
 * 特别就领域模型而言。
 *
 * Class VenueCollection
 *
 * @package popp\ch13\batch01
 */
class VenueCollection extends Collection
{
    public function targetClass(): string
    {
        return Venue::class;
    }
}
