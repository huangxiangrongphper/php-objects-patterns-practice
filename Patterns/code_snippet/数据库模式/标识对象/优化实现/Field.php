<?php
declare(strict_types = 1);

namespace popp\ch13\batch07;

/**
 *
 *
 *
 * 这个类会保存各个字段的查询值并最终生成一个WHERE子句。
 *
 * Class Field
 *
 * @package popp\ch13\batch07
 */
class Field
{
    protected $name = null;
    protected $operator = null;
    protected $comps = [];
    protected $incomplete = false;

    // sets up the field name (age, for example)
    public function __construct(string  $name)
    {
        $this->name = $name;
    }

    // add the operator and the value for the test
    // (> 40, for example) and add to the $comps property
    // 能够对某个字段保存多个查询条件。
    public function addTest(string $operator, $value)
    {
        $this->comps[] = [
            'name' => $this->name,
            'operator' => $operator,
            'value' => $value
        ];
    }

    // comps is an array so that we can test one field in more than one way
    public function getComps(): array
    {
        return $this->comps;
    }

    // if $comps does not contain elements, then we have
    // comparison data and this field is not ready to be used in
    // a query
    public function isIncomplete(): bool
    {
        return empty($this->comps);
    }
}
