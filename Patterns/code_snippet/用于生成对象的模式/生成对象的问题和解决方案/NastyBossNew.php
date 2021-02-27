<?php
declare(strict_types = 1);

namespace popp\ch09\batch02;

class NastyBossNew
{
    private $employees = [];

    public function addEmployee(Employee $employee)
    {
        // 现在不再负责实例化具体的对象了
        // 通过参数类型来避开这个问题
        $this->employees[] = $employee;
    }

    public function projectFails()
    {
        if (count($this->employees)) {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}
