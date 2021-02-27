<?php
declare(strict_types = 1);

namespace popp\ch11\batch04;

class Login
{
    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;

    private $status = [];

    // Login类很快就会紧紧地与系统耦合起来，
    // 如果不仔细地逐行检查代码并将与系统耦合的部分移除，
    // 我们就无法将这个类应用于其他系统。
    // 当然，移除耦合并不困难，但会带领我们走上剪切、复制、和粘贴代码的不归路。
    public function handleLogin(string $user, string $pass, string $ip): bool
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

        Logger::logIP($user, $ip, $this->getStatus());

        if (! $isvalid) {
            Notifier::mailWarning(
                $user,
                $ip,
                $this->getStatus()
            );
        }

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
