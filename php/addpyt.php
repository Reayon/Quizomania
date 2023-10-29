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

if (isset($_GET['category'])) {
    $category_i = $_GET['category'];

    $_SESSION['chuj'] = $category_i;
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
                                <p><a href = "addodp.php"><input type="submit" name="submit"></p></a><br>
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
                            $chuj = $_SESSION['chuj'];
                            $name = $_POST['fname'];
                            if (empty($name)) {
                              echo "Name is empty";
                            } else {
                              echo $name;
                              $sql1 = "SET FOREIGN_KEY_CHECKS=0";
                              $sql2 = "INSERT INTO pytania (ID_kategorii, tresc) VALUES ('$chuj', '$name')";
                              $sql3 = "SET FOREIGN_KEY_CHECKS=1";
                              $result1 = $conn->query($sql1);
                              $result2 = $conn->query($sql2);
                              $result3 = $conn->query($sql3);
                            }
                          }
                        //echo mysqli_num_rows($result4);
                        //header("Location: addodp.php?pytanie=$cuj");         
                        //exit();
                    }echo "<td><a style='color: black;' href='edytor.php'>Wróć do quizów</a></td>";
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