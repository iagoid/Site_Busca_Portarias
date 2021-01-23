<?php

$palavra = isset($_POST['wrdConsult']) ? $palavra = $_POST['wrdConsult'] : $palavra = 'Edimar manica 2020';

if ($palavra != null) {
	unset($arrayDados);
	$classificacao = 1;
	$arrayDados = array();
	putenv('LANG=en_US.UTF-8');
	$shell = exec('java -jar "C://Users//Igor//Documents//NetBeansProjects//PROJETO_BUSCADOR-PORTARIAS-//Buscador_Portarias//dist//Buscador_Portarias.jar" -query "'.trim($palavra).'"' , $saida);
	// $shell = exec('java -jar "/var/www/Buscador_Portarias/dist/Buscador_Portarias.jar" -query "'.trim($palavra).'"' , $saida);
	$quantidade = count($saida);
	// var_dump($saida);
	
	for ($i=0; $i < $quantidade; $i++) {
		// var_dump($saida[$i]);
		
		$json = json_decode(utf8_encode($saida[$i])); // Usar esse no localhost
		//$json = json_decode($saida[$i]); // Usar esse na AWS
		// var_dump($json);
		// var_dump(utf8_encode($saida[1]));
		// echo"<br><br>";
		// exit();
		// die();
		$jsonCount = (is_array($json) ? count($json) : 0);
		if ($jsonCount > 0) {
			foreach ($json as $key => $value) {	
				$arrayDados[$key]['posicao'] = $classificacao;
				$arrayDados[$key]['datePort'] = str_replace("\/", "-", $value->datePort) ;
				if ($value->numPort > 0) {
					$arrayDados[$key]['numPort'] = $value->numPort;
				}else{
					$arrayDados[$key]['numPort'] = 00000;
				}
				$url = $value->nameDoc;
				$arrayDados[$key]['nameDoc'] = $url;

				$arrayDados[$key]['DocRelevante'] = 
					"<select class='relevancia' name='relevancia-$classificacao' id='relevancia-$classificacao' required>
							<option></option>
							<option value='sim'>Sim</option>
							<option value='nao'>Não</option>
					</select>";
				$classificacao++;


				$conteudo = $value->conteudo;
				$conteudo = str_replace(",,", " ", $conteudo);
				$conteudo = str_replace(", ,", " ", $conteudo);
				$conteudo = str_replace(",  ,", " ", $conteudo);
				$conteudo = str_replace(",   ,", " ", $conteudo);
				$conteudo = str_replace(",    ,", " ", $conteudo);
				
				$busca_separada = explode(' ', $palavra);

				$posicao = strripos($conteudo, $busca_separada[0]);
				$posicao = $posicao > 0 ? $posicao : 1;
				var_dump($posicao);

				// $conteudoSeparado =  substr($conteudo, $posicao, 500);
				$tamanho = strlen($conteudo);
				if ($tamanho > 500){
					$tamanho = 500;
				} 
				$conteudoSeparado =  substr($conteudo, $posicao-1, $tamanho).trim("...");
				$conteudoSeparado = mb_convert_encoding($conteudoSeparado, "UTF-8", "auto");


				// Destacar termos pesquisados
				foreach($busca_separada as $busca){
					if (stripos($conteudoSeparado, $busca)) {
						$posicao = strripos($conteudoSeparado, $busca);
						// var_dump($conteudoSeparado);
						// var_dump($posicao);
						$conteudoSeparado = substr_replace($conteudoSeparado, '</strong>', $posicao + strlen($busca), 0);
						$conteudoSeparado = substr_replace($conteudoSeparado, '<strong>', $posicao, 0);
					}
				}
				
				
				$arrayDados[$key]['conteudo'] = $conteudoSeparado;
			}
		}
	}
	// var_dump($arrayDados);


	$stringarray = json_encode($arrayDados);
	// var_dump($stringarray);
	unlink("".__DIR__."/archives/arquivo.txt");
	$arquivo = fopen("".__DIR__."/archives/arquivo.txt", "w+");
	fwrite($arquivo, $stringarray);
	fclose($arquivo);

	echo "true";

}