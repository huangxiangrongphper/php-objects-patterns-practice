<?php

/**
 *
 * 外观（Facade）模式：为复杂或多变的系统创建一个简单接口。
 *
 * 以下是一些故意让人迷惑的代码，其功能是从文件中获取日志信息并将其转换为对象数据。
 *
 *
 * @param $file
 *
 * @return array|bool
 */

function getProductFileLines($file)
{
    return file($file);
}

function getProductObjectFromId($id, $productname)
{
    // some kind of database lookup
    return new Product($id, $productname);
}

function getNameFromLine($line)
{
    if (preg_match("/.*-(.*)\s\d+/", $line, $array)) {
        return str_replace('_', ' ', $array[1]);
    }
    return '';
}

function getIDFromLine($line)
{
    if (preg_match("/^(\d{1,3})-/", $line, $array)) {
        return $array[1];
    }
    return -1;
}

class Product
{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
