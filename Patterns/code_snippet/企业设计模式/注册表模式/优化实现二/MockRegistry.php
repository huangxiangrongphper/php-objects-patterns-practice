<?php
declare(strict_types = 1);

namespace popp\ch12\batch04;

/**
 * 当需要测试系统时，我们可以通过测试模式使用模拟的注册表。
 *
 * 可以用这个办法提供stub（在测试中代替真实环境的模拟对象）
 * 或mock（与stub对象类似，但还会分析对它们的调用并评估调用的正确性）。
 * Class MockRegistry
 *
 * @package popp\ch12\batch04
 */
class MockRegistry extends Registry
{
}
