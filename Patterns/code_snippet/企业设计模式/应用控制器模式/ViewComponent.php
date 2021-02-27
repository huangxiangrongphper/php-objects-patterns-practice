<?php
declare(strict_types = 1);

namespace popp\ch12\batch06;

/**
 * 负责渲染模板的接口类
 *
 * 为什么要使用接口呢？
 *
 * 因为我们将转发和显示模板都视为视图处理
 *
 * Interface ViewComponent
 *
 * @package popp\ch12\batch06
 */
interface ViewComponent
{
    public function render(Request $request);
}

