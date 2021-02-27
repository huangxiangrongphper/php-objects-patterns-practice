<?php
declare(strict_types = 1);

namespace popp\ch12\batch06;

/**
 * 一个具体的Command类
 * Class AddVenue
 *
 * @package popp\ch12\batch06
 */
class AddVenue extends Command
{
    // 不同的状态会导致应用控制器选择和返回不同的视图。
    public function doExecute(Request $request): int
    {
        $name = $request->getProperty("venue_name");

        if (is_null($name)) {
            $request->addFeedback("no name provided");
            return self::CMD_INSUFFICIENT_DATA;
        } else {
            // do some stuff
            $request->addFeedback("'{$name}' added");
            return self::CMD_OK;
        }

        return self::CMD_DEFAULT;
    }
}
