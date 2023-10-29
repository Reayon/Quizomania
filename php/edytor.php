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
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: 800;
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
            font-size: 15px;
            background-color: #2980b9;
            font-family: 'Poppins', sans-serif;
        }

        .content-table tbody td{
            background: linear-gradient(120deg, #2980b9, #8e44ad);
            width: 100%;
            text-align: center;
            font-size: 20px;
            padding-bottom: 10px;
            font-weight: bold;
        }

        .content-table tbody td{
            color: white;
        }

        input[type="submit"]{
            width: 40%;
            height: 50px;
            border: 1px solid;
            background: #2691d9;
            border-radius: 25px;
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
            <h2>Lista Quizów</h2>
            <button><a style='color: black;' href='add.php'>Dodaj quiz</a></button>
            <div class="tabela">
                <table class="content-table">
                    <thead>
                        <tr>
                            <th scope="col">Nazwa</th>
                            <th scope="col">Edytuj</th>
                            <th scope="col">Usuń</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Wyświetlenie dostępnych kategorii
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            $category_id = $row['ID_kategorii'];
                            $category_name = $row['nazwa'];
                            echo "<tr>";
                            echo "<td><p>$category_name</p></td>";
                            echo "<td><a style='color: black;' href='edit.php?category=$category_id'>Edytuj </a></td>";
                            echo "<td><a style='color: black;' href='delete.php?category=$category_id'>Usuń </a></td>";
                            echo "</tr>";
                            }
                        } else {
                            echo "Brak dostępnych kategorii.";
                        }
                    ?>
                </table>
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