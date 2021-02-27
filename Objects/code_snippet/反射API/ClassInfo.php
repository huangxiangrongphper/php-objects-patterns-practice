<?php
declare(strict_types=1);

namespace popp\ch05\batch07;

/**
 * 用反射API做更专业的事情。
 *
 *
 *
 *
 *
 *
 * Class ClassInfo
 *
 * @package popp\ch05\batch07
 */

class ClassInfo
{

    // class ClassInfo

    public static function getData(\ReflectionClass $class)
    {
        $details = "";
        // 返回要检查的类的名称
        $name = $class->getName();
        // PHP代码中声明的
        if ($class->isUserDefined()) {
            $details .= "$name is user defined\n";
        }
        // PHP的内置类
        if ($class->isInternal()) {
            $details .= "$name is built-in\n";
        }
        // 是否为接口
        if ($class->isInterface()) {
            $details .= "$name is interface\n";
        }
        // 是否为抽象类
        if ($class->isAbstract()) {
            $details .= "$name is an abstract class\n";
        }
        // 是否为最终类
        if ($class->isFinal()) {
            $details .= "$name is a final class\n";
        }
        // 检查类是否可以被实例化
        if ($class->isInstantiable()) {
            $details .= "$name can be instantiated\n";
        } else {
            $details .= "$name can not be instantiated\n";
        }

        // 类是否可以被克隆
        if ($class->isCloneable()) {
            $details .= "$name can be cloned\n";
        } else {
            $details .= "$name can not be cloned\n";
        }
        return $details;
    }




    // class ClassInfo
    // ReflectionMethod对象可以检查方法
    public static function methodData(\ReflectionMethod $method)
    {
        $details = "";
        $name = $method->getName();
        if ($method->isUserDefined()) {
            $details .= "$name is user defined\n";
        }
        if ($method->isInternal()) {
            $details .= "$name is built-in\n";
        }
        if ($method->isAbstract()) {
            $details .= "$name is abstract\n";
        }
        if ($method->isPublic()) {
            $details .= "$name is public\n";
        }
        if ($method->isProtected()) {
            $details .= "$name is protected\n";
        }
        if ($method->isPrivate()) {
            $details .= "$name is private\n";
        }
        if ($method->isStatic()) {
            $details .= "$name is static\n";
        }
        if ($method->isFinal()) {
            $details .= "$name is final\n";
        }
        // 是否为构造方法
        if ($method->isConstructor()) {
            $details .= "$name is the constructor\n";
        }
        // 是否返回了引用 只有被检查的方法明确地声明返回引用（方法名前面有一个&符号）时，
        // ReflectionMethod::returnsReference()才会返回true。
        if ($method->returnsReference()) {
            $details .= "$name returns a reference (as opposed to a value)\n";
        }
        return $details;
    }

    // class ClassInfo
    public function argData(\ReflectionParameter $arg)
    {
        $details = "";
        $declaringclass = $arg->getDeclaringClass();
        // 得到参数名
        $name  = $arg->getName();
        // 如果方法声明中有类型提示，那么ReflectionParameter::getClass方法会返回一个ReflectionClass对象。
        $class = $arg->getClass();
        $position = $arg->getPosition();
        $details .= "\$$name has position $position\n";
        if (! empty($class)) {
            $classname = $class->getName();
            $details .= "\$$name must be a $classname object\n";
        }

        // 检查参数是否为引用
        if ($arg->isPassedByReference()) {
            $details .= "\$$name is passed by reference\n";
        }

        // 检查参数是否提供了默认值
        if ($arg->isDefaultValueAvailable()) {
            $def = $arg->getDefaultValue();
            $details .= "\$$name has default: $def\n";
        }

        if ($arg->allowsNull()) {
            $details .= "\$$name can be null\n";
        }

        return $details;
    }

}
