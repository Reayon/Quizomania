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

// Rozpoczęcie lub odzyskanie sesji
session_start();

// Przetwarzanie formularza dodawania pytania
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_question'])) {
    $category_id = $_POST['category_id'];
    $question_text = $_POST['question_text'];

    // Dodawanie pytania do bazy danych
    $query = "INSERT INTO pytania (id_kategorii, tresc) VALUES ('$category_id', '$question_text')";
    $conn->query($query) or die($conn->error);

    $question_id = $conn->insert_id; // Pobranie identyfikatora dodanego pytania

    // Dodawanie odpowiedzi do bazy danych
    $correct_answer_text = $_POST['correct_answer'];
    $incorrect_answers = $_POST['incorrect_answers'];

    // Dodawanie poprawnej odpowiedzi
    $query = "INSERT INTO odpowiedzi (id_pytania, odp, czy_poprawna) VALUES ('$question_id', '$correct_answer_text', 1)";
    $conn->query($query) or die($conn->error);

    // Dodawanie błędnych odpowiedzi
    foreach ($incorrect_answers as $incorrect_answer) {
        $query = "INSERT INTO odpowiedzi (id_pytania, odp, czy_poprawna) VALUES ('$question_id', '$incorrect_answer', 0)";
        $conn->query($query) or die($conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="www.quizomania.pl">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styl.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../src/logo3.png">
        <title>Quizomania</title>
    </head>
    
    <style>

        .tabela{
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
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
            font-size: 20px;
        }

        .content-table a:hover{
            transition: .5s;
            border-color: #2691d9;
        }

        .content-table a:visited{
            transition: .5s;
            border-color: #2691d9;
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
        
    </style>
<body>
    <header style="height: 125px">
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
            <div style='height: 600px;' class="menu">
                <h2>Lista Quizów</h2>
                <div class="tabela">
                <!---<form>
                    <div class="txt_field">
                        <input type="text" class="form-control" placeholder="Wyszukaj po nazwie" name="search" value="<?php echo $search ?>">
                    </div>
                </form> -->
                <h2>Dodaj pytanie do kategorii:</h2>
    <form method="post">
        <select name="category_id">
            <!-- Wypełnij listę dostępnymi kategoriami z bazy danych -->
            <?php
            $query = "SELECT * FROM kategorie";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_kategorii'] . "'>" . $row['nazwa_kategorii'] . "</option>";
            }
            ?>
        </select>
        <br>
        Pytanie: <input type="text" name="question_text" required>
        <br>
        Poprawna odpowiedź: <input type="text" name="correct_answer" required>
        <br>
        Błędne odpowiedzi (oddzielone przecinkiem): <input type="text" name="incorrect_answers" required>
        <br>
        <input type="submit" name="add_question" value="Dodaj pytanie">
    </form>
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