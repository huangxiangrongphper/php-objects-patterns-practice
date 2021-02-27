<?php
declare(strict_types = 1);

namespace popp\ch12\batch09;

/**
 * 创建只负责管理显示和用户界面的模板页面，
 * 在显示标记中加入动态信息，
 * 尽可能少地使用原生代码。
 *
 * 有时视图确实需要查询系统，此时我们最好提供一个视图助手对象来代替视图执行相关工作。
 *
 * 有点麻烦的是if语句和循环语句。
 * 这些都很难委托给视图助手，
 * 因为它们通常都与格式化输出绑定在一起。
 *
 * 倾向于在模板视图中保留简单的条件语句和循环语句（构建显示多行数据的表格时很常见），
 *
 * 但为了尽量保持这些语句简单，会尽可能将检查语句等处理委托给视图助手。
 *
 * Class ViewHelper
 *
 * @package popp\ch12\batch09
 */
class ViewHelper
{
    public function sponsorList()
    {
        // do something complicated to get the sponsor list
        return "Bob's Shoe Emporium";
    }
}

