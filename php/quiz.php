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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../src/logo3.png">
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
            font-family: 'Poppins', sans-serif;
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
            <img class="logo" src="../src/logo3.png" alt="logo">
				<nav>
					<ul class="nav_links">
							<li><a href="../php/stronaGlowna.php">Strona główna</a></li>
							<li><a href="onas.php" >O nas</a></li>
					</ul>
				</nav>
					<a class="cta" href="../php/logout.php"><button>Wyloguj sie</button></a>
		</header>
    <div style="height:50%px;" class="menu">
        <div class="tabela">
        <?php


    // Jeśli nie zainicjowaliśmy jeszcze aktualnego pytania w sesji, inicjujemy je wartością 0.
    if (!isset($_SESSION['current_question'])) {
        $_SESSION['current_question'] = 0;
        $_SESSION['score'] = 0; // Inicjacja wyniku gracza
    }

    $answer_result = "";  // Przechowuje wynik odpowiedzi użytkownika.

    // Sprawdzamy, czy kategoria została przekazana poprzez parametr GET.
    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];

    // Tworzymy zapytanie do bazy danych, które wybierze jedno losowe pytanie na podstawie aktualnego indeksu pytania.
    // Następnie dołączamy do niego cztery odpowiedzi.
    $query = "SELECT pytania.id_pytania, pytania.tresc, odpowiedzi.id_odpowiedzi, odpowiedzi.odp, odpowiedzi.czy_poprawna
    FROM (SELECT * FROM pytania WHERE id_kategorii = $category_id ORDER BY pytania.id_pytania, RAND() LIMIT 1 OFFSET {$_SESSION['current_question']}) AS pytania
    JOIN odpowiedzi ON pytania.id_pytania = odpowiedzi.id_pytania ORDER BY RAND() LIMIT 4";

    // Wykonanie zapytania.
    $result = $conn->query($query);
    $questions = array();

    // Jeśli zapytanie zwróciło jakieś wyniki, przetwarzamy je.
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

        // WYSWIETLANIE WYBRANEJ KATEGORII

        // Zapytanie do bazy danych
        $category_query = "SELECT nazwa FROM kategorie WHERE id_kategorii = $category_id";

        // Pobieranie wyniku
        $category_result = $conn->query($category_query);
        if ($category_result->num_rows > 0) {
            $category_name = $category_result->fetch_assoc()['nazwa'];
            $_SESSION['kategorie'] = $category_name;
        }

        // Wyswietlanie wyniku
        if (isset($category_name)) {
            echo "<h1>$category_name</h1>";
        } else {
            echo "<h1>BLAD KATEGORII</h1>";
        }


    // Sprawdzamy, czy metoda żądania to POST (czyli czy formularz został przesłany).
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_answers = $_POST['user_answers'];
        $correct_answer = null;
        
        // Sprawdzamy, która odpowiedź była poprawna dla obecnego pytania.
        foreach ($questions[$_SESSION['current_question']]['odpowiedzi'] as $answer) {
            if ($answer['czy_poprawna']) {
                $correct_answer = $answer['id'];
                break;
            }
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['user_answers']) && isset($_POST['user_answers'][$question_id])) {
                $user_answer = $_POST['user_answers'][$question_id];
                
                foreach ($questions[$question_id]['odpowiedzi'] as $answer) {
                    if ($answer['id'] == $user_answer && $answer['czy_poprawna']) {
                        $_SESSION['score']++;
                        break;
                    }
                }
            }
        }

        // Zwiększamy licznik pytania, aby przejść do następnego pytania.
        $_SESSION['current_question']++;

        // Sprawdzamy, czy to było ostatnie pytanie.
        $count_query = "SELECT COUNT(*) AS total FROM pytania WHERE id_kategorii = $category_id";
        $count_result = $conn->query($count_query);
        $total_questions = $count_result->fetch_assoc()['total'];
        

        // Jeśli tak, przenosimy użytkownika na stronę wyników. W przeciwnym przypadku odświeżamy stronę.
            if ($_SESSION['current_question'] >= $total_questions) {
                header("Location: final.php");
                exit();
            } else {
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            }
        }

        $count_query = "SELECT COUNT(*) AS total FROM pytania WHERE id_kategorii = $category_id";
        $count_result = $conn->query($count_query);
        $total_questions = $count_result->fetch_assoc()['total'];

        if ($_SESSION['current_question'] >= $total_questions) {
            $_SESSION['current_question'] = 0;  // Zresetuj licznik pytania
        }

        echo "<h2>Pytanie: " . ($_SESSION['current_question'] + 1)."/".$total_questions."</h2>";

        // Wyświetlamy pytanie i odpowiedzi.
        foreach ($questions as $question_id => $question_data) {
            echo "<p>" . $question_data['pytanie'] . "</p>";
            echo "<form method='post'>";
            echo "<ul class='choices'>";
            foreach ($question_data['odpowiedzi'] as $answer) {
                echo "<li><label><input type='radio' name='user_answers[$question_id]' value='" . $answer['id'] . "'>" . $answer['odpowiedz'] . "</label></li>";
            }
            echo "</ul>";
            echo '<input type="submit" name="next_question" value="Następne pytanie">';
            echo '</form>';
        }
    } else {
        echo "Nie wybrano kategorii.";  // Wyświetlenie informacji, jeśli kategoria nie została przekazana.
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