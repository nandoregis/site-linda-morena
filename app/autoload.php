<?php

    $autoload = function ($class) {
        $class = implode('/', explode('\\', $class));

        include($class.'.php');
    };

    spl_autoload_register($autoload);


?>