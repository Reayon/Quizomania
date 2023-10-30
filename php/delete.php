<?php 
session_start();

	include("connection.php");
	include("function.php");

	$user_data = check_login($con);
?>
<?php

// Zapytanie do bazy danych w celu pobrania kategorii
$query = "SELECT * FROM kategorie";
$result = $conn->query($query);
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
                display: block;
                text-align: center;
            }

            .title{
                border-bottom: 1px solid black;
            }

            .srodek{
                position: absolute;
                height: auto;
                width: auto;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }


        </style>

    <body>
    <header>
			<img class="logo" src="../src/logo3.png" alt="logo">
				<nav>
					<ul class="nav_links">
                    <li><a href="../php/stronaGlowna.php">Strona główna</a></li>
						<li><a href="onas.php" >O nas</a></li>
                        <li><a href="edytor.php" >Edytor Quizów</i></a></li>
                        <li><a href="#" >Witaj, <?php echo $user_data['username']; ?><i class="bi bi-person-fill"></i></a></li>
					</ul>
				</nav>
					<a class="cta" href="../php/logout.php"><button>Wyloguj sie</button></a>
		</header>
        <div class="menu">
        <div class="title">
            <h2>USUWANIE KATEGORII</h2>
            </div>
            <div class="srodek">
                <table class="tabela">
                    <thead>
                        <tr>
                            <th scope="col">Twoje rekordy zostały pomyślnie<p style=color:red>Usunięte</p></th>
                            <th scope="col"><br></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                         // Połączenie z bazą danych
                        $host = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "quizy";
     
                        $conn = new mysqli($host, $username, $password, $database);
     
                        if ($conn->connect_error) {
                            die("Błąd połączenia z bazą danych: " . $conn->connect_error);
                        } 

                        if (isset($_GET['category'])) {
                            $category_id = $_GET['category'];
                        
                            $query = "DELETE FROM kategorie WHERE ID_kategorii = $category_id";

                            $query1 = "DELETE FROM pytania WHERE ID_kategorii = $category_id";

                            $result1 = $conn->query($query1);

                            $result = $conn->query($query);

                        }                     
                    ?>
                    <td><button onclick="location.href='edytor.php'" type="button">Wróć do edytora</button></td>
                    </table>
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