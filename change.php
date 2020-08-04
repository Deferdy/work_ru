<?php
  
  session_start();
  require 'admin/database.php';
 
      
  if(!isset($_SESSION['login'])){

    header("Location: espace.php");
    exit;
  } 

  
   
  $fioError = $passwordError = $r_passwordError = $message = "";
  

  if(!empty($_POST)) { 
  
    $fio               = checkInput($_POST['fio']);
    $password          = (checkInput($_POST['password']));
    $isSuccess         = true;

    if(empty($fio)) { 
      
      $fioError = 'Ошибка , Введите новое ФИО';
      $isSuccess = false;
     
    }

    if (empty($_POST['password'])){

      $passwordError = " Ошибка , Введите новый пароль";
      $success = false;
    }

    if (empty($_POST['r_password'])){

      $r_passwordError = " повторите новый пароль ";
      $success = false;
    }

    if (!empty($_POST['password']) AND !empty($_POST['r_password']) ){

      if( $_POST['password'] != $_POST['r_password'] ) { 

        $r_passwordError = " Пароли не совпадают";
        $success = false;

      } else {

          $success = true ;
        }
    }
     

    
    if($isSuccess )  {

      $db = Database::connect();
      $statement = $db->prepare("UPDATE inscrit SET fio =? , password =? WHERE login ='{$_SESSION['login']}' ");

      $statement->execute(array($fio,$password));
         
      Database::disconnect();
          
      header("Location: change.php");
      $message = " Пароль и ФИО успешно изменены " ;  
      exit;        
    }
  }
    
    // else{
    //     $db =Database::connect();
    //     $statement = $db->prepare("SELECT * FROM exercice WHERE id=?");
    //     $statement->execute(array($id));
    //     $item = $statement->fetch() ; 
    //     $name = $item['Name'];
    //     $email =$item['Email'];
    //     $text  =$item['Devoir'];
    //     $is_corrected=$item['Statut'];
    //     Database::disconnect();
    // }

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Cabinet</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  </head>
  <body> 
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
           <b><ul class="nav navbar-nav">
          <li><a style="color: white "  href="cabinet.php">Кабинет администрации</a></li>
          <li><a style="color: white" href="deconnexion.php">Выход из профиля админа </a></li>     
        </ul></b>
        </div>
      </div>
    </div>
    <br></br><br></br>
    <div id="view">
      <div class="previeww"><br><br>    
        <div style='padding-left: 25px;'>
          <h3><strong> Отредактировать </strong></h3><br><br>
          <span style="color: green"><?php echo $message; ?></span><br>
          <form class="form" role="form"action="change.php" method="post">
            <label for= "password"> Пароль :</label><br>
            <input type="password" id="password" name="password" size="25" placeholder="Пароль" value=""><br>
            <span style="color: red"><?php echo $passwordError; ?></span><br>
            <label for= "r_password"> Пароль ешё раз : </label><br>
            <input type="password" name="r_password" id="r_password" size="25" placeholder="Пароль" value=""><br> 
            <span style="color: red"><?php echo $r_passwordError; ?></span><br>
            <label for="fio"> Фио :</label><br>
            <input type="text" name="fio" id="fio" placeholder="Фио" size="35" value=""><br>
            <span style="color: red"><?php echo $fioError ; ?></span><br><br>
            <input type="submit" class="btn btn-success" name="submit" value="Отредактировать">
          </form>
        </div>
      </div>
    </div>  
  </body>
</html>

 
