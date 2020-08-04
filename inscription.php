<?php 
    
    session_start();
    require_once ("admin/database.php");


    if (isset($_SESSION['login'])){

    	header("location : cabinet.php");
    	exit;
    }


	

	$db = Database::connect();
	
	$login = $password = $email = $fio = $r_password = $loginError = $passwordError = $emailError = $fioError = $r_passwordError = $message = "";
	
	if (isset($_POST['submit'])) {

		$login = checkInput($_POST['login']);
		$email = checkInput($_POST['email']);
		$password =checkInput($_POST['password']);
		$r_password = checkInput($_POST['r_password']);
		$fio = checkInput($_POST['fio']);
        $success = true;

		if (empty($_POST['login'])){

			$loginError = "Это объязательное поле";
			$success = false;
		} 

		if (empty($_POST['password'])){

			$passwordError = "Это объязательное поле";
			$success = false;
		}

		if (empty($_POST['r_password'])){

			$r_passwordError = "Это объязательное поле";
			$success = false;
		}

	    if (!empty($_POST['password']) AND !empty($_POST['password']) ){

	    	if( $_POST['password'] != $_POST['r_password'] ) { 

			$r_passwordError = " Пароли не совпадают";
			$success = false;

			} else {

				$success = true ;
			}
		}
	    

	    if (empty($_POST['email'])) {

	    	$emailError ="Это объязательное поле";
	    } 

	   
	    
	    if (empty ($_POST['fio'])) {

	        $fioError ="Это объязательное поле" ;
	    }

    }

    if ($success){

        $query = $db -> prepare ( " INSERT INTO inscrit (login , password , email , fio ) values (?,?,?,?)" );

        $query->execute (array( $login , $password , $email , $fio));

        $db = Database::disconnect();

        header("location: inscription.php");
        $message = "Вы успешно зарегистрированы !";
        exit;

    }

	function checkInput($data){

		$data = trim($data);
		$data = htmlspecialchars($data);
		$data = htmlentities($data);
		$data =  stripslashes($data);
		return $data;
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
	        <div class="container-fluid">
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
			            <li><a style="color: white" href="index.php"><p><b> Cтарт </b></p></a></li>
			            <li><a style="color: white" href="espace.php"><b>Авторизаться</b></a></li>     
		            </ul>
	            </div>
	        </div>
	    </div><br><br><br><br>
	    <div style='padding-left: 25px;'>
            <h3><strong> Регистрация </strong></h3><br><br>
        	<span style="color: green"><?php echo $message; ?></span>
			<form class="form" role="form"action="inscription.php" method="post">
				<label for="login"> Логин :</label><br>
				<input type="text" id="login"name="login" placeholder="Логин" size="25"value="<?php echo $login ;?>"><br>
				<span style="color: red"><?php echo $loginError; ?></span><br>
				<label for= "password"> Пароль :</label><br>
				<input type="password" id="password" name="password" size="25" placeholder="Пароль" value="<?php echo $password; ?>"><br>
				<span style="color: red"><?php echo $passwordError; ?></span><br>
				<label for= "r_password"> Пароль ешё раз : </label><br>
				<input type="password" name="r_password" id="r_password" size="25" placeholder="Пароль" value="<?php echo $r_password; ?>"><br>	
				<span style="color: red"><?php echo $r_passwordError; ?></span><br>
				<label for="email"> Email : </label><br>
				<input type="email" name="email" id="email" size="25"placeholder="Email" value="<?php echo $email; ?>"><br>
				<span style="color: red"><?php echo $emailError ; ?></span><br>
				<label for="fio"> Фио :</label><br>
				<input type="text" name="fio" id="fio" placeholder="Фио" size="35" value="<?php echo $fio; ?>"><br>
				<span style="color: red"><?php echo $fioError ; ?></span><br><br>
				<input type="submit" class="btn btn-success" name="submit" value="ЗАРЕГИСТРИРОВАТЬСЯ">
			</form>
		</div>
    </body>
</html>

	