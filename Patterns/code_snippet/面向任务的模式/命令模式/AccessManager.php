<?php
declare(strict_types = 1);

namespace popp\ch11\batch09;

/**
 * LoginCommand与AccessManager对象一起工作。
 * AccessManager是一个虚构出来的类，其任务就是处理用户登录系统的细节。
 * Class AccessManager
 *
 * @package popp\ch11\batch09
 */
class AccessManager
{
    public function login(string $user, string $pass): User
    {
        $ret = new User($user);
        return $ret;
    }

    public function getError(): string
    {
        return "move along now, nothing to see here";
    }
}
