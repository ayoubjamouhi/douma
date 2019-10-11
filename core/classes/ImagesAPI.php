<?php

class ImagesAPI{

	private $pdo;

	public function __construct(PDO $pdo)

	{

		$this->pdo = $pdo;
	}

	public function insererImage($name)

	{
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');
        ini_set('max_input_time', 300);
        ini_set('max_execution_time', 300);
		$ret        = false;
        $img_blob   = '';
        $img_taille = 0;
        $img_type   = '';
        $img_nom    = '';
        $taille_max = 250000;
        $ret        = is_uploaded_file($name['tmp_name']);

        if (!$ret)

        {

            return false;
        }
        else

        {

            // Le fichier a bien été reçu
            $img_taille = $name['size'];
            $img_type   = $name['type'];
            $img_nom    = $name['name'];

            if ($img_taille > $taille_max)
                return false;

            if($img_type != 'image/png' && $img_type != 'image/jpeg' && $img_type != 'image/jpg')
                    return false;

            $img_type = $name['type'];
            $img_nom  = $name['name'];


            $req = "INSERT INTO `images` (img_nom,img_taille,img_type) VALUES ('{$img_nom}','{$img_taille}','{$img_type}')";

            $statment = $this->pdo->prepare($req);

            $statment->execute();

            $oldpath = $name['tmp_name'];
            $newpath ="public/imagesClients/".$name['name'];
            move_uploaded_file($oldpath, $newpath);

            return true;
        }
	}

    public function updateImage($id,$name=NULL)
    {
	    	ini_set('upload_max_filesize', '10M');
	    	ini_set('post_max_size', '10M');
	    	ini_set('max_input_time', 300);
	    	ini_set('max_execution_time', 300);
            if($name != NULL)
            {
	            $ret        = false;
	            $img_blob   = '';
	            $img_taille = 0;
	            $img_type   = '';
	            $img_nom    = '';
	            $taille_max = 250000;
	            $_id = (int)$id;
	            $ret        = is_uploaded_file($name['tmp_name']);

	            if (!$ret)
	                return false;
	            else
	            {

		            // Le fichier a bien été reçu
		            $img_taille = $name['size'];
		            $img_type   = $name['type'];
		            $img_nom    = $name['name'];


		            if($img_type != 'image/png' && $img_type != 'image/jpeg' && $img_type != 'image/jpg')
		                    return false;

		            $img_type = $name['type'];
		            $img_nom  = $name['name'];


		            $req = "UPDATE `images` SET `img_nom` = '{$img_nom}', `img_taille` = '{$img_taille}', `img_type` = '{$img_type}' WHERE `img_id` = {$_id}";



		            $statment = $this->pdo->prepare($req);

		            $statment->execute();

		            $oldpath = $name['tmp_name'];
		            $newpath ="public/imagesClients/".$name['name'];
		            move_uploaded_file($oldpath, $newpath);

		            return true;
            	}
            }
            else
                return false;
    }
    public function lastIdInserer()

    {
        $id = (int)$this->pdo->lastInsertId();
        return $id;
    }

    public function selectImage($extra = '')

    {

        $statment = $this->pdo->prepare("SELECT * FROM `images` {$extra}");
        $e = $statment->execute();

        if(!$e)
            return NULL;

        return $statment->fetchAll(PDO::FETCH_OBJ);
    }


    public function selectNameImageById($id)

    {
        $_id = (int)$id;

        $select = $this->selectImage("WHERE `img_id` = {$_id}");

        if($select != NULL)
            return $select[0];

        else
            return NULL;
    }

}