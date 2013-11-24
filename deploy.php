<?php

while (True) {
    exec("git pull", $str1, $str2);
    if ($str1[0] == "Already up-to-date.") {
        echo "Up to date.\n";
    } else {
        exec("/etc/init.d/php-fpm restart");
        echo "Updated.\n";
    }
}
