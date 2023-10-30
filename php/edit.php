<?php 
session_start();

	include("connection.php");
	include("function.php");

	$user_data = check_login($con);

?>
<?php

// Zapytanie do bazy danych w celu pobrania kategorii
//$query = "SELECT * FROM pytania WHERE ID_kategorii = $category_id";
//$result = $conn->query($query);
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
        <!-- SKRYPT ODPOWIEDZIALNY ZA SCROLLBAR -->
        <script>
            // Opcjonalne: Jeśli chcesz umożliwić dynamiczne dostosowywanie wysokości tabeli na podstawie zawartości
            window.addEventListener('DOMContentLoaded', () => {
                const tableContainer = document.querySelector('.table-container');
                const table = document.querySelector('table');

                // Dostosuj maksymalną wysokość kontenera tabeli w zależności od zawartości
                tableContainer.style.maxHeight = (window.innerHeight - tableContainer.getBoundingClientRect().top) + 'px';
            });
        </script>


        <style>

        /* MENU - div srodka strony */      

        .menu{
            display: block;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .menu p{
            font-weight: 15px;
        }

        /* TABELA - div odpowiedający za tabele */

        .tabela{
            display: block;
            margin: auto;
            margin-top: 70px;
            width: 70%;
            overflow-y: scroll;
            max-height: 340px;
        }
    
        .tabela p{
            font-weight: 50px;
        }

        /* TITLE - naglowek strony z odkreślajacą linią */

        .title{
            border-bottom: 1px solid black;
        }

        /* CRUD - ciało tabeli do edycji */

        .crud{
            border-collapse: collapse;
            margin: 25px, 0;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
        }

        .crud thead tr{
            background-color: #b3b3b3;
            height: 50px;
            color: black;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
        }

        .crud th{
            padding-left: 50px;
            padding-right: 50px;
        }

        .crud td{
            padding: 12px, 15px;
        }

        .crud tbody tr{
            border-bottom: 1px solid black;
        }

        .crud tbody tr:nth-of-type(even){
            background-color: f3f3f3;
        }

        .crud tbody tr:last-of-type{
            border-bottom: 1px solid #737373;
        }

        /* BUTTON - przycisk powrotu */

        button {
            margin-left: 20px;
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

        </style>
    <body>
    <header style="height: 60px">
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
        <div class="menu" style="height: 700px">
        <div class="title">
                <h2>NARZĘDZIE DO EDYCJI</h2>
                <p>Dodaj pytanie - służy do dodania własnego pytania w danej kategorii.</p>
                <p>Edytuj pytanie - służy do napisania czterech odpowiedzi na to pytanie: jednej poprawnej i trzech błędnych.</p>
                <p>Usuń pytanie - służy do usuwania własnego pytania i zawartych w nich odpowiedzi.</p>
                <p style="color:red">UWAGA: zanim usuniesz kategorie musisz usunąć związane z nią pytania i odpowiedzi!!!</p>
                </div>
                <div class="tabela">
                <table class="crud">
                    <thead>
                        <tr>
                            <th scope="col">Treść pytania</th>
                            <th scope="col">Odpowiedzi</th>
                            <th scope="col">Edytuj</th>
                            <th scope="col">Usuń</th>
                        </tr>
                        <!--
                        <tr>
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                <p>Nazwa kategorii: <input type="text" name="fname"></p><br>
                                <p><input type="submit"></p><br>
                            </form>
                            -->
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
                        /*if (isset($_GET['category'])) {
                            $category_id = $_GET['category'];
                            echo "<td><a style='color: black;' href='addpyt.php?category=$category_id'>Dodaj pytanie</a></td>";
                            $query = "SELECT * FROM pytania WHERE ID_kategorii = $category_id";
                            $result = $conn->query($query);
                            
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            $pytanie_id = $row['ID_pytania'];
                            $pytanie_nazwa = $row['tresc'];
                            echo "<tr>";
                            echo "<td><p>$pytanie_nazwa</p></td>";
                            echo "<td><a style='color: black;' href='editpyt.php?pytanie=$pytanie_id'>Edytuj pytanie</a></td>";
                            echo "<td><a style='color: black;' href='deletepyt.php?pytanie=$pytanie_id'>Usuń pytanie</a></td>";
                            echo "</tr>";
                            }
                        } else {
                            echo "Brak dostępnych pytań.";
                        }
                        }

                        /*if (isset($_GET['category'])) {
                            $category_id = $_GET['category'];
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // collect value of input field
                                $name = $_POST['fname'];
                                if (empty($name)) {
                                  echo "Name is empty";
                                } else {
                                    echo $name;
                                  $sql = "INSERT INTO pytania (ID_kategorii, tresc) VALUES ('$category_id', '$name')";
                                  $result = $conn->query($sql);
                                }
                            }
                        }
                        
                        echo "<td><a style='color: black;' href='edytor.php'>Wróć do quizów</a></td>";*/
                        if (isset($_GET['category'])) {
                            $category_id = $_GET['category'];
                            echo "<td><a style='color: black;' href='addpyt.php?category=$category_id'>Dodaj pytanie</a></td>";
                            $query = "SELECT * FROM pytania WHERE ID_kategorii = $category_id";
                            $result = $conn->query($query);
                        
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $pytanie_id = $row['ID_pytania'];
                                    $pytanie_nazwa = $row['tresc'];
                                    echo "<tr>";
                                    echo "<td><p>$pytanie_nazwa</p></td>";
                        
                                    // Pobierz odpowiedzi dla tego pytania
                                    $odpowiedzi_query = "SELECT * FROM odpowiedzi WHERE ID_pytania = $pytanie_id";
                                    $odpowiedzi_result = $conn->query($odpowiedzi_query);
                        
                                    if ($odpowiedzi_result->num_rows > 0) {
                                        echo "<td>";
                                        while ($odpowiedz_row = $odpowiedzi_result->fetch_assoc()) {
                                            $odpowiedz_tresc = $odpowiedz_row['odp'];
                                            echo "<p>$odpowiedz_tresc</p>";
                                        }
                                        echo "</td>";
                                    } else {
                                        echo "<td>Brak odpowiedzi.</td>";
                                    }
                        
                                    echo "<td><a style='color: black;' href='editpyt.php?pytanie=$pytanie_id'>Edytuj pytanie</a></td>";
                                    echo "<td><a style='color: black;' href='deletepyt.php?pytanie=$pytanie_id'>Usuń pytanie</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "Brak dostępnych pytań.";
                            }
                        }?>
                    </table>
                    
                </div>
                <button onclick="location.href='edytor.php'" type="button">Wróć do edytora</button>
                    </div>
                <footer style="height: 150px">
            	<div class="footer-bottom">
					<h2>Quizomania</h2>
						Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone.
				</div>
			</footer>
    </body>
</html>