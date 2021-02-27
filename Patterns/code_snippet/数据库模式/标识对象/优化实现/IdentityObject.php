<?php
declare(strict_types = 1);

namespace popp\ch13\batch07;

/**
 * 标识对象：允许客户端组装查询条件，无须在意底层数据库。
 *
 * 以下类实现的是流接口，
 * 使类的setter方法返回对象实例，
 * 这样调用方就可以像写文章时将单词连接在一起那样将对象连接在一起。
 *
 * 标识对象允许客户端程序员不直接使用数据库查询语言就编写各种查询条件。
 * 我们也不必再针对各种不同的查询条件编写不同的查询方法。
 *
 * 标识对象还具有对调用方隐藏数据库细节的作用。
 * 因此，
 * 如果想要像前面的示例那样构建一个流接口的自动化数据映射解决方案，
 * 那么需要指定的名字应该是领域对象中的字段名而不是底层的列名。
 * 当领域对象的字段名与列名不同时，需要考虑使用别名。
 *
 *  当每个领域对象都用到某些特定的领域对象时，
 * 一种非常有用的方法是使用抽象工厂（如PersistenceFactory）来生成这些对象及其所需的其他领域对象。
 *
 *
 * Class IdentityObject
 *
 * @package popp\ch13\batch07
 */
class IdentityObject
{
    protected $currentfield = null;
    protected $fields = [];
    private $and = null;
    private $enforce = [];

    // an identity object can start off empty, or with a field
    public function __construct(string $field = null, array $enforce = null)
    {
        if (! is_null($enforce)) {
            $this->enforce = $enforce;
        }

        if (! is_null($field)) {
            $this->field($field);
        }
    }

    // field names to which this is constrained
    public function getObjectFields()
    {
        return $this->enforce;
    }

    // kick off a new field.
    // will throw an error if a current field is not complete
    // (ie age rather than age > 40)
    // this method returns a reference to the current object
    // allowing for fluent syntax
    public function field(string $fieldname): self
    {
        if (! $this->isVoid() && $this->currentfield->isIncomplete()) {
            throw new \Exception("Incomplete field");
        }

        $this->enforceField($fieldname);

        if (isset($this->fields[$fieldname])) {
            $this->currentfield = $this->fields[$fieldname];
        } else {
            $this->currentfield = new Field($fieldname);
            $this->fields[$fieldname] = $this->currentfield;
        }

        return $this;
    }

    // does the identity object have any fields yet
    public function isVoid(): bool
    {
        return empty($this->fields);
    }

    // is the given fieldname legal?
    public function enforceField(string $fieldname)
    {
        if (! in_array($fieldname, $this->enforce) && ! empty($this->enforce)) {
            $forcelist = implode(', ', $this->enforce);
            throw new \Exception("{$fieldname} not a legal field ($forcelist)");
        }
    }

    // add an equality operator to the current field
    // ie 'age' becomes age=40
    // returns a reference to the current object (via operator())
    public function eq($value): self
    {
        return $this->operator("=", $value);
    }

    // less than
    public function lt($value): self
    {
        return $this->operator("<", $value);
    }

    // greater than
    public function gt($value): self
    {
        return $this->operator(">", $value);
    }

    // does the work for the operator methods
    // gets the current field and adds the operator and test value
    // to it
    private function operator(string $symbol, $value): self
    {
        if ($this->isVoid()) {
            throw new \Exception("no object field defined");
        }

        $this->currentfield->addTest($symbol, $value);

        return $this;
    }

    // return all comparisons built up so far in an associative array
    public function getComps(): array
    {
        $ret = [];

        foreach ($this->fields as $field) {
            $ret = array_merge($ret, $field->getComps());
        }

        return $ret;
    }

    public function __toString()
    {
        $ret = [];

        foreach ($this->getComps() as $compdata) {
            $ret[] = "{$compdata['name']} {$compdata['operator']} {$compdata['value']}";
        }

        return implode(" AND ", $ret);
    }
}
