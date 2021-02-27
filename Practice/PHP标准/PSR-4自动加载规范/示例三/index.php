<?php

// 必须先用Composer生成自动加载文件vendor/autoload.php，并以某种方式包含此文件。
// 然后才能访问composer.json中声明的映射逻辑。
// 可以运行composer install命令来实现此目标。

// 创建一个顶层执行脚本index.php来实例化这些类。
require_once("vendor/autoload.php");

use popp\library\LibraryCatalogue;

// will be found under mylib/
use popp\library\inventory\Book;

// will be found under additional/
use popp\library\inventory\Ebook;

$catalogue = new LibraryCatalogue();
$catalogue->addBook(new Book());
$catalogue->addBook(new Ebook());

