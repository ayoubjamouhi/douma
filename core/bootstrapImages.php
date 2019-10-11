<?php

        require_once 'classes/Connection.php';
        require_once 'classes/ImagesAPI.php';

        return new ImagesAPI( 
        	Db::make()
        );
?>