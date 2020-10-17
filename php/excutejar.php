<?php

$palavra = isset($_POST['wrdConsult']) ? $palavra = $_POST['wrdConsult'] : $palavra = 'silva';

if ($palavra != null) {
	unset($arrayDados);
	$arrayDados = array();
	$shell = exec('java -jar "C:\Users\Igor\Documents\NetBeansProjects\PROJETO_BUSCADOR-PORTARIAS-\Buscador_Portarias\dist\Buscador_Portarias.jar" -query "'.trim($palavra).'"' , $saida);
	$quantidade = count($saida);
	var_dump($saida);
	
	for ($i=0; $i < $quantidade; $i++) {
		// var_dump($saida[$i]);
		
		$json = json_decode(mb_convert_encoding($saida[$i], "UTF-8", "auto"));
		var_dump($json);
		// var_dump(utf8_encode($saida[1]));
		// echo"<br><br>";
		// exit();
		// die();
		$jsonCount = (is_array($json) ? count($json) : 0);
		if ($jsonCount > 0) {
			foreach ($json as $key => $value) {	
				$arrayDados[$key]['datePort'] = str_replace("\/", "-", $value->datePort) ;
				if ($value->numPort > 0) {
					$arrayDados[$key]['numPort'] = $value->numPort;
				}else{
					$arrayDados[$key]['numPort'] = 00000;
				}
				// $arrayDados['numPort'][] = $value->numPort;
				$arrayDados[$key]['nameDoc'] = $value->nameDoc;
				// $arrayDados[$key]['conteudo'] = $value->conteudo;
			}
		}
	}

	$stringarray = json_encode($arrayDados);
	// var_dump($stringarray);
	unlink("".__DIR__."/archives/arquivo.txt");
	$arquivo = fopen("".__DIR__."/archives/arquivo.txt", "w+");
	fwrite($arquivo, $stringarray);
	fclose($arquivo);

	echo "true";

}