<?php 
session_start();

	include("connection.php");
	include("function.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password) && !is_numeric($username))
		{

			$userid = random_num(20);
			$query = "insert into users (userid,username,password) values ('$userid','$username','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="www.quizomania.pl">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styleLoginSignup.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../src/logoikona.ico">
        <title>Quizomania</title>
    </head>
    <body>
        <div id="container">
            <div id="content">
                <img src="../src/logo3.png">
                <div id="box">
		        <form method="post">
			    	<div style="font-size: 20px;margin: 10px;color: black;"><h1>Zarejestruj się</h1></div>
					<label class="form-label">Login</label>
			    	<input id="text" type="text" name="username"><br><br>
					<label class="form-label">Hasło</label>
			    	<input id="text" type="password" name="password"><br><br>
			    	<input id="button" type="submit" value="Login"><br>
			    	<a href="../php/login.php">Masz konto? Zaloguj się</a>
				</form>
				</div>
            </div>
        </div>
    </body>
</html>