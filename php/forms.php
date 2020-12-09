<?php
    session_start();

    $_SESSION['pesquisa'] = $_POST['pesquisa'];

    header('Location: http://localhost/site/portarias');
?>