<?php
/**
 * 我们并不总需要对外公开自己的包，
 * 有时只对一些认证用户公开即可。
 *
 * 如果无法在Packagist使用它。
 * 那么怎样才能在项目中安装它呢？
 * 答案很简单，
 * 告诉Composer到哪里找它即可。
 * 具体做法是创建一个repositories元素，
 * 然后定义仓库的URL。
 * {
 * "repositories": [
 * {
 *   "type": "vcs",
 *   "url": "git@bitbucket.org:getinstance/api_util.git"
 * }
 *  ],
 *  "require": {
 *  "popp5/megaquiz": "*",
 *  "getinstance/api_util": "v1.0.3"
 * }
 * }
 *
 * 现在，只要具有访问的权限，就可以在项目中安装这个私有包了。
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 */
