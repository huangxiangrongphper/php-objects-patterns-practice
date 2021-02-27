<?php
/**
 *  PHP_CodeSniffer可以帮助我们检测甚至修改违反标准（不仅仅是PSR）的代码。
 *  既可以按照https:://github.com/squizlabs/PHP_CodeSniffer上的说明获取和安装它，
 *  也可以选择从Composer或PEAR安装它，
 *  这里我使用下载PHP归档文件的安装方法。
 *  curl -0L https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar
 *  curl -0L https://squizlabs.github.io/PHP_CodeSniffer/phpcbf.phar
 *
 *  为什么要下载两个归档文件？
 *  第一个是phpcs,
 *  用于检查代码并报告违规情况。
 *  第二个文件是phpcbf,
 *  用于修复许多违规代码。
 *
 *  以下是一段不符合格式的代码
 *
 *  接着让PHP_CodeSniffer代替我们检查代码。
 *
 * $ php phpcs.phar --standard=PSR2 src/ch15/batch01/phpcsBroken.php
 *
 * 再使用phpcbf来完成修改
 * $ php phpcbf.phar --standard=PSR2 src/ch15/batch01/EbookParser.php
 *
 * 再运行phpcs,应该可以看到代码相比之前更符合规范了
 * $ php phpcs.phar --standard=PSR2 src/ch15/batch01/EbookParser.php
 *
 *
 *
 *
 *
 *
 */
namespace popp\ch15\batch01;
class ebookParser {

    function __construct(string $path , $format=0 ) {
        if ($format>1)
            $this->setFormat( 1 );
    }

    function setformat(int $format) {
        // do something with $format
    }
}

