<?php

	class Db

	{

		public $pdo;

		public static function make()

		{
			try 
			{

				$pdo = new PDO('mysql:dbname=doumahalim;host=jamouhicom.ipagemysql.com','jdotnet','passwordhalim');
				return $pdo;
			}catch (PDOException $e) 

			{
			    echo 'Connexion échouée : ' . $e->getMessage();
			}
		}
		public static function db_close()

		{

			$pdo = NULL;
		}

	}


?>