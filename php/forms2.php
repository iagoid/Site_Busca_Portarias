<?php

    session_start();

    $_SESSION['score'] = $_POST['score'];
    $_SESSION['urls'] = $_POST['urls'];
    $_SESSION['relevantes'] = $_POST['relevantes'];

?>