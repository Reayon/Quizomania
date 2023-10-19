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
        <link rel="stylesheet" href="../css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../src/logo.ico">
        <title>Quizomania</title>
    </head>
    <body>
        <div id="container">
            <div id="content">
                <img src="../src/logo2.png">
                <div id="box">
		        <form method="post">
			    <div style="font-size: 20px;margin: 10px;color: white;"><h1>Zaloguj się</h1></div>
				<label class="form-label">Login</label>
			    <input id="text" type="text" name="username"><br><br>
				<label class="form-label">Hasło</label>
			    <input id="text" type="password" name="password"><br><br>
			    <input id="button" type="submit" value="Login"><br>
			    <a href="../php/signup.php">Zarejestruj się</a>
		</form>
		</div>
            </div>
            <div id="footer">Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone</div>
        </div>
    </body>
</html>