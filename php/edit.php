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
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                <p>Wpisz treść pytania: <input type="text" name="fname"></p><br>
                                <p>Wpisz treść poprawnej odpowiedzi: <input type="text" name="gname"></p><br>
                                <p>Wpisz treść złej odpowiedzi: <input type="text" name="hname"></p><br>
                                <p>Wpisz treść złej odpowiedzi: <input type="text" name="jname"></p><br>
                                <p>Wpisz treść złej odpowiedzi: <input type="text" name="kname"></p><br>
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
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // collect value of input field
                                $name = $_POST['fname'];
                                //echo "lacze sie";
                                //$aname = $_POST['gname'];
                                //$bname = $_POST['hname'];
                                //$cname = $_POST['jname'];
                                //$dname = $_POST['kname'];
                                if (empty($name)) {
                                  echo "Name is empty";
                                } else {
                                    echo $name;
                                  //echo $aname;
                                  //echo $bname;
                                  //echo $cname;
                                  //echo $dname;
                                  $sql = "INSERT INTO pytania (ID_kategorii, tresc) VALUES ('$category_id', '$name')";
                                  //$sql1 = "INSERT INTO odpowiedzi (ID_pytania, odp, czy_poprawna) VALUES ('$category_id', '$aname', 1)";
                                  //$sql2 = "INSERT INTO odpowiedzi (ID_pytania, odp, czy_poprawna) VALUES ('$category_id', '$bname', 0)";
                                  //$sql3 = "INSERT INTO odpowiedzi (ID_pytania, odp, czy_poprawna) VALUES ('$category_id', '$cname', 0)";
                                  //$sql4 = "INSERT INTO odpowiedzi (ID_pytania, odp, czy_poprawna) VALUES ('$category_id', '$dname', 0)";
                                  $result = $conn->query($sql);
                                  //$result1 = $conn->query($sql1);
                                  //$result2 = $conn->query($sql2);
                                  //$result3 = $conn->query($sql3);
                                  //$result4 = $conn->query($sql4);
                                }
                            }
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