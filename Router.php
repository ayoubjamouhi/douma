<?php

	class Router

	{

		protected $routes = [];

		public function get($routes)

		{
			$config = require_once 'core/config.php';
			$pdo = new PDO('mysql:dbname=doumahalim;host=127.0.0.1','root','root');

			require 'core/classes/ClientsAPI.php';

			$clientObj = new ClientsAPI($pdo);

			$clients = $clientObj->get_clients();

			$keys = array_keys($routes);
			$array = [];
			foreach ($keys as $key)

			{
				$ex = explode('/', $key);
				if($ex[1] == 'id')

				{
					foreach($clients as $client)
					{
						$array[$ex[0].'/'.$client->id_user] = $routes[$key];
					}
				}
				else
					$array[$key] = $routes[$key];
			}
			$this->routes = $array;

		}

		public static function load($file)

		{
			$router = new self();
			require $file;
			return $router;
		}

		public function direct($uri)

		{
			//var_dump('a');
			if(array_key_exists($uri, $this->routes))
				return $this->routes[$uri];

			else
				header('location: /error404');

		}

	}