<?php

/**
 *
 * 创建一个供他人使用的包不需要太多的信息，
 * 但至少需要定义name元素，
 * 这样其他人才能找到我们的包。
 *
 * "name": "popp5/megaquiz",
 * "description"："a truly mega quiz",
 * "authors": [
 *    {
 *       "name": "matt zandstra",
 *       "email": "matt@getinstanse.com"
 *    }
 * ],
 * name元素中的命名空间，它为供应商名，
 * 通过正斜杠与实际包名分隔。
 * 当其他人安装我们的软件包时，
 * 供应商名将成为vendor/下的第一级目录的目录名。
 * 供应商名通常是软件包拥有者在GitHub中使用的组织名称。
 * 之后就可以将软件包提交到所选择的版本库了。
 *
 * 虽然Composer支持version元素，
 * 但我们最好还是通过在Git上打标签（git tag）来追踪软件包版本。
 * Composer可以自动识别出Git标签。
 *
 * 不应该将vendor目录推送到版本库中，
 * 至少不应该总是推送，
 * 这条规则有一些有争议的例外情况。
 * 然而，
 * 同时推送composer.json文件与生成的composer.lock文件到版本库中
 * 通常是一种最佳实践。
 *
 * 不同平台软件包
 * 虽然无法用Composer安装系统的软件包，
 * 但我们能够指定系统的需求，
 * 这样我们的软件包就只会安装在符合需求的系统上。
 * 可以用一个单独的键来指定平台软件包。
 * 在某些情况下，
 * 我们也可以按类型用破折号划分键。
 *
 * 可用的类型
 *
 * 类型                 示例                 说明
 * PHP                 "php": "7.*"          PHP版本
 * 扩展                "ext-xml": ">2"       PHP扩展
 * 库                  "lib-iconv": "~2"     PHP使用的系统库
 * HHVM                "hhvm": "~2"          HHVM版本（一种支持PHP扩展版本的虚拟机）
 *
 * {
 *    "require": {
 *       "abraham/twitteroauth": "0.6.*"，
 *       "ext-xml": "*",
 *       "ext-gd":  "*"
 *   }
 * }
 * 以上代码指定了软件包需要xml和gd扩展。
 * 现在是时候运行update命令了。
 *
 *
 *
 *
 *
 *
 *
 *
 */
