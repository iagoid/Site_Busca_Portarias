<?php
// Conexão
include_once 'php/dbconnect.php';
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Buscador - Portarias</title>
</head>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Pesquisa</th>
                <th scope="col">Score</th>
                <th scope="col">URL</th>
                <th scope="col">Relevante?</th>
                <th scope="col">IP</th>
                <th scope="col">Horário</th>
                <th scope="col">Objetivo</th>
            </tr>
        </thead>


        <tbody>
            <tr>
                <?php
                $sql = "SELECT * FROM portarias";
                $resultado = mysqli_query($connect, $sql);
                if (mysqli_num_rows($resultado) > 0) :
                    while ($dados = mysqli_fetch_array($resultado)) :
                ?>
                        <td><?php echo $dados['pesquisa']; ?></td>
                        <td><?php echo $dados['score']; ?></td>
                        <td><a href="<?php echo $dados['urls']; ?>" target="_blank">Link</a></td>
                        <td><?php echo $dados['relevante']; ?></td>
                        <td><?php echo $dados['ip']; ?></td>
                        <td><?php echo $dados['horario']; ?></td>
                        <td><?php echo $dados['objetivo']; ?></td>
            </tr>
        <?php
                    endwhile;
                else : ?>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    <?php endif; ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>