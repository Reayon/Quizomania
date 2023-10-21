<?php 
session_start();

	include("connection.php");
	include("function.php");

	$user_data = check_login($con);
?>
<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=quizy', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$search = $_GET['search'] ?? '';
if ($search) {
    $statement = $pdo->prepare('SELECT * FROM kategorie WHERE nazwa LIKE :nazwa');
    $statement->bindValue(':nazwa', "%$search%");
}
else{
    $statement = $pdo->prepare('SELECT * FROM kategorie ORDER BY nazwa');
}
$statement->execute();
$kategorie = $statement->fetchAll(PDO::FETCH_ASSOC);
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
                <form>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Wyszukaj po nazwie" name="search" value="<?php echo $search ?>">
                        <button class="btn btn-outline-secondary" type="submit">Wyszukaj</button>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nr</th>
                            <th scope="col">Nazwa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($kategorie as $i => $kategoria) { ?>
                        <tr>
                            <th scope="row"><?php echo $i + 1 ?></th>
                            <td><?php echo $kategoria['nazwa'] ?></td>
                            <td>
                                    <a href="../php/quiz.php?id=<?php echo $kategoria['ID_kategorii'] ?>" class="btn btn-sm btn-outline-primary">
                                    <button class="button-3" role="button">Rozpocznij quiz</button></a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div id="footer">Filip B, Dawid C, Piotr K <br> &copy; Wszelkie prawa zastrzeżone</div>
        </div>
    </body>
</html>