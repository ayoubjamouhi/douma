<?php require_once 'core/Session.php';?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Application DOUMA FITNESS</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/public/css/normalize.css">
  	<link rel="stylesheet" href="/public/css/font-awesome.min.css">
  	<link rel="stylesheet" href="/public/css/style.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Start Header-->
<header>	
  <div class="container">
  <div class="logo">
    <img src="/public/img/logo.jpg">
  </div>

  <!-- Start navbar-->
  <nav>
        <ul>
          <li>

            <?php 
              $ex = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
              if($ex[0] == 'home'):
            ?>
            <a href="/home" style="color: #eded07">Home</a>
            <?php else: ?>
            <a href="/home">Home</a>
            <?php endif; ?>

          </li>
          <li>

            <?php if($ex[0] == 'gererclient'):?>
            <a href="/gererclient" style="color: #eded07">Ajoutez des clients</a>
            <?php else: ?>
            <a href="/gererclient">Ajoutez des clients</a>
            <?php endif; ?>          
            
          </li>
          <li>

            <?php if($ex[0] == 'archiveclient'):?>
            <a href="/archiveclient" style="color: #eded07">L'archive des clients</a>
            <?php else: ?>
            <a href="/archiveclient">L'archive des clients</a>
            <?php endif; ?> 
            
          </li>
          <?php if($_SESSION['user'] != false): ?>
          <li style="float: right" class="logout">
            <a style="color: red" href="/logout">Déconnecter</a>
          </li>
          <?php endif;?>
      </ul>
  </nav>
  <!-- End navbar-->
  </div>
</header>
<!-- End Header-->
