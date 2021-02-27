<?php
declare(strict_types = 1);

namespace popp\ch11\batch05;

/**
 * 现在Login类可以管理一系列观察者对象了。
 * Class Login
 *
 * @package popp\ch11\batch05
 */
class Login implements Observable
{
    private $observers = [];
    private $storage;

    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS   = 2;
    const LOGIN_ACCESS       = 3;

    // 将观察者对象添加到Login对象中
    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        $this->observers = array_filter(
            $this->observers,
            function ($a) use ($observer) {
                return (! ($a === $observer ));
            }
        );
    }

    // 通知观察者它所期待的事情发生了
    public function notify()
    {
        foreach ($this->observers as $obs) {
            $obs->update($this);
        }
    }

    // ...

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

