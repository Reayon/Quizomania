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
        <link rel="stylesheet" href="../css/styl.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../src/logo3.ico">
        <title>Quizomania</title>
    </head>

    <style>

        .tabela{
            width: 100%;
            height: auto;
            text-align: center;
            background: white;
        }
        

        h2{
            text-align: center;
        }

        .content-table{
            width: 50%;
            height: auto;
            overflow: hidden;
            font-size: 25px;
            text-decoration: none;
            align-items: center;
            border: 1px solid #666666;
            padding: 10px;
        }

        .content-table a{
            color: black;
        }

        .content-table a:hover{
            border-color: #2691d9;
            transition: .5s;
        }

        .content-table thead th{
            background: #2691d9;
            width: 100%;
            height: 50px;
            color: white;
            font-size: 25px;
            text-decoration: none;
            text-align: center;
        }

        .content-table tbody
        {
            color: black;
            width: 100%;
            font-size: 25px;
            background-color: #2980b9;
        }

        .content-table tbody td{
            display: block;
            background: linear-gradient(120deg, #2980b9, #8e44ad);
            width: 100%;
            text-align: center;
            font-size: 20px;
            padding-bottom: 20px;
            font-weight: bold;
        }

        input[type="submit"]{
            width: 50%;
            height: 50px;
            border: 1px solid;
            background: #2691d9;
            font-size: 18px;
            color: #e9f4fb;
            font-weight: 700;
            outline: none;
            cursor: pointer;
        }

        input[type="submit"]:hover{
            border-color: #2691d9;
            transition: .5s;
        }
    </style>


    <body>
        <header style="height: 100px">
			<img class="logo" src="../src/logoquiz.png" alt="logo">
				<nav>
					<ul class="nav_links">
							<li><a href="../php/stronaGlowna.php">Strona główna</a></li>
							<li><a href="#" >Nasze quizy</a></li>
							<li><a href="#" >O nas</a></li>
					</ul>
				</nav>
					<a class="cta" href="../php/logout.php"><button>Wyloguj sie</button></a>
		</header>
    <div style="height:50%px;" class="menu">
        <div class="tabela">
    <?php
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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obsługa odpowiedzi użytkownika
        foreach ($_POST['user_answers'] as $question_id => $user_answer_id) {
            $user_answers[$question_id] = $user_answer_id;
        }
    }
        // Wyświetlenie wszystkich pytań i odpowiedzi
        foreach ($questions as $question_id => $question_data) {
            echo "<p><strong>Pytanie:</strong> " . $question_data['pytanie'] . "</p>";
            echo "<form method='post'>";
            echo "<ul class='choices'>";
            foreach ($question_data['odpowiedzi'] as $answer) {
                echo "<li><label><input type='radio' name='user_answers[$question_id]' value='" . $answer['id'] . "'>" . $answer['odpowiedz'] . "</label></li>";
            }
            echo "</ul>";
        }

        // Przycisk "Zakończ" po wybraniu odpowiedzi
        echo '<input type="submit" name="finish_quiz" value="Zakończ">';
        echo '</form>';
        if (isset($_POST['finish_quiz'])) {
            // Sprawdzenie odpowiedzi i wyświetlenie wyniku
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
    
            // Zapis wyniku do sesji
        $_SESSION['score'] = $score;

        // Przekierowanie na stronę wyników
        header("Location: final.php");
        exit();
        }
} else {
    echo "Nie wybrano kategorii.";
}
                ?>
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