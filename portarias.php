<!doctype html>
<html lang="pt-br" style="overflow: hidden;">

<head>
  <!-- Required meta tags -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/sitStyle.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Buscador - Portarias</title>
  <link rel="stylesheet" href="css/development_style.css">

  <link rel="shortcut icon" href="img/logo_vertical.png" />

  <style>

  </style>
</head>
<header style="width: device-width ; max-height: 20vh;background-image: -webkit-gradient(linear,left top,right top,from(#fff),to(#ecedf1))">
  <img class="logoIfrs" src="img/header-default.png" style=" margin-left: 5vw;margin-top: 2.5vh">
  <div style="width:-device-width;min-height: 4vh;background-color: green ; margin-top: 1.5vh">
    <nav style="float: right; margin-top: 0.6vh">
      <ul class="menuTop">
        <li>
          <a href="https://ifrs.edu.br/">IFRS - Oficial</a>
        </li>
        <li>
          <a href="https://ifrs.edu.br/ibiruba/">IFRS - Campus Ibiruba</a>
        </li>
        <li>
          <a href="https://ibiruba.ifrs.edu.br/site/">Ibiruba - Site Antigo</a>
        </li>
      </ul>
    </nav>
  </div>
</header>

<body>

  <form enctype="multipart/form-data" action="php/forms2.php" method="post" id="formulario">
    <section class="container-fluid abresult" id="abresult" style="width: -device-width;max-height: 63vh;margin-top: 80px">
      <h3 id="results-search"> Resultados para:
        <?php
        session_start(); # Deve ser a primeira linha do arquivo
        echo $_SESSION['pesquisa'];
        ?>
      </h3>
      <table id="example" class="display" style="width:100%" data-page-length="25">
        <thead style="background-color: green;color: white; opacity: 0.2;">

          <tr style="text-align: center;">
            <th>Posicao</th>
            <th>Nº Portaria</th>
            <th>Resumo da Portaria</th>
            <th>Data</th>
            <th>Documento Relevante?</th>
            <th>PDF</th>
          </tr>
        </thead>
      </table>

      <button type="submit" class="btn btn-lg btn-block btn-green" id="form-button" name="btn-cadastrar">Concluir</button>
    </section>
  </form>


  <div class="my-modal modal-button" style="display: none;">
    <div class="modal-popup small-modal modal-bottom">
      <div class="modal-title">
        <h2>Fim das avaliações</h2>
        <label for="click" class="fas fa-times"></label>
      </div>
      <p>Após avaliar <b>todas</b> as portarias você deve clicar no botão concluir.</p>
      <div class="line"></div>
      <p class="touch-next">Clique aqui para fechar</p>
    </div>
  </div>


  <div class="my-modal modal-relevancia" style="display: none;">
    <div class="modal-popup small-modal modal-bottom modal-right">
      <div class="modal-title">
        <h2>Avaliações</h2>
        <label for="click" class="fas fa-times"></label>
      </div>
      <p>Após ler a portaria, avalie-a dizendo se o <b>documento é relevante</b> </p>
      <div class="line"></div>
      <p class="touch-next">Clique aqui para continuar</p>
    </div>
  </div>

  <div class="my-modal modal-pdf" style="display: none;">
    <div class="modal-popup small-modal modal-bottom modal-right-full">
      <div class="modal-title">
        <h2>PDF</h2>
        <label for="click" class="fas fa-times"></label>
      </div>
      <p>Para ver a portaria clique no icone do <b>PDF</b>, ele irá abrir a portaria em uma nova guia.</p>
      <div class="line"></div>
      <p class="touch-next">Clique aqui para continuar</p>
    </div>
  </div>

  <div class="my-modal modal-items" style="display: none;">
    <div class="modal-popup small-modal modal-top">
      <div class="modal-title">
        <h2>Itens</h2>
        <label for="click" class="fas fa-times"></label>
      </div>
      <p>Elas possuem 5 itens: o <b>Nº Portaria</b>, <b>Resumo</b>, <b>Data</b>, <b>Documento Relevante?</b> e o
        <b>PDF</b> </p>
      <div class="line"></div>
      <p class="touch-next">Clique aqui para continuar</p>
    </div>
  </div>

  <div class="my-modal">
    <div class="modal-popup small-modal modal-bottom">
      <div class="modal-title">
        <h2>Busca Completa</h2>
        <label for="click" class="fas fa-times"></label>
      </div>
      <p>Aqui estão as portarias que você pesquisou!</p>
      <div class="line"></div>
      <p class="touch-next">Clique aqui para continuar</p>
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