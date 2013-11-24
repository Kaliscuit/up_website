<?php

while (True) {
    exec("git pull", $str1, $str2);
    try {
        if ($str1[0] == "Already up-to-date.") {
            echo "Up to date.\n";
        } else {
            var_dump($str1);
            exec("git pull && /etc/init.d/php-fpm restart", $str1);
            echo "Updated.\n";
        }
    } catch (Exception $e) {
        var_dump($str1);
        exec("git pull && /etc/init.d/php-fpm restart", $str1);
        echo "Updated.\n";
    }
    sleep(5);
}
