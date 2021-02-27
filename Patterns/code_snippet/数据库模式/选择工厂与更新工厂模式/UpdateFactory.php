<?php
declare(strict_types = 1);

namespace popp\ch13\batch07;

use popp\ch13\batch04\DomainObject;

/**
 *
 *
 * 前面已经可以用对象表示查询条件了，
 * 接下来将构建查询语句。
 * 将创建数据库查询语句的职责从映射器中移除。
 *
 * 与数据库交互的任何系统都必须生成查询语句，
 * 将领域数据转化为数据库可以理解的形式时，
 * 需要进行一次转换，
 * 这才是真正发生解耦的地方。
 *
 * 选择工厂和更新工厂通常与系统中的领域对象平行组织（可能以标识对象为媒介）。
 *
 * 一个对领域对象进行持久化操作的抽象工厂。
 *
 * 以下是更新工厂的基类的定义。
 *
 * Class UpdateFactory
 *
 * @package popp\ch13\batch07
 */
abstract class UpdateFactory
{
    abstract public function newUpdate(DomainObject $obj): array;

    // 提供了创建更新语句的通用操作
    // 子类可以为不同的领域对象提供不同的实现。
    // 返回一个由查询字符串和要查询的值组成的数组。
    protected function buildStatement(string $table, array $fields, array $conditions = null): array
    {
        $terms = array();

        if (! is_null($conditions)) {
            $query  = "UPDATE {$table} SET ";
            $query .= implode(" = ?,", array_keys($fields)) . " = ?";
            $terms  = array_values($fields);
            $cond   = [];
            $query .= " WHERE ";

            foreach ($conditions as $key => $val) {
                $cond[] = "$key = ?";
                $terms[] = $val;
            }

            $query .= implode(" AND ", $cond);
        } else {
            $query  = "INSERT INTO {$table} (";
            $query .= implode(",", array_keys($fields));
            $query .= ") VALUES (";

            foreach ($fields as $name => $value) {
                $terms[] = $value;
                $qs[] = '?';
            }

            $query .= implode(",", $qs);
            $query .= ")";
        }

        return [$query, $terms];
    }
}
