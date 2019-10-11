<?php

var_dump($_SERVER['REQUEST_URI']);

$ex = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

var_dump($ex[1]);

var_dump(is_int($ex[1]));