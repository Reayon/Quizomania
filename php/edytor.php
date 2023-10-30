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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../src/logo3.png">
        <title>Quizomania</title>
    </head>

    <script>
        // Opcjonalne: Jeśli chcesz umożliwić dynamiczne dostosowywanie wysokości tabeli na podstawie zawartości
        window.addEventListener('DOMContentLoaded', () => {
            const tableContainer = document.querySelector('.table-container');
            const table = document.querySelector('table');

            // Dostosuj maksymalną wysokość kontenera tabeli w zależności od zawartości
            tableContainer.style.maxHeight = (window.innerHeight - tableContainer.getBoundingClientRect().top) + 'px';
        });
    </script>
    <style>

         /* MENU - div srodka strony */ 

        .menu{
            display: inline-block;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .menu p{
            font-weight: 500px;
        }

        .title{
            border-bottom: 1px solid black;
        }

        /* TABELA - div odpowiedający za tabele po stronie prawej */

        .tabela{
            text-align: center;
            width: 50%;
            float: right;
            overflow-y: scroll;
            max-height: 520px;
        }
    
        .tabela p{
            font-weight: 50px;
        }


        /* CRUD - ciało tabeli do edycji */

        .crud{
            border-collapse: collapse;
            margin: 25px, 0;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            text-align: center;
            margin-left: 125px;
        }

        .crud h2{
            height: 50px;
            text-align: center;
        }

        .crud thead tr{
            background-color: #b3b3b3;
            height: 50px;
            color: black;
            text-align: center;
            font-weight: bold;
        }

        .crud th{
            font-size: 20px;
        }

        .crud td{
            padding: 12px, 15px;
        }

        .crud tbody tr{
            border-bottom: 1px solid black;
        }

        .crud tbody tr:nth-of-type(even){
            background-color: f3f3f3;
        }

        .crud tbody tr:last-of-type{
            border-bottom: 1px solid #737373;
        }

        /* DODAJ QUIZ - osobny div lewy */

        .dodajquiz{
            display: inline-block;
            float: left;
            width: 50%;
            height: auto;
        }

        .dodajquiz button{
            width: 300px;
            height: 50px;
            border: 1px solid;
            background: #2691d9;
            border-radius: 25px;
            margin-left: 5px;
            outline: none;
            cursor: pointer;
        }

        .dodajquiz button:hover{
            border-color: #2691d9;
            transition: .5s;
        }


    </style>
    <body>
        <header style="height: 90px">
           <img class="logo" src="../src/logo3.png" alt="logo">
				<nav>
					<ul class="nav_links">
							<li><a href="../php/stronaGlowna.php">Strona główna</a></li>
                            <li><a href="../php/edytor.php" >Edytor quizów</a></li>
							<li><a href="onas.php" >O nas</a></li>
                            <li><a href="#" >Witaj, <?php echo $user_data['username']; ?><i class="bi bi-person-fill"></i></a></li>
					</ul>
				</nav>
				<a class="cta" href="../php/logout.php"><button>Wyloguj sie</button></a>
	    </header>
        <div style="height: 730px" class="menu">
        <div class="title">
            <h2>EDYTOR QUIZÓW</h2>
            <p style="color:red">UWAGA: zanim usuniesz kategorie musisz usunąć związane z nią pytania i odpowiedzi!!!</p>
        </div>
            <div class="dodajquiz">
                <h2>Kreator kategorii:</h2>
                <p>Gotów na tworzenie ciekawych kategorii?</p> 
                <p>Zacznij teraz!</p>
                <br><br>
            <button onclick="location.href='add.php'" type="button">Zaczynamy</button>
            </div>
            <h2> Lista już dodanych quizów: </h2>
            <div class="tabela">
                <table class="crud">
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