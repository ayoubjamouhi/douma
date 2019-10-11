<!DOCTYPE html>
<html>
<head>
  <title>Se connecter</title>
  <link rel="stylesheet" href="public/css/style.css">
</head>
<body >

  <main style="background: none">
    <div class="login">
      <div class="container">

        <form action="checklogin" method="post">
          <div>
            <span>Nom d'utilisateur</span><br><br>
            <input type="text" name="username" placeholder="username">                                        
          </div>
          <div>           
            <span>Password</span><br><br>
            <input type="password" name="password" placeholder="password">
          </div>    
          
          <div>
            <button type="submit" name="login">Login</button>      
          </div>
        </form>

      </div>
    </div> 
     
  </main>

</body>
</html>

