<?php 

  session_start();
  if(isset($_SESSION['login'])){
    header("Location: cabinet.php");
    exit;
  }


?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" >
    <meta name="author" content="">
    <meta name="description" content="">
    <title>Application</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  </head>
  <body> 
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a style="color: white" href="inscription.php"><p><b> Зарегистироваться </b></p></a></li>
            <li><a style="color: white" href="espace.php"><b> Авторизаться </b> </a></li>     
          </ul>
        </div>
      </div>
    </div>
  </body>
</html>











