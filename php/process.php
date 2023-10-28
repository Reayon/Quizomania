<?php session_start(); 

	include("connection.php");
	include("function.php");

	$user_data = check_login($con);
    //Check to see if score is set_error_handler
    if(!isset($_SESSION['score'])){
        $_SESSION['score'] = 0;
    }


    if($_POST){
        $number = $_POST['id_pytania'];
        $selected_choice = $_POST['odp'];
        $next = $number+1;
        /*
        *   Get correct choice
        */
        $query = "SELECT * FROM odpowiedzi WHERE id_odpowiedzi = $number AND czy_poprawna = 1";

        // Get result
        $result = $mysqli->query($query) or die($mysqli->error.__LINE__);

        // Get row
        $row = $result->fetch_assoc();

        // Set correct choice
        $correct_choice = $row['id'];

        // Compare
        if($correct_choice == $selected_choice)
        {
            //Anwser is correct
            $_SESSION['score']++;
        }

        // Check if last question
        if($number == $total){
            header("Location: ../php/final.php");
            exit();
        } else {
            header("Location: ../php/quiz.php?n=".$next);
        }
    }

