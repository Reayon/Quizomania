<?php 
session_start();

	include("connection.php");
	include("function.php");

	$user_data = check_login($con);
    $_SESSION['sesja'];
?>
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "quizy";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
} 

if (isset($_GET['category'])) {
    $category_i = $_GET['category'];

    $_SESSION['sesja'] = $category_i;
}
/*if (isset($_GET['category'])) {
    $category_i = $_GET['category'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['fname'];
    if (empty($name)) {
      echo "Name is empty";
    } else {
      echo $name;
      $sql = "INSERT INTO pytania (ID_kategorii) VALUES ('$category_i')";
      $result = $conn->query($sql);
    }
  }
}*/

// Zapytanie do bazy danych w celu pobrania kategorii
$query = "SELECT * FROM pytania";
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

        /* MENU - div srodka strony */ 

         .menu{
            display: inline-block;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .menu p{
            font-weight: 500px;
        }

        /* TITLE - naglowek strony z odkreślajacą linią */

        .title{
            border-bottom: 1px solid black;
        }

        /* SRODEK - div potrzebny do wyśrodkowania tabeli lub jakiegos inputa */ 

        .srodek{
            position: absolute;
            height: auto;
            width: 100%;
            text-align: center;
            justify-content: center;
            width: 70%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .srodek p{
            text-align: center;
        }

        /* TABELA - div odpowiedający za tabele */

        .tabela{
            float: right;
        }

        .tabela thead p{
            font-weight: 50px;
        }

        .tabela tbody p{
            color: green;
        }

        .tabela td button{
            padding: 9px 25px;
            background-color: rgba(0,136,169,1);
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease 0s;
        }

        /* INPUT */

        input[type="text"]{
            margin-left: 10px;
        }

        input[type="submit"]{
            width: 50%;
            height: 50px;
            border: 1px solid black;
            background: #a6a6a6;
        }

        input[type="submit"]:hover{
            border-color: white;
            transition: .5s;
        }

        /* BUTTON - przycisk powrotu */

        button:hover{
            background-color: rgba(0,136,169,0);
        }
    </style>

    <body>
    <header style="height: 100px">
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
            <h2>KREATOR PYTAN</h2>
            </div>
            <div class="srodek">
                    <p>Stwórz nazwę pytania dla twojej kategorii.</p>
                    <p>Podaj nazwę i kliknij przycisk "Zatwierdź pytanie",
                    następnie "Wroć do edytora" wyszukaj swoją kategorie na liście dostępnych i wybierz opcje edytuj pytanie aby dodać odpowiedzi.</p>
                <table class="tabela">
                    <thead>
                        <tr>
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                <p>Wpisz treść pytania: <input type="text" name="fname"></p><br>
                                <p><a href = "addodp.php"><input type="submit" value="Zatwierdź pytanie" name="submit"></p></a><br>
                            </form>
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
                        
                        if (isset($_POST['submit'])){
                        
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // collect value of input field
                            $sesja = $_SESSION['sesja'];
                            $name = $_POST['fname'];
                            if (empty($name)) {
                                echo "<p style=color:red>Nazwa twojego pytania jest pusta</p>";
                            } else {
                                echo "<tr>";
                                echo "<p style=color:green>Dodano pytanie!</p>";
                                echo "<p>Twoje dodane pytanie to: ". $name."</p>";
                                echo "</tr>";
                              $sql1 = "SET FOREIGN_KEY_CHECKS=0";
                              $sql2 = "INSERT INTO pytania (ID_kategorii, tresc) VALUES ('$sesja', '$name')";
                              $sql3 = "SET FOREIGN_KEY_CHECKS=1";
                              $result1 = $conn->query($sql1);
                              $result2 = $conn->query($sql2);
                              $result3 = $conn->query($sql3);
                            }
                          }
                        //echo mysqli_num_rows($result4);
                        //header("Location: addodp.php?pytanie=$cuj");         
                        //exit();
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