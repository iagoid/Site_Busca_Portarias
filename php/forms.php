<?php
require_once 'dbconnect.php';
    date_default_timezone_set('America/Sao_Paulo');

   
    if(isset($_POST['btn-cadastrar'])){
        $pesquisa = $_POST['pesquisa'];
        $objetivo = $_POST['objetivo'];
        $score = $_POST['score'];
        $urls = $_POST['urls'];
        $relevantes = $_POST['relevantes'];
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $horario = date('Y-m-d H:i');
        

        for ($i=0; $i < sizeof($urls); $i++) { 
            $sql = "INSERT INTO portarias (pesquisa, score, urls, relevante, ip, horario, objetivo) VALUES 
                ('$pesquisa', '$score[$i]', '$urls[$i]', '$relevantes[$i]', '$ip', '$horario', '$objetivo')";

            if(mysqli_query($connect, $sql)){
                $_SESSION['mensagem'] = "Cadastrado com sucesso";
                header('Location: ../index.html');
            }
            else{
                header('Location: ../index.php');
                $_SESSION['mensagem'] = "Erro ao cadastrar";

            }
        }
    }


    // Pegar dados da pesquisa
    session_start();

    $_SESSION['pesquisa'] = $_POST['pesquisa'];;

    header('Location: http://localhost/site/portarias');
?>