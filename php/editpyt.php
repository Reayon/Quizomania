<?php 
session_start();

	include("connection.php");
	include("function.php");

	$user_data = check_login($con);
    $_SESSION['chuj'];
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

    $_SESSION['chuj'] = $pytanie_id;
    $sql1 = "INSERT INTO odpowiedzi (ID_pytania, odp, czy_poprawna) VALUES ('$pytanie_id', ' ', 1)";
    $sql2 = "INSERT INTO odpowiedzi (ID_pytania, odp, czy_poprawna) VALUES ('$pytanie_id', ' ', 0)";
    $sql3 = "INSERT INTO odpowiedzi (ID_pytania, odp, czy_poprawna) VALUES ('$pytanie_id', ' ', 0)";
    $sql4 = "INSERT INTO odpowiedzi (ID_pytania, odp, czy_poprawna) VALUES ('$pytanie_id', ' ', 0)";
}

$empty = "ALTER TABLE odpowiedzi ADD CONSTRAINT odpowiedzi_limit CHECK (ID_pytania IN (SELECT ID_pytania FROM odpowiedzi GROUP BY ID_pytania HAVING COUNT(*) = 4))";
$resem = $conn->query($empty);

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
                        
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                
                                $pyt = $_SESSION['chuj'];

                                $aname = $_POST['gname'];
                                $bname = $_POST['hname'];
                                $cname = $_POST['jname'];   
                                $dname = $_POST['kname'];
                                if (empty($aname || empty($bname) || empty($cname) || empty($dname))) {
                                  echo "Name is empty";
                                } else {
                                    if($resem == true) {
                                  echo $aname;
                                  echo $bname;
                                  echo $cname;
                                  echo $dname;
                                    $upd1 = "UPDATE odpowiedzi SET odp = '$aname' WHERE ID_pytania = $pyt";
                                    $upd2 = "UPDATE odpowiedzi SET odp = '$bname' WHERE ID_pytania = $pyt";
                                    $upd3 = "UPDATE odpowiedzi SET odp = '$cname' WHERE ID_pytania = $pyt";
                                    $upd4 = "UPDATE odpowiedzi SET odp = '$dname' WHERE ID_pytania = $pyt";
                                  //$sql1 = "INSERT INTO odpowiedzi (ID_pytania, odp, czy_poprawna) VALUES ('$pyt', '$aname', 1)";
                                  //$sql2 = "INSERT INTO odpowiedzi (ID_pytania, odp, czy_poprawna) VALUES ('$pyt', '$bname', 0)";
                                  //$sql3 = "INSERT INTO odpowiedzi (ID_pytania, odp, czy_poprawna) VALUES ('$pyt', '$cname', 0)";
                                  //$sql4 = "INSERT INTO odpowiedzi (ID_pytania, odp, czy_poprawna) VALUES ('$pyt', '$dname', 0)";
                                  $sql5 = "SET FOREIGN_KEY_CHECKS=0";
                                  $sql6 = "SET FOREIGN_KEY_CHECKS=1";
                                  $result5 = $conn->query($sql5);
                                  $result1 = $conn->query($upd1);
                                  $result2 = $conn->query($upd2);
                                  $result3 = $conn->query($upd3);
                                  $result4 = $conn->query($upd4);
                                  $result6 = $conn->query($sql6);
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