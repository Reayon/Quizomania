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
        <link rel="stylesheet" href="../css/buttons.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../src/logo3.ico">
        <title>Quizomania</title>
    </head>
    <body>
    <header>
			<img class="logo" src="../src/logo3.png" alt="logo">
				<nav>
					<ul class="nav_links">
							<li><a href="../php/stronaGlowna.php">Strona główna</a></li>
							<li><a href="#" >Nasze quizy</a></li>
                            <li><a href="../php/edytor.php" >Edytor quizów</a></li>
							<li><a href="#" >O nas</a></li>
					</ul>
				</nav>
					<a class="cta" href="../php/logout.php"><button>Wyloguj sie</button></a>
		</header>
        <div class="menu">
                <!---<form>
                    <div class="txt_field">
                        <input type="text" class="form-control" placeholder="Wyszukaj po nazwie" name="search" value="<?php echo $search ?>">
                    </div>
                </form>--->
                <h2>Lista Quizów</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Pomyślnie usunięto</th>
                            <th scope="col"></th>
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

                            $result = $conn->query($query);

                        }
                        echo "<td><a style='color: black;' href='edytor.php'>Wróć do quizów</a></td>";
                    ?>
                    </table>
                </div>
                <footer>
            	<div class="footer-bottom">
					<h2>Quizomania</h2>
						Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone.
				</div>
			</footer>
    </body>
</html>