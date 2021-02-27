<? // 错误地使用短开标签
   // 忘记声明namespace
require_once("conf/ConfFile.ini");

/**
 * 完全不符合PSR-1的实例代码
 *
 * 类名使用了下划线，并且没有以大写字母开头，
 * 这不符合StudyCaps大写开头的驼峰式命名规范。
 *
 * Class conf_reader
 */
class conf_reader {
    // 常量要所有字母必须大写，单词之间以下划线分隔的常量命名规范
    const ModeFile = 1;
    const Mode_DB = 2;

    // 属性命名方式应该统一
    private $conf_file;
    private $confValues= [];

    // 方法名中使用了下划线，这不符合小写开头的驼峰式命名规范
    function read_conf() {
        // implementation
    }
}

?>
