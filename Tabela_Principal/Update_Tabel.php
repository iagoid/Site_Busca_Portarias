<?php
			// DB table to use
$columns = array(
<<<<<<< HEAD
	array( 'db' => 'posicao', 'dt' => 0),
=======
	array( 'db' => 'classificacao', 'dt' => 0),
>>>>>>> 28f93e6cf3258222d6a579afe9ec776b65758d1d
	array( 'db' => 'numPort','dt' => 1),
	array( 'db' => 'conteudo', 'dt' => 2),
	array( 'db' => 'datePort', 'dt' => 3),
	array( 'db' => 'DocRelevante', 'dt' => 4),
	array( 'db' => 'nameDoc', 'dt' => 5),
<<<<<<< HEAD

	
=======
>>>>>>> 28f93e6cf3258222d6a579afe9ec776b65758d1d
	
);

$tabelaPrincipal = "../php/archives/arquivo.txt";
require( 'CarteiraSSp.php' );
echo json_encode(
	SSPCA::simpleCA( $_GET, $tabelaPrincipal, $columns )
);
?>
