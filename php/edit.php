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
        <link rel="stylesheet" href="../css/buttons.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../src/logo3.ico">
        <title>Quizomania</title>
    </head>
        <style>
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
        }

        .crud th{

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

        </style>
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
                <table class="crud">
                    <thead>
                        <tr>
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                <p>Nazwa kategorii: <input type="text" name="fname"></p><br>
                                <p><input type="submit"></p><br>
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
                        }*/
                        
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