<?php 
session_start();

    include("connection.php");
    include("function.php");


<<<<<<< HEAD
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $username = $_POST['username'];
        $password = $_POST['password'];
=======
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
>>>>>>> be23d63f15b6ca59e4c5c8bfdbc9c2473b3c76cc

        if(!empty($username) && !empty($password) && !is_numeric($username))
        {

<<<<<<< HEAD
            //save to database
            $userid = random_num(20);
            $query = "insert into users (userid,username,password) values ('$userid','$username','$password')";
=======
			$userid = random_num(20);
			$query = "insert into users (userid,username,password) values ('$userid','$username','$password')";
>>>>>>> be23d63f15b6ca59e4c5c8bfdbc9c2473b3c76cc

            mysqli_query($con, $query);

<<<<<<< HEAD
            header("Location: stronaGlownaLogin.php");
            die;
        }else
        {
            echo "Please enter some valid information!";
        }
    }
=======
			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
>>>>>>> be23d63f15b6ca59e4c5c8bfdbc9c2473b3c76cc
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="www.quizomania.pl">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styl.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../src/logo3.png">
        <title>Quizomania</title>
    </head>
    <body>
		<header>
			<img class="logo" src="../src/logo3.png" alt="logo">
		</header>
        <div class="center">
		        <form method="post">
			    <h1>Zarejestruj się</h1>
				<div class="txt_field">
				<input id="text" type="text" name="username" required>
					<span></span>
					<label>Username</label>	
				</div>
				<div class="txt_field">
				<input id="password" type="password" name="password" required>
					<span></span>
					<label class="form-label">Hasło</label>
				</div>
			    <input type ="submit" value="Zarejestruj się">
					<div class="signup_link">
					Masz konto już konto? <a href="../php/login.php">Zaloguj się</a>
				</div>
		</form>
		</div>
			<footer>
            	<div class="footer-bottom">
					<h2>Quizomania</h2>
						Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone.
				</div>
			</footer>
    </body>
</html>