<?php 
session_start();

	include("connection.php");
	include("function.php");

	$user_data = check_login($con);
?>
<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "quizy";

$conn = new mysqli($host, $username, $password, $database);
/*$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$search = $_GET['search'] ?? '';
if ($search) {
    $statement = $pdo->prepare('SELECT * FROM kategorie WHERE nazwa LIKE :nazwa');
    $statement->bindValue(':nazwa', "%$search%");
}
<form>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Wyszukaj po nazwie" name="search" value="<?php echo $search ?>">
                        <button class="btn btn-outline-secondary" type="submit">Wyszukaj</button>
                    </div>
                </form>
else{
    $statement = $pdo->prepare('SELECT * FROM kategorie ORDER BY nazwa');
}
$statement->execute();
$kategorie = $statement->fetchAll(PDO::FETCH_ASSOC);*/

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
        <link rel="stylesheet" href="../css/styleStronaGlowna.css">
        <link rel="stylesheet" href="../css/buttons.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../src/logo3.ico">
        <title>Quizomania</title>
    </head>
    <body>
        <div id="container">
        <div id="baner">
                <div id="banerL"><a href="../php/stronaGlowna.php" ><img src="../src/logo3.png"/></a></div>
                <div id="banerR">
                    <div class="option"><p>Witaj, <?php echo $user_data['username']; ?></p><a href="../php/logout.php">Wyloguj</a></div>
                    <div class="option"><a href="../php/stronaGlowna.php" >Strona główna</a></div>
                    <div style="clear: both;"></div>
            </div>
            </div>
            <div id="content">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nr</th>
                            <th scope="col">Nazwa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Wyświetlenie dostępnych kategorii
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            $category_id = $row['ID_kategorii'];
                            $category_name = $row['nazwa'];
                            echo "<li><a href='quiz.php?category=$category_id'>$category_name</a></li>";
                            }
                        } else {
                            echo "Brak dostępnych kategorii.";
                        }
                    ?>
                </table>
            </div>
            <div id="footer">Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone</div>
        </div>
    </body>
</html>