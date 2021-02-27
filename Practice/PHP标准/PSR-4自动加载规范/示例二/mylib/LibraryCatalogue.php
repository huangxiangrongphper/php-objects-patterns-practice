<?php


// mylib/LibraryCatalogue.php

namespace popp\library;

use popp\library\inventory\Book;

/**
 *  路径中的初始命名空间必须对应一个或多个基础目录。
 *  我们可以用它作为一组子命名空间的起始目录。
 *  例如，
 *  如果想要使用命名空间popp\library(并且popp命名空间下没有其他命名空间)，
 *  那么我们可以将其映射到最上层目录上，
 *  以免维护一个空的popp/目录。
 *
 *  注意，基础目录的名字甚至不需要是library。
 *  以上定义的是从popp\library到mylib目录的映射。
 *
 *  为了找到LibraryCatalogue类，我们必须将这个类放在同名文件中(当然还要有.php后缀名)。
 *
 *
 * Class LibraryCatalogue
 *
 * @package popp\library
 */
class LibraryCatalogue
{
    private $books = [];

    public function addBook(Book $book)
    {
        $this->books[] = $book;
    }
}
