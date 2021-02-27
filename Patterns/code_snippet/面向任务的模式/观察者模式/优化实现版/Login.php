<?php
declare(strict_types = 1);

namespace popp\ch11\batch06;

/**
 *  PHP通过内置的PHP标准库（SPL，Standard PHP Library）扩展提供了对观察者模式的原生支持。
 *  SPL是一套可以帮助我们解决共通的、主要的面向对象问题的工具，
 *  堪称面向对象的瑞士军刀。
 *  其中的观察者模式由三个部分组成：SplObserver、SplSubject和SplObjectStorage。
 *  SplObserver、SplSubject都是接口，分别与前面示例中的Observer和Observable接口对应。
 *  SplObjectStorage 则是一个工具，用于更方便地存储和移除对象。
 *
 *  可以在 https://www.php.net/spl上获取更多关于SPL的信息。
 *  特别值得注意的是，SPL有许多迭代器。
 *
 *  这里我们再次在运行时通过"组合"构建了一种灵活且可扩展的模型。
 *  现在我们可以将Login类从这个程序中提取出来，
 *  使其在另外一个完全不同的项目中与一组不同的观察者协作。
 *
 * Class Login
 *
 * @package popp\ch11\batch06
 */
class Login implements \SplSubject
{
    private $storage;

    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS   = 2;
    const LOGIN_ACCESS       = 3;

    public function __construct()
    {
        $this->storage = new \SplObjectStorage();
    }

    public function attach(\SplObserver $observer)
    {
        $this->storage->attach($observer);
    }

    public function detach(\SplObserver $observer)
    {
        $this->storage->detach($observer);
    }

    public function notify()
    {
        foreach ($this->storage as $obs) {
            $obs->update($this);
        }
    }

    public function handleLogin(string $user, string $pass, string $ip)
    {
        switch (rand(1, 3)) {
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $isvalid = true;
                break;
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
                $isvalid = false;
                break;
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                $isvalid = false;
                break;
        }
        $this->notify();
        return $isvalid;
    }

    private function setStatus(int $status, string $user, string $ip)
    {
        $this->status = array( $status, $user, $ip );
    }

    public function getStatus(): array
    {
        return $this->status;
    }

}

