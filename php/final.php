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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../src/logo3.png">
        <title>Quizomania</title>
    </head>
    <style>
        .wynik{
            width: 75%;
            height: 75%;
            margin: auto;
            display: block;
            text-align: center;
        }

        .wynik h2{ 
            color: black;
            text-align: center;
            margin-top: 190px;
        }

        .wynik button{
            margin-left: 5px;
            padding: 9px 25px;
            background-color: rgba(0,136,169,1);
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease 0s;
        }

        button:hover{
            background-color: rgba(0,136,169,0);
        }

        .wynik a:visited{
            text-decoration: none;
        }

        .wynik a{
            text-decoration: none;
        }

    </style>

    <body>
        <header style="height: 125px">
			<img class="logo" src="../src/logo3.png" alt="logo">
				<nav>
					<ul class="nav_links">
							<li><a href="../php/stronaGlowna.php">Strona główna</a></li>
							<li><a href="onas.php" >O nas</a></li>
                            <li><a href="#" >Witaj, <?php echo $user_data['username']; ?><i class="bi bi-person-fill"></i></a></li>
					</ul>
				</nav>
					<a class="cta" href="../php/logout.php"><button>Wyloguj sie</button></a>
		</header>
        <div style='height: 600px;' class="menu">
            <div class="wynik">
                <h2>Test zakonczono!</h2>
            <p>Ukończono test z: <?php echo $_SESSION['kategorie'] ?></p>
<<<<<<< HEAD
            <p>Twój wynik końcowy wynosi: <?php echo $_SESSION['score']."/".$_SESSION['total_questions']?></p>
=======
            <p>Twój wynik końcowy wynosi: <?php echo $_SESSION['score'] ."/".$_SESSION['total_questions']?></p>
>>>>>>> f01d9f5ec6c08d7d410f59e1216991572e26e4d9
                <?php 
                    $_SESSION['score'] = 0;
                ?> 
            <button onclick="location.href='stronaGlowna.php'" type="button">Spróbuj Ponownie</button>
            </div>
		</div>
                <footer>
                    <div class="footer-bottom">
                    <h2>Quizomania</h2>
                        Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone.
                    </div>
                </footer>
        </body>
</html>