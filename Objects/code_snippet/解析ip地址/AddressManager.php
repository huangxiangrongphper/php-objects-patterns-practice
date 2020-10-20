<?php

/**
 *  AddressManager — 获取指定的IP地址对应的主机名
 *
 */
class AddressManager
{
    private $addresses = ["209.131.36.159", "216.58.213.174"];

    public function outputAddresses($resolve)
    {
        if (is_string($resolve)) {
            // 使用正则表达式判断
            $resolve = (preg_match("/^(false|no|off)$/i", $resolve) ) ? false : true;
        }

        foreach ($this->addresses as $address) {
            print $address;
            if ($resolve) {
                print " (".gethostbyaddr($address).")";
            }
            print "\n";
        }
    }
}

