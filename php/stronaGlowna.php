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
            <div id="content">
                Zalogowałeś się
                <div class="optionl"><a href="logout.php">Wyloguj</a></div>
            </div>
            <div id="footer">Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone</div>
        </div>
    </body>
</html>