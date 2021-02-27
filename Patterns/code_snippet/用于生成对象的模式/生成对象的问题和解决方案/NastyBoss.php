<?php
declare(strict_types = 1);

namespace popp\ch09\batch01;

class NastyBoss
{
    private $employees = [];

    public function addEmployee(string $employeeName)
    {
        // 在本类中直接实例化Minion 对象限制了程序的灵活性
        $this->employees[] = new Minion($employeeName);
    }

    public function projectFails()
    {
        if (count($this->employees) > 0) {
            // array_pop — 弹出数组最后一个单元（出栈）
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}
