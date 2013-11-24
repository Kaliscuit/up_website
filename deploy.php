<?php

exec("git pull", $str1, $str2);
var_dump($str1);


//while (True) {
//    exec("git pull", $str1, $str2);
//    try {
//        if ($str1[0] == "Already up-to-date.") {
//            echo "Up to date.\n";
//        } else {
//            exec("git pull && /etc/init.d/php-fpm restart", $str1);
//            echo "Updated.\n";
//        }
//    } catch (Exception $e) {
//        exec("git pull && /etc/init.d/php-fpm restart", $str1);
//        echo "Updated.\n";
//    }
//    sleep(5);
//}
