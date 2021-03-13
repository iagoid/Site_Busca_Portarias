<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
    integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Buscador - Portarias</title>

  <link rel="stylesheet" href="css/development_style.css">

  <link rel="shortcut icon" href="img/logo_vertical.png" />

</head>
<header>
  <img class="logoIfrs" src="img/header-default.png">
  <div class="header-links">
    <nav>
      <ul class="menuTop">
        <li>
          <a href="https://ifrs.edu.br/">IFRS - Oficial</a>
        </li>
        <li>
          <a href="https://ifrs.edu.br/ibiruba/">IFRS - Campus Ibirubá</a>
        </li>
        <li>
          <a href="https://ibiruba.ifrs.edu.br/site/">Ibirubá - Site Antigo</a>
        </li>
      </ul>
    </nav>
  </div>
</header>

<body>
  <section class="container-fluid abresult">
    <div class="header-portarias">
      <div>
        <h3 id="results-search"> Resultados para:
          <?php
          session_start();
          echo $_SESSION['pesquisa'];
          ?>
        </h3>
      </div>
      <div>

        <a href="../site2/search.html" class="btn btn-green">Realizar outra pesquisa</a>
      </div>
    </div>

    <table id="example" class="display" style="width:100%" data-page-length="25">
      <thead style="background-color: green;color: white;">

        <tr style="text-align: center;">
          <th>Posição</th>
          <th>Nº Portaria</th>
          <th>Resumo da Portaria</th>
          <th>Data</th>
          <th>PDF</th>
        </tr>
      </thead>
    </table>

    <i class="fas fa-question-circle btn-help">
      <span class="tooltiptext">Ajuda</span>
    </i>

  </section>

  <div class="my-modal  modal-help">
    <div class="modal-popup big-modal">
      <div class="modal-title">
        <h2>Ajuda</h2>
        <label for="click" class="fas fa-times close_portarias"></label>
      </div>
      <p>Aqui estão as portarias encontradas a partir da sua busca.

        Os resultados estão apresentados em uma tabela com 4 colunas: o <b>Nº Portaria</b>, <b>Resumo</b>, <b>Data</b> e o
        <b>PDF</b>.
      </p>
      <p> Para visualizar a portaria, clique no ícone de <b>PDF</b> (última coluna), que o documento original com a portaria será aberto em uma nova guia.</p>

      </p>
      <div class="line"></div>
      <p class="touch-next">Clique aqui para fechar</p>
    </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.xml4jquery.com/ajax/libs/xml4jquery/1.1.2/xml4jquery.js"></script>
  <script type="text/javascript" src="js/development_scripts.js"></script>
</body>

</html>