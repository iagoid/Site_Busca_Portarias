<?php
require_once 'dbconnect.php';


    $score = $_POST['score'];
    $urls = $_POST['urls'];
    $relevantes = $_POST['relevantes'];

    isset($_POST['pesquisa']) ? $pesquisa = $_POST['pesquisa'] : $pesquisa="Inexistente";
    $ip = $_SERVER['REMOTE_ADDR'];
    $horario = date('Y-m-d H:i');
    isset($_POST['objetivo']) ? $objetivo = $_POST['objetivo'] : $objetivo="Não relatado";
    

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
?>