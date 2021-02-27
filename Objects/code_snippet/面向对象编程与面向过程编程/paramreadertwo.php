<?php

// 在读取和写入参数文件的处理过程中检查文件后缀名。
// 用于展示设计和重复代码问题，并不代表解析和写入文件的最佳方式。
// 必须在每个函数中检查文件的后缀名是否为.xml
function readParams(string $source): array
{
    $params = [];
    if (preg_match("/\.xml$/i", $source)) {
        // read XML parameters from $source
        $el = simplexml_load_file($source);
        foreach ($el->param as $param) {
            $params["$param->key"] = "$param->val";
        }
    } else {
         // read text parameters from $source
        $fh = fopen($source, 'r');
        while (! feof($fh)) {
            $line = trim(fgets($fh));
            if (! preg_match("/:/", $line)) {
                continue;
            }
            list( $key, $val ) = explode(':', $line);
            if (! empty($key)) {
                $params[$key]=$val;
            }
        }
        fclose($fh);
    }
    return $params;
}

function writeParams(array $params, string $source)
{
    $fh = fopen($source, 'w');
    if (preg_match("/\.xml$/i", $source)) {
        // write XML parameters to $source
        fputs($fh, "<params>\n");
        foreach ($params as $key => $val) {
            fputs($fh, "\t<param>\n");
            fputs($fh, "\t\t<key>$key</key>\n");
            fputs($fh, "\t\t<val>$val</val>\n");
            fputs($fh, "\t</param>\n");
        }
        fputs($fh, "</params>\n");
    } else {
        // write text parameters to $source
        foreach ($params as $key => $val) {
            fputs($fh, "$key:$val\n");
        }
    }
    fclose($fh);
}
