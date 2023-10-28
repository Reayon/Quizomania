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
        <header style="height: 125px">
			<img class="logo" src="../src/logoquiz.png" alt="logo">
				<nav>
					<ul class="nav_links">
							<li><a href="../php/stronaGlowna.php">Strona główna</a></li>
							<li><a href="#" >Nasze quizy</a></li>
							<li><a href="#" >O nas</a></li>
					</ul>
				</nav>
					<a class="cta" href="../php/logout.php"><button>Wyloguj sie</button></a>
		</header>
        <div style='height: 600px;' class="menu">
                <h2>Test zakonczono!</h2>
            <p>Ukonczono test z wybranej kategorii</p>
            <p>Twój wynik koncowy wynosi: <?php echo $_SESSION['score']?></p>
                <?php 
                    $_SESSION['score'] = 0;
                ?> 
            <a href="stronaGlowna.php" class="start">Spróbuj ponownie</a>

		</div>
                <footer>
                    <div class="footer-bottom">
                    <h2>Quizomania</h2>
                        Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone.
                    </div>
                </footer>
        </body>
</html>