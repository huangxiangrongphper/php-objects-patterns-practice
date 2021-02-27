<?php
declare(strict_types = 1);

namespace popp\ch13\batch06;

class Runner
{
    // 构建WHERE语句的代码。
    // 虽然这种模型可以正常工作，
    // 但还不够符合"懒惰"精神。
    // 对于一个庞大的领域对象，
    // 我们需要编写大量的getter方法和setter方法。
    // 然后，
    // 为了遵循这个设计方式，
    // 我们需要编写代码将每个条件都输出到WHERE子句。
    public static function run()
    {
        $idobj = new EventIdentityObject();
        $idobj->setMinimumStart(time());
        $idobj->setName("A Fine Show");
        $comps = array();
        $name = $idobj->getName();

        if (! is_null($name)) {
            $comps[] = "name = '{$name}'";
        }

        $minstart = $idobj->getMinimumStart();

        if (! is_null($minstart)) {
            $comps[] = "start > {$minstart}";
        }

        $start = $idobj->getStart();

        if (! is_null($start)) {
            $comps[] = "start = '{$start}'";
        }

        $clause = " WHERE " . implode(" and ", $comps);

        print "{$clause}\n";
    }
}
