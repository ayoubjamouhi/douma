<?php

class ClientsAPI
{

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert_clients($nom, $prenom, $dateinsc, $datepaymentsfixe, $datepaymentsmois, $dateapres30, $img_id, $assurer, $dateassurance)
    {

        if (empty($nom) || empty($prenom) || empty($datepaymentsfixe)) {
            return false;
        }

        $_nom = $this->pdo->quote($nom);

        $_prenom = $this->pdo->quote($prenom);

        $_imgId = (int) $img_id;

        $_assurer = (int) $assurer;

        if (!empty($dateinsc)) {

            $date1 = strtr($dateinsc, '/', '-');
            $timestamp1 = date('Y-m-d H:i:s', strtotime($date1));

            $date2 = strtr($datepaymentsfixe, '/', '-');
            $timestamp2 = date('Y-m-d', strtotime($date2));

            $date3 = strtr($dateapres30, '/', '-');
            $timestamp3 = date('Y-m-d', strtotime($date3));

            if ($_assurer == 0 || $_assurer == 2) {
                if (empty($datepaymentsmois)) {
                    $s = sprintf("INSERT into `clients` values (null,%s,%s,'$timestamp1','$timestamp2',CURRENT_TIMESTAMP,'$timestamp3',0,'',%d,0,0)", $_nom, $_prenom, $_imgId);
                } else {

                    $date4 = strtr($datepaymentsmois, '/', '-');
                    $timestamp4 = date('Y-m-d', strtotime($date4));

                    $s = sprintf("INSERT into `clients` values (null,%s,%s,'$timestamp1','$timestamp2','$timestamp4','$timestamp3',0,'',%d,0,0)", $_nom, $_prenom, $_imgId);
                }
            } else {

                $date5 = strtr($dateassurance, '/', '-');
                $timestamp5 = date('Y-m-d', strtotime($date5));

                if (empty($datepaymentsmois)) {
                    $s = sprintf("INSERT into `clients` values (null,%s,%s,'$timestamp1','$timestamp2',CURRENT_TIMESTAMP,'$timestamp3',0,'',%d,1,'$timestamp5')", $_nom, $_prenom, $_imgId);
                } else {

                    $date4 = strtr($datepaymentsmois, '/', '-');
                    $timestamp4 = date('Y-m-d', strtotime($date4));
                    $s = sprintf("INSERT into `clients` values (null,%s,%s,'$timestamp1','$timestamp2','$timestamp4','$timestamp3',0,'',%d,1,'$timestamp5')", $_nom, $_prenom, $_imgId);
                }
            }

        } else {

            $date2 = strtr($datepaymentsfixe, '/', '-');
            $timestamp2 = date('Y-m-d', strtotime($date2));

            $date3 = strtr($dateapres30, '/', '-');
            $timestamp3 = date('Y-m-d', strtotime($date3));

            if ($_assurer == 0 || $_assurer == 2) {

                if (empty($datepaymentsmois)) {
                    $s = sprintf("INSERT into `clients` values (null,%s,%s,CURRENT_TIMESTAMP,'$timestamp2',CURRENT_TIMESTAMP,'$timestamp3',0,'',%d,0,0)", $_nom, $_prenom, $_imgId);
                } else {

                    $date4 = strtr($datepaymentsmois, '/', '-');
                    $timestamp4 = date('Y-m-d', strtotime($date4));
                    $s = sprintf("INSERT into `clients` values (null,%s,%s,CURRENT_TIMESTAMP,'$timestamp2','$timestamp4','$timestamp3',0,'',%d,0,0)", $_nom, $_prenom, $_imgId);
                }
            } else {

                $date5 = strtr($dateassurance, '/', '-');
                $timestamp5 = date('Y-m-d', strtotime($date5));

                if (empty($datepaymentsmois)) {
                    $s = sprintf("INSERT into `clients` values (null,%s,%s,CURRENT_TIMESTAMP,'$timestamp2',CURRENT_TIMESTAMP,'$timestamp3',0,'',%d,1,'$timestamp5')", $_nom, $_prenom, $_imgId);
                } else {

                    $date4 = strtr($datepaymentsmois, '/', '-');
                    $timestamp4 = date('Y-m-d', strtotime($date4));
                    $s = sprintf("INSERT into `clients` values (null,%s,%s,CURRENT_TIMESTAMP,'$timestamp2','$timestamp4','$timestamp3',0,'',%d,1,'$timestamp5')", $_nom, $_prenom, $_imgId);
                }
            }

        }

        $p = $this->pdo->prepare($s);
        $e = $p->execute();

        if (!$e) {
            return false;
        } else {
            return true;
        }

    }

    public function update_payment_client($id, $typeDate, $avantdate, $client)
    {

        $_id = (int) $id;
        $_typedate = (int) $typeDate;
        $_avantdate = (int) $avantdate;
		// var_dump($_typedate, $_avantdate);
        if ($_typedate == 2) {

            if ($_avantdate == 1) {

                $dateaprestrente = $this->genererDateApres30($client->date_payment_obliger, date('Y-m-d'));

                $date1 = strtr($dateaprestrente, '/', '-');
                $timestamp1 = date('Y-m-d', strtotime($date1));

                $u = "UPDATE `clients` SET `date_payment_mois` = CURRENT_TIMESTAMP,`date_plus_trente`='{$timestamp1}'  WHERE `id_user` = $_id";

            } else if ($_avantdate == 2) {

                $dateaprestrente = $this->genererDateApres30JourPayeAvantLaDateFixe($client->date_payment_obliger, date('Y-m-d'));

                $date1 = strtr($dateaprestrente, '/', '-');
                $timestamp1 = date('Y-m-d', strtotime($date1));

                $u = "UPDATE `clients` SET `date_payment_mois` = CURRENT_TIMESTAMP,`date_plus_trente`='{$timestamp1}'  WHERE `id_user` = $_id";

            }

        } else if ($_typedate == 1) {

            if ($_avantdate == 1) {

                $dateaprestrente = $this->genererDateApres30JourPayeAvantLaDateFixe(date('Y-m-d'), date('Y-m-d'));

                $date1 = strtr($dateaprestrente, '/', '-');
                $timestamp1 = date('Y-m-d', strtotime($date1));

                $u = "UPDATE `clients` SET   		`date_payment_mois` = CURRENT_TIMESTAMP,
											   			`date_payment_obliger` = CURRENT_TIMESTAMP,
													    `date_plus_trente`='{$timestamp1}'
									WHERE `id_user` = $_id";

            } else if ($_avantdate == 2) {

                $dateaprestrente = $this->genererDateApres30(date('Y-m-d'), date('Y-m-d'));

                $date1 = strtr($dateaprestrente, '/', '-');
                $timestamp1 = date('Y-m-d', strtotime($date1));

                $u = "UPDATE `clients` SET   		`date_payment_mois` = CURRENT_TIMESTAMP,
											   			`date_payment_obliger` = CURRENT_TIMESTAMP,
													    `date_plus_trente`='{$timestamp1}'
									WHERE `id_user` = $_id";

            }
        }
        $p = $this->pdo->prepare($u);
        $e = $p->execute();

        if (!$e) {
            return false;
        }

        return true;
    }

    public function get_clients($extra = '')
    {

        $s = sprintf("SELECT * FROM `clients` %s ", $extra);
        $p = $this->pdo->prepare($s);
        $e = $p->execute();
        if (!$e) {
            return null;
        } else {
            return $p->fetchAll(PDO::FETCH_OBJ);
        }

    }

    public function get_clients_with_date_payment($extra = '')
    {

        $s = sprintf("SELECT *,DATE_ADD(date_payment_obliger, INTERVAL 30 DAY) AS datePlusTrente FROM `clients` %s ", $extra);
        $p = $this->pdo->prepare($s);
        $e = $p->execute();
        if (!$e) {
            return null;
        } else {
            return $p->fetchAll(PDO::FETCH_OBJ);
        }

    }

    public function get_client_by_id($id)
    {

        $_id = (int) $id;
        $client = $this->get_clients_with_date_payment("WHERE `id_user`= $_id");

        if (!$client) {
            return null;
        } else {
            return $client[0];
        }

    }

    public function get_client_by_nom($nom)
    {

        $_nom = $this->pdo->quote($nom);
        $client = $this->get_clients("WHERE `nom_user`= $_nom");

        if (!$client) {
            return null;
        } else {
            return $client;
        }

    }

    /*public function search_client($archive,$nom=NULL,$prenom=NULL,$mois=0)

    {

    $_archive = (int)$archive;
    $q = array();

    if(!empty($nom))

    {

    $_nom = $this->pdo->quote($nom);
    $q[@count($q)] =  " `nom_user` = ".$_nom;
    }

    if(!empty($prenom))

    {

    $_prenom = $this->pdo->quote($prenom);
    $q[@count($q)] = " `prenom_user` = ".$_prenom;
    }

    if($mois != 0)

    {

    $_mois = (int)$mois;
    if($_mois < 0 || $_mois > 12)
    return NULL;

    if(count($q) == 0)

    $s = $this->get_clients("WHERE `is_archive`={$_archive} ORDER BY `date_plus_trente` ASC");

    else if(count($q) == 1)

    $s = $this->get_clients(

    "WHERE " . $q[0] . " AND `is_archive`={$_archive} ORDER BY `date_plus_trente` ASC"
    );

    else

    $s = $this->get_clients_with_date_payment(

    "WHERE " . $q[0] . " AND " .  $q[1]. "AND `is_archive`={$_archive} ORDER BY `date_plus_trente` ASC "
    );

    $array = [];
    foreach ($s as $c)

    {
    if(($c->date_payment_mois)[5] == 0)
    {
    if(($c->date_payment_mois)[6] == $_mois)
    $array[count($array)] = $c;
    }
    else
    {
    $str = (string)$_mois;
    if(($c->date_payment_mois)[6] == $str[1])
    $array[count($array)] = $c;

    }

    }

    if($array == NULL)

    return NULL;

    else
    return $array;
    }
    else

    {
    if(count($q) == 0)

    return NULL;

    else if(count($q) == 1)

    $s = $this->get_clients_with_date_payment(

    "WHERE " . $q[0] . "AND `is_archive`={$_archive} ORDER BY `date_plus_trente` ASC"
    );
    else

    $s = $this->get_clients_with_date_payment(

    "WHERE " . $q[0] . " AND " .  $q[1]. "AND `is_archive`={$_archive} ORDER BY `date_plus_trente` ASC "
    );                if(!$s)

    return NULL;

    return $s;
    }
    }
     */
    public function update_client($id, $nom = null, $prenom = null, $dateinsc = null, $datepaymentsfixe = null, $dateplustrente = null, $assurer = null, $dateassurance, $img_id = null, $datepaymentsmois)
    {

        $_id = (int) $id;
        $q = "UPDATE `clients` SET ";
        $a = array();

        if (!empty($nom)) {

            $_nom = $this->pdo->quote($nom);
            $a[count($a)] = " `nom_user` = " . $_nom;
        }

        if (!empty($prenom)) {

            $_prenom = $this->pdo->quote($prenom);
            $a[count($a)] = " `prenom_user` = " . $_prenom;
        }

        if (!empty($dateinsc)) {

            $date1 = strtr($dateinsc, '/', '-');
            $timestamp = date('Y-m-d H:i:s', strtotime($date1));
            $a[count($a)] = sprintf(" `date_inscription_user` = '$timestamp' ");
        }

        if (!empty($datepaymentsfixe)) {

            $date2 = strtr($datepaymentsfixe, '/', '-');
            $timestamp2 = date('Y-m-d', strtotime($date2));
            $a[count($a)] = sprintf(" `date_payment_obliger` = '$timestamp2' ");

            $date3 = strtr($dateplustrente, '/', '-');
            $timestamp3 = date('Y-m-d', strtotime($date3));
            $a[count($a)] = sprintf(" `date_plus_trente` = '$timestamp3' ");

        }

        if (!empty($assurer)) {

            $_assurer = (int) $assurer;

            if ($_assurer == 1) {
                $a[count($a)] = " `assurer` = 1";
            } else if ($_assurer == 2) {
                $a[count($a)] = " `assurer` = 0";
            }

        }

        if (!empty($dateassurance)) {

            $date = strtr($dateassurance, '/', '-');
            $timestamp = date('Y-m-d', strtotime($date));

            $a[count($a)] = sprintf(" `date_assurance` = '$timestamp' ");
        }

        if (!empty($img_id)) {

            $_img_id = (int) $img_id;

            $a[count($a)] = " `img_id` = {$_img_id}";
        }

        $date = strtr($datepaymentsmois, '/', '-');
        $timestamp = date('Y-m-d', strtotime($date));
        $a[count($a)] = sprintf(" `date_payment_mois` = '$timestamp' ");

        if (count($a) == 0) {
            return false;
        } else if (count($a) == 1) {

            $q .= $a[0] . " WHERE `id_user` = " . $_id;
        } else {

            for ($i = 0; $i < count($a); $i++) {

                if ($i < count($a) - 1) {
                    $q .= $a[$i] . " , ";
                } else {
                    $q .= $a[$i] . " WHERE `id_user` = " . $_id;
                }

            }
        }

        $p = $this->pdo->prepare($q);
        $e = $p->execute();

        if (!$e) {

            return false;
        } else {
            return true;
        }

    }

    public function timea($id)
    {

        $_id = (int) $id;
        $date1 = substr($this->get_client_by_id($_id)->date_plus_trente, 0, 10);

        $date2 = substr(date('c'), 0, 10);

        $diff = (strtotime($date2) - strtotime($date1));

        $y = floor($diff / (365 * 60 * 60 * 24));
        $m = floor(($diff - $y * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $d = floor(($diff - $y * 365 * 60 * 60 * 24 - $m * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        if (($y == 0 && $m == 0 && $d == 0) || ($y == 0 && $m == 0 && ($d == 1 || $d == 2 || $d == 3))) {
            return 1;
        }

        if ($y == 0 && $m == 0 && $d > 3) {
            return 2;
        }

        if (strcmp($date1, $date2) > 0) {

            $date2 = substr(date('c'), 0, 10);

            $diff = (strtotime($date1) - strtotime($date2));

            if ($y == 0 && $m == 0 && $d == 1) {
                return 1;
            }

            if ($y == 0 && $m == 0 && $d > 1) {
                return 3;
            }

        }
    }

    /**
     * [typeOfTime description]
     * @param  [object of client] $client [description]
     * @return numéro 1 , 2 ou 3
    1: color vert
    2: color rouge
    3: color normal
     */
    public function typeOfTime($client)
    {

        /**
         * [$dateCurrent description]
         * @var [string]
         */
        $dateCurrent = date('Y-m-d');

        $dateFixe = date('Y-m-d', strtotime($client->date_plus_trente));

        if ($dateCurrent == $dateFixe) {
            return 1;
        } else if ($dateCurrent > $dateFixe) {
            return 2;
        } else {
            return 3;
        }

    }
    public function archive_client($id, $argument)
    {

        $_id = (int) $id;
        $_argument = $this->pdo->quote(strip_tags($argument));
        $client = $this->get_client_by_id($_id);

        if ($client == null) {
            return false;
        }

        $q = "UPDATE `clients` SET `is_archive`= 1 , `archive_argument` = {$_argument} WHERE `id_user` = " . $_id;

        $p = $this->pdo->prepare($q);
        $e = $p->execute();

        if (!$e) {
            return false;
        } else {
            return true;
        }

    }

    public function archive_to_active_client($id)
    {

        $_id = (int) $id;

        $client = $this->get_client_by_id($_id);

        if ($client == null) {
            return false;
        }

        $q = "UPDATE `clients` SET `is_archive`= 0 WHERE `id_user` = " . $_id;

        $p = $this->pdo->prepare($q);
        $e = $p->execute();

        if (!$e) {
            return false;
        } else {
            return true;
        }

    }

    public function get_revenu()
    {

        $clients = $this->get_clients("ORDER BY `date_payment_mois` DESC");
        $date = substr($clients[0]->date_payment_mois, 0, 7);

        $array = array();

        $i = 0;
        foreach ($clients as $client) {

            if (substr($client->date_payment_mois, 0, 7) == $date) {

                //$date = substr($client->date_payment_mois, 0, 7)];

                if (array_key_exists($date, $array)) {

                    $array[$date] = $i + 1;
                    $i++;

                } else {

                    $array[$date] = $i + 1;
                    $i++;
                }

            } else {
                $i = 0;
                $date = substr($client->date_payment_mois, 0, 7);
                if (array_key_exists($date, $array)) {
                    $array[$date] = $i + 1;
                    $i++;
                } else {
                    $array[$date] = $i + 1;
                    $i++;

                }
            }

        }
        return $array;
    }
    /*
    Convert String date to d-m-Y
     */
    public function dateConvert($date)
    {
        $_date = (string) $date;
        return date('d-m-Y', strtotime($date));
    }

    public function dateConvertSansAnnee($date)
    {
        $_date = (string) $date;
        return date('d-m', strtotime($date));
    }

    public function dateConvertSansAnneeEtMois($date)
    {
        $_date = (string) $date;
        return date('d', strtotime($date));
    }

    public function genererDateApres30($datepaymentsfixe, $datepaymentsmois)
    {

        $dayFixe = date('d', strtotime($datepaymentsfixe));
        $dayDePayment = date('d', strtotime($datepaymentsmois));
		// var_dump( $datepaymentsfixe , $datepaymentsmois);
        if ((int) $dayFixe > (int) $dayDePayment) {

            $moisDePayment = date('m', strtotime($datepaymentsmois));
            $yearDePayment = date('y', strtotime($datepaymentsmois));

            $dateDePayment = $yearDePayment . "-" . ($moisDePayment) . "-" . $dayFixe;

            $dateDePayment1 = date('Y-m-d', strtotime($dateDePayment));

            return $dateDePayment1;
		}
		else if ((int) $dayFixe < (int) $dayDePayment)
		{
			if (date('m', strtotime($datepaymentsmois)) == 12)
			{
                $moisDePayment = '01';
			}
			else if (date('m', strtotime($datepaymentsmois)) == 9)
			{
                $moisDePayment = (string) ((int) date('m', strtotime($datepaymentsmois)) + 1);
            }
			else
			{
                $moisDePayment = '0' . (string) ((int) date('m', strtotime($datepaymentsmois)) + 1);
            }
            $yearDePayment = date('y', strtotime('+1 month', strtotime($datepaymentsmois)));

            $dateDePayment = $yearDePayment . "-" . $moisDePayment . "-" . $dayFixe;

            $dateDePayment1 = date('Y-m-d', strtotime($dateDePayment));
			// var_dump($dateDePayment1, $yearDePayment, $moisDePayment);
            return $dateDePayment1;
        } else if ((int) $dayFixe == (int) $dayDePayment) {
            return date('Y-m-d', strtotime('+1 month', strtotime($datepaymentsmois)));
        }
    }

    public function genererDateApres30JourPayeAvantLaDateFixe($datepaymentsfixe, $datepaymentsmois)
    {

        $dayFixe = date('d', strtotime($datepaymentsfixe));

        $moisDePayment = date('m', strtotime('+1 month', strtotime($datepaymentsmois)));

        $yearDePayment = date('y', strtotime($datepaymentsmois));

        $dateDePayment = $yearDePayment . "-" . $moisDePayment . "-" . $dayFixe;

        $dateDePayment1 = date('Y-m-d', strtotime($dateDePayment));

        return $dateDePayment1;
    }

    public function search_client($archive, $nom, $prenom, $mois, $annee)
    {

        $_archive = (int) $archive;
        $q = array();
        $requete = "SELECT * FROM `clients` WHERE ";

        $_mois = (int) $mois;
        $_annee = (int) $annee;

        if (!empty($nom)) {

            $_nom = $this->pdo->quote($nom);
            $q[@count($q)] = " `nom_user` = " . $_nom;
        }

        if (!empty($prenom)) {

            $_prenom = $this->pdo->quote($prenom);
            $q[@count($q)] = " `prenom_user` = " . $_prenom;
        }

        if ($_mois > 0 && $_mois < 13) {

            if ($_mois > 0 && $_mois < 10) {
                $date = $_annee . "-" . "0" . $_mois;
            } else {
                $date = $_annee . "-" . $_mois;
            }

            $q[@count($q)] = " `date_plus_trente` LIKE " . "'%$date%'";

        }

        if (count($q) == 0) {
            return null;
        } else if (count($q) == 1) {
            $requete .= $q[0] . " AND `is_archive`= {$_archive} ORDER BY `date_plus_trente` ASC";
        } else {

            for ($i = 0; $i < count($q); $i++) {
                $requete .= $q[$i] . " AND ";
            }

            $requete .= "`is_archive`= {$_archive} ORDER BY `date_plus_trente` ASC";

        }

        $statment = $this->pdo->prepare($requete);
        $e = $statment->execute();

        if (!$e) {
            return null;
        } else {
            return $statment->fetchAll(PDO::FETCH_OBJ);
        }

    }

}
