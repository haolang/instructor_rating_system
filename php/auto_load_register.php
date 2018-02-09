<?php
/**
 * Created by PhpStorm.
 * User: Linker
 * Date: 2018/2/9
 * Time: 14:40
 */
include 'auto_loader.php'; // 引入加载器
spl_autoload_register('auto_loader::autoload'); // 注册自动加载