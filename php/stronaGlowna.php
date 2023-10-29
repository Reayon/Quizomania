<?php 
session_start();

	include("connection.php");
	include("function.php");

	$user_data = check_login($con);

<<<<<<< HEAD
// Zapytanie do bazy danych w celu pobrania kategorii
$query = "SELECT * FROM kategorie";
$result = $conn->query($query);
=======

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `kategorie` WHERE nazwa LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM kategorie";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "quizy");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
>>>>>>> 0a3808b643d217b4a39fee673a3546afab1c5345
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
<<<<<<< HEAD
    <link rel="icon" type="image/x-icon" href="../src/logo3.ico">
        <title>Quizomania</title>
    </head>
    <body>
    <header>
			<img class="logo" src="../src/logo3.png" alt="logo">
=======
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
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
        <header style="height: 125px">
			<img class="logo" src="../src/logoquiz.png" alt="logo">
>>>>>>> 0a3808b643d217b4a39fee673a3546afab1c5345
				<nav>
					<ul class="nav_links">
						<li><a href="../php/stronaGlowna.php">Strona główna</a></li>
						<li><a href="#" >O nas</a></li>
                        <li><a href="edit.php" >Edytor<i class="bi bi-pencil-fill"></i></a></li>
                        <li><a href="#" >Witaj, <?php echo $user_data['username']; ?><i class="bi bi-person-fill"></i></a></li>
					</ul>
				</nav>
				<a class="cta" href="../php/logout.php"><button>Wyloguj sie</button></a>
		</header>
<<<<<<< HEAD
        <div class="menu">
=======
            <div style='height: 600px;' class="menu">
                <h2>Lista Quizów</h2>
>>>>>>> 0a3808b643d217b4a39fee673a3546afab1c5345
                <!---<form>
                    <div class="txt_field">
                        <input type="text" class="form-control" placeholder="Wyszukaj po nazwie" name="search_term" value="<?php echo $search ?>">
                    </div>
                </form>--->
<<<<<<< HEAD
                <h2>Lista Quizów</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nazwa</th>
                            <th scope="col"></th>
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
                            echo "<td><a style='color: black;' href='quiz.php?category=$category_id'>Rozpocznij quiz</a></td>";
                            echo "</tr>";
                            }
                        } else {
                            echo "Brak dostępnych kategorii.";
                        }
                    ?>
                    </table>
                </div>
                <footer>
            	<div class="footer-bottom">
					<h2>Quizomania</h2>
						Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone.
				</div>
=======
                <div class="txt_field">
                    <form action="stronaGlowna.php" method="post">
                    <input type="text" class="form-control" name="valueToSearch" placeholder="Value To Search"><br><br>
                    <input type="submit" name="search" value="Filter"><br><br>
                </div>
                <div class="tabela">
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>Wybierz kategorie quizu:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_array($search_result)):
                                $category_id = $row['ID_kategorii'];
                                $category_name = $row['nazwa'];?>
                                <tr>
                                <td><a href='quiz.php?category=<?php echo $category_id?>'>
                                <br><?php echo $category_name?></a></td>
                                </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <footer>
                <div class="footer-bottom">
                    <h2>Quizomania</h2>
                        Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone.
                </div>
>>>>>>> 0a3808b643d217b4a39fee673a3546afab1c5345
			</footer>
    </body>
</html>