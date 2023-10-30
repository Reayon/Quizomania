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

if (isset($_GET['pytanie'])) {
    $pytanie_id = $_GET['pytanie'];

    $_SESSION['sesja'] = $pytanie_id;
}

//$empty = "ALTER TABLE odpowiedzi ADD CONSTRAINT odpowiedzi_limit CHECK (ID_pytania IN (SELECT ID_pytania FROM odpowiedzi GROUP BY ID_pytania HAVING COUNT(*) = 4))";
//$resem = $conn->query($empty);

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
            top: 65%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .srodek p{
            text-align: center;
        }
        
        .srodek button{
            float: right;
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
                            <li><a href="../php/edytor.php" >Edytor quizów</a></li>
							<li><a href="onas.php" >O nas</a></li>
                            <li><a href="#" >Witaj, <?php echo $user_data['username']; ?><i class="bi bi-person-fill"></i></a></li>
					</ul>
				</nav>
					<a class="cta" href="../php/logout.php"><button>Wyloguj sie</button></a>
		</header>
        <div class="menu" style="height: 680px">
        <div class="title">
            <h2>KREATOR ODPOWIEDZI NA PYTANIE</h2>
            <p>Stwórz nazwy odpowiedz na twoje pytania/e.</p>
            <p>Wprowadź treści pytań w tym jedną poprawną i trzy błędne kliknij "Zatwierdź odpowiedzi", jeśli poprawnie wypełniłeś pola z wprowadzeniem treści odpowiedzi zostaną dodane a ty otrzymasz komunikat
            ,następnie "Wroć do edytora"</p>
            <p style="color:red">UWAGA: Wszystkie z czterech odpowiedzi muszą być wypełnione</p>
            </div>
            <div class="srodek">
                <table class="tabela"></table>
                    <thead>
                        <tr>
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                <p>Wpisz treść poprawnej odpowiedzi: <input type="text" name="gname"></p>
                                <p>Wpisz treść złej odpowiedzi: <input type="text" name="hname"></p>
                                <p>Wpisz treść złej odpowiedzi: <input type="text" name="jname"></p>
                                <p>Wpisz treść złej odpowiedzi: <input type="text" name="kname"></p><br>
                                <p><input type="submit" value="Zatwierdź odpowiedzi"></p>
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
                        
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                
                                $pyt = $_SESSION['sesja'];

                                $aname = $_POST['gname'];
                                $bname = $_POST['hname'];
                                $cname = $_POST['jname'];   
                                $dname = $_POST['kname'];
                                if (empty($aname) || empty($bname) || empty($cname) || empty($dname)) {
                                    echo "<p style=color:red>Twoje odpowiedzi są puste</p>";
                                } else {
                                    echo "<tr>";
                                    echo "<p style=color:green>Dodano odpowiedzi!</p>";
                                    echo "<p>Twoje dodane odpowiedzi to:</p>";
                                    echo "<p>$aname, $bname, $cname, $dname</p>";
                                    echo "</tr>";
                                  $sql = "DELETE FROM odpowiedzi WHERE ID_pytania = $pyt";
                                  $result5 = $conn->query($sql);
                                  $sql1 = "INSERT INTO odpowiedzi (ID_pytania, odp, czy_poprawna) VALUES ('$pyt', '$aname', 1), ('$pyt', '$bname', 0), ('$pyt', '$cname', 0), ('$pyt', '$dname', 0)";
                                  $sql5 = "SET FOREIGN_KEY_CHECKS=0";
                                  $sql6 = "SET FOREIGN_KEY_CHECKS=1";
                                  $result5 = $conn->query($sql5);
                                  $result1 = $conn->query($sql1);
                                  $result6 = $conn->query($sql6);
                                    }
                                }
                    ?>
                            </tbody>
                            <button onclick="location.href='edytor.php'" type="button">Wróć do edytora</button>
                    </table>
                </div>
        </div>
        <footer style="height: 150px">
            	<div class="footer-bottom">
					<h2>Quizomania</h2>
						Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone.
				</div>
			</footer>
    </body>
</html>