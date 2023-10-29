<?php session_start(); 
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
        <link rel="stylesheet" href="../css/styl.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../src/logo.ico">
        <title>Quizomania</title>
    </head>
    <body>
        <div id="container">
        <div id="baner">
                
            <div id="content">
                <h2>Test zakonczono!</h2>
            <p>Gratulacje! Ukonczyles test.</p>
            <p>Wynik koncowy: <?php echo $_SESSION['score']?></p>
                <?php 
                    $_SESSION['score'] = 0;
                ?> 
            <a href="quiz.php?n=1" class="start">Spróbuj ponownie</a>

		</div>
            </div>
            <div id="footer">Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone</div>
        </div>
    </body>
</html>