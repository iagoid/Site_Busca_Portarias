<?php
require_once 'dbconnect.php';
date_default_timezone_set('America/Sao_Paulo');

if(isset($_POST['btn-cadastrar'])){

    isset($_POST['pesquisa']) ? $pesquisa = $_POST['pesquisa'] : $pesquisa="Inexistente";
    isset($_POST['relevancia-1']) ? $doc1 = $_POST['relevancia-1'] : $doc1="Inexistente";
    isset($_POST['relevancia-2']) ? $doc2 = $_POST['relevancia-2'] : $doc2="Inexistente";
    isset($_POST['relevancia-3']) ? $doc3 = $_POST['relevancia-3'] : $doc3="Inexistente";
    isset($_POST['relevancia-4']) ? $doc4 = $_POST['relevancia-4'] : $doc4="Inexistente";
    isset($_POST['relevancia-5']) ? $doc5 = $_POST['relevancia-5'] : $doc5="Inexistente";
    isset($_POST['relevancia-6']) ? $doc6 = $_POST['relevancia-6'] : $doc6="Inexistente";
    isset($_POST['relevancia-7']) ? $doc7 = $_POST['relevancia-7'] : $doc7="Inexistente";
    isset($_POST['relevancia-8']) ? $doc8 = $_POST['relevancia-8'] : $doc8="Inexistente";
    isset($_POST['relevancia-9']) ? $doc9 = $_POST['relevancia-9'] : $doc9="Inexistente";
    isset($_POST['relevancia-10']) ? $doc10 = $_POST['relevancia-10'] : $doc10="Inexistente";
    $ip = $_SERVER['REMOTE_ADDR'];
    $horario = date('Y-m-d H:i');



    $sql = "INSERT INTO portarias (pesquisa, doc1, doc2, doc3, doc4, doc5, doc6, doc7, doc8, doc9, doc10, ip, horario) VALUES 
                        ('$pesquisa', '$doc1', '$doc2', '$doc3', '$doc4', '$doc5', '$doc6', '$doc7', '$doc8', '$doc9', '$doc10', '$ip', '$horario')";

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