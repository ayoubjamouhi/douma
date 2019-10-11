<?php

        require_once 'classes/Connection.php';
        require_once 'classes/UsersAPI.php';
        
        return new usersAPI( 
        	Db::make()
        );
?>