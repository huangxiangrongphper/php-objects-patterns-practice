<?php
namespace popp\ch11\batch02;

class Runner
{
    public static function run()
    {

        $markers = [
            // 一条包含斜杠的正则表达式
            new RegexpMarker("/f.ve/"),
            // 纯文本
            new MatchMarker("five"),
            // 是一条以冒号开头的MarkLogic语句
            new MarkLogicMarker('$input equals "five"')
        ];

        foreach ($markers as $marker) {
            print get_class($marker) . "\n";
            $question = new TextQuestion("how many beans make five", $marker);

            foreach (array( "five", "four" ) as $response) {
                print "    response: $response: ";
                if ($question->mark($response)) {
                    print "well done\n";
                } else {
                    print "never mind\n";
                }
            }
        }

    }
}
