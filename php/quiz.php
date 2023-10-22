<?php 
session_start();

	include("connection.php");
	include("function.php");

	$user_data = check_login($con);  
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

// Inicjowanie sesji na początku quizu
if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
}

// Zainicjowanie zmiennej do przechowywania informacji o poprawności odpowiedzi
$answer_result = "";

// Sprawdzenie, czy została przekazana kategoria
if (isset($_GET['category'])) {
    $category_id = $_GET['category'];

    // Pobranie wszystkich pytań i odpowiedzi dla wybranej kategorii
    $query = "SELECT pytania.id_pytania, pytania.tresc, odpowiedzi.id_odpowiedzi, odpowiedzi.odp, odpowiedzi.czy_poprawna
              FROM pytania
              JOIN odpowiedzi ON pytania.id_pytania = odpowiedzi.id_pytania
              WHERE pytania.id_kategorii = $category_id
              ORDER BY pytania.id_pytania, RAND()";
    

    $result = $conn->query($query);
    $questions = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $question_id = $row['id_pytania'];
            if (!isset($questions[$question_id])) {
                $questions[$question_id] = array(
                    'pytanie' => $row['tresc'],
                    'odpowiedzi' => array()
                );
            }
            $questions[$question_id]['odpowiedzi'][] = array(
                'id' => $row['id_odpowiedzi'],
                'odpowiedz' => $row['odp'],
                'czy_poprawna' => $row['czy_poprawna']
            );
        }
    }

    
    echo "<h1>Kategoria Quizu</h1>";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finish_quiz'])) {
        // Sprawdzenie odpowiedzi i wyświetlenie wyniku
        $user_answers = isset($_POST['user_answers']) ? $_POST['user_answers'] : array();
        $score = 0;

        foreach ($user_answers as $question_id => $user_answer_id) {
            $correct_answer = null;

            foreach ($questions[$question_id]['odpowiedzi'] as $answer) {
                if ($answer['czy_poprawna']) {
                    $correct_answer = $answer['id'];
                    break;
                }
            }

            if ($user_answer_id == $correct_answer) {
                $score++;
            }
        }

        echo "<p>Twój wynik: $score / " . count($questions) . "</p>";
    } else {
        // Wyświetlenie wszystkich pytań i odpowiedzi
        foreach ($questions as $question_id => $question_data) {
            echo "<p><strong>Pytanie:</strong> " . $question_data['pytanie'] . "</p>";
            echo "<form method='post'>";
            foreach ($question_data['odpowiedzi'] as $answer) {
                echo "<label><input type='radio' name='user_answers[$question_id]' value='" . $answer['id'] . "'>" . $answer['odpowiedz'] . "</label><br>";
            }
            echo "</form>";
        }

        // Przycisk "Zakończ" po wybraniu odpowiedzi
        echo '<form method="post">';
        echo '<input type="submit" name="finish_quiz" value="Zakończ">';
        echo '</form>';
    }
} else {
    echo "Nie wybrano kategorii.";
}
                ?>
            </div>
            <div id="footer">Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone</div>
        </div>
    </body>
</html>