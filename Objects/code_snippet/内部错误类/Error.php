<?php

/**
 *  try和catch子句主要针对的是PHP代码，而不是核心引擎。
 *  内部生成的错误会维护它们自己的逻辑。如果我们想用管理代码生成的异常的方法来管理核心错误，那么
 *  场面可能会一片混乱。PHP7引入了Error类来解决这个问题。Error类与Exception类实现了同一个内置接口Throwable。
 *  因此，可以用相同的方法处理它们。
 *
 *  PHP中引入的内置错误类
 *
 *  错误                                  说明
 * ArithmeticError           在发生于数学计算（特别是位运算）相关的错误时被抛出
 * AssertionError            当assert()语言结构（调试中）断言失败时被抛出
 * DivisionByZeroError       进行除零计算时被抛出
 * ParseError                在运行时解析PHP（如使用eval() 出错时被抛出）
 * TypeError                 当错误类型的参数被传递给方法，方法返回一个错误类型的参数，或是传递给方法的参数的数量不正确时被抛出
 *
 *
 */
try {
    eval("illegal code");
    // Error类是针对独立的错误类型进行子类化的。
} catch (\Error $e) {
    print get_class($e) . "\n";
    // 输出ParseError
} catch (\Exception $e) {
    // 使用Exception进行一些处理
}
