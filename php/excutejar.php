<?php

$palavra = isset($_POST['wrdConsult']) ? $palavra = $_POST['wrdConsult'] : $palavra = 'comissão de avaliação e gestão de projetos';

if ($palavra != null) {
	unset($arrayDados);
	$classificacao = 1;
	$arrayDados = array();
	putenv('LANG=en_US.UTF-8');
	$shell = exec('java -jar "C://Users//Igor//Documents//NetBeansProjects//PROJETO_BUSCADOR-PORTARIAS-//Buscador_Portarias//dist//Buscador_Portarias.jar" -query "' . trim($palavra) . '"', $saida);
	// $shell = exec('java -jar "/var/www/Buscador_Portarias/dist/Buscador_Portarias.jar" -query "'.trim($palavra).'"' , $saida);
	$quantidade = count($saida);
	// var_dump($saida);


	// Ignorando stopwords
	$busca_separada = explode(' ', $palavra);
		
	$txtStopWords = file("../php/archives/stopwords.txt");
	foreach($txtStopWords as $linha){
		$linha = trim($linha);
		$stopWords[] = $linha;
	}
	$termosDestaque = array_diff($busca_separada, $stopWords);

	for ($i = 0; $i < $quantidade; $i++) {
		// var_dump($saida[$i]);

		$json = json_decode(utf8_encode($saida[$i])); // Usar esse no localhost
		//$json = json_decode($saida[$i]); // Usar esse na AWS
		$jsonCount = (is_array($json) ? count($json) : 0);
		if ($jsonCount > 0) {
			foreach ($json as $key => $value) {
				$arrayDados[$key]['posicao'] = $classificacao;
				$arrayDados[$key]['datePort'] = str_replace("\/", "-", $value->datePort);
				if ($value->numPort > 0) {
					$arrayDados[$key]['numPort'] = $value->numPort;
				} else {
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

				do {
					$conteudo = str_replace("  ", " ", $conteudo);
					$conteudo = str_replace(",,", " ", $conteudo);
					$conteudo = str_replace(", ,", " ", $conteudo);
				} while (strripos($conteudo, "  "));


				// Separando nas possveis ocorrencias
				$posicao = 0;
				

				foreach ($busca_separada as $palavra1) {
					foreach ($busca_separada as $palavra2) {
						$posicao = strripos($conteudo, $palavra1 . " " . $palavra2);
						if ($posicao > 0) {
							break 2;
						}
					}
				}

				if ($posicao <= 0) {
					foreach ($busca_separada as $palavra) {
						$posicao = strripos($conteudo, $palavra);
						if ($posicao > 0) {
							break;
						}
					}
				}

				$posicao = $posicao > 0 ? $posicao : 1;

				// Dividindo o texto que irá aparecer
				$conteudoB = " ";
				$tamanho = strlen($conteudo);
				if ($tamanho - $posicao > 500) {
					$tamanho = 500;
				} else {
					$conteudoB =  substr($conteudo, $posicao - 1, $tamanho) . "...";
					$tamanho = 500 - strlen($conteudoB);
					$posicao = 1;
				}

				$conteudoSeparado =  substr($conteudo, $posicao - 1, $tamanho) . "...";
				$conteudoSeparado = mb_convert_encoding($conteudoSeparado . $conteudoB, "UTF-8", "auto");

				// Destacar termos pesquisados
				$busca_strong = [];

				foreach ($termosDestaque as $busca) {
					$busca_strong[] = "<strong> " . mb_strtoupper ($busca) . " </strong>";
				}
				var_dump($busca_strong);

				$conteudoSeparado = str_ireplace($termosDestaque, $busca_strong, $conteudoSeparado);

				$arrayDados[$key]['conteudo'] = $conteudoSeparado;
			}
		}
	}
	// var_dump($arrayDados);


	$stringarray = json_encode($arrayDados);
	// var_dump($stringarray);
	unlink("" . __DIR__ . "/archives/arquivo.txt");
	$arquivo = fopen("" . __DIR__ . "/archives/arquivo.txt", "w+");
	fwrite($arquivo, $stringarray);
	fclose($arquivo);

	echo "true";
}
