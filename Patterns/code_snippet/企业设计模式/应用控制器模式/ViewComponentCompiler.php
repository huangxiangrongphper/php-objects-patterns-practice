<?php
declare(strict_types = 1);

namespace popp\ch12\batch06;

/**
 * 得益于SimpleXML扩展，我们不必自己解析配置文件，
 * SimpleXML会负责一切。
 * 剩下的就是遍历SimpleXML返回的数据结构并构建我们自己的数据。
 *
 * 以下这个类就是完成这个工作
 *
 * 构建潜在的请求与命令和视图间的关系
 * Class ViewComponentCompiler
 *
 * @package popp\ch12\batch06
 */
class ViewComponentCompiler
{
    private static $defaultcmd = DefaultCommand::class;

    public function parseFile($file)
    {
        $options = \simplexml_load_file($file);

        return $this->parse($options);
    }

    public function parse(\SimpleXMLElement $options): Conf
    {
        $conf = new Conf();

        foreach ($options->control->command as $command) {
            $path = (string) $command['path'];
            $cmdstr = (string) $command['class'];
            $path = (empty($path)) ? "/" : $path;
            $cmdstr = (empty($cmdstr)) ? self::$defaultcmd : $cmdstr;
            // 每个ComponentDescriptor对象都保存了一条路径和一个Command类
            $pathobj = new ComponentDescriptor($path, $cmdstr);

            // 0 是因为正处于默认状态
            $this->processView($pathobj, 0, $command);

            if (isset($command->status) && isset($command->status['value'])) {
                foreach ($command->status as $statusel) {
                    $status = (string)$statusel['value'];
                    $statusval = constant(Command::class . "::" . $status);

                    if (is_null($statusval)) {
                        throw new AppException("unknown status: {$status}");
                    }

                    // 这次我们传递给processView()方法的参数是一个非零整数以及一个statusXML元素。
                    $this->processView($pathobj, $statusval, $statusel);
                }
            }

            // 以命令对象的path值为索引，将ComponentDescriptor对象
            // 保存在Conf对象中。
            $conf->set($path, $pathobj);
        }
        // 构建一个ComponentDescriptor对象的数组
        return $conf;
    }

    public function processView(ComponentDescriptor $pathobj, int $statusval, \SimpleXMLElement $el)
    {
        // 当然，它也可能什么都匹配不到，根本不进行任何调用，
        // 但这可能是不妥的，
        // 或许我们应该在完整的实现中将其作为一种错误条件。

        if (isset($el->view) && isset($el->view['name'])) {
            // ComponentDescriptor对象中保存一个以状态值（0表示默认视图）
            // 为索引的ViewComponent对象（管理模板显示或转发）的数组。
            $pathobj->setView($statusval, new TemplateViewComponent((string)$el->view['name']));
        }

        if (isset($el->forward) && isset($el->forward['path'])) {
            $pathobj->setView($statusval, new ForwardViewComponent((string)$el->forward['path']));
        }
    }
}
