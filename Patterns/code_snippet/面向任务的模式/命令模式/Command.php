<?php
declare(strict_types = 1);

namespace popp\ch11\batch09;

use popp\ch11\batch09\CommandContext;

/**
 *
 * 使用命令模式构建可扩展的分层系统。
 *
 * 命令（Command）模式：创建能够保存和传递的命令对象。
 *
 * 命令模式最初起源于GUI设计，但现在已经广泛应用于企业应用设计，
 * 促进了控制器（请求和分发处理）与领域模型层（应用逻辑）的分离。
 *
 * 更简单来说，命令模式可以帮助我们更好组织系统，使系统更易于扩展。
 * Class Command
 *
 *
 * 相较于接口，基类还可以为继承类提供共通功能。
 *
 * 命令模式中有三个参与者：实例化命令对象的客户端、部署命令对象的调用者、接受命令的接受者。
 *
 * 接受者可以通过构造方法接收客户端传递的命令对象，也可以通过某种工厂方法得到命令对象。
 * 我更倾向于后者，这样可以保持构造方法中参数的清晰性。
 * 使用这种方法的话，所有的命令对象都能够以相同的方式被实例化。
 *
 * @package popp\ch11\batch09
 */
abstract class Command
{
    abstract public function execute(CommandContext $context): bool;
}
