<?php 

session_start();

	include("connection.php");
	include("function.php");

	$error_message = "";

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];
	
		if(!empty($username) && !empty($password) && !is_numeric($username)) {
	
			// Użycie przygotowanej instrukcji dla lepszej ochrony
			$stmt = $con->prepare("SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1");
			$stmt->bind_param("ss", $username, $username);
			$stmt->execute();
	
			$result = $stmt->get_result();
	
			if($result && $result->num_rows > 0) {
				$user_data = $result->fetch_assoc();
				
				// Użycie password_verify do sprawdzenia hasła
				if(password_verify($password, $user_data['password'])) {
					$_SESSION['userid'] = $user_data['userid'];
					header("Location: stronaGlowna.php");
					die;
				} else {
					$error_message = "Podane hasło jest nieprawidłowe.";
				}
			} else {
				$error_message = "Użytkownik o podanym username/emailu nie istnieje.";
			}
		} else {
			$error_message = "Proszę podać prawidłowy username/email i hasło.";
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
    	<link rel="icon" type="image/x-icon" href="../src/logo3.png">
		<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=Poppins:wght@300&display=swap" rel="stylesheet">
        <title>Quizomania</title>
    </head>
	<style>
		.error-message {
		color: red;
		font-size: 16px;
		text-align: center;
		margin-top: 10px;
		font-weight: bold;
	}
	</style>

    <body>
		<header>
			<img src="../src/logo3.png" class="logo"  alt="logo">
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
					<input type="password" name="password" required>
					<span></span>
					<label>Password</label>	
				</div>
				<div class="pass">Forgot Password?</div>
					<input type ="submit" value="Login">
					<div class="signup_link">
						Nie masz konta? <a href="../php/signup.php">Zarejestruj się</a>
					</div>
		</form>
			<?php if(!empty($error_message)): ?>
        	<div class="error-message"><?php echo $error_message; ?></div>
    		<?php endif; ?>
		</div>
            <footer>
            	<div class="footer-bottom">
				<h2>Quizomania</h2>
					Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone.
				</div>
			</footer>
    </body>
</html>