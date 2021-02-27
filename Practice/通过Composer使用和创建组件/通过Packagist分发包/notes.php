<?php

/**
 *
 * Packagist是一个软件包仓库。https:://packagist.org
 * 只要将软件包放到公共的Git仓库上，
 * 其他人就可以通过Packagist获得它们。
 *
 *  先将项目推送到Github，再将Git仓库的相关信息告诉Packagist。
 *  完成Packagist上的注册后，简单地输入Git仓库的URL即可分发我们的软件包。
 *
 * 向Packagist添加megaquiz后，
 * Packagist会访问Git仓库、检查composer.json文件并
 * 显示控制面板。
 *
 * 需要添加许可证信息，向composer.json添加一个license元素即可解决这个问题。
 * "license"： "Apache-2.0"，
 *
 * 设置版本信息。给Github仓库打个标记即可解决这个问题、
 * git tag -a '1.0.1' -m '1.0.1'
 * git push -tags
 *
 * 现在，packagist已经知道软件包的版本号了。
 *
 *
 */
