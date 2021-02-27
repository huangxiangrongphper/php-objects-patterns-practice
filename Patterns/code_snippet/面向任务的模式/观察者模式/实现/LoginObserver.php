<?php
declare(strict_types = 1);

namespace popp\ch11\batch05;

/**
 * 让Observer类负责确保它们的主体是正确的类型。
 * Observer类甚至能将它们自己添加到主体中。
 * 既然有多种Observer类型，而且我打算给它们一些共通的任务，
 * 那么我决定创建一个抽象基类来做这些工作。
 * Class LoginObserver
 *
 * @package popp\ch11\batch05
 */
abstract class LoginObserver implements Observer
{
    private $login;

    public function __construct(Login $login)
    {
        $this->login = $login;
        $login->attach($this);
    }

    public function update(Observable $observable)
    {
        if ($observable === $this->login) {
            $this->doUpdate($observable);
        }
    }

    abstract public function doUpdate(Login $login);
}
