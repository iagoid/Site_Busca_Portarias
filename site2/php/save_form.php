<?php
require_once 'dbconnect.php';

session_start();

date_default_timezone_set('America/Sao_Paulo');


    $pesquisa = $_SESSION['pesquisa'];
    $score = $_POST['score'];
    $url = $_POST['url'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $horario = date('Y-m-d H:i');
    

    $sql = "INSERT INTO portarias_sem_classificacao (pesquisa, score, urls, ip, horario) VALUES 
        ('$pesquisa', '$score', '$url', '$ip', '$horario')";

    if(mysqli_query($connect, $sql)){
        $_SESSION['mensagem'] = "Cadastrado com sucesso";
    }

    else{
        header('Location: http://localhost/site/site2/search');
        $_SESSION['mensagem'] = "Erro ao cadastrar";
    }
