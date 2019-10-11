<?php 

if(isset($_POST['login']))

{

  if(empty($_POST['username']) && empty($_POST['password']))

  {

    echo "<div class='echec'>Erreur</div>";
    header('Refresh:3; url=/');
  }

  require_once 'core/Session.php';

  $usersObj = require 'core/bootstrapUsers.php';

  $_username = Db::make($config['database'])->quote($_POST['username']);
  $_password = Db::make($config['database'])->quote(md5($_POST['password']));

  $users = $usersObj->get_users("WHERE `username` = {$_username} AND `password`= {$_password}");

  include('views/partials/header.php'); 
  if($users != NULL)

  {

    $_SESSION['user'] = $users;
    echo "<main><div class='success'>Vous avez été connecté avec succès !</div></main>";
    echo "<script type='text/javascript'>
            function Redirect() 
            {  
            window.location='/'; 
            } 
            setTimeout('Redirect()', 5000);  
          </script>";
  }

  else

  {

    echo "<main><div class='echec'>Erreur des données</div></main>";
    echo "<script type='text/javascript'>
            function Redirect() 
            {  
            window.location='/'; 
            } 
            setTimeout('Redirect()', 5000);  
          </script>";
  }  
  include('views/partials/footer.php');   
}

else

  header("Location : /Error404");
