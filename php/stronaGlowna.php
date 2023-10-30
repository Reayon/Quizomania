<?php 
session_start();

	include("connection.php");
	include("function.php");

	$user_data = check_login($con);


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
$_SESSION['current_question'] = 0;
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="www.quizomania.pl">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styl.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
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
    display: flex;
    justify-content: center;
    text-align: center;
    background: white;
    overflow-y: scroll;
    max-height: 570px;
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
    display: block;
    background: linear-gradient(120deg, #2980b9, #8e44ad);
    width: 100%;
    text-align: center;
    font-size: 20px;
    padding-bottom: 20px;
    font-weight: bold;
    color: red;
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

.txt_field{
    font-family: 'Poppins', sans-serif;
}

.searchbar{
    width: 300px;
    height: 10px;
    background: rgba(255,255,0,0.2);
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 60px;
    padding: 20px;
    font-size: 15px;
    margin-top: 10px;
    margin-right: 50px;
    backdrop-filter: blur(4px) saturate(180%);
}

.searchbar button{
    display: block;
    border: 0;
    outline: none;
    font-size: 20px;
    color: #cac77c;
    font-family: 'Poppins', sans-serif;
}

.searchbar i {
   color: white;
   display: flex;
   justify-content: center;
}

.searchbar button[type="submit"]{
    border-radius: 30px;
    height: 50px;
    width: 30px;
    background: #58629b;
    cursor: pointer;
    margin-left: 10px;
}

.search{
    display: flex;
    flex-direction: row;
    justify-content: center;
}

.search h2{
    margin-right: 50px;
    margin-left: 75px;
}

.searchbar input img[type="submit"]{
    width: 5px;
    height: 5px;
}

</style>
    <script>
        // Opcjonalne: Jeśli chcesz umożliwić dynamiczne dostosowywanie wysokości tabeli na podstawie zawartości
        window.addEventListener('DOMContentLoaded', () => {
        const tableContainer = document.querySelector('.table-container');
        const table = document.querySelector('table');

        // Dostosuj maksymalną wysokość kontenera tabeli w zależności od zawartości
        tableContainer.style.maxHeight = (window.innerHeight - tableContainer.getBoundingClientRect().top) + 'px';
    });

    </script>
    <body>
        <header style="height: 100px">
			<img class="logo" src="../src/logo3.png" alt="logo">
				<nav>
					<ul class="nav_links">
						<li><a href="../php/stronaGlowna.php">Strona główna</a></li>
						<li><a href="onas.php" >O nas</a></li>
                        <li><a href="edytor.php" >Edytor Quizów</i></a></li>
                        <li><a href="#" >Witaj, <?php echo $user_data['username']; ?><i class="bi bi-person-fill"></i></a></li>
					</ul>
				</nav>
				<a class="cta" href="../php/logout.php"><button>Wyloguj sie</button></a>
		</header>
            <div style='height: 650px;' class="menu">
                <div class="search">
                    <h2>Lista Quizów</h2>
                    <div class="txt_field">
                        <form action="stronaGlowna.php" method="post" class="searchbar">
                        <input type="text" class="form-control" name="valueToSearch" placeholder="Wyszukaj swoją kategorie: "><br><br>
                        <button type="submit" value="" name="search"><i class="bi bi-search"></i></button>
                    </div>
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
			</footer>
    </body>
</html>