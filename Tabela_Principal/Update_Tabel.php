<?php
			// DB table to use
$columns = array(
	array( 'db' => 'classificacao', 'dt' => 0),
	array( 'db' => 'numPort','dt' => 1),
	array( 'db' => 'conteudo', 'dt' => 2),
	array( 'db' => 'datePort', 'dt' => 3),
	array( 'db' => 'DocRelevante', 'dt' => 4),
	array( 'db' => 'nameDoc', 'dt' => 5),
	
);

$tabelaPrincipal = "../php/archives/arquivo.txt";
require( 'CarteiraSSp.php' );
echo json_encode(
	SSPCA::simpleCA( $_GET, $tabelaPrincipal, $columns )
);
?>
