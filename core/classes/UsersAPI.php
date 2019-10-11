<?php

	class usersAPI

	{

		protected $pdo;

		public function __construct(PDO $pdo)

		{

			$this->pdo = $pdo;
		}

		public  function get_users($extra='')

		{

			$s = sprintf("SELECT * FROM `users` %s",$extra);
			$p = $this->pdo->prepare($s);
			$e = $p->execute();
			if(!$e)
				return NULL;
			else
				return $p->fetchAll(PDO::FETCH_OBJ);
		}

		public static function get_user_by_id($id)

		{
			
			$_id = (int)$id;
			$user = clientsAPI::get_users("WHERE `id`= $_id");

			if(!$user)
				return NULL;
			else
				return $user[0];
		}
	}

?>