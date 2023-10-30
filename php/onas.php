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
		.menu{
			text-align: center;
		}
		p{
			margin: 30px;
			font-size: 17px;
		}
        .tabela{
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            text-align: center;
            background: white;
        }

        h2{
			font-size: 30px;
            text-align: center;
        }

        .content-table{
            width: 50%;
            height: auto;
            overflow: hidden;
            font-size: 25px;
            text-decoration: none;
            align-items: center;
            border: 1px solid #666666;
            padding: 10px;
        }

        .content-table a{
            color: black;
            font-size: 20px;
        }

        .content-table a:hover{
            transition: .5s;
            border-color: #2691d9;
        }

        .content-table a:visited{
            transition: .5s;
            border-color: #2691d9;
        }

        .content-table thead th{
            background: #2691d9;
            width: 100%;
            height: 50px;
            color: white;
            font-size: 25px;
            text-decoration: none;
            text-align: center;
        }

        .content-table tbody
        {
            color: black;
            width: 100%;
            font-size: 25px;
            background-color: #2980b9;
        }

        .content-table tbody td{
            display: block;
            background: linear-gradient(120deg, #2980b9, #8e44ad);
            width: 100%;
            text-align: center;
            font-size: 20px;
            padding-bottom: 20px;
            font-weight: bold;
        }
        input[type="submit"]{
            width: 40%;
            height: 50px;
            border: 1px solid;
            background: #2691d9;
            border-radius: 25px;
            font-size: 18px;
            color: #e9f4fb;
            font-weight: 700;
            outline: none;
            cursor: pointer;
        }

        input[type="submit"]:hover{
            border-color: #2691d9;
            transition: .5s;
        }
        .searchbar{
            width: 100%;
            height: 10px;
            background: rgba(255,255,0,0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 60px;
            padding: 20px;
            font-size: 15px;
            margin-top: 10px;
            margin-right: 50px;
            backdrop-filter: blur(4px) saturate(180%);
        }

        .searchbar button{
            display: block;
            border: 0;
            outline: none;
            font-size: 20px;
            color: #cac77c;
            font-family: 'Poppins', sans-serif;
        }

        .searchbar i {
           color: white;
           margin-right: 30px;
        }

        .searchbar button[type="submit"]{
            border-radius: 20px;
            height: 40px;
            width: 30px;
            background: #58629b;
            cursor: pointer;
            margin-left: 10px;
        }

        .search{
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .search h2{
            margin-right: 50px;
        }

        .searchbar input img[type="submit"]{
            width: 5px;
            height: 5px;
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