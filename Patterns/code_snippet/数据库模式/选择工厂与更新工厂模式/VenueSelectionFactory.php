<?php
declare(strict_types = 1);

namespace popp\ch13\batch07;

/**
 * 具体的选择工厂类
 *
 * 各个具体的选择工厂唯一不同的是表名。
 * 如果没有特殊的需求，
 * 可以重构这些子类，
 * 只使用一个具体的选择工厂类，
 * 然后PersistenceFactory获取表名。
 *
 * 由于这些方法可以动态地生成查询，
 * 我们很难发觉何时编写了重复查询。
 *
 * 因此，
 * 建立比较标识对象的方式很有简直，
 * 在发现标识对象相同时直接返回缓存的SQL语句字符串，
 * 可以省去重复构建查询语句的工作。
 * 我们还可以在更高层次上考虑一种名为"数据库语句缓存池"的缓存策略。
 *
 * 通用的标识对象让使用参数化的选择工厂变得更加简单。
 * 如果选择硬编码标识对象（即用一组getter和setter方法组成标识对象），
 * 那么我们可能需要为每个领域对象都构建一个单独的选择工厂。
 *
 * 虽然映射器类的创建和维护比较麻烦，
 * 但想在简洁的API背后执行性能优化或数据处理时，
 * 它们是最合适的地方。
 * 这些优雅的模式更专注于自己的职责，
 * 而且更强调组合使用，
 * 这样就很难走捷径实现一些不优雅却强大的功能。
 * 好在我们可以在更高层次的接口（控制器层）上实现这些功能（DomainObjectAssembler）
 *
 *
 * Class VenueSelectionFactory
 *
 * @package popp\ch13\batch07
 */
class VenueSelectionFactory extends SelectionFactory
{
    // 通用的标识对象让使用参数化的选择工厂类变得更简单。
    public function newSelection(IdentityObject $obj): array
    {
        $fields = implode(',', $obj->getObjectFields());
        $core = "SELECT $fields FROM venue";
        list($where, $values) = $this->buildWhere($obj);

        return [$core . " " . $where, $values];
    }
}
