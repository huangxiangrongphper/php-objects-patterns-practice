<?php
namespace popp\ch06\batch01;

// 读取和写入配置文件的工具
function readParams(string $source): array
{
    $params = [];
    // read text parameters from $source
    $fh = fopen($source, 'r') or die("problem with $source");
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

    return $params;
}

function writeParams(array $params, string $source)
{
    // write text parameters to $source
    // 只要“||”前面为false,不管“||”后面是true还是false，都返回“||”后面的值。
    // 只要“||”前面为true,不管“||”后面是true还是false，都返回“||”前面的值。
    $fh = fopen($source, 'w') or die("problem with $source");
    foreach ($params as $key => $val) {
        fputs($fh, "$key:$val\n");
    }
    fclose($fh);
}
