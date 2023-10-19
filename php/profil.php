<?php 
session_start();

	include("connection.php");
	include("function.php");

	$user_data = check_login($con);
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="www.quizomania.pl">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styleStronaGlowna.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../src/logo.ico">
        <title>Quizomania</title>
    </head>
    <body>
        <div id="container">
        <div id="baner">
                <div id="banerL"><a href="../php/stronaGlowna.php" ><img src="../src/logo.png"/></a></div>
                <div id="banerR">
                    <div class="option"><a href="../php/logout.php">Wyloguj</a></div>
                    <div class="option"><a href="../php/profil.php">Profil</a></div>
                    <div class="option"><a href="../php/stronaGlowna.php" >Strona główna</a></div>
                    <div style="clear: both;"></div>
            </div>
            </div>
            <div id="content">
                <p><h1>Twój profil </h1>
	                <br>
	                Witaj, <?php echo $user_data['username']; ?>
                    <button type="submit" class="btn btn-warning"><a href="logout.php">Wyloguj</a></button>
		            </div>
	            </p>
            </div>
            <div id="footer">Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone</div>
        </div>
    </body>
</html>