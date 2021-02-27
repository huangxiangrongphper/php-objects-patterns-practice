<?php
// namespace声明后应该插入一个空白行
namespace popp\ch15\batch01;
// use声明语句块后也应该要有一个空白行。
// 不要在同一行代码中进行多次use声明。
use popp\ch10\batch06\PollutionDecorator;
use popp\ch10\batch06\DiamondDecorator;
use popp\ch10\batch06\Plains;

// begin class

/*
 * 使用闭标签结束文件，
 * 并在后面加上一个空白行非常容易，
 * 但这可能会导致格式化错误以及设置HTTP头部时发生错误（请求内容发送到浏览器后无法在这么做）。
 *
 * 属性名的命名规范：可是使用下划线、小写驼峰式命名或大写驼峰式命名方式，
 * 应该保持一致。
 * 每个属性都必须有访问修饰符（public、private、protected）。
 * 不可以使用关键字var声明属性。
 *
 *
 * class关键字、类名，以及extends和implements关键字
 * 必须在同一行中。
 * 如果一个类实现了多个接口，那么这些接口名可以在类声明的同一行中，
 * 也可以各占一行。
 * 如果选择将这些接口名放在多行中，
 * 那么第一个接口名必须自成一行，
 * 而不是跟在implements关键字后面。
 *
 * 类的开始花括号（{）应该写在函数声明后自成一行，
 * 结束花括号（}）也应该写在类体后自成一行。
 *
class EarthGame extends Game implements
    Playable,
    Savable
*/

/**
 * PSR-2建立在PSR-1的基础之上。
 * PSR-2规定纯PHP文件不应该以一个?>标签结束，
 * 而应该以一个空白行结束。
 *
 *
 *  行与缩进
 *  代码应该使用4个空格符来缩进，而不是使用制表符。
 *  可以检查编辑器设置，
 *  将其设置为按下Tab键时使用4个空格而不是制表符。
 *  每行代码的长度不应该超过120个字符。
 *
 * Class EarthGame
 *
 * @package popp\ch15\batch01
 */
class EarthGame extends Game implements Playable, Savable
{

    public function __construct(
        // 将每个参数（包括类型、参数变量、默认值和逗号）单独放在缩进的一行中。
        int $size,
        string $name,
        bool $wraparound = false,
        bool $aliens = false
    ) { // 结束圆括号应该放在参数列表后面一行中，并与方法声明的开始位置对齐。
        // 开始花括号应该在同一行的结束圆括号之后，以空格分隔。
        // 方法体应该从新的一行开始。
        // implementation
    }

    // 所有方法必须具有访问修饰符（public、private、或protected）。
    // 访问修饰符必须在abstract或final之后，static之前。
    // 具有默认值的方法参数应该放在参数列表的末尾。
    // 方法参数列表不应该以空格开始或结束（即应该紧贴包裹着它们的圆括号）。
    // 对于每个参数，参数名（或默认值）后面应该有一个逗号，
    // 且逗号后面有一个空格。
    final public static function generateTile(int $diamondCount, bool $polluted = false)
    { // 开始花括号应该写在方法名后自成一行
        // implementation
        $tile = [];

        // 流程控制
        // 流程控制关键字（if、for、while等）后面必须紧跟一个空格。
        // 但是，开始圆括号后不能有空格，结束圆括号前不能有空格。
        // 流程控制代码块的开始花括号应该与结束圆括号在同一行。
        // 结束花括号应该自成一行。
        for ($x = 0; $x < $diamondCount; $x++) {
            if ($polluted) {
                $tile[] = new PollutionDecorator(new DiamondDecorator(new Plains()));
            } else {
                $tile[] = new DiamondDecorator(new Plains());
            }
        }

        return $tile;
    }
    // 结束花括号也应该写在方法体后自成一行

}
