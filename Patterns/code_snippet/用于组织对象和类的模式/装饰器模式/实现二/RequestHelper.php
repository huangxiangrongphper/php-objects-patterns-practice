<?php
declare(strict_types =1 );

namespace popp\ch10\batch07;

/**
 * 装饰器模式具有非常高的可扩展性。我们能够非常轻松地添加新的装饰器或者新的组件。
 * 通过使用大量的装饰器，我们能够在运行时创建出非常灵活的对象结构。
 *
 * 我们能够以多种方式修改组件类（上例中是Plains类）的行为，而无须将修改的内容反映到类层次结构中。
 * 通俗地讲就是无须创建PolluteDiamondPlains对象就可以构造一个拥有钻石且被污染的Plains对象。
 *
 * 装饰器模式所建立的流水线非常适合创造过滤器。
 * 这种可配置的流水线同样适用于前面提到过的Web请求示例。
 *
 * Class RequestHelper
 *
 * @package popp\ch10\batch07
 */
class RequestHelper
{
}
