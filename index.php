<?php

require 'core/bootstrap.php';
// var_dump(Request::uri());

require Router::load('routes.php')
      	->direct(Request::uri());

