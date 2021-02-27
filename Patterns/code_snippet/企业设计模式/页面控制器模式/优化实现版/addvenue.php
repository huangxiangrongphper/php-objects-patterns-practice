<?php

namespace popp\ch12\batch08;

require_once(__DIR__ . "/../../../vendor/autoload.php");

/**
 * AddVenueController类中没有任何代码会运行它。
 * 本可以将运行它的代码放在同一个文件中，
 * 但这会让测试变得困难（因为加载类的行为会执行类的方法）
 * 因此，
 * 决定为每个页面都创建一个运行脚本。
 */

$addvenue = new AddVenueController();
$addvenue->init();
$addvenue->process();

