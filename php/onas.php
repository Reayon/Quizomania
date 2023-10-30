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
        <link rel="stylesheet" href="../css/styl.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../src/logo3.png">
        <title>Quizomania</title>
    </head>
    <style>

        /* MENU - div srodka strony */ 

		.menu{
			text-align: center;
		}

        /* P - paragraf całej strony */

		p{
			margin: 30px;
			font-size: 17px;
		}

        /* NAGLÓWEK H2 */
        
        h2{
			font-size: 30px;
            text-align: center;
        }


    </style>
    <body>
        <header style="height: 125px">
            <img class="logo" src="../src/logo3.png" alt="logo">
				<nav>
					<ul class="nav_links">
						<li><a href="../php/stronaGlowna.php">Strona główna</a></li>
						<li><a href="onas.php" >O nas</a></li>
                        <li><a href="edytor.php" >Edytor Quizów</a></li>
                        <li><a href="#" >Witaj, <?php echo $user_data['username']; ?><i class="bi bi-person-fill"></i></a></li>
					</ul>
				</nav>
				<a class="cta" href="../php/logout.php"><button>Wyloguj sie</button></a>
		</header>
            <div style='height: 600px;' class="menu">
                <h2>O nas</h2><br><br>
				<p>Quizomania to interaktywna strona internetowa, która umożliwia użytkownikom tworzenie, rozwiązywanie i udostępnianie różnorodnych quizów. To idealne miejsce zarówno dla pasjonatów wiedzy ogólnej, jak i dla tych, którzy chcą stworzyć spersonalizowane quizy na temat swoich zainteresowań. <p></p><br><br>
				<p>Witryna oferuje szeroki zakres kategorii, od matematyki po sport, dzięki czemu każdy znajdzie coś dla siebie. Quizomania to także społeczność, która umożliwia użytkownikom dzielenie się swoimi quizami, tworząc przy tym przyjazną atmosferę. Niezależnie od tego, czy jesteś nauczycielem, studentem, czy po prostu miłośnikiem zabawy w quizy, Quizomania to świetne miejsce do rozwijania swojej wiedzy i czerpania przyjemności z rozwiązywania oraz tworzenia quizów.</p><br><br>
				<p><i class="bi bi-envelope"></i>Adres E-mail: kontakt@quizomania.pl</p>

            </div>
        <footer>
            <div class="footer-bottom">
                <h2>Quizomania</h2>
                    Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone.
            </div>
		</footer>
    </body>
</html>