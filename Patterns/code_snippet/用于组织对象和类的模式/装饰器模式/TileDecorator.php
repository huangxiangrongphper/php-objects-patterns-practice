<?php
declare(strict_types = 1);

namespace popp\ch10\batch06;

abstract class TileDecorator extends Tile
{
    protected $tile;

    public function __construct(Tile $tile)
    {
        $this->tile = $tile;
    }
}
