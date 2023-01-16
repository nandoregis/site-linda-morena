<?php
    include('./app/config.php');

    $url = isset( $_GET['url'] ) != '' ? explode('/', $_GET['url'])[0] : 'inicio';

    $test = new Application;
    $test->auto($url);


?>