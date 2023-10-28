<?php 

session_start();

	include("connection.php");
	include("function.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password) && !is_numeric($username))
		{

			//read from database
			$query = "select * from users where username = '$username' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['userid'] = $user_data['userid'];
						header("Location: stronaGlowna.php");
						die;
					}
				}
			}
		}	
	}

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
			<img src="../src/logoquiz.png" class="logo"  alt="logo">
		</header>
        <div class="center">
            <h1>Login</h1>
			<form method="post">
				<div class="txt_field">
					<input type="text" name="username" required>
					<span></span>
					<label>Username</label>	
				</div>
				<div class="txt_field">
					<input type="password" name="password" minlength="8" required>
					<span></span>
					<label>Password</label>	
				</div>
				<div class="pass">Forgot Password?</div>
					<input type ="submit" value="Login">
					<div class="signup_link">
						Nie masz konta? <a href="../php/signup.php">Zarejestruj się</a>
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