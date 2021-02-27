<?php
declare(strict_types = 1);

namespace popp\ch09\batch11;

class Runner
{
    public static function run()
    {
        // 如果想在海洋和森林类似地球，
        // 但平原类似火星的星球上玩一局文明游戏，
        // 也无须创建任何新的创建者类，
        // 在TerrainFactory中改变这几种地形的组合就可以了。
        $factory = new TerrainFactory(
            new EarthSea(),
            new EarthPlains(),
            new EarthForest()
        );
        print_r($factory->getSea());
        print_r($factory->getPlains());
        print_r($factory->getForest());
    }

    public static function run1()
    {
        $factory = new TerrainFactory(
            new EarthSea(-1),
            new EarthPlains(),
            new EarthForest()
        );
        print_r($factory->getSea());
        print_r($factory->getPlains());
        print_r($factory->getForest());
    }
}
