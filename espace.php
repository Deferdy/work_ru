<?php 

  session_start();
  require('admin/database.php');
  $db = Database::connect();

  $Error = $error = "";

  if(isset($_SESSION['login'])){
    header("Location: cabinet.php");
    exit;
  }   

 
  if (!empty($_POST)) {
    
    extract($_POST);
    $login = checkInput($_POST['login']);
    $password= checkInput($_POST['password']);
    $valid = true ;
  
     

    if (empty($_POST['login']) OR empty($_POST['password'])) {

      $Error = " Поля не заполнены";
      $valid = false;
   
    } 

   
      
    $req= $db-> prepare ("SELECT * FROM inscrit WHERE login = :login AND password = :password " );
    $req -> execute(array ("login"=> $login, "password" => $password ));

    $req = $req->fetch();
    
    if (!$req['login']) { 
      
      $valid = false;
      $error = "Логин и пароль не существуют" ;
      
    } 


    if ($valid){

      $_SESSION['id'] = $req['id'];

      $_SESSION['login'] = $req['login'];

      $_SESSION['password'] = $req['password'];

      header("Location: cabinet.php");
      exit;
    }
  }



  function checkInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Application</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a style="color: white" href="index.php"><b>Старт</b></a></li>
            <li><a style="color: white" href="inscrition.php"><b> Регистрация</b></a></li>
          </ul>
        </div>
      </div>
    </div>
    <br><br><br><br>
    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4 padding-right">
            <div class="signup-form">
              <p style="padding-top: 15px">
                <h3> Авторизация </h3> <br>
                <span style="color: red"><b><?php echo $error; ?></b></span>
                <form class="form-inline" action="espace.php" method="post" style="margin-top: 25px"> 
                  <P><input class="sr-only" for="inlineFormInput"></P>
                  <P><input type="text" name="login" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" value="" placeholder="Логин"></P>
                  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                    <input type="password" name="password" class="form-control" id="inlineFormInputGroup" value="" placeholder="Пароль">
                  </div>
                  <br><br>
                  <button type="submit" name="submit" class="btn btn-success">Войти</button>
                </form><br>
                <strong><span style="color: red"><?php echo $Error; ?></span></strong>
              </p>
            </div>
            <br> <br>
          </div>
        </div>
      </div>
    </section>
  </body>   
</html>


