<?php
declare(strict_types = 1);

namespace popp\ch13\batch07;

/**
 * 查询（选择和更新）工厂：封装创建SQL语句的逻辑。
 *
 * 选择工厂基类的定义
 *
 * Class SelectionFactory
 *
 * @package popp\ch13\batch07
 */
abstract class SelectionFactory
{
    abstract public function newSelection(IdentityObject $obj): array;

    public function buildWhere(IdentityObject $obj): array
    {
        if ($obj->isVoid()) {
            return ["", []];
        }

        $compstrings = [];
        $values = [];

        foreach ($obj->getComps() as $comp) {
            $compstrings[] = "{$comp['name']} {$comp['operator']} ?";
            $values[] = $comp['value'];
        }

        $where = "WHERE " . implode(" AND ", $compstrings);

        // 构建where子句以及参数值所组成的数组
        return [$where, $values];
    }
}
