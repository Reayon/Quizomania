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
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>Wybierz kategorie quizu:</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                    <?php
                        // Wyświetlenie dostępnych kategorii
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            $category_id = $row['ID_kategorii'];
                            $category_name = $row['nazwa'];
                            ?>
                            <tr>
                            <td><a href='quiz.php?category=<?php echo $category_id?>'>
                            <br><?php echo $category_name?></a></td>
                            </tr>
                            <?php
                            }
                        } else {
                            echo "Brak dostępnych kategorii.";
                        }
                        
                        $_SESSION['current_question'] = 0;
                        $_SESSION['score'] = 0;


                    ?>
                    </tr>
                    </tbody>
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