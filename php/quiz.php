<?php 
session_start();

	include("connection.php");
	include("function.php");

	$user_data = check_login($con);


    
// Połączenie z bazą danych za pomocą PDO
$servername = "localhost"; // Adres serwera MySQL
$username = "root"; // Twój login do bazy danych
$password = ""; // Twoje hasło do bazy danych
$database = "quizy"; // Nazwa Twojej bazy danych

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Błąd połączenia z bazą danych: " . $e->getMessage());
}

// Zerowanie komunikatów
unset($_SESSION['message']);

// Obsługa formularza
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selectedAnswer = $_POST["answer"];
    $correctAnswer = $_POST["correct_answer"];

    if ($selectedAnswer === $correctAnswer) {
        $_SESSION['message'] = "Twoja odpowiedź jest poprawna!";
    } else {
        $_SESSION['message'] = "Twoja odpowiedź jest niepoprawna.";
    }
    // Przekierowanie na tę samą stronę, aby uniknąć ponownego przesłania formularza
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

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
    <link rel="icon" type="image/x-icon" href="../src/logo.ico">
        <title>Quizomania</title>
    </head>
    <body>
        <div id="container">
        <div id="baner">
                <div id="banerL"><a href="../php/stronaGlowna.php" ><img src="../src/logo.png"/></a></div>
                <div id="banerR">
                    <div class="option"><a href="../php/logout.php">Wyloguj</a></div>
                    <div class="option"><a href="../php/profil.php">Profil</a></div>
                    <div class="option"><a href="../php/stronaGlowna.php" >Strona główna</a></div>
                    <div style="clear: both;"></div>
            </div>
            </div>
            <div id="content">
                <?php

try {
$stmt = $pdo->prepare('SELECT pytania.id_pytania, pytania.tresc AS pytanie, odpowiedzi.tresc AS odpowiedz, odpowiedzi.czy_poprawna
FROM pytania
INNER JOIN odpowiedzi ON pytania.id_pytania = odpowiedzi.id_pytania
LIMIT 4');
$stmt->execute();

// Wyświetlanie pytania
if ($stmt->rowCount() > 0) {
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<h3>Pytanie: " . $row["pytanie"] . "</h3>";

// Wyświetlanie odpowiedzi w formie formularza
echo "<form method='post'>";
do {
    echo "<input type='radio' name='answer' value='{$row['odpowiedz']}'> " . $row["odpowiedz"] . "<br>";
} while ($row = $stmt->fetch(PDO::FETCH_ASSOC));

echo "<input type='hidden' name='correct_answer' value='";
echo $row["odpowiedz"];
echo "'>";
echo "<input type='submit' value='Sprawdź odpowiedzi'>";
echo "</form>";
} else {
echo "Brak pytań i odpowiedzi w bazie danych.";
}
} catch (PDOException $e) {
die("Błąd podczas pobierania danych z bazy danych: " . $e->getMessage());
}

// Zakończenie połączenia z bazą danych
$pdo = null;
        ?>
            </div>
            <div id="footer">Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone</div>
        </div>
    </body>
</html>