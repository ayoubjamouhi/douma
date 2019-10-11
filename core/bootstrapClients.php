<?php

        require_once 'classes/Connection.php';
        require_once 'classes/ClientsAPI.php';

        return new ClientsAPI( 
        	Db::make()
        );
?>